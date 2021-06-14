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
     * Para un dado modelo de usuario, retorna 'true' si el usuario es votante del posteo
     */
    public function esVotante (User $usuario)
    {
        $esVotante = $this->votantes()->get()->contains($usuario);
        return $esVotante;
    }


    /**
     * DEFINICIÓN DE LOS MÉTODOS PARA MODELAR RELACIONES
     */

    /**
     * Los tópicos a los cuales está suscrito el usuario     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function topico()
    {
        return $this->belongsTo(Topico::class, 'id_topico_asociado');
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function denuncias ()
    {
        return $this->hasMany(Denuncia::class, 'id_denuncia', 'id_denunciado');
    }

    /**
     * Las denuncias que puede recibir un posteo particular
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario ()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function aliasUsuario ()
    {
        return $this->usuario()->first()->alias;
    }

    public function votantes ()
    {
        return $this->belongsToMany(User::class, 'gustados', 'id_posteo', 'id_usuario');
    }

}
