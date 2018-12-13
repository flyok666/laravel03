@extends('layout.default')

@section('content')
    <h1>账号列表</h1>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->username }}</td>
                <td>
                    <a href="/admin/edit/{{ $admin->id }}" >编辑</a>
                    <a href="/admin/delete/{{ $admin->id }}" >删除</a>
                </td>
            </tr>

            @endforeach
    </table>
    @stop