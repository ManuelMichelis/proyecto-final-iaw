<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posteo extends Model
{
    use HasFactory;

    /**
     * Atributos agregados
     *
     */
    public $incrementing = true;

    protected $table = 'posteos';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'contenido',
        'votos',
    ];


    /**
     * DEFINICIÓN DE LOS MÉTODOS PARA MODELAR RELACIONES
     */

    /**
     * Retorna la relacion del posteo con el modelo Topico,
     * correspondiente al tema tratado en su contenido
     */
    public function topico()
    {
        return $this->belongsTo(Topico::class, 'id_topico_asociado');
    }


    /**
     * Retorna la relacion del posteo, si es un comentario, con el
     * modelo Posteo al cual se refiere
     */
    public function referido ()
    {
        return $this->belongsTo(Posteo::class, 'id_referido');
    }


    /**
     * Retorna la relacion del posteo con los modelos Posteo
     * que corresponden a sus comentarios
     */
    public function comentarios ()
    {
        return $this->hasMany(Posteo::class, 'id_referido', 'id');
    }


    /**
     * Retorna la relacion del posteo con los modelos Denuncia,
     * asociados a las denuncias que ha recibido
     */
    public function denuncias ()
    {
        return $this->hasMany(Denuncia::class, 'id_denuncia', 'id_denunciado');
    }


    /**
     * Retorna la relacion con el modelo Usuario que corresponde
     * a aquel que publico el posteo
     */
    public function usuario ()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }


    /**
     * Retorna el alias del usuario que publico el posteo
     */
    public function aliasUsuario ()
    {
        return $this->usuario()->first()->alias;
    }


    /**
     * Retorna una coleccion de modelos Usuario correspondiente
     * a los votantes del posteo
     */
    public function votantes ()
    {
        return $this->belongsToMany(User::class, 'gustados', 'id_posteo', 'id_usuario');
    }


    /**
     * Los usuarios a los cuales se les recomendo actualmente el posteo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sugeridos ()
    {
        return $this->belongsToMany(User::class, 'posteos_recomendados', 'id_posteo', 'id_usuario');
    }


    /**
     * Retorna 'true' si el posteo corresponde a un comentario,
     * y 'false' en caso contrario
     */
    public function esComentario ()
    {
        return $this->id_referido != null;
    }


    /**
     * Retorna 'true' si el posteo ha sido comentado por un usuario
     * dado como argumento, y 'false' en caso contrario
     */
    public function haComentado (User $user)
    {
        $idUsuario = $user->id;
        $comentario = $this->comentarios->where('id_usuario', $idUsuario)->first();
        return $comentario != null;
    }


    /**
     * Para un dado modelo de usuario, retorna 'true' si el usuario es votante del posteo
     */
    public function esVotante (User $usuario)
    {
        $esVotante = $this->votantes()->get()->contains($usuario);
        return $esVotante;
    }


    /**
     * Retorna una coleccion de IDs de los usuarios a los que les
     * gusto el posteo, sin considerar a aquel usuario que lo
     * publico
     *
     * NOTA: no considerar un 'me gusta' del usuario que publico el
     * posteo, implica que el valor de este, para ser recomendado,
     * depende solo de la participacion de terceros
     */
    public function idsOtrosVotantes ()
    {
        $idUsuarioPosteo = $this->id_usuario;
        $votantes = $this->votantes;
        $coleccionIds = [];
        foreach ($votantes as $usuario)
        {
            $idVotante = $usuario->id;
            // Si el usuario votante no coincide con el que publico el posteo, lo guardo
            if ($idUsuarioPosteo != $idVotante)
            {
                array_push($coleccionIds, $idVotante);
            }
        }
        return $coleccionIds;
    }


    /**
     * Retorna una coleccion de IDs de los usuarios que comentaron
     * el posteo, sin considerar a aquel usuario que lo publico
     *
     * NOTA: no considerar L usuario que publico el posteo, implica
     * que el valor de este, para ser recomendado, depende solo de
     * la participacion de terceros
     */
    public function idsOtrosParticipantes ()
    {
        $idUsuarioPosteo = $this->id_usuario;
        $comentarios = $this->comentarios;
        $coleccionIds = [];
        foreach ($comentarios as $comentario)
        {
            $idDebatiente = $comentario->id_usuario;
            // Si el usuario que debate no es el que publico el posteo, lo guardo
            if ($idUsuarioPosteo != $idDebatiente)
            {
                array_push($coleccionIds, $idDebatiente);
            }
        }
        return $coleccionIds;
    }

}
