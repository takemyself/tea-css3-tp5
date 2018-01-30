<?php
/**
 * Created by PhpStorm.
 * User : Leopard
 * Date : 2017/12/25
 * Time : 9:55
 * Email: 417780879@qq.com
 */
namespace app\admin\controller;
use app\common\controller\Common;
use think\Request;
use think\Session;

class Index extends Common
{
    /**
     * 后台首页
     * @return \think\response\View
     */
    public function index(){
        return view();
    }

    /**
     * 修改密码
     * @param Request $request
     * @return \think\response\View
     */
    public function editpass(Request $request){
        if ($request->isPost()){
            $res=(new \app\admin\model\Login())->editpass($request->param());
            if ($res['valid']==1){
                Session::delete('admin.id');
                $this->success($res['msg'],'admin/login/index');exit;
            }else{
                echo "<script>alert('".$res['msg']."');history.go(-1)</script>";exit;
            }
        }
        return view();
    }
}