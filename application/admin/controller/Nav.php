<?php
/**
 * Created by PhpStorm.
 * User : Leopard
 * Date : 2018/1/3
 * Time : 10:03
 * Email: 417780879@qq.com
 */
namespace app\admin\controller;
use app\common\controller\Common;
use think\Request;

class Nav extends Common
{
    public function _initialize()
    {
        parent ::_initialize();
        $this -> model = new \app\admin\model\Nav();
        $this -> url   = url('admin/nav/index');
    }

    public function index()
    {
        $navData = $this -> model -> order('sta,sort desc') -> select() -> toArray();
        $this -> assign('navData',$navData);
        return view();
    }

    public function editnav(Request $request)
    {
        $oldData = $this -> model -> get($request -> param('id'));
        if($request -> isPost()) {
            $this -> return_res($this -> model -> store($request -> param()),$this -> url);
        }
        $this -> assign('oldData',$oldData);
        return view();
    }

    public function ajaxEditSort(Request $request)
    {
        if($request -> isAjax()) {
            return $this -> model -> editsort($request -> param());
        }
    }

    public function delnav(Request $request)
    {
        if($request -> isGet()) {
            $this -> return_res($this -> model -> store($request -> param()),$this -> url);
        }
    }
}