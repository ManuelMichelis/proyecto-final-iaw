<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topico extends Model
{
    use HasFactory;

    /**
     * Atributos agregados
     *
     */
    public $incrementing = true;

    protected $table = 'topicos';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];


    /**
     * Definición de los métodos para modelar las relaciones
     */

    /**
     * Los tópicos a los cuales está suscrito el usuario     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function suscriptos()
    {
        return $this->belongsToMany(User::class, 'suscripciones', 'id_topico', 'alias_usuario');
    }

    /**
     * Los tópicos asociados a un posteo     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function exposiciones()
    {
        return $this->belongsToMany(Posteo::class, 'exposiciones', 'id_topico', 'id_posteo');
    }

}
