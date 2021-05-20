<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fonte;
use App\Models\Fundo;
use App\Models\Modelo;
use App\Models\Moldura;
use App\Models\Placa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PlacaController extends Controller
{
    private $placa;

    public function __construct(Placa $placa)
    {
        $this->placa = $placa;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $placas = $this->placa->paginate(10);

        return view('admin.placas.index', compact('placas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $modelos = Modelo::all();
        $molduras = Moldura::all();
        $fundos = Fundo::all();
        $fontes = Fonte::all();
        
        return view('admin.placas.create', compact('modelos', 'molduras', 'fundos', 'fontes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['price'] = str_replace(',', '.', $request->price);
        $data['height'] = str_replace(',', '.', $request->height);
        $data['width'] = str_replace(',', '.', $request->width);
        $data['length'] = str_replace(',', '.', $request->length);
        $data['weight'] = str_replace(',', '.', $request->weight);

        $image = $request->file('image')->store('placas', 'public');
        $data['image'] = $image;

        // Redimensionando a imagem
        $image = Image::make(public_path("storage/{$image}"))->fit(800, 347);
        $image->save();

        $placa = $this->placa->create($data);
        $placa->modelos()->sync($data['modelos']);
        $placa->molduras()->sync($data['molduras']);
        $placa->fundos()->sync($data['fundos']);

        flash('Placa criada com sucesso!')->success();
        return redirect()->route('admin.placas.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($placa)
    {

        $modelos = Modelo::all();
        $molduras = Moldura::all();
        $fundos = Fundo::all();
        $fontes = Fonte::all();

        $placa = $this->placa->findOrFail($placa);
        return view('admin.placas.edit', compact('placa', 'modelos', 'molduras', 'fundos', 'fontes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $placa)
    {
        $data = $request->all();

        $placa = $this->placa->find($placa);

        $data['price'] = str_replace(',', '.', $request->price);
        $data['height'] = str_replace(',', '.', $request->height);
        $data['width'] = str_replace(',', '.', $request->width);
        $data['length'] = str_replace(',', '.', $request->length);
        $data['weight'] = str_replace(',', '.', $request->weight);

        if ($request->hasFile('image')) {

            if (Storage::exists($placa->image)) {
                Storage::delete($placa->image);
            }

            $image = $request->file('image')->store('placas', 'public');
            $data['image'] = $image;

            // Redimensionando a imagem
            $image = Image::make(public_path("storage/{$image}"))->fit(800, 347);
            $image->save();
        }

        $placa->update($data);
        $placa->modelos()->sync($data['modelos']);
        $placa->molduras()->sync($data['molduras']);
        $placa->fundos()->sync($data['fundos']);
        $placa->fontes()->sync($data['fontes']);

        flash('Placa atualizada com sucesso!')->success();
        return redirect()->route('admin.placas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete(Request $request)
    {
        $id = $request->id;

        $placa = $this->placa->find($id);

        if ($placa->delete() == TRUE) {
            if (Storage::exists($placa->image)) {
                Storage::delete($placa->image);
            }
        }

        flash('Placa removida com sucesso!')->success();
        return redirect()->route('admin.placas.index');
    }
}
