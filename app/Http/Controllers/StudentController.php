<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //学生列表
    public function index()
    {
        //获取数据表中所有 的学生
        //$students = Student::all();
        //分页显示
        $students = Student::paginate(5);
        //将$students传递到视图中
        return view('student.index',['students'=>$students]);
    }
    //添加学生
    public function add()
    {
        return view('student.add');
    }

    //接收表单数据，保存到数据表
    //安全机制 csrf验证
    public function store(Request $request)
    {
        //表单验证   required:不能为空
        $this->validate($request, [
            'name' => 'required',
            'age' => 'required|integer',
        ],[//错误提示信息
            'name.required'=>'姓名不能为空',
            'age.required'=>'年龄不能为空',
            'age.integer'=>'年龄必须是整数',
        ]);
        //验证失败，会跳转回表单页面
        //验证通过，继续往下执行

        //接收表单提交的数据
        //$name = $_POST['name'];
        //$name = $request->name;
        //var_dump($name);
        //保存数据
        $student = new Student();
        $student->name = $request->name;
        $student->age = $request->age;
        $student->save();
        //echo '保存成功';
        //跳转到学生列表页    带上操作提示信息
        return redirect('/student/index')->with('success','添加用户成功');
    }

    //修改学生信息
    public function edit($id)
    {
        //dd($id);
        //根据id获取对应的学生信息
        $student = Student::find($id);


//        return view('student.edit',['student'=>$student]);
        return view('student.edit',compact('student'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
            'age' => 'required|integer',
        ],[//错误提示信息
            'name.required'=>'姓名不能为空',
            'age.required'=>'年龄不能为空',
            'age.integer'=>'年龄必须是整数',
        ]);
        //$student = new Student();
        $student = Student::find($id);
        $student->name = $request->name;
        $student->age = $request->age;
        $student->save();
        //echo '保存成功';
        //跳转到学生列表页    带上操作提示信息
        return redirect('/student/index')->with('success','修改用户成功');

    }

    //删除学生
    public function delete($id)
    {
        Student::destroy($id);
        return redirect('/student/index')->with('success','删除用户成功');

    }

}
