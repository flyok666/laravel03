<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //登录
    public function login()
    {
        return view('user.login');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'username'=>'required',
                'password'=>'required',
            ],
            [
                'username.required'=>'用户名不能为空',
                'password.required'=>'密码不能为空',
            ]);

        //验证账号密码是否正确
        if(Auth::attempt([
            'username'=>$request->username,
            'password'=>$request->password
        ])){//验证通过，说明登录成功
            return redirect('/admin/index')->with('success','登录成功');
        }
        //验证失败，提示错误信息
        return redirect('/login')->with('danger','登录失败,用户名或密码错误');
    }

    //退出登录
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success','您已安全退出');
    }

    //修改密码
    public function password()
    {
        return view('user.password');
    }

    public function updatePw(Request $request)
    {
        $this->validate($request,
            [
                'password'=>'required',
                'newpassword'=>'required|confirmed',
                'newpassword_confirmation'=>'required',
            ],
            [
                'password.required'=>'旧密码不能为空',
                'newpassword.required'=>'新密码不能为空',
                'newpassword.confirmed'=>'两次密码不一致',
                'newpassword_confirmation.required'=>'确认新密码不能为空',
            ]
        );
        //获取当前登录用户
        $admin = auth()->user();
        //验证旧密码
        if(!Hash::check($request->password,$admin->password)){
            //验证没有通过  旧密码不正确
            return back()->with('danger','旧密码不正确');
        }
        //旧密码正确 更新新密码
        $admin->password = Hash::make($request->newpassword);
        $admin->save();

        Auth::logout();
        return redirect('/login')->with('success','密码修改成功，请重新登录');

    }

}
