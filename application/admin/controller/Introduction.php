<?php
/**
 * Created by PhpStorm.
 * User : Leopard
 * Date : 2018/1/4
 * Time : 11:11
 * Email: 417780879@qq.com
 */
namespace app\admin\controller;
use app\common\controller\Common;
use think\Cache;
use think\Request;

class Introduction extends Common
{
    public function _initialize()
    {
        parent ::_initialize();
        $this->model=new \app\admin\model\Introduction();
        $this->url=url('admin/introduction/index');
    }

    /**
     * company introduction
     * @param Request $request
     *
     * @return \think\response\View
     */
    public function index(Request $request){
        $oldData=$this->model->get(1)->toArray();
        if($request->isPost()){
            Cache::rm('introduction');
            $data=$request->param();
            $data['id']=$oldData['id'];
            $this->return_res($this->model->store($data),$this->url);
        }
        $this->assign('oldData',$oldData);
        return view();
    }
}