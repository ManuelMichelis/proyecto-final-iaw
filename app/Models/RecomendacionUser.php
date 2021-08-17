<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecomendacionUser extends Model
{
    use HasFactory;

    /**
     * Atributos agregados
     *
     */

    protected $table = 'usuarios_recomendados';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'valor_recomendacion',
    ];


}
