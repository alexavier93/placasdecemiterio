<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Moldura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MolduraController extends Controller
{

    private $moldura;

    public function __construct(Moldura $moldura)
    {
        $this->moldura = $moldura;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $molduras = $this->moldura->paginate(10);

        return view('admin.molduras.index', compact('molduras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.molduras.create');
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

        $image = $request->file('image')->store('molduras', 'public');
        $data['image'] = $image;

        // Redimensionando a imagem
        $image = Image::make(public_path("storage/{$image}"))->fit(500, 350);
        $image->save();

        $this->moldura->create($data);

        flash('Moldura Criada com Sucesso!')->success();
        return redirect()->route('admin.molduras.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($moldura)
    {
        $moldura = $this->moldura->findOrFail($moldura);
        return view('admin.molduras.edit', compact('moldura'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $moldura)
    {
        $data = $request->all();

        $moldura = $this->moldura->find($moldura);

        if ($request->hasFile('image')) {

            if (Storage::exists($moldura->image)) {
                Storage::delete($moldura->image);
            }

            $image = $request->file('image')->store('molduras', 'public');
            $data['image'] = $image;

            // Redimensionando a imagem
            $image = Image::make(public_path("storage/{$image}"))->fit(500, 350);
            $image->save();
        }

        $moldura->update($data);

        flash('Moldura Atualizada com Sucesso!')->success();
        return redirect()->route('admin.molduras.index');
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

        $moldura = $this->moldura->find($id);

        if ($moldura->delete() == TRUE) {
            if (Storage::exists($moldura->image)) {
                Storage::delete($moldura->image);
            }
        }

        flash('Moldura removida com sucesso!')->success();
        return redirect()->route('admin.molduras.index');
    }
}
