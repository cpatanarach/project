@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span><strong>&nbspแก้ไขข้อมูลหน่วยงาน(ส่วนกลาง)</strong></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/update_division/{id}') }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">ID</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="id" value="{{ $division->id }}" readonly>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('division_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">ชื่อหน่วยงาน</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="division_name" value="{{ $division->division_name }}">

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
    </div>
</div>
@endsection
