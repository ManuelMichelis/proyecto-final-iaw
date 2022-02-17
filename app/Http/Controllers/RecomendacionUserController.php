<?php

namespace App\Http\Controllers;

use App\Recomendacion\Engine\MotorRecomendacion;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class RecomendacionUserController extends RecomendacionController
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
        $target = User::where('id',Auth::user()->id)->first();
        if ($requiereNuevas)
        {
            // Obtengo los usuarios que no sigo
            $usuariosNoSeguidos = User::all()
                                    ->filter(
                                        function($us)
                                        {
                                            $target = User::where('id',Auth::user()->id)->first();
                                            return $us->recomendable($target);
                                        }
                                    )
                                    ->where('id', '!=', $target->id);
            // Creo el motor de recomendaciones y le solicito sugerencias
            $items = ["potenciales" => $usuariosNoSeguidos];
            $motor = MotorRecomendacion::get();
            $motor->setModoUsers($target,$items);
            $motor->generarRecomendaciones();
        }
        $usuariosRecomendados = $target->usuariosRecomendados;
        return view('./recomendaciones-usuario')->with('usuarios', $usuariosRecomendados);
    }


    public function verExposiciones()
    {
        $target = User::where('id',Auth::user()->id)->first();
        // Obtengo el conjunto de entrenamiento: forma (usuario_seguido, estado_seguimiento)
        $seguidos = $target->seguidos;
        $conjunto_entrenamiento = [];
        foreach ($seguidos as $seguido)
        {
            //array_push($conjunto_entrenamiento,["item" => $seguido, "prediccion" => ]
        }

    }

}
