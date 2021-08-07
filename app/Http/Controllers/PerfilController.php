<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;


class PerfilController extends Controller
{

    /**
     * Muestra la vista del perfil del usuario, si existe, cuyo alias
     * es dado como argumento
     */
    public function ver ($alias)
    {
        $usuario = User::where('alias', $alias)->first();
        $posteos = $usuario->posteos()->orderByDesc('id')->get();
        if ($usuario != null)
        {
            return view('perfil-usuario')
                ->with('usuario', $usuario)
                ->with('posteos', $posteos);
        }
    }

}
