<?php

namespace app\Libraries\Similitud;

use Libraries\Similitud\Similitud;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class SimilitudPosteos extends Similitud
{

    const PESO_TOPICOS_IGUALES = 0.25;
    const PESO_LIKES_COMUNES_MIN = 0.5;
    const PESO_LIKES_COMUNES_MAX = 0.7;

    private $posteos;


    /**
     * Constructor
     */
    public function __construct (Collection $posteos)
    {
        $this->posteos = $posteos;
    }


    /**
     * Retorna una matriz que contiene, para cada modelo de la coleccion
     * de 'posteos', el valor de similitud con cada uno de los demas
     */
    public function matrizSimilitud () : array
    {
        $matriz = [];
        // Para cada posteo, determino la similitud con el resto
        foreach ($this->posteos as $posteo)
        {
            $puntajesDeSimilitud = [];
            foreach ($this->posteos as $otro)
            {
                if ($posteo->id != $otro->id)
                {
                    $puntajesDeSimilitud['posteo_id_'.$otro->id] = $this->puntajeSimilitud($posteo, $otro);
                }
            }
            $matriz['posteo_id_'.$posteo->id] = $puntajesDeSimilitud;
        }
        return $matriz;
    }


    /**
     * Calcula el puntaje de similitud que existe entre dos modelos
     * posteo y lo retorna
     */
    protected function puntajeSimilitud ($posteo, $otro)
    {
        $votantesPosteo = $posteo->idsOtrosVotantes();
        $votantesOtro = $otro->idsOtrosVotantes();
        $idTopicoPosteo = $posteo->topico->id;
        $idTopicoOtro = $otro->topico->id;
        $pesoPorMeGusta = self::PESO_LIKES_COMUNES_MIN;
        $adicionPorTopico = 0;
        // Si coinciden los topicos, considero sumar un valor fijo al puntaje
        if ($idTopicoPosteo == $idTopicoOtro)
        {
            $adicionPorTopico = self::PESO_TOPICOS_IGUALES;
            $pesoPorMeGusta = self::PESO_LIKES_COMUNES_MAX;
        }
        // Obtener arreglos de los ids de los posteos (no comentarios) que le gustaron a uno y a otro
        $puntaje =
            parent::jaccardSimple($votantesPosteo, $votantesOtro)*$pesoPorMeGusta
            +
            $adicionPorTopico;

        return $puntaje;
    }


}
