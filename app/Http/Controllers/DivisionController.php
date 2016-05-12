<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Division;
use Auth;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function validator($data){
        if(empty($data['id'])){$data['id']=0;}
        return Validator::make($data, [
            'division_name' => 'required|min:6|max:64|unique:divisions,division_name,'.$data['id'],
        ],[
            'required'=>'ข้อมูลที่จำเป็น',
            'min'=>'ไม่ควรใช้อักษรย่อ',
            'max'=>'ข้อมูลยาวเกินไป',
            'unique'=>'มีข้อมูลแล้ว',
        ]);
    }
    public function index()
    {
        if(Auth::user()->type == 'admin'){
            return view('division.home')->with('division', Division::all());
        }else{
            Auth::logout();
            return redirect()->back();
        }
    }
    public function store(Request $request)
    {
        if(Auth::user()->type == 'admin'){
            $errors = $this->validator($request->all());
            if($errors->passes()){            
                Division::create([
                    'division_name'=>$request->division_name,]);
                return redirect()->back()->with('success','บันทึกข้อมูลแล้ว');
            }else{
            return redirect()->back()->withErrors($errors)->withInput();
            }
        }else{
            Auth::logout();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if(Auth::user()->type == 'admin'){
            $division = Division::findOrFail($request->id);
            return view('division.edit')->with('division',$division);

        }else{
            Auth::logout();
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(Auth::user()->type == 'admin'){
            $errors = $this->validator($request->all());
            if($errors->passes()){
                $division = Division::findOrFail($request->id);
                $division->division_name = $request->division_name;
                $division->save();
                return redirect('division')->with('success','บันทึกข้อมูลแล้ว');
            }else{
                $division = new Division;
                $division->id = $request->id;
                $division->division_name = $request->division_name;
                return view('division.edit')->with('division', $division)->withErrors($errors);
            }
        }else{
            Auth::logout();
            return redirect()->back();
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(Auth::user()->type == 'admin'){
            Division::findOrFail($request->id)->delete();
            return redirect()->back()->with('success','ลบข้อมูลแล้ว');
        }else{
            Auth::logout();
            return redirect()->back();
        }     
    }
}
