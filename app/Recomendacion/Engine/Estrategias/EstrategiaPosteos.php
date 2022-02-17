<?php

namespace Engine\Estrategias;

use Engine\Estrategias\EstrategiaRecomendacion;
use App\Models\User;
use App\Models\Posteo;
use App\Models\RecomendacionPosteo;

class EstrategiaPosteos extends EstrategiaRecomendacion
{
    const VALOR_MIN_RECOMENDACION = 0.40;
    const PESO_TOPICOS_IGUALES = 0.25;
    const PESO_LIKES_COMUNES_MIN = 0.5;
    const PESO_LIKES_COMUNES_MAX = 0.7;


    /**
     * Constructor
     */
    public function __construct(User $target)
    {
        $this->target = $target;
    }


    /**
     * Estrategia de limpieza de recomendaciones para USERS
     */
    public function limpiar()
    {
        $this->target->posteosRecomendados()->detach();
    }
    

    /**
     * Estrategia de generación de recomendaciones para POSTEOS
     */
    public function recomendar($matriz)
    {
        $claves_comparadas = array_keys($matriz);
		// Por cada clave asociada a una entidad que uso para comparar...
		$index = 0;
        foreach ($claves_comparadas as $clave_comparada)
		{
            $potenciales = $matriz[$clave_comparada]["potenciales_comparados"];
			$claves_potenciales = array_keys($potenciales);
            // Por cada clave de una entidad potencialmente recomendable...
			foreach ($claves_potenciales as $clave_potencial)
			{
				$potencial = $potenciales[$clave_potencial][self::ENTIDAD];
				$puntaje_similitud = $potenciales[$clave_potencial][self::PUNTAJE];
                
				if ($puntaje_similitud > self::VALOR_MIN_RECOMENDACION)
				{
                    // Si ya fue recomendado, guardo la recomendación con mayor puntaje
                    $recomendacion = RecomendacionPosteo::obtener($this->target->id,$clave_potencial);
                    if ($recomendacion != null)
                    {
                        $maximo_puntaje = max($puntaje_similitud,$recomendacion->valor);
                        if ($maximo_puntaje > $recomendacion->valor)
                        {
                            $this->target->posteosRecomendados()->detach($potencial);
                            $this->target->posteosRecomendados()->save($potencial, ["valor" => $maximo_puntaje]);
                        }
                    }
                    else
                    {
                        $this->target->posteosRecomendados()->save($potencial, ["valor" => $puntaje_similitud]);   
                    }                  
				}
			}
		}
    }


    /**
     * Retorna una matriz que contiene, para cada modelo de la coleccion
     * de posteos, el valor de similitud con cada uno de los demas
     */
    public function similitud ($items)
    {
        $matriz = [];
        $potenciales = $items["potenciales"];
        $likes = $items["comparados"];
        // Para cada posteo, determino la similitud con el resto
        foreach ($likes as $likeado)
        {
            $puntaje_similitud = [];
            foreach ($potenciales as $potencial)
            {
                if ($likeado->id != $potencial->id)
                {
                    $puntaje = Posteo::similitud($likeado,$potencial);
                    $puntaje_similitud[$potencial->id] = ["entidad" => $potencial, "puntaje" => $puntaje];
                }
            }
            $matriz[$likeado->id] = ["entidad" => $likeado, "potenciales_comparados" => $puntaje_similitud];
        }
        return $matriz;
    }
    

}