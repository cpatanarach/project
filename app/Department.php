<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['no','date', 'customer', 'address', 'total','user_id', 'read'];
    protected $primaryKey='id';
    public function user(){
    	return $this->belongsTo('App\User',$this->primaryKey);
    }
}