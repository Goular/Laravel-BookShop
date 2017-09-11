<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * 注册需要展示的页面
     */
    public function index(){
        return view("frontend.register.index");
    }
}
