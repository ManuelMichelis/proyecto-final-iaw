<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Topico;

class SuscripcionController extends Controller
{

    /**
     * Actualiza el estado de suscripcion, sobre un id asociado a un topico,
     * para el usuario en sesion
     */
    public function actualizarEstado ($id)
    {
        $miUsuario = Auth::user();
        $nuevoSuscripto = false;
        $topico = Topico::where('id', $id)->first();
        // Si el topico existe, entonces actualizo el estado de suscripcion del usuario a este
        if ($topico != null)
        {
            $suscripto = $miUsuario->suscripciones->where('id', $id)->first();
            // Si se encuentra el topico entre mis suscripciones, lo elimino y no hay nuevo seguido
            if ($suscripto != null)
            {
                $miUsuario->suscripciones()->detach($id);
            }
            else
            {
                // Agrego al otro usuario a mis seguidos, por lo que hay un nuevo seguido
                $miUsuario->suscripciones()->save($topico);
                $nuevoSuscripto = true;
            }
            $miUsuario->save();
            $cantSuscriptos = count($topico->suscriptos);
        }
        return response()
                ->json([
                    'status' => 200,
                    'data' => [
                        'nuevo_suscripto' => $nuevoSuscripto,
                        'cant_suscriptos_topico' => $cantSuscriptos,
                    ]
                ]);

    }

}
