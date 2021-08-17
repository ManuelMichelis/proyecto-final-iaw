<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;
use App\Models\Posteo;
use App\Models\User;
use App\Engine\MotorRecomendacionUsers;
use App\Engine\MotorRecomendacionPosteos;


class RecomendacionController extends Controller
{

    public function verRecomendacionesUsuarios ()
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


    public function verRecomendacionesPosteos ()
    {
        $requiereNuevas = true;
        $miUsuario = Auth::user();
        if ($requiereNuevas)
        {
            // Obtengo los 'me gusta' sobre posteos (no comentarios) que no son mios
            $misGustados =
                $miUsuario
                    ->gustados
                    ->where('id_referido', null)
                    ->where('id_usuario', '!=', $miUsuario->id)
                    ->where('created_at', '>=', now()->subMonth(3)->toDateTimeString());
            $idsExposicionesGustadas =
                $miUsuario->idsExposicionesGustadas();

            $nuevosPosteos =
                Posteo::all()
                    ->filter(
                        function($pos)
                        {
                            $esComentario = $pos->esComentario();
                            return !$esComentario;
                        }
                    )
                    ->whereNotIn('id', $idsExposicionesGustadas)
                    ->where('created_at', '>=', now()->subMonth(1)->toDateTimeString());

            //dd($nuevosPosteos);
            // Creo el motor de recomendaciones y le solicito sugerencias
            $motor = new MotorRecomendacionPosteos($miUsuario, $misGustados, $nuevosPosteos);
            $motor->generarRecomendaciones();
        }
        $posteosRecomendados = $miUsuario->posteosRecomendados;
        return view('./recomendaciones-posteo')->with('posteos', $posteosRecomendados);
    }


    public function requiereRecomendacion ()
    {
        // Obtengo datetime de ultima recomendacion para el usuario actual
        // Si la fecha es nula o tiene una hora de antiguedad, retorno 'true'; si no, 'false'

    }

}
