@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">    	
                    @if (Session::has('success'))
                    <div class="alert alert-success col-md-10 col-md-offset-1" role="alert"><span class="glyphicon glyphicon-ok"></span>&nbsp&nbsp{{ Session::get('success') }}</div>
                    @endif                    
        <div class="col-md-10 col-md-offset-1">
                <table class="table table-hover">
                <tr><td><strong>วันที่ลงทะเบียน</strong></td><td><strong>ชื่อ - สกุล</strong></td><td><strong>หน่วยงาน</strong></td><td></td><td></td></tr>
                    @foreach($department as $departments)
                        <tr><td>{{ $departments->updated_at }}</td><td>{{$departments->department_name}}</td><td>{{$departments->type}}</td><td>
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
