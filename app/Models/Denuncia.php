<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

    /**
     * Atributos agregados
     *
     */
    public $incrementing = true;

    protected $table = 'denuncias';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'problema',
        'detalle',
    ];


    /**
     * DEFINICIÓN DE LOS MÉTODOS PARA MODELAR RELACIONES
     */

    /**
     * Posteo al cual le corresponde la denuncia
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function denunciado ()
    {
        return $this->belongsTo(Posteo::class, 'id_denunciado');
    }

    /**
     * El usuario, si existe, que fue bloqueado consecuencia del posteo reportado
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bloqueado ()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

}
