<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fonte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FonteController extends Controller
{
    private $fonte;

    public function __construct(Fonte $fonte)
    {
        $this->fonte = $fonte;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fontes = $this->fonte->paginate(10);

        return view('admin.fontes.index', compact('fontes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fontes.create');
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

        $image = $request->file('image')->store('fontes', 'public');
        $data['image'] = $image;

        // Redimensionando a imagem
        $image = Image::make(public_path("storage/{$image}"))->fit(600, 260);
        $image->save();

        $this->fonte->create($data);

        flash('Fonte criado com sucesso!')->success();
        return redirect()->route('admin.fontes.index');

    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($fonte)
    {
        $fonte = $this->fonte->findOrFail($fonte);
        return view('admin.fontes.edit', compact('fonte'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fonte)
    {
        $data = $request->all();

        $fonte = $this->fonte->find($fonte);

        if ($request->hasFile('image')) {

            if (Storage::exists($fonte->image)) {
                Storage::delete($fonte->image);
            }

            $image = $request->file('image')->store('fontes', 'public');
            $data['image'] = $image;

            // Redimensionando a imagem
            $image = Image::make(public_path("storage/{$image}"))->fit(600, 260);
            $image->save();
        }

        $fonte->update($data);

        flash('Fonte atualizado com sucesso!')->success();
        return redirect()->route('admin.fontes.index');
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

        $fonte = $this->fonte->find($id);

        if ($fonte->delete() == TRUE) {
            if (Storage::exists($fonte->image)) {
                Storage::delete($fonte->image);
            }
        }

        flash('Fonte removido com sucesso!')->success();
        return redirect()->route('admin.fontes.index');
    }
}
