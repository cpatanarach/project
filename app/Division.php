<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = ['division_name',];
    protected $primaryKey='id';
    public function hasDepartment(){
    	return $this->hasMany('App\Department');
    }
    public function hasUser(){
    	return $this->hasMany('App\User');
    }
}
