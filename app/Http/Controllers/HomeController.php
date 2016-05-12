<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (Auth::user()->type=='admin') {
            return view('admin');
        }elseif(Auth::user()->type=='draft'){
            return view('guest');
        }elseif(Auth::user()->type=='guest'){
            return view('home');
        }else{
            return 'Coming Soon...';
        }
    }
    public function guest(Request $request){
        $user = User::findOrFail(Auth::user()->id);
        if(md5($user->email) == $request->verify){
            $user->type = 'guest';
            $user->save();
            return redirect()->back();
        }else{
            return redirect()->back()->withErrors(['verify'=>'กรุณาตรวจสอบการกรอกข้อมูลอีกครั้ง'])->withInput();
        }
    }
}
