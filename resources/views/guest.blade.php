@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>@&nbspลงทะเบียนอีเมล</strong></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/guest/{id}') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('verify') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label">รหัสยืนยัน</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" name="verify" value="{{ old('verify') }}" placeholder="กรอกรหัสยืนยันที่ได้รับจากอีเมล">

                                @if ($errors->has('verify'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('verify') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-send"></i>ส่งรหัส
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
