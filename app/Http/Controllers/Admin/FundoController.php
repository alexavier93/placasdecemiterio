<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fundo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FundoController extends Controller
{
    private $fundo;

    public function __construct(Fundo $fundo)
    {
        $this->fundo = $fundo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fundos = $this->fundo->paginate(10);

        return view('admin.fundos.index', compact('fundos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fundos.create');
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

        $image = $request->file('image')->store('fundos', 'public');
        $data['image'] = $image;

        // Redimensionando a imagem
        $image = Image::make(public_path("storage/{$image}"))->fit(300, 300);
        $image->save();

        $this->fundo->create($data);

        flash('Fundo criado com sucesso!')->success();
        return redirect()->route('admin.fundos.index');

    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($fundo)
    {
        $fundo = $this->fundo->findOrFail($fundo);
        return view('admin.fundos.edit', compact('fundo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fundo)
    {
        $data = $request->all();

        $fundo = $this->fundo->find($fundo);

        if ($request->hasFile('image')) {

            if (Storage::exists($fundo->image)) {
                Storage::delete($fundo->image);
            }

            $image = $request->file('image')->store('fundos', 'public');
            $data['image'] = $image;

            // Redimensionando a imagem
            $image = Image::make(public_path("storage/{$image}"))->fit(300, 300);
            $image->save();
        }

        $fundo->update($data);

        flash('Fundo atualizado com sucesso!')->success();
        return redirect()->route('admin.fundos.index');
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

        $fundo = $this->fundo->find($id);

        if ($fundo->delete() == TRUE) {
            if (Storage::exists($fundo->image)) {
                Storage::delete($fundo->image);
            }
        }

        flash('Fundo removido com sucesso!')->success();
        return redirect()->route('admin.fundos.index');
    }
}
