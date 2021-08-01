<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
     * https://laracasts.com/discuss/channels/eloquent/laravel-eloquent-followers-relationship
     * PARA CUANDO SE DEBA IMPLEMENTAR LA INSERCIÓN DE SEGUIDORES/SEGUIDOS
     */

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
    public function gustados()
    {
        return $this->belongsToMany(Posteo::class, 'gustados', 'id_usuario', 'id_posteo');
    }


    /**
     * Controla si un dado posteo fue publicado por el usuario en sesion
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
     * Determina si el usuario esta suscripto al topico dado como
     * argumento
     */
    public function suscripto (Topico $topico)
    {
        $id = $topico->id;
        $suscripcion = $this->suscripciones->where('id', $id)->first();
        return $suscripcion != null;
    }


    /**
     * Retorna la coleccion de posteos realizados por el usuario
     */
    public function discusionesOriginadas ()
    {
        return $this->posteos->where('titulo','!=', null);
    }

}
