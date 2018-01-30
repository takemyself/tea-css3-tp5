<?php
/**
 * Created by PhpStorm.
 * User : Leopard
 * Date : 2018/1/4
 * Time : 13:54
 * Email: 417780879@qq.com
 */
namespace app\admin\controller;
use app\common\controller\Common;
use think\Cache;
use think\Request;

class Cases extends Common
{
    public function _initialize()
    {
        parent ::_initialize();
        $this->model=new \app\admin\model\Cases();
        $this->url=url('admin/cases/index');
    }

    public function index(){
        $casesData=$this->model->order('caid desc')->select();
        $this->assign('casesData',$casesData);
        return view();
    }

    /**
     * add cases
     * @param Request $request
     *
     * @return \think\response\View
     */
    public function addcases(Request $request){
        if($request->isPost()){
            Cache::rm('cases');
            Cache::rm('cases_index');
            $this->return_res($this->model->store($request->param()),$this->url);
        }
        return view();
    }

    /**
     * edit cases
     * @param Request $request
     *
     * @return \think\response\View
     */
    public function editcases(Request $request){
        $oldData=$this->model->get($request->param('caid'));
        if($request->isPost()){
            Cache::rm('cases');
            Cache::rm('cases_index');
            $this->return_res($this->model->store($request->param()),$this->url);
        }
        $this->assign('oldData',$oldData);
        return view();
    }
    public function delcases(Request $request){
        Cache::rm('cases');
        Cache::rm('cases_index');
        $caid=$request->param('caid');
        $this->model->destroy($request->param('caid'));
        $this->redirect('index');
    }
}