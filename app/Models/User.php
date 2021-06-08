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
    public $incrementing = false;

    protected $table = 'usuarios';
    protected $primaryKey = 'alias';

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
        return $this->belongsToMany(User::class, 'seguimientos', 'alias_seguidor', 'alias_seguido');
    }

    public function seguidores()
    {
        return $this->belongsToMany(User::class, 'seguimientos', 'alias_seguido', 'alias_seguidor');
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
        return $this->belongsToMany(Topico::class, 'suscripciones', 'alias_suscripto', 'id_topico');
    }

    /**
     * Los tópicos a los cuales está suscrito el usuario
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posteos()
    {
        return $this->hasMany(Posteo::class, 'publicaciones', 'alias_usuario', 'id_posteo');
    }

    /**
     * Los bloqueos de cuenta que ha recibido el usuario
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bloqueos()
    {
        return $this->hasMany(Denuncia::class, 'bloqueos', 'alias_usuario', 'id_denuncia');
    }

    /**
     * Los 'me gusta' que ha realizado el usuario sobre posteos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gustados()
    {
        return $this->hasMany(Posteo::class, 'votaciones', 'alias_usuario', 'id_posteo');
    }


}
