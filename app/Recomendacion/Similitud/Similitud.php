<?php

namespace Recomendacion\Similitud;

class Similitud
{

    /**
     * Constructor oculto
     */
    private function __construct ()
    {

    }

    /**
     * Retorna el cociente de la cardinalidad de la interseccion sobre
     * la de la union de ambos conjuntos
     */
    public static function jaccardSimple (Array $conjuntoA, Array $conjuntoB)
    {
        $interseccion = array_unique(array_intersect($conjuntoA, $conjuntoB));
        $cantIntersec = count($interseccion);
        $union = array_unique(array_merge($conjuntoA, $conjuntoB));
        $cantUnion = count($union);
        return $cantUnion > 0 ? $cantIntersec / $cantUnion : 0;
    }


    /**
     * Retorna el cociente de la cardinalidad de la interseccion sobre
     * la de la union de los dos primeros conjuntos con los dos ultimos
     */
    public static function jaccardComplejo (
        Array $conjuntoA,
        Array $conjuntoB,
        Array $conjuntoC,
        Array $conjuntoD
    )
    {
        $interseccionAB = array_unique(array_intersect($conjuntoA, $conjuntoB));
        $interseccionCD = array_unique(array_intersect($conjuntoC, $conjuntoD));
        $cantIntersecAB = count($interseccionAB);
        $cantIntersecCD = count($interseccionCD);
        $union = array_unique(array_merge($conjuntoA,$conjuntoB,$conjuntoC,$conjuntoD));
        $cantUnion = count($union);
        return $cantUnion > 0 ? ($cantIntersecAB + $cantIntersecCD) / $cantUnion : 0;
    }

}
