@extends('layout.default')

@section('content')
    <h1>登录</h1>
    @include('layout._error')
    <form method="post" action="/store">
        <div class="form-group">
            <label>用户名</label>
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" >
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" >
        </div>
        <div class="form-group">
            <label>验证码</label>
            <input id="captcha" class="form-control" name="captcha" >
            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">登录</button>
    </form>
@stop