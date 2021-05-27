<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PostController extends Controller
{
    /**
     * Obtiene todos los empleados registrados y lo suministra a una vista para su visualización
     */
    public function create (Request $request) {
        #$posteo = new Posteo;
        dd($request);

        #return redirect()->to('/dashboard');
    }
}
