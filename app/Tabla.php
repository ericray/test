<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tabla extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tablas';

    /**
     * The attribute created_at and updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var array
     */
    protected $fillable = ['descripcion'];
}
