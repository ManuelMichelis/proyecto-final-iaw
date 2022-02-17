<?php

namespace Engine\Estrategias;

use App\Models\User;

abstract class EstrategiaRecomendacion
{
    const ENTIDAD = "entidad";
    const COMPARADOS = "comparados";
    const PUNTAJE = "puntaje";
    
    protected User $target;

    /**
     * Limpia las recomendaciones almacenadas para la
     * entidad target
     */
    public abstract function limpiar();

    /**
     * Genera nuevas recomendaciones, en base a una matriz de 
     * similitud de entidades, para la entidad target
     */
    public abstract function recomendar($matriz);


    /**
     * Calcula el valor de similitud entre colecciones de entidades
     * potencialmente recomendables y comparadas, para el target 
     */
    public abstract function similitud($items);

} 