@extends('layout.default')

@section('content')


    <h1>学生列表</h1>
    <form method="get" action="/student/index" class="form-inline">
        <div class="form-group">
            <label>姓名</label>
            <input type="text" class="form-control" name="name">
        </div>

        <button type="submit" class="btn btn-default">查找</button>
    </form>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>姓名</th>
            <th>头像</th>
            <th>年龄</th>
            <th>学校</th>
            <th>操作</th>
        </tr>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td><img src="{{ $student->head }}" /> </td>
                <td>{{ $student->age }}</td>
                <td>{{ $student->school_id?$student->school->name:'-' }}</td>

                <td>
                    <a href="/student/edit/{{ $student->id }}" >编辑</a>
                    <a href="/student/delete/{{ $student->id }}" >删除</a>
                </td>
            </tr>
        @endforeach
        {{--<tr>
            <td>1</td>
            <td>王大锤</td>
            <td>20</td>
            <td>编辑 查看</td>
        </tr>
        <tr>
            <td>2</td>
            <td>王尼玛</td>
            <td>22</td>
            <td>编辑 查看</td>
        </tr>--}}
    </table>
        {{ $students->appends(['name'=>$name])->links() }}
@stop