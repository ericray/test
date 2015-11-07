<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'estados';

    /**
     * The attribute created_at and updated_at
     *
     * @var array
     */
    protected $fillable = ['descripcion'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
