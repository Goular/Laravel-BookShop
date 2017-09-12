<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;

use App\Models\M3Result;
use App\Models\TempPhone;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;
use Overtrue\EasySms\EasySms;


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

    /**
     * 发送验证码
     * @param Request $request
     */
    public function sendSMS(Request $request)
    {
        $m3_result = new M3Result();
        //获取手机号码
        $phone = request('phone', '');
        if (empty($phone)) {
            $m3_result->status = 1;
            $m3_result->message = '手机号不能为空';
            return $m3_result->toJson();
        }
        if (strlen($phone) != 11 || $phone[0] != '1') {
            $m3_result->status = 2;
            $m3_result->message = '手机格式不正确';
            return $m3_result->toJson();
        }
        $code = "";
        $charset = '1234567890';
        $_len = strlen($charset) - 1;
        $content = "【加工屋】欢迎使用加工屋，您的手机验证码是%s。本条信息无需回复";
        for ($i = 0; $i < 6; ++$i) {
            $code .= $charset[mt_rand(0, $_len)];
        }
        try {
            $easySms = new EasySms(config('sms'));
            $easySms->send($phone, ['content' => sprintf($content, $code)]);
            $tempPhone = TempPhone::where('phone', $phone)->first();
            if ($tempPhone == null) {
                $tempPhone = new TempPhone();
            }
            $tempPhone->phone = $phone;
            $tempPhone->code = $code;
            $tempPhone->deadline = date('Y-m-d H:i:s', time() + 60 * 60);
            $tempPhone->save();
            $m3_result->status = 0;
            return json_encode($m3_result);
        } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $e) {
            dd($e->results);
        } catch (ClientException $e) {
            dd($e);
        }
    }
}
