<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recordatorio extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'recordatorios';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
