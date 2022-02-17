<?php

namespace App\Recomendacion;

class Valoracion
{
    public const LIKE = 1;
    public const SIN_VALOR = 0;
    public const DISLIKE = 0;


    public static function valores()
    {
        return [self::LIKE, self::DISLIKE];
    }

}
