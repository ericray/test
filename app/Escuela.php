<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'escuelas';

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
    protected $fillable = ['nombre'];

    public function scopeGetEscuelaByEstado($query,$estado_id)
    {
        return $query->join('estados','estados.id','=','escuelas.estado_id')
                     ->where('estados.id','=',$estado_id)
                     ->select('escuelas.*')
                     ->get();
    }

    public static function getByEstado($estado_id)
    {
        return Escuela::getEscuelaByEstado($estado_id);
    }
}