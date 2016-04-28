<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Department;
use App\Division;
use Auth;
class DepartmentController extends Controller
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

    public function index()
    {
        if(Auth::user()->type == 'admin'){
            return view('department.home')->with('department', Department::all())->with('division', Division::all());
        }else{
            Auth::logout();
            return redirect()->back();
        }
    }
    public function validator($data){
        return Validator::make($data, [
            'department_name' => 'required|min:10|max:64|unique:departments,department_name,'.$data['id'],
            'division_id' => 'required|numeric',
        ],[
            'required'=>'ข้อมูลที่จำเป็น',
            'min'=>'ไม่ควรใช้อักษรย่อ',
            'max'=>'ข้อมูลยาวเกินไป',
            'unique'=>'มีข้อมูลแล้ว',
        ]);
    }
    public function store(Request $request){        
        if(Auth::user()->type == 'admin'){
            $errors = $this->validator($request->all());
            if($errors->passes()){            
                Department::create([
                    'department_name'=>$request->department_name,
                    'division_id'=>$request->division_id]);
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
            $department = Department::findOrFail($request->id);
            return view('department.edit')->with('department',$department)->with('division', Division::all());

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
                $department = Department::findOrFail($request->id);
                $department->department_name = $request->department_name;
                $department->division_id = $request->division_id;
                $department->save();
                return redirect('department')->with('success','บันทึกข้อมูลแล้ว');
            }else{
                $department = new Department;
                $department->id = $request->id;
                $department->department_name = $request->department_name;
                $department->division_id = $request->division_id;
                return view('department.edit')->with('department', $department)->with('division', Division::all())->withErrors($errors);
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
            Department::findOrFail($request->id)->delete();
            return redirect()->back()->with('success','ลบข้อมูลแล้ว');
        }else{
            Auth::logout();
            return redirect()->back();
        }        
    }
}
