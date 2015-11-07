<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Tarea extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tareas';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function scopeAttachAlumno($query,$alumno_id)
    {
        $id = 0;
        if(is_object($alumno_id)){
            if($alumno_id->id)
                $id = $alumno_id->id;
        } elseif(is_integer($alumno_id)){
            $id = $alumno_id;
        }

        if($tarea_id = $this->attributes['id']){
            if(is_integer($id)){
                \DB::table('tarea_alumno')->insert([
                    'tarea_id' => $tarea_id,
                    'alumno_id' => $id
                ]);
            } else{
                return false;
            }
        }else{
            return false;
        }

        return true;
    }

    public static function getByAlumno($alumno_id,$nombre = "")
    {
        return Tarea::getTareaByAlumno($alumno_id,$nombre);
    }

    public function scopeGetTareaByAlumno($query,$alumno_id,$nombre = "")
    {
        return $query->select(\DB::raw('tareas.*,estatus.descripcion estatus'))
            ->join('tarea_alumno','tarea_alumno.tarea_id','=','tareas.id')
            ->join('users','users.id','=','tarea_alumno.alumno_id')
            ->join('tipos','tipos.id','=','users.tipo_id')
            ->join('estatus','estatus.id','=','tareas.estatus_id')
            ->join('tablas','tablas.id','=','estatus.tabla_id')
            ->where('tablas.descripcion','tareas')
            ->where('tipos.descripcion','Alumno')
            ->where('users.id',$alumno_id)
            ->where('tareas.nombre','LIKE',"%$nombre%");
    }
}
