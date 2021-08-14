<?php

namespace Libraries\Similitud;

abstract class Similitud
{

    /**
     * Retorna el cociente de la cardinalidad de la interseccion sobre
     * la de la union de ambos conjuntos
     */
    protected function jaccardSimple (Array $conjuntoA, Array $conjuntoB)
    {
        $interseccion = array_unique(array_intersect($conjuntoA, $conjuntoB));
        $cantIntersec = count($interseccion);
        $union = array_unique(array_merge($conjuntoA, $conjuntoB));
        $cantUnion = count($union);
        return $cantIntersec / $cantUnion;
    }


    /**
     * Retorna el cociente de la cardinalidad de la interseccion sobre
     * la de la union de los dos primeros conjuntos con los dos ultimos
     */
    protected function jaccardComplejo (
        Array $conjuntoA,
        Array $conjuntoB,
        Array $conjuntoC,
        Array $conjuntoD
    )
    {
        //dd($conjuntoA);
        //dump($conjuntoB);
        $interseccionAB = array_unique(array_intersect($conjuntoA, $conjuntoB));
        //dd($interseccionAB);
        $interseccionCD = array_unique(array_intersect($conjuntoC, $conjuntoD));
        $cantIntersecAB = count($interseccionAB);
        $cantIntersecCD = count($interseccionCD);
        $union = array_unique(array_merge($conjuntoA, $conjuntoB, $conjuntoC, $conjuntoD));
        $cantUnion = count($union);
        return ($cantIntersecAB + $cantIntersecCD) / $cantUnion;
    }


    /**
     * Construye una matriz de similitud entre objetos de una coleccion
     * de modelos, en base a un criterio definido por el programador
     */
    public abstract function matrizSimilitud ();


    /**
     * Calcula el puntaje de similitud que existe entre dos modelos y
     * lo retorna, en base a un criterio definido por el programador
     */
    protected abstract function puntajeSimilitud ($objeto, $otro);

}
