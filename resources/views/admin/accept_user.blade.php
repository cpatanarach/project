@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">    	
                    @if (Session::has('success'))
                    <div class="alert alert-success col-md-10 col-md-offset-1" role="alert"><span class="glyphicon glyphicon-ok"></span>&nbsp&nbsp{{ Session::get('success') }}</div>
                    @endif                    
        <div class="col-md-12">
                <table class="table table-hover">
                <tr><td><strong>วันที่ลงทะเบียน</strong></td><td><strong>ชื่อ - สกุล</strong></td><td><strong>หน่วยงาน</strong></td><td><strong>ส่วนกลาง</strong></td><td><strong>ระดับผู้ใช้งาน</strong></td><td></td></tr>
                    @forelse($guest as $user)
                        <tr><td>{{ $user->updated_at }}</td><td>{{$user->firstname}}&nbsp&nbsp{{$user->lastname}}</td><td>{{$user->getDepartment->department_name}}</td><td>{{$user->getDivision->division_name}}</td>
                            <form class="form-horizontal" role="form" name="accept{{$user->id}}" action="{{ url('accept_user/{id}') }}" method="post">{!! csrf_field() !!}
                            <td>
                            <input type="hidden" name="id" value="{{$user->id}}"></input>
                            <select name="type">
                                <option value="guest">Guest</option>
                                <option value="user">ผู้ใช้งาน</option>
                                <option value="author">เจ้าหน้าที่</option>
                                <option value="ceo">ผู้บริหาร</option>
                            </select>
                        </td><td>
                            <button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-btn fa-sign-in"></i><i>ยอมรับ</i></button>
                    </td></form></tr>
                    @empty
                        <tr class="danger"><td></td><td><p class="text-danger"><ยังไม่มีผู้ลงทะเบียน><p></td><td></td><td></td><td></td><td></td></tr>
                    @endforelse
                </table>
        </div>
    </div>
</div>
@endsection
