<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\HttpKernel\DataCollector\TimeDataCollector;

class Tipo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipos';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fill mass attributes
     *
     * @var array
     */
    public $fillable = ['descripcion','tabla_id'];

    /**
     * Get scope model by name
     *
     * @param $query
     * @param string $name
     */
    public function scopeGetByName($query,$name)
    {
        return $query->where('descripcion','=',$name)->get()->first();
    }

    public static function byName($name)
    {
        return Tipo::getByName($name);
    }

    public static function getByTabla($name)
    {
        return Tipo::getTipoByTabla($name);
    }

    public function scopeGetTipoByTabla($query,$name)
    {
        return $query->join('tablas','tipos.tabla_id','=','tablas.id')
              ->where('tablas.descripcion','=',$name)
              ->select(\DB::raw('tablas.*'))
              ->get();
    }
}
