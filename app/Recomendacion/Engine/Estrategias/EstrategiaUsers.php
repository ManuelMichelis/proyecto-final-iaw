<?php

namespace Engine\Estrategias;

use Engine\Estrategias\EstrategiaRecomendacion;
use App\Models\User;

class EstrategiaUsers extends EstrategiaRecomendacion
{

    const VALOR_MIN_RECOMENDACION = 0.4;
    const PESO_SUSCRIPCIONES_COMUNES = 0.2;
    const PESO_LIKES_COMENTARIOS_COMUNES = 0.75;    


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
        $this->target->usuariosRecomendados()->detach();
    }


    /**
     * Estrategia de generación de recomendaciones para USERS
     */
    public function recomendar($matriz)
    {
        $claves_potenciales = array_keys($matriz);
        // Por cada clave de un usuario potencialmente recomendable...
		foreach ($claves_potenciales as $clave_potencial)
		{
			$potencial = $matriz[$clave_potencial][self::ENTIDAD];
			$puntaje_similitud = $matriz[$clave_potencial][self::PUNTAJE];
			if ($puntaje_similitud > self::VALOR_MIN_RECOMENDACION)
			{
				$this->target->usuariosRecomendados()->save($potencial, ["valor" => $puntaje_similitud]);
			}
		}
    }


    /**
     * Estrategia de similitud entre entidades usuario y
     * el target
     */
    public function similitud($items)
    {
        $potenciales = $items["potenciales"];
        $matriz = [];
        foreach ($potenciales as $potencial)
        {
            // Si tienen ID distinto y el target no sigue al potencial,
            if ($potencial->recomendable($this->target))
            {
                $puntaje_similitud = User::similitud($this->target,$potencial);
                $matriz[$potencial->id] = [self::ENTIDAD => $potencial, self::PUNTAJE => $puntaje_similitud];
            }
        }
        return $matriz;
    }


}