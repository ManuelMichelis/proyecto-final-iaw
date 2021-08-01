<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topico;

class TopicoController extends Controller
{

    public function muestra ()
    {
        $topicos = Topico::orderBy('nombre')->get();
        return view('coleccion-topicos')
            ->with('topicos', $topicos);
    }
}
