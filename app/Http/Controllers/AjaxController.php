<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Department;
use App\Division;
use App\User;

class AjaxController extends Controller
{
    public function getdepartment(Request $request){
    	return Division::findOrFail($request->id)->hasDepartment;
    }
}
