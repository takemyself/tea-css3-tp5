<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/29
 * Time: 14:25
 */

namespace app\admin\controller;
use think\Controller;
use think\Request;

class Login extends Controller
{
   //后台用户模型
   protected $adminuserModel;
   public function _initialize()
   {
	  parent ::_initialize();
	  $this->adminuserModel=new \app\admin\model\Login();
   }

   /**
	* 登录
	* @param Request $request
	* @return \think\response\View
	*/
   public function index(Request $request){
	   if ($request->isPost()){
		  $res=$this->adminuserModel->login($request->param());
		  if ($res['valid']==1){
			 $this->success($res['msg'],'admin/index/index');exit;
		  }else{
		     echo "<script>alert('".$res['msg']."');history.go(-1)</script>";exit;
		  }
	   }
	   return view();
	}
}