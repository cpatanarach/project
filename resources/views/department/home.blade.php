@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading"><span class="glyphicon glyphicon-plus"></span><strong>&nbspเพิ่มหน่วยงานเข้าระบบ</strong></div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/add_department') }}">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('department_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">ชื่อหน่วยงาน</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="department_name" placeholder="กรอกชื่อหน่วยงาน" value="{{ old('department_name') }}">

                                @if ($errors->has('department_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department_name') }}</strong>
                                    </span>
                                @endif
                            </div>                         
                        </div>

                        <div class="form-group{{ $errors->has('division_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">ส่วนกลาง</label>
                            <div class="col-md-6">
                                <select class="form-control" name="division_id">
                                    @foreach($division as $divisions)
                                        <option value="{{ $divisions->id }}">{{ $divisions->division_name }}</option>
                                    @endforeach
                                </select>
                            </div>                            
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-save"></i>บันทึกข้อมูล
                                </button>
                            </div>
                        </div>  
                            
                    </form>                    
                </div>
            </div>
        </div>        
                    @if (Session::has('success'))
                    <div class="alert alert-success col-md-10 col-md-offset-1" role="alert"><span class="glyphicon glyphicon-ok"></span>&nbsp&nbsp{{ Session::get('success') }}</div>
                    @endif
                    
        <div class="col-md-10 col-md-offset-1">
                <table class="table table-hover">
                <tr><td><strong><center>ลำดับที่</center></strong></td><td><strong>ชื่อหน่วยงาน</strong></td><td><strong>ส่วนกลาง</strong></td><td></td><td></td></tr>
                    @foreach($department as $index => $departments)
                        <tr><td><center>{{ $index+1 }}</center></td><td>{{$departments->department_name}}</td><td>
                        @foreach($division as $divisions)
                            @if($divisions->id == $departments->division_id)
                                {{ $divisions->division_name }}
                            @endif
                        @endforeach
                        </td><td>
                            <form class="form-horizontal" role="form" name="edit{{$departments->id}}" action="{{ url('edit_department/{id}') }}" method="post">{!! csrf_field() !!}
                        
                            <input type="hidden" name="id" value="{{$departments->id}}"></input>
                            <button type="submit" class="btn btn-primary btn-xs"><i>แก้ไขข้อมูล</i></button>
                            </form>
                        </td><td><form class="form-horizontal" role="form" name="del{{$departments->id}}" action="{{ url('del_department/{id}') }}" method="post">{!! csrf_field() !!}
                        
                            <input type="hidden" name="id" value="{{$departments->id}}"></input>
                            <button type="submit" class="btn btn-danger btn-xs"><i>ลบข้อมูล</i></button>
                    </form></td></tr>
                    @endforeach
                </table>
        </div>

    </div>
</div>
@endsection
