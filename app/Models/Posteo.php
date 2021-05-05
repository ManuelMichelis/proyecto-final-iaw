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
     * DEFINICIÓN DE LOS MÉTODOS PARA MODELAR RELACIONES
     */

    /**
     * Los tópicos a los cuales está suscrito el usuario     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function topicos()
    {
        return $this->belongsToMany(Topico::class, 'exposiciones', 'id_posteo', 'id_topico');
    }

    /**
     * Los comentarios de un posteo y el posteo al cual hace referencia uno en particular
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referido ()
    {
        return $this->belongsTo(Posteo::class, 'id_referido');
    }

    public function replicas ()
    {
        return $this->hasMany(Posteo::class, 'id_referido', 'id');
    }

    /**
     * Las denuncias que puede recibir un posteo particular
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function denuncias ()
    {
        return $this->hasMany(Denuncia::class, 'id_denuncia', 'id_denunciado');
    }


    public function usuario ()
    {
        return $this->belongsTo(User::class, 'alias_usuario');
    }

}
