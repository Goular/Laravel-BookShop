<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ValidateController extends Controller
{
    public function create(Request $request)
    {
        //https://github.com/mewebstudio/captcha

        //返回图片的写法
        return \Captcha::create();
        //return captcha();

        //返回URL
        //return captcha_src();

        //返回HTML格式的显示
        //return captcha_img();

        //使用个性化的设计
        //return captcha_img('flat');
        //return \Captcha::img('inverse');
    }
}
