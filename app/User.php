<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'department_id', 'division_id', 'email', 'password', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $primaryKey='id';
    public function getDepartment(){
        return $this->belongsTo('App\Department',$this->primaryKey);
    }
    public function getDivision(){
        return $this->belongsTo('App\Division',$this->primaryKey);
    }
}
