<?php

namespace app\Libraries\Similitud;

use Libraries\Similitud\Similitud;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class SimilitudUsuarios extends Similitud
{

    private $usuarios;
    const PESO_SUSCRIPCIONES_COMUNES = 0.15;


    /**
     * Constructor
     */
    public function __construct (Collection $usuarios)
    {
        $this->usuarios = $usuarios;
    }


    /**
     * Retorna una matriz que contiene, para cada modelo de la coleccion
     * de 'usuarios', el valor de similitud con cada uno de los demas
     */
    public function matrizSimilitud () : array
    {
        //dd($this->usuarios);
        $matriz = [];
        // Para cada usuario, determino la similitud con el resto
        foreach ($this->usuarios as $usuario)
        {
            $puntajesDeSimilitud = [];
            foreach ($this->usuarios as $otro)
            {
                if ($usuario->id != $otro->id)
                {
                    $puntajesDeSimilitud['user_id_'.$otro->id.''] = $this->puntajeSimilitud($usuario, $otro);
                }
            }
            $matriz['user_id_'.$usuario->id] = $puntajesDeSimilitud;
        }
        return $matriz;
    }


    /**
     * Calcula el puntaje de similitud que existe entre dos modelos
     * usuario y lo retorna
     */
    protected function puntajeSimilitud ($usuario, $otro)
    {
        $topicosUsuario = $usuario->idsTopicosSuscriptos();
        $topicosOtro = $otro->idsTopicosSuscriptos();
        $gustadosUsuario = $usuario->idsExposicionesGustadas();
        $comentadosUsuario = $usuario->idsExposicionesDebatidas();
        $gustadosOtro = $otro->idsExposicionesGustadas();
        $comentadosOtro = $otro->idsExposicionesDebatidas();
        // Obtener arreglos de los ids de los posteos (no comentarios) que le gustaron a uno y a otro
        $puntaje =
            parent::jaccardComplejo($gustadosUsuario, $gustadosOtro,$comentadosUsuario, $comentadosOtro)
            +
            parent::jaccardSimple($topicosUsuario, $topicosOtro)*self::PESO_SUSCRIPCIONES_COMUNES;

        return $puntaje;
    }


}
