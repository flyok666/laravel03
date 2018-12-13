<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return redirect('/login')->with('danger','登录失败');
    }

    //退出登录
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success','您已安全退出');
    }

}
