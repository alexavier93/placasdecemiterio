<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ModeloController extends Controller
{
    private $modelo;

    public function __construct(Modelo $modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelos = $this->modelo->paginate(10);

        return view('admin.modelos.index', compact('modelos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modelos.create');
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

        $image = $request->file('image')->store('modelos', 'public');
        $data['image'] = $image;

        // Redimensionando a imagem
        $image = Image::make(public_path("storage/{$image}"))->fit(800, 347);
        $image->save();

        $this->modelo->create($data);

        flash('Modelo criado com sucesso!')->success();
        return redirect()->route('admin.modelos.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($modelo)
    {
        $modelo = $this->modelo->findOrFail($modelo);
        return view('admin.modelos.edit', compact('modelo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $modelo)
    {
        $data = $request->all();

        $modelo = $this->modelo->find($modelo);

        if ($request->hasFile('image')) {

            if (Storage::exists($modelo->image)) {
                Storage::delete($modelo->image);
            }

            $image = $request->file('image')->store('modelos', 'public');
            $data['image'] = $image;

            // Redimensionando a imagem
            $image = Image::make(public_path("storage/{$image}"))->fit(800, 347);
            $image->save();
        }

        $modelo->update($data);

        flash('Modelo atualizado com sucesso!')->success();
        return redirect()->route('admin.modelos.index');
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

        $modelo = $this->modelo->find($id);

        if ($modelo->delete() == TRUE) {
            if (Storage::exists($modelo->image)) {
                Storage::delete($modelo->image);
            }
        }

        flash('Modelo removido com sucesso!')->success();
        return redirect()->route('admin.modelos.index');
    }
}
