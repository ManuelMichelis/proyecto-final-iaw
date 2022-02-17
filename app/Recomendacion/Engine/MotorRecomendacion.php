<?php

namespace App\Recomendacion\Engine;

use Engine\Estrategias\EstrategiaRecomendacion;
use Engine\Estrategias\EstrategiaUsers;
use Engine\Estrategias\EstrategiaPosteos;

use App\Models\User;


class MotorRecomendacion 
{
    protected const ENTIDAD = "entidad";
    protected const PUNTAJE = "puntaje";

    protected static MotorRecomendacion $motor;
    protected static $items;
    protected static EstrategiaRecomendacion $estrategia;

    /**
     * Constructor
     */
    private function __construct()
    {
        
    }

    /**
     * Retorna la instancia correspondiente al motor y le
     * setea por defecto la estrategia de recomendación
     * de usuarios, si la instancia es nula
     */
    public static function get()
    {
        if (!isset(self::$motor))
        {
            self::$motor = new MotorRecomendacion();
        }
        return self::$motor;
    }

    /**
     * Setea la estrategia de recomendación de Usuarios
     */
    public static function setModoUsers (User $target, $items)
    {
        self::$items = $items;
        self::$estrategia = new EstrategiaUsers($target);
    }

    /**
     * Setea la estrategia de recomendación de Posteos
     */
    public static function setModoPosteos (User $target, $items)
    {
        self::$items = $items;
        self::$estrategia = new EstrategiaPosteos($target);
    }

    /**
     * Borra todos los registros correspondientes a recomendaciones
     * entre entidades
     */
    protected function borrarRecomendados()
    {
        self::$estrategia->limpiar();
    }

    /**
     * Retorna una colección de items seleccionados para compartir
     * con el usuario
     */
    public function generarExposiciones()
    {
        // USAR ACTIVE LEARNING
    }
    
    /**
     * Crea las relaciones de recomendacion entre las entidades
     * que correspondan
     */
    public function generarRecomendaciones()
    {
        $this->borrarRecomendados();
        $matriz = $this->similitud(self::$items);
        self::$estrategia->recomendar($matriz);
    }

    /**
     * Construye una matriz de similitud entre objetos de una coleccion
     * de modelos, en base a un criterio definido por el programador
     */
    protected function similitud($items)
    {
        $matriz = self::$estrategia->similitud($items);
        return $matriz;
    }


    /**
     * Retorna 'true' si el motor de recomendación está creado y
     * 'false' en otro caso
     */
    public function estaInstanciado()
    {
        return self::$motor != null && self::$estrategia != null;
    }

}
