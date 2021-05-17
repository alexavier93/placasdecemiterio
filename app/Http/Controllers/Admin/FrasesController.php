<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frase;
use Illuminate\Http\Request;

class FrasesController extends Controller
{

    private $frase;

    public function __construct(Frase $frase)
    {
        $this->frase = $frase;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frases = $this->frase->paginate(10);

        return view('admin.frases.index', compact('frases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.frases.create');
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

        $this->frase->create($data);

        flash('Frase criada com sucesso!')->success();
        return redirect()->route('admin.frases.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($frase)
    {
        $frase = $this->frase->findOrFail($frase);
        return view('admin.frases.edit', compact('frase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $frase)
    {
        $data = $request->all();

        $frase = $this->frase->find($frase);
        $frase->update($data);

        flash('Frase atualizada com sucesso!')->success();
        return redirect()->route('admin.frases.index');
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

        $frase = $this->frase->find($id);

        if ($frase->delete() == TRUE) {

            flash('Frase removida com sucesso!')->success();
            return redirect()->route('admin.frases.index');

        }
        
    }
}
