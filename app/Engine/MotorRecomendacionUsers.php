<?php

namespace App\Engine;

use Engine\MotorRecomendacion;
use Engine\Similitud\Similitud;
use App\Models\User;
use App\Models\RecomendacionUser;
use Illuminate\Database\Eloquent\Collection;

class MotorRecomendacionUsers extends MotorRecomendacion
{

    const PUNTAJE_MIN_RECOMENDACION = 0.50;
    const PESO_SUSCRIPCIONES_COMUNES = 0.2;
    const PESO_LIKES_COMENTARIOS_COMUNES = 0.75;


    private User $usuario;
    private Collection $coleccionUsuarios;


    /**
     * Borra todos los registros correspondientes a recomendaciones
     * de usuarios
     */
    public function __construct (User $usuario, Collection $coleccionUsuarios)
    {
        $this->usuario = $usuario;
        $this->coleccionUsuarios = $coleccionUsuarios;
    }


    /**
     * Elimina todas las recomendaciones de usuarios a seguir
     * para el usuario para el cual se buscan renovar
     */
    protected function borrarRecomendados ()
    {
        $this->usuario->usuariosRecomendados()->detach();
    }


    /**
     * Crea las relaciones de recomendacion entre los usuarios
     * sobre los cuales se evaluo su similitud
     */
    public function generarRecomendaciones ()
    {
        $this->borrarRecomendados();
        $similitud = $this->similitud();
        $idsUsuarios = array_keys($similitud);
        // Para cada uno de los usuarios que se evaluaron, obtengo los id de los comparados
        foreach ($idsUsuarios as $idComparado)
        {
            $puntaje = $similitud[$idComparado];
            // Si el puntaje es igual o superior a 0.45, guardo la relacion de recomendacion
            if ($puntaje > self::PUNTAJE_MIN_RECOMENDACION)
            {
                $usuarioComparado = User::where('id', $idComparado)->first();
                $this->usuario
                    ->usuariosRecomendados()
                    ->save($usuarioComparado, ['valor_recomendacion' => $puntaje]);
            }
        }
    }


    /**
     * Retorna un arreglo que contiene, para el usuario sobre el cual
     * se requieren construir recomendaciones, el valor de similitud con
     * los demas usuarios de la coleccion dada
     */
    protected function similitud () : array
    {
        $similitud = [];
        // Para cada usuario, determino la similitud con el resto
        foreach ($this->coleccionUsuarios as $otroUsuario)
        {
            $miId = $this->usuario->id;
            // Si el otro usuario es distinto al mio y no lo sigo, considero la similitud entre ambos
            if ($miId != $otroUsuario->id && !$this->usuario->sigue($otroUsuario))
            {
                $puntaje = $this->puntajeSimilitud($otroUsuario);
                $similitud[$otroUsuario->id] = $puntaje;
            }
        }
        return $similitud;
    }


    /**
     * Calcula el puntaje de similitud que existe entre dos modelos
     * usuario y lo retorna
     */
    protected function puntajeSimilitud ($otro)
    {
        $topicosUsuario = $this->usuario->idsTopicosSuscriptos();
        $gustadosUsuario = $this->usuario->idsExposicionesGustadas();
        $comentadosUsuario = $this->usuario->idsExposicionesDebatidas();
        $topicosOtro = $otro->idsTopicosSuscriptos();
        $gustadosOtro = $otro->idsExposicionesGustadas();
        $comentadosOtro = $otro->idsExposicionesDebatidas();
        $puntaje =
            Similitud::jaccardComplejo(
                $gustadosUsuario,
                $gustadosOtro,
                $comentadosUsuario,
                $comentadosOtro
            )*self::PESO_LIKES_COMENTARIOS_COMUNES
            +
            Similitud::jaccardSimple(
                $topicosUsuario,
                $topicosOtro
            )*self::PESO_SUSCRIPCIONES_COMUNES;

        return $puntaje;
    }


}
