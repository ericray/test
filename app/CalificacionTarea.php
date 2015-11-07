<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalificacionTarea extends Model
{
    /**
     * @var string
     */
    protected $table = 'calificacion_tareas';

    /**
     * @var array
     */
    protected $fillable = ['observaciones','evaluacion'];

    /**
     * @var bool
     */
    public $timestamps = false;
}
