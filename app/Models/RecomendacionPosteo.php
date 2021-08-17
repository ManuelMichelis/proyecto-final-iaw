<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecomendacionPosteo extends Model
{
    use HasFactory;

    /**
     * Atributos agregados
     *
     */

    protected $table = 'posteos_recomendados';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'valor_recomendacion',
    ];


}
