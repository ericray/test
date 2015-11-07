<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract,
                                    /*AuthorizableContract,*/
                                    CanResetPasswordContract
{
    use EntrustUserTrait, Authenticatable, /*Authorizable,*/ CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','sexo_id','estado_id','grupo_id','sexo_id','escuela_id','lastname','lastname2'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public static function getByType($type,$escuela_id = 0,$grupo_id = 0)
    {
        return User::getUserType($type,$escuela_id,$grupo_id);
    }

    /**
     * @param string $type
     * @param int $grupo_id
     * @param string $name
     * @return scope
     */
    public static function getByTypeAndName($type,$grupo_id = 0 ,$name = "",$sort = 'DESC')
    {
        return User::getUserByTypeAndName($type,$grupo_id,$name,$sort);
    }

    public function scopeGetUserByTypeAndName($query,$type,$grupo_id = 0,$name,$orderBy = 'DESC')
    {
        return $query->where('tipos.descripcion','=',$type)
            ->select(DB::raw('users.id,CONCAT(users.name,\' \',users.lastname,\' \',users.lastname2) as name,tipos.id as tipo_id,tipos.descripcion tipo,escuelas.id as escuela_id,escuelas.nombre as escuela'))
            ->join('tipos','users.tipo_id','=','tipos.id')
            ->join('escuelas','users.escuela_id','=','escuelas.id')
            ->where('users.grupo_id','=',$grupo_id)
            ->where('name','LIKE',"%$name%")
            ->orderBy('users.name',$orderBy)
            ->get();
    }

    /**
     * @param $query
     * @param string $type
     * @return User
     */
    public function scopeGetUserType($query, $type,$escuela_id = 0,$grupo_id = 0)
    {
        if(is_numeric($escuela_id) and $escuela_id > 0){
            return $query->where('tipos.descripcion','=',$type)
                ->select(DB::raw('users.id,CONCAT(users.name,\' \',users.lastname,\' \',users.lastname2) as name,tipos.id as tipo_id,tipos.descripcion tipo,escuelas.id as escuela_id,escuelas.nombre as escuela'))
                ->join('tipos','users.tipo_id','=','tipos.id')
                ->join('escuelas','users.escuela_id','=','escuelas.id')
                ->where('users.escuela_id','=',$escuela_id)
                ->get();
        }

        if(is_numeric($grupo_id) and $grupo_id > 0){
            return $query->where('tipos.descripcion','=',$type)
                ->select(DB::raw('users.id,CONCAT(users.name,\' \',users.lastname,\' \',users.lastname2) as name,tipos.id as tipo_id,tipos.descripcion tipo,escuelas.id as escuela_id,escuelas.nombre as escuela'))
                ->join('tipos','users.tipo_id','=','tipos.id')
                ->join('escuelas','users.escuela_id','=','escuelas.id')
                ->where('users.grupo_id','=',$grupo_id)
                ->get();
        }

        if($type == 'Administrador'){
            return $query->where('tipos.descripcion','=',$type)
                ->select(DB::raw('users.id,CONCAT(users.name,\' \',users.lastname,\' \',users.lastname2) as name,tipos.id as tipo_id,tipos.descripcion tipo'))
                ->join('tipos','users.tipo_id','=','tipos.id')
                ->where('users.id','<>',\Auth::user()->id)
                ->get();
        } else{
            return $query->where('tipos.descripcion','=',$type)
                ->select(DB::raw('users.id,CONCAT(users.name,\' \',users.lastname,\' \',users.lastname2) as name,tipos.id as tipo_id,tipos.descripcion tipo,escuelas.id as escuela_id,escuelas.nombre as escuela'))
                ->join('tipos','users.tipo_id','=','tipos.id')
                ->join('escuelas','users.escuela_id','=','escuelas.id')
                ->get();
        }
    }

    public function scopeGetEscuela($query)
    {
        return $query->join('escuelas','users.escuela_id','=','escuelas.id')

                ->select(DB::raw('escuelas.nombre as nombre_escuela'))
                ->where('users.id','=',$this->attributes['id'])
                ->first();
    }

    public function scopeGetTipo($query)
    {
        return $query->join('tipos','tipos.id','=','users.tipo_id')
                    ->select('tipos.descripcion as nombre_tipo')
                    ->where('users.id','=',$this->attributes['id'])
                    ->first();
    }

    public function getTipoAttribute()
    {
        $user = User::getTipo();

        if(isset($user->nombre_tipo)){
            return $user->nombre_tipo;
        }

        return '';
    }

    public function getEscuelaAttribute()
    {
        $escuela = User::getEscuela();
        if(isset($escuela->nombre_escuela)){
            return $escuela->nombre_escuela;
        }

        return '';
    }
}