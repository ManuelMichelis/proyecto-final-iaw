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
     * Definición de los métodos para modelar las relaciones
     */

    /**
     * Los tópicos a los cuales está suscrito el usuario     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function topicos()
    {
        return $this->belongsToMany(Topico::class, 'suscripciones', 'alias_usuario', 'id_topico');
    }

}
