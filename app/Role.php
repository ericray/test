<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $table = 'roles';
    protected $fillable = ['name','display_name','description'];

    public function scopeGetRoleByName($query,$name)
    {
        return $query->where('name','=',$name)->get()->first();
    }

    public static function getByName($name)
    {
        return Role::getRoleByName($name);
    }
}
