<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Grupo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'grupos';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = ['descripcion','escuela_id'];

    public static function getByEscuela($escuela_id)
    {
        return Grupo::getGrupoByEscuela($escuela_id);
    }

    public function scopeGetGrupoByEscuela($query,$escuela_id)
    {
        return $query->join('escuelas','escuelas.id','=','grupos.escuela_id')
              ->where('escuelas.id','=',$escuela_id)
              ->select(\DB::raw('grupos.*'))
              ->get();
    }
}
