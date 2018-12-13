@extends('layout.default')

@section('content')
    <h1>修改账号</h1>
    @include('layout._error')
    <form method="post" action="/admin/update/{{ $admin->id }}">
        <div class="form-group">
            <label>用户名</label>
            <input type="text" class="form-control" name="username" value="{{ $admin->username }}" >
        </div>

        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    @stop