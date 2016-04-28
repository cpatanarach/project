@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading"><span class="glyphicon glyphicon-plus"></span><strong>&nbspเพิ่มหน่วยงาน(ส่วนกลาง)เข้าระบบ</strong></div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/add_division') }}">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('division_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">ชื่อหน่วยงาน</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="division_name" placeholder="กรอกชื่อหน่วยงาน" value="{{ old('division_name') }}">

                                @if ($errors->has('division_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('division_name') }}</strong>
                                    </span>
                                @endif
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
                <tr><td><strong><center>ลำดับที่</center></strong></td><td><strong>แก้ไขล่าสุด</strong></td><td><strong>ชื่อหน่วยงาน</strong></td><td></td><td></td></tr>
                    @foreach($division as $index => $divisions)
                        <tr><td><center>{{ $index+1 }}</center></td><td>{{$divisions->updated_at}}</td><td>{{$divisions->division_name}}</td><td>
                            <form class="form-horizontal" role="form" name="edit{{$divisions->id}}" action="{{ url('edit_division/{id}') }}" method="post">{!! csrf_field() !!}
                        
                            <input type="hidden" name="id" value="{{$divisions->id}}"></input>
                            <button type="submit" class="btn btn-primary btn-xs"><i>แก้ไขข้อมูล</i></button>
                            </form>
                        </td><td><form class="form-horizontal" role="form" name="del{{$divisions->id}}" action="{{ url('del_division/{id}') }}" method="post">{!! csrf_field() !!}
                        
                            <input type="hidden" name="id" value="{{$divisions->id}}"></input>
                            <button type="submit" class="btn btn-danger btn-xs"><i>ลบข้อมูล</i></button>
                    </form></td></tr>
                    @endforeach
                </table>
        </div>

    </div>
</div>
@endsection
