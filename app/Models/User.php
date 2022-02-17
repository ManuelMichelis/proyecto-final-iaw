<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Recomendacion\Similitud\Similitud;

class User extends Authenticatable implements Recomendable
{
    use HasFactory, Notifiable;

    const PESO_SUSCRIPCIONES_COMUNES = 0.2;
    const PESO_LIKES_COMENTARIOS_COMUNES = 0.75;


    /**
     * Atributos agregados manualmente
     *
     */
    public $incrementing = true;

    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alias',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * DEFINICIÓN DE LOS MÉTODOS PARA MODELAR RELACIONES
     */

    /**
     * Los seguidores y seguidos que un usuario tiene
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function seguidos()
    {
        return $this->belongsToMany(User::class, 'seguimientos', 'id_seguidor', 'id_seguido');
    }

    public function seguidores()
    {
        return $this->belongsToMany(User::class, 'seguimientos', 'id_seguido', 'id_seguidor');
    }
    

    /**
     * Los tópicos a los cuales está suscrito el usuario
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function suscripciones()
    {
        return $this->belongsToMany(Topico::class, 'suscripciones', 'id_suscripto', 'id_topico');
    }

    /**
     * Los tópicos a los cuales está suscrito el usuario
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posteos()
    {
        return $this->hasMany(Posteo::class, 'id_usuario', 'id');
    }


    /**
     * Los usuarios que le son recomendados actualmente al usuario
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function usuariosRecomendados()
    {
        return $this->belongsToMany(User::class, 'usuarios_recomendados', 'id_usuario', 'id_recomendado');
    }


    /**
     * Los posteos que le son recomendados actualmente al usuario
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posteosRecomendados()
    {
        return $this->belongsToMany(Posteo::class, 'posteos_recomendados', 'id_usuario', 'id_recomendado');
    }


    /**
     * Los usuarios que le son recomendados actualmente al usuario
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sugeridos ()
    {
        return $this->belongsToMany(User::class, 'usuarios_recomendados', 'id_usuario_2', 'id_usuario_1');
    }    


    /**
     * Los bloqueos de cuenta que ha recibido el usuario
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bloqueos()
    {
        return $this->hasMany(Denuncia::class, 'id_usuario', 'id_denuncia');
    }

    /**
     * Los 'me gusta' que ha realizado el usuario sobre posteos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->belongsToMany(Posteo::class, 'likes', 'id_usuario', 'id_posteo');
    }


    /**
     * Los 'no me gusta' que ha realizado el usuario sobre posteos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dislikes()
    {
        return $this->belongsToMany(Posteo::class, 'dislikes', 'id_usuario', 'id_posteo');
    }


    /**
     * Definición de recomendable de usuario a usuario
     */
    public function recomendable(User $target)
    {
        return $this->id != $target->id && !$target->sigue($this);
    }


    /**
     * Similitud entre dos entidades User
     */
    public static function similitud($usuario, $usuarioComparado)
    {
        $topicosUsuario = $usuario->idsTopicosSuscriptos();
        $likesUsuario = $usuario->idsThreadsLikeados();
        $debatidosUsuario = $usuario->idsThreadsDebatidos();
        $topicosComparado = $usuarioComparado->idsTopicosSuscriptos();
        $likesComparado = $usuarioComparado->idsThreadsLikeados();
        $debatidosComparado = $usuarioComparado->idsThreadsDebatidos();
        $puntaje =
            Similitud::jaccardComplejo(
                $likesUsuario,
                $likesComparado,
                $debatidosUsuario,
                $debatidosComparado
            )*self::PESO_LIKES_COMENTARIOS_COMUNES
            +
            Similitud::jaccardSimple(
                $topicosUsuario,
                $topicosComparado
            )*self::PESO_SUSCRIPCIONES_COMUNES;
        return $puntaje;
    }


    /**
     * Retorna 'true' si el usuario publicó un posteo dado como
     * argumento
     */
    public function haPublicado (Posteo $posteo)
    {
        $idUsuario = $posteo->id_usuario;
        $miId = $this->id;
        return $idUsuario == $miId;
    }


    /**
     * Determina si el usuario sigue a otro, con modelo dado como argumento
     */
    public function sigue (User $user)
    {
        $id = $user->id;
        $seguido = $this->seguidos->where('id', $id)->first();
        return $seguido != null;
    }

    /**
     * Retorna 'true' si el usuario esta suscripto al tópico,
     * dado como argumento
     */
    public function suscripto(Topico $topico)
    {
        $id = $topico->id;
        $suscripcion = $this->suscripciones->where('id', $id)->first();
        return $suscripcion != null;
    }


