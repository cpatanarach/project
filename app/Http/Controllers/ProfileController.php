<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Department;
use Auth;
use Validator;
use App\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|max:32',
            'lastname' => 'required|max:32',
            
        ],[
            'max'=>'ข้อมูลยาวเกินไป',
            'min'=>'ข้อมูลสั้นเกินไป',
            'required'=>'ข้อมูลที่จำเป็น',
            'unique'=>'อีเมลถูกใช้แล้ว',
        ]);
    }

    public function show()
    {
        return view('profile.profile')->with('self', Auth::user())->with('department', Department::all());
    }

    public function update(Request $request)
    {
        $errors = $this->validator($request->all());
        if(Auth::check()){
            if($errors->passes()){
                $self = Auth::user();
                $self->firstname = $request->firstname;
                $self->lastname = $request->lastname;
                $self->email = $request->email;
                $self->department_id = $request->department_id;
                $self->save();
                return redirect()->back()->with('success','บันทึกข้อมูลแล้ว');
            }else{
                $self = new User;
                $self->firstname = $request->firstname;
                $self->lastname = $request->lastname;
                $self->email = $request->email;
                $self->department_id = $request->department_id;
                return view('profile.profile')->withErrors($errors)->with('self', $self)->with('department', Department::all());
            }
        }else{
            Auth::logout();
            return redirect()->back();
        }   
    }
}
