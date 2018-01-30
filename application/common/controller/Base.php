<?php
/**
 * Created by PhpStorm.
 * User : Leopard
 * Date : 2018/1/5
 * Time : 15:07
 * Email: 417780879@qq.com
 */
namespace app\common\controller;
use app\admin\model\Introduction;
use think\Cache;
use think\Controller;

class Base extends Controller
{
    public function _initialize()
    {
        parent ::_initialize();
        $initData=Cache::remember('introduction',function(){
            return (new Introduction())->get(1)->toArray();
        });
        $this->assign('initData',$initData);
    }
}