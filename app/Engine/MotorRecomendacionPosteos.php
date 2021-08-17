<?php

namespace App\Engine;

use Engine\MotorRecomendacion;
use Engine\Similitud\Similitud;
use App\Models\User;
use App\Models\Posteo;
use App\Models\RecomendacionPosteo;
use Illuminate\Database\Eloquent\Collection;

class MotorRecomendacionPosteos extends MotorRecomendacion
{

    const PUNTAJE_MIN_RECOMENDACION = 0.45;
    const PESO_TOPICOS_IGUALES = 0.25;
    const PESO_LIKES_COMUNES_MIN = 0.5;
    const PESO_LIKES_COMUNES_MAX = 0.7;

    private $usuario;
    private $coleccionGustados;
    private $coleccionNuevos;


    /**
     * Constructor
     */
    public function __construct (User $usuario, Collection $coleccionGustados, Collection $coleccionNuevos)
    {
        $this->usuario = $usuario;
        $this->coleccionGustados = $coleccionGustados;
        $this->coleccionNuevos = $coleccionNuevos;
    }


    /**
     * Elimina todas las recomendaciones de posteos para el
     * usuario para el cual se buscan renovar
     */
    protected function borrarRecomendados ()
    {
        $this->usuario->posteosRecomendados()->detach();
    }


    /**
     * Crea las relaciones de recomendacion entre los usuarios
     * sobre los cuales se evaluo su similitud
     */
    public function generarRecomendaciones ()
    {
        // Borro recomendaciones antiguas y elaboro las nuevas
        $this->borrarRecomendados();
        $matriz = $this->similitud();
        //dd($matriz);
        $idsPosteosGustados = array_keys($matriz);
        // Para cada uno de los usuarios que se evaluaron, obtengo los id de los comparados
        foreach ($idsPosteosGustados as $id)
        {
            $posteoGustado = Posteo::where('id', $id)->first();
            $idsComparados = array_keys($matriz[$id]);
            // Para cada uno de los usuarios comparados con el seleccionado, verifico similitud
            foreach ($idsComparados as $idComparado)
            {
                $posteoComparado = Posteo::where('id', $idComparado)->first();
                $puntaje = $matriz[$id][$idComparado];
                // Si la similitud es igual o superior a 0.45, guardo la relacion de recomendacion
                if ($puntaje > self::PUNTAJE_MIN_RECOMENDACION)
                {
                    // Determino si ya fue recomendado el posteo comparado
                    $recomendacion =
                        RecomendacionPosteo::all()
                            ->where('id_usuario', $this->usuario->id)
                            ->where('id_posteo', $posteoComparado->id)
                            ->first();
                    // Si la recomendacion ya existia, me quedo con el valor de recomendacion mayor
                    if ($recomendacion != null)
                    {
                        $probRecomendacion = $recomendacion->valor_recomendacion;
                        $recomendacion->valor_recomendacion = max($probRecomendacion, $puntaje);
                    }
                    else
                    {
                        $this->usuario
                        ->posteosRecomendados()
                        ->save($posteoComparado, ['valor_recomendacion' => $puntaje]);
                    }
                }
            }
        }
    }


    /**
     * Retorna una matriz que contiene, para cada modelo de la coleccion
     * de posteos, el valor de similitud con cada uno de los demas
     */
    protected function similitud () : array
    {
        $matriz = [];
        // Para cada posteo, determino la similitud con el resto
        foreach ($this->coleccionGustados as $posteoGustado)
        {
            $puntajesDeSimilitud = [];
            foreach ($this->coleccionNuevos as $posteoNuevo)
            {
                if ($posteoGustado->id != $posteoNuevo->id)
                {
                    $puntaje = $this->puntajeSimilitud($posteoGustado, $posteoNuevo);
                    $puntajesDeSimilitud[$posteoNuevo->id] = $puntaje;
                }
            }
            $matriz[$posteoGustado->id] = $puntajesDeSimilitud;
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
            Similitud::jaccardSimple($votantesPosteo, $votantesOtro)*$pesoPorMeGusta
            +
            $adicionPorTopico;

        return $puntaje;
    }


}



