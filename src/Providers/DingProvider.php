<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/8
 * Time: 上午10:15
 */

namespace HXSD\Ding\Providers;


use Illuminate\Support\ServiceProvider;
use HXSD\Ding\Ding;

class DingProvider extends ServiceProvider
{
    /**
     * 是否延时加载提供器。
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * 引导任何应用程序服务。
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * 在容器中注册绑定。
     *
     * @return void
     */
    public function register()
    {
        // 注册 Elastic 实现
        $this->registerNativeDing();
    }

    /**
     * 注册 Elastic 实现
     *
     * @return void
     */
    protected function registerNativeDing()
    {
        $this->app->singleton('ding', function () {
            return new Ding;
        });
    }
}