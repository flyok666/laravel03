<?php

namespace App\Http\Controllers;

use App\School;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //学生列表
    public function index(Request $request)
    {
        //获取查询内容
        $name = $request->name;//张三
        if($name){
            //name有值 需要搜索
            //sql： SELECT * FROM students WHERE name like‘%张%’
            $students = Student::where('name','like',"%{$name}%")->paginate(2);
        }else{
            //name是空
            //获取数据表中所有 的学生
            //$students = Student::all();
            //分页显示
            $students = Student::paginate(2);
        }


        //将$students传递到视图中
        return view('student.index',['students'=>$students,'name'=>$name]);
    }
    //添加学生
    public function add()
    {
        //获取所有学校数据
        $schools = School::all();

        return view('student.add',['schools'=>$schools]);
    }

    //接收表单数据，保存到数据表
    //安全机制 csrf验证
    public function store(Request $request)
    {
        //表单验证   required:不能为空
        $this->validate($request, [
            'name' => 'required',
            'age' => 'required|integer',
            'sex'=> 'required',
            'city'=> 'required',
            'description'=> 'required',
            'school_id'=> 'required',
            //头像验证
            'head'=>'required|image',
        ],[//错误提示信息
            'name.required'=>'姓名不能为空',
            'age.required'=>'年龄不能为空',
            'age.integer'=>'年龄必须是整数',
            'sex.required'=>'性别不能为空',
            'city.required'=>'城市不能为空',
            'school_id.required'=>'学校不能为空',
            'description.required'=>'个人简介不能为空',
            'head.required'=>'请上传头像',
            'head.image'=>'只能上传图片',
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
        $student->sex = $request->sex;
        $student->city = $request->city;
        $student->school_id = $request->school_id;
        $student->description = $request->description;
        //保存学生信息之前处理上传文件
        $path = $request->file('head')->store('public');
        //获取图片的访问地址
        $url = Storage::url($path);

        $student->head = $url;

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
