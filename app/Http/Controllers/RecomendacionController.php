<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;


abstract class RecomendacionController extends Controller
{

    /**
     * Determina si corresponde solicitar nuevas recomendaciones al
     * motor de recomendacion correspondiente
     */
    //protected abstract function requiereRecomendacion () : boolean;


    /**
     * Muestra la seccion de recomendaciones para las entidades que
     * corresponde que sean sugeridas
     */
    public abstract function verRecomendaciones();


    /**
     * Muestra una seccion de items propuestos al usuario para su
     * inspección y valoración
     */
    public abstract function verExposiciones();


}
