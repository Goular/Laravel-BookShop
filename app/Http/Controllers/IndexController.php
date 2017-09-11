<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * 首页控制器
 *
 * Class IndexController
 * @package App\Http\Controllers
 */
class IndexController extends Controller
{
    //首页展示
    public function index(){
        return view('welcome');
    }
}
