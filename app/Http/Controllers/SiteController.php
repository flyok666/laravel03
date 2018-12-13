<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    //about方法
    public function about()
    {
        //echo 'about';
        //调用视图文件（resources/views/   site/about  .blade.php）
        return view('site.about');
    }

    public function info()
    {
        echo 'info';
    }
}
