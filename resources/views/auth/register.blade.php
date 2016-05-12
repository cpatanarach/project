@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-user"></span><strong>&nbspแบบฟอร์มลงทะเบียนเข้าใช้งานระบบ</strong></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">ชื่อ</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}">

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
                                <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">

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
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">รหัสผ่าน</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">ยืนยันรหัสผ่าน</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('division_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">ส่วนกลาง</label>

                            <div class="col-md-6">
                                <select id="division_id" class="form-control" name="division_id">
                                    <option value="draf">เลือกส่วนกลาง</option>
                                    @foreach($division as $divisions)
                                    @if(old('division_id')==$divisions->id)
                                        <option value="{{$divisions->id}}" selected="">{{$divisions->division_name}}</option>
                                    @endif
                                        <option value="{{$divisions->id}}">{{$divisions->division_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">หน่วยงาน</label>

                            <div class="col-md-6">
                                <select id="department_id" class="form-control" name="department_id">
                                    <option value="draft">เลือกหน่วยงาน</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>ลงเทะเบียน
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
@section('script')

    <script>
        $(document).ready(function(){
            alert('document.ready');
        });
        $('#division_id').change(function(){
            $('#department_id').find('option').remove().end();
            $('#department_id').append('<option value="draft">เลือกส่วนกลาง</option>');
            $.post('{{url('getdepartment')}}',
                {'id':$(this).val(),'_token':$('input[name=_token]').val()},function(response){
                $('#department_id').append('<option value="0">สังกัดส่วนกลาง</option>');
                $.each(response, function(row, department) {
                    $('#department_id').append('<option value="'+department.id+'">'+department.department_name+'</option>');
                });
            });
        });

    </script>

@endsection