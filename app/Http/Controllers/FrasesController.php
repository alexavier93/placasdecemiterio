<?php

namespace App\Http\Controllers;

use App\Models\Frase;
use Illuminate\Http\Request;

class FrasesController extends Controller
{

    private $frase;

    public function __construct(Frase $frase)
    {
        $this->frase = $frase;
    }

    public function index(Request $request)
    {
        
        $frases = $this->frase->paginate(10);

        return view('frases.index', compact('frases'));
  
    }
}
