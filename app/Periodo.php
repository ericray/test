<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Builder;

class Periodo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'periodos';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public $fillable = ['descripcion','ano_inicio','ano_fin','escuela_id'];

    public function scopeGetPeriodoAndId($query)
    {
        return $query->select('id','descripcion')->get();
    }

    public static function getIdAndDescripcion()
    {
        return Periodo::getPeriodoAndId();
    }
}