<?php

namespace Engine;

abstract class MotorRecomendacion {


    /**
     * Borra todos los registros correspondientes a recomendaciones
     * entre entidades
     */
    protected abstract function borrarRecomendados ();


    /**
     * Crea las relaciones de recomendacion entre las entidades
     * que correspondan
     */
    public abstract function generarRecomendaciones ();


    /**
     * Construye una matriz de similitud entre objetos de una coleccion
     * de modelos, en base a un criterio definido por el programador
     */
    protected abstract function similitud ();


}
