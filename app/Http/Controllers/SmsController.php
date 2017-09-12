<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;

class SmsController extends Controller
{
    protected $config;

    /**
     * SmsController constructor.
     * @param $config
     */
    public function __construct()
    {
        $this->config = config('sms');
    }


    public function sendSms(Request $request, $id)
    {
        //获取需要发送何种功能的验证码
        $func = intval($id, 0);
        $content = "";
        switch ($func) {
            case 1://登录注册
                $content = "【加工屋】欢迎使用加工屋，您的手机验证码是951753。本条信息无需回复";
                break;
            case 2://修改密码
                $content = "【加工屋】正在找回密码，您的验证码是159357";
                break;
            case 3://忘记密码
                $content = "【加工屋】正在找回密码，您的验证码是147963";
                break;
            default:
                abort(404);
                return;
        }
        try {
            $easySms = new EasySms($this->config);
            $easySms->send("15800279296", ['content' => $content]);
        } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $e) {
            dd($e->results);
        }catch(ClientException $e){
            dd($e);
        }
        echo "发送成功";
    }
}
