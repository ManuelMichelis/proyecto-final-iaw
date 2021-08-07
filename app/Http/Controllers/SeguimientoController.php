<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SeguimientoController extends Controller
{

    /**
     * Actualiza el estado de seguimiento del usuario en sesion a otro
     * usuario
     */
    public function actualizarEstado ($id)
    {
        $miUsuario = Auth::user();
        $nuevoSeguido = false;
        $otroUsuario = User::where('id', $id)->first();
        // Si el usuario existe, entonces actualizo el estado de seguimiento de mi usuario al otro
        if ($otroUsuario != null)
        {
            $seguido = $miUsuario->seguidos->where('id', $id)->first();
            // Si se encuentra el otro usuario entre mis seguidos, lo elimino y no hay nuevo seguido
            if ($seguido != null)
            {
                $miUsuario->seguidos()->detach($id);
            }
            else
            {
                // Agrego al otro usuario a mis seguidos, por lo que hay un nuevo seguido
                $miUsuario->seguidos()->save($otroUsuario);
                $nuevoSeguido = true;
            }
            $miUsuario->save();
            $cantSeguidoresOtro = count($otroUsuario->seguidores);
        }
        return response()
                ->json([
                    'status' => 200,
                    'data' => [
                        'nuevo_seguido' => $nuevoSeguido,
                        'cant_seguidores_usuario' => $cantSeguidoresOtro,
                    ]
                ]);
    }

}
