<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Engine\MotorRecomendacionUsers;


class RecomendacionUserController extends Controller
{

    /**
     * Determina si corresponde solicitar nuevas recomendaciones al
     * motor de recomendacion de usuarios
     */
    /*
    protected function requiereRecomendacion () : boolean
    {
        return true;
    }
    */


    /**
     * Muestra la seccion de recomendaciones de los usuarios que pueden
     * interesarle al usuario en sesion para seguirlos
     */
    public function verRecomendaciones ()
    {
        $requiereNuevas = true;
        $miUsuario = Auth::user();
        if ($requiereNuevas)
        {
            // Obtengo los usuarios que no sigo
            $usuariosNoSeguidos = User::all()
                                    ->filter(
                                        function($us)
                                        {
                                            $miUsuario = Auth::user();
                                            $esSeguidor = $miUsuario->sigue($us);
                                            return !$esSeguidor;
                                        }
                                    )
                                    ->where('id', '!=', $miUsuario->id);
            // Creo el motor de recomendaciones y le solicito sugerencias
            $motor = new MotorRecomendacionUsers($miUsuario, $usuariosNoSeguidos);
            $motor->generarRecomendaciones();
        }
        $usuariosRecomendados = $miUsuario->usuariosRecomendados;
        return view('./recomendaciones-usuario')->with('usuarios', $usuariosRecomendados);
    }

}
