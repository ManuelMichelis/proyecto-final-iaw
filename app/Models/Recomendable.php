<?php

namespace App\Models;

interface Recomendable
{

    /**
     * Determina si la entidad cumple las condiciones
     * necesarias para ser potencialmente recomendada a un
     * usuario target
     */
    public function recomendable(User $target);

 
    /**
     * Retorna el valor de similitud entre los items dados como
     * argumento, el cual varía entre 0 y 1
     */
    public static function similitud($item,$itemComparado);


}
