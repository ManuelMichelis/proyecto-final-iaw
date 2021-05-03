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
        'contenido',
        'votos',
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
        return $this->belongsToMany(Topico::class, 'topicos_posteos', 'id_posteo', 'id_topico');
    }

}
