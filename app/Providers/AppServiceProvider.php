<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //如果你正在运行的 MySQL release 版本低于5.7.7 或 MariaDB release 版本低于10.2.2 ，为了MySQL为它们创建索引，你可能需要手动配置迁移生成的默认字符串长度
        Schema::defaultStringLength(191);

        //用于数据库的监听
        \DB::listen(function ($query) {
            $sql = $query->sql;
            //PDO预处理需要绑定的对象
            $binding = $query->bindings;
            $time = $query->time;
            //var_export -- 输出或返回一个变量的字符串表示
            \Log::debug('SQL查询详情',compact('sql', 'binding', 'time'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
