@extends('layout.default')

@section('content')
    <h1>添加学生</h1>

    @include('layout._error')

    <form method="post" action="/student/store" enctype="multipart/form-data">
        <div class="form-group">
            <label>姓名</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" >
        </div>
        <div class="form-group">
            <label>上传头像</label>
            <input type="file" name="head" >
        </div>
        <div class="form-group">
            <label>年龄</label>
            <input type="text" class="form-control" name="age" value="{{ old('age') }}" >
        </div>
        <div class="form-group">
            <label>性别</label>
            <label class="radio-inline">
                <input type="radio" name="sex" value="1" @if(old('sex')==1) checked="checked" @endif > 男
            </label>
            <label class="radio-inline">
                <input type="radio" name="sex" value="2" @if(old('sex')==2) checked="checked" @endif> 女
            </label>
        </div>
        <div class="form-group">
            <label>城市</label>
            <select name="city" class="form-control">
                <option @if(old('city')=='北京') selected="selected" @endif>北京</option>
                <option @if(old('city')=='上海') selected="selected" @endif>上海</option>
                <option @if(old('city')=='广州') selected="selected" @endif>广州</option>
                <option @if(old('city')=='重庆') selected="selected" @endif>重庆</option>
                <option @if(old('city')=='成都') selected="selected" @endif>成都</option>
            </select>
        </div>
        <div class="form-group">
            <label>个人介绍</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@stop