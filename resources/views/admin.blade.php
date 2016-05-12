@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-user"></span><strong>&nbsp การจัดการผู้ใช้งาน</strong></div>

                <div class="panel-body">
                    <ul><ul>
                        <li class="btn-link"><a class="btn-link" href="{{url('/accept/{id}')}}">อนุญาตผู้ใช้งานเข้าสู่ระบบ</a></li>
                        <li class="btn-link"><a class="btn-link" href="{{url('/department')}}">การจัดการผู้ใช้งานภายในระบบ</a></li>
                    </ul></ul>
                </div>
                <div class="panel-heading"><strong>Administrator's Page</strong></div>

                <div class="panel-body">
                <ul><ul>
                        <li class="btn-link"><a class="btn-link" href="{{url('/division')}}">การจัดการหน่วยงานส่วนกลาง</a></li>
                        <li class="btn-link"><a class="btn-link" href="{{url('/department')}}">การจัดการหน่วยงานส่วนภูมิภาค</a></li>
                </ul></ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
