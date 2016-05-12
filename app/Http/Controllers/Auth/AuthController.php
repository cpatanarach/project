<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/system';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|max:32',
            'lastname' => 'required|max:32',
            'email' => 'required|email|max:64|unique:users',
            'password' => 'required|min:6|confirmed',
            'department_id'=>'numeric',
            'division_id'=>'numeric',
            
        ],[
            'max'=>'ข้อมูลยาวเกินไป',
            'min'=>'ข้อมูลสั้นเกินไป',
            'required'=>'ข้อมูลที่จำเป็น',
            'unique'=>'อีเมลถูกใช้แล้ว',
            'numeric'=>'ข้อมูลจำเป็น',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'department_id' => $data['department_id'],
            'division_id' => $data['division_id'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'type' => 'draft',
        ]);
    }
}
