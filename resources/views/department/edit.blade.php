@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span><strong>&nbspแก้ไขข้อมูล</strong></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/update_department/{id}') }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">ID</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="id" value="{{ $department->id }}" readonly>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('department_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">ชื่อหน่วยงาน</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="department_name" value="{{ $department->department_name }}">

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
                                        @if($divisions->id == $department->division_id)
                                            <option value="{{$divisions->id}}" selected>{{$divisions->division_name}}</option>
                                        @else
                                            <option value="{{$divisions->id}}">{{$divisions->division_name}}</option>
                                        @endif
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
    </div>
</div>
@endsection
