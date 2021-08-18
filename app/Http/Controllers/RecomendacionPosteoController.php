<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Posteo;
use App\Models\User;
use App\Models\RecomendacionPosteo;
use App\Engine\MotorRecomendacionPosteos;
use Illuminate\Database\Eloquent\Collection;


class RecomendacionPosteoController extends Controller
{

    /**
     * Determina si corresponde solicitar nuevas recomendaciones al
     * motor de recomendacion de posteos
     */
    /*
    protected function requiereRecomendacion () : boolean
    {
        return true;
    }
    */

    /**
     * Muestra la seccion de recomendaciones de los posteos que pueden
     * interesarle al usuario en sesion
     */
    public function verRecomendaciones ()
    {
        $requiereNuevas = true;
        $miUsuario = Auth::user();
        if ($requiereNuevas)
        {
            // Obtengo los 'me gusta' sobre exposiciones que no son mias, de los ultimos tres meses
            $misGustados =
                $miUsuario
                    ->gustados
                    ->where('id_referido', null)
                    ->where('id_usuario', '!=', $miUsuario->id)
                    ->where('created_at', '>=', now()->subMonth(3)->toDateTimeString());

            // Obtengo los ids de las exposiciones que me gustaron
            $idsExposicionesGustadas =
                $miUsuario->idsExposicionesGustadas();

            // Obtengo aquellos posteos a los que no les he dado 'me gusta', del ultimo mes
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

            // Creo el motor de recomendaciones y le solicito sugerencias
            $motor = new MotorRecomendacionPosteos($miUsuario, $misGustados, $nuevosPosteos);
            $motor->generarRecomendaciones();
        }
        $recomendaciones =
            RecomendacionPosteo::where('id_usuario', $miUsuario->id)
                ->orderBy('valor_recomendacion', 'desc')
                ->limit(10)
                ->get();

        // Por cada recomendacion que surgio, recupero el posteo
        $posteosRecomendados = new Collection();
        foreach ($recomendaciones as $rec)
        {
            $idPosteo = $rec->id_posteo;
            $posteo = Posteo::where('id', $idPosteo)->first();
            $posteosRecomendados->add($posteo);
        }

        return view('./recomendaciones-posteo')->with('posteos', $posteosRecomendados);
    }


}
