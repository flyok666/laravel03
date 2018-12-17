@extends('layout.default')

@section('content')
    <h1>修改密码</h1>
    @include('layout._error')
    <form method="post" action="/updatePw">
        <div class="form-group">
            <label>旧密码</label>
            <input type="password" class="form-control" name="password" >
        </div>
        <div class="form-group">
            <label>新密码</label>
            <input type="password" class="form-control" name="newpassword" >
        </div>
        <div class="form-group">
            <label>确认新密码</label>
            <input type="password" class="form-control" name="newpassword_confirmation" >
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@stop