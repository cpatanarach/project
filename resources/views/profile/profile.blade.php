@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-user"></span><strong>&nbspแก้ไขโปรไฟล์</strong></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/update_profile/{id}') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">ชื่อ</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="firstname" value="{{ $self->firstname }}">

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">สกุล</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="lastname" value="{{ $self->lastname }}">

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ $self->email }}" readonly>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">หน่วยงาน</label>

                            <div class="col-md-6">
                            @if(Auth::user()->type != "admin")
                                <select class="form-control" name="department_id">
                                    @foreach($department as $departments)
                                    @if($departments->id == $self->department_id)
                                    <option value="{{ $departments->id }}" selected>{{ $departments->department_name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            @else
                                <select class="form-control" name="department_id">
                                    @foreach($department as $departments)
                                    @if($departments->id == $self->department_id)
                                    <option value="{{ $departments->id }}" selected>{{ $departments->department_name }}</option>
                                    @else
                                    <option value ="{{ $departments->id }}">{{ $departments->department_name }}</option>
                                    @endif
                                    @endforeach
                                </select>
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
                <div class="alert alert-success col-md-8 col-md-offset-2" role="alert"><span class="glyphicon glyphicon-ok"></span>&nbsp&nbsp{{ Session::get('success') }}</div>
            @endif          
    </div>
</div>
@endsection
