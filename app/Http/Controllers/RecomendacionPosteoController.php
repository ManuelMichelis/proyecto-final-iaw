<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Posteo;
use App\Models\User;
use App\Models\RecomendacionPosteo;
use App\Recomendacion\Engine\MotorRecomendacion;
use App\Recomendacion\Learning\ActiveLearner;
use App\Recomendacion\Valoracion;
use Illuminate\Database\Eloquent\Collection;

class RecomendacionPosteoController extends RecomendacionController
{

    const MAX_ITEMS_POR_RECOMENDACION = 10;
    const MESES_ANTIGUEDAD_GUSTADOS = 3;

    /**
     * Muestra la seccion de recomendaciones de los posteos que pueden
     * interesarle al usuario en sesion
     */
    public function verRecomendaciones ()
    {
        $requiereNuevas = true;
        $target = User::where('id',Auth::user()->id)->first();
        if ($requiereNuevas)
        {
            // Obtengo los 'me gusta' sobre exposiciones que no son mias, de los ultimos tres meses
            $misLikes =
                $target->likes
                    ->where('id_referido', null)
                    ->where('id_usuario', '!=', $target->id)
                    ->where('created_at', '>=', now()->subMonth(self::MESES_ANTIGUEDAD_GUSTADOS)->toDateTimeString());

            // Obtengo los ids de las exposiciones que me gustaron
            $idsGustadas =
                $target->idsThreadsLikeados();

            // Obtengo aquellos posteos a los que no les he dado 'me gusta', del ultimo mes
            $posteosNuevos =
                Posteo::all()
                    ->filter(
                        function($pos)
                        {
                            $target = User::where('id',Auth::user()->id)->first();
                            return $pos->recomendable($target);
                        }
                    )
                    ->whereNotIn('id', $idsGustadas)
                    ->where('created_at', '>=', now()->subMonth(1)->toDateTimeString());

            // Creo el motor de recomendaciones y le solicito sugerencias
            $items = ["potenciales" => $posteosNuevos, "comparados" => $misLikes];
            $motor = MotorRecomendacion::get();
            $motor->setModoPosteos($target,$items);
            $motor->generarRecomendaciones();
        }
        $recomendaciones =
            RecomendacionPosteo::where('id_usuario', $target->id)
                ->orderBy('valor', 'desc')
                ->limit(self::MAX_ITEMS_POR_RECOMENDACION)
                ->get();

        // Por cada recomendacion que surgió, recupero el posteo
        $recomendados = new Collection();
        foreach ($recomendaciones as $rec)
        {
            $id_posteo = $rec->id_recomendado;
            $posteo = Posteo::where('id', $id_posteo)->first();
            $recomendados->add($posteo);
        }
        return view('./recomendaciones-posteo')->with('posteos', $recomendados);
    }


    public function verExposiciones()
    {
        $trainingSet = [];
        $target = User::where('id',Auth::user()->id)->get()->first();
        $likeados = $target->likes;
        $dislikeados = $target->dislikes;
        // Incorporo los pares (item,valor) para los 'me gusta'
        foreach ($likeados as $likeado)
        {
            $item = Posteo::where('id', $likeado->id)->first();
            $trainingSet[$item->id] = ["item" => $item, "valor" => Valoracion::LIKE];
        }
        // Incorporo los pares (item,valor) para los 'no me gusta'
        foreach ($dislikeados as $dislikeado)
        {
            $item = Posteo::where('id', $dislikeado->id)->first();
            $trainingSet[$item->id] = ["item" => $item, "valor" => Valoracion::DISLIKE];
        }
        $testSet = $target->posteosSinParticipacion();
        //dd($trainingSet);
        ActiveLearner::build($trainingSet,$testSet);
        $propuestos = ActiveLearner::get()->propuesta();
        $claves_propuestos = array_keys($propuestos);
        dd($claves_propuestos);
        $posteos_propuestos = [];
        foreach ($claves_propuestos as $clave)
        {
            array_push($posteos_propuestos,Posteo::find($clave)->clave);
        }
        // Obtengo los posteos que deberán ser expuestos
        dd($posteos_propuestos);





    }

}