    /**
     * Retorna la coleccion de posteos realizados por el usuario
     */
    public function discusionesGeneradas()
    {
        return $this->posteos->where('titulo','!=', null);
    }


    /**
     * Retorna una coleccion de IDs de los posteos que gustaron al
     * usuario y no fueron publicados por el
     *
     * NOTA: no considerar posteos publicados por el, implica que
     * el valor de un posteo, para ser recomendado, depende solo de
     * la participacion de terceros en la discusion
     */
    public function idsThreadsLikeados()
    {
        $miId = $this->id;
        $likes = $this->likes;
        $coleccionIds = [];
        foreach ($likes as $like)
        {
            $idPosteo = $like->id;
            $posteo = Posteo::where('id', $idPosteo)->first();
            // Si el posteo no es un comentario, tiene mi 'me gusta' y no es mio, considero su ID
            if (!$posteo->esComentario() && $posteo->id_usuario != $miId)
            {
                array_push($coleccionIds, $idPosteo);
            }
        }
        return $coleccionIds;
    }


    /**
     * Retorna una coleccion de IDs de los posteos que gustaron al
     * usuario y no fueron publicados por el
     *
     * NOTA: no considerar posteos publicados por el, implica que
     * el valor de un posteo, para ser recomendado, depende solo de
     * la participacion de terceros en la discusion
     */
    public function idsThreadsDislikeados()
    {
        $miId = $this->id;
        $dislikes = $this->dislikes;
        $coleccionIds = [];
        foreach ($dislikes as $dislike)
        {
            $idPosteo = $dislike->id;
            $posteo = Posteo::where('id', $idPosteo)->first();
            // Si el posteo no es un comentario, tiene mi 'me gusta' y no es mio, considero su ID
            if (!$posteo->esComentario() && $posteo->id_usuario != $miId)
            {
                array_push($coleccionIds, $idPosteo);
            }
        }
        return $coleccionIds;
    }


    /**
     * Retorna una coleccion de IDs de los posteos que comento el
     * usuario y no fueron publicados por el
     *
     * NOTA: no considerar posteos publicados por el, implica que
     * el valor de un posteo, para ser recomendado, depende solo de
     * la participacion de terceros en la discusion
     */
    public function idsThreadsDebatidos()
    {
        $miId = $this->id;
        $coleccionIds = [];
        $comentarios = $this->posteos->where('id_referido', '!=', null);
        // Para cada commentario del usuario, obtengo los ID de posteos que comento y que no sean suyos
        foreach ($comentarios as $comentario)
        {
            $idReferido = $comentario->id_referido;
            $posteo = Posteo::where('id', $idReferido)->first();
            // Si el posteo principal no es mio, entonces considero el id del comentario para la coleccion
            if (!$posteo->esComentario() && $posteo->id_usuario != $miId)
            {
                array_push($coleccionIds, $idReferido);
            }
        }
        return $coleccionIds;
    }


    /**
     * Retorna una colección con aquellos posteos que no publicó
     * el usuario y para los cuales no ha dado 'me gusta', 
     * 'no me gusta' ni ha comentado
     */
    public function posteosSinParticipacion()
    {
                        // Descarto los threads del usuario
        $posteos = Posteo::where('id_usuario','!=',$this->id)
                        // Descarto los comentarios
                        ->where('id_referido', null)
                        // Descarto posteos que ya le gustan al usuario
                        ->whereNotIn(
                            'id',
                            $this->likes->pluck('id')
                        )
                        // Descarto posteos que no le gustan al usuario
                        ->whereNotIn(
                            'id',
                            $this->dislikes->pluck('id')
                        )
                        // Posteos que se discutieron (comentaron)
                        ->whereNotIn('id_referido', $this->idsThreadsDebatidos())                        
                        ->get();
        return $posteos;
        
    }


    /**
     * Retorna una coleccion de IDs de los topicos a los cuales
     * el usuario esta suscripto
     */
    public function idsTopicosSuscriptos()
    {
        $coleccionIds = [];
        $topicos = $this->suscripciones;
        foreach ($topicos as $topico)
        {
            array_push($coleccionIds, $topico->id);
        }
        return $coleccionIds;
    }


    /**
     * Retorna la entidad de recomendación para el usuario, si existe,
     * asociada
     * al posteo con id dado como argumento
     */
    public function obtenerPosteoRecomendado($id)
    {
        return $this->posteosRecomendados->where('id_recomendado',$id)->first();
    }

}
