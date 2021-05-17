<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContatoRequest;
use App\Models\Message;

class ContatoController extends Controller
{

    private $contato;

    public function __construct(Message $contato)
    {
        $this->contato = $contato;
    }

    public function index()
    {
 
        return view('contato.index');
  
    }

    public function enviaEmail(ContatoRequest $request)
    {

        $data = $request->all();

        $data['status'] = 0;

        $this->contato->create($data);

        flash('Contato enviado com sucesso!')->success();
        return redirect()->route('contato.index');
  
    }

}
