<?php

namespace App\Recomendacion\Learning;

use App\Models\Posteo;
use App\Recomendacion\Valoracion;

class ActiveLearner
{
    const AMPLITUD_ENTORNO = 3;
    const NRO_MAXIMO_PROPUESTAS = 5;

    protected static ActiveLearner $learner;
    protected static $trainingSet;
    protected static $testSet;

    private function __construct() {}


    /**
     * Retorna la instancia correspondiente al Active Learner
     */
    public static function get()
    {
        if (!isset(self::$learner))
        {
            self::$learner = new ActiveLearner();
            self::$trainingSet = [];
            self::$testSet = [];
        }
        return self::$learner;
    }


    /**
     * Construye un nuevo modelo de predicción a partir del
     * conjunto de entrenamiento y test, dados como
     * argumento
     */
    public static function build ($trainingSet,$testSet)
    {
        self::get()::$trainingSet = $trainingSet;
        self::get()::$testSet = $testSet;
    }


    /**
     * Retorna una colección de items propuesta para su
     * observación, en base al target dado
     */
    public static function propuesta()
    {
        $cambios = [];
        // Tomo un Xa y lo uso como argumento de la función de cambio en estimaciones. Busco lograr
        // el mayor valor de cambio posible (max) (A MAYOR CAMBIO, MÁS ÚTIL RESULTA EL ITEM CANDIDATO)
        foreach (self::$testSet as $candidato)
        {
            $utilidad = self::utilidad($candidato);
            $cambios[$candidato->id] = $utilidad;
        }
        asort($cambios);
        dd($cambios);
        return $cambios;
    }


    /**
     * Retorna el valor de utilidad asociado al item, basado
     * en el método de Cambio de estimaciones
     */
    private static function utilidad ($item)
    {
        $valores = Valoracion::valores();
        foreach ($valores as $etiqueta)
        {
            $agregado = ["item" => $item, "valor" => $etiqueta];
            $nuevoTrainingSet = self::$trainingSet;
            $nuevoTrainingSet[$item->id] = $agregado;
            $cambio = 0;
            foreach (self::$testSet as $nuevoItem)
            {
                $cambio += 
                        ( 
                        -1*(
                            pow(
                                self::learn(self::$trainingSet,$nuevoItem) 
                                -
                                self::learn($nuevoTrainingSet,$nuevoItem)
                            ,2)
                            )
                        );
            }
        }
        return $cambio / count($valores);
    }


    /**
     * Predice y retorna la calificación estimada para un item,
     * contando con un conjunto de entrenamiento, dados como
     * argumento
     */
    private static function learn($trainingSet,$candidato)
    {
        $similitud = [];
        foreach ($trainingSet as $par)
        {
            $item = $par["item"];
            $similitud[$item->id] = Posteo::similitud($par["item"],$candidato);
        }
        $clavesSimilitud = array_keys($similitud);
        $claveMasCercano = null;
        $similitudMasCercana = 0;
        $votosPorLike = 0;
        $votosPorDislike = 0;
        $index = 0;
        for ($index; $index < self::AMPLITUD_ENTORNO; $index++)
        {
            foreach ($clavesSimilitud as $clave)
            {
                if ($similitud[$clave] >= $similitudMasCercana)
                {
                    $similitudMasCercana = $similitud[$clave];
                    $claveMasCercano = $clave;
                }
            }
            // Si existe una clave más cercana, entonces el conj de entrenamiento no es vacío
            if ($trainingSet[$claveMasCercano]["valor"] == Valoracion::LIKE)
            {
                $votosPorLike += 1;
            }
            else
            {
                $votosPorDislike += 1;
            }            
        }
        return ($votosPorLike > $votosPorDislike) ? Valoracion::LIKE : Valoracion::DISLIKE;
    }

}