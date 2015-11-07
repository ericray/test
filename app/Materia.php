<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'materias';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
