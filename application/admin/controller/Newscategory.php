<?php
/**
 * Created by PhpStorm.
 * User : Leopard
 * Date : 2018/1/4
 * Time : 15:34
 * Email: 417780879@qq.com
 */
namespace app\admin\controller;
use app\common\controller\Common;
use think\Request;

class Newscategory extends Common
{
    public function _initialize()
    {
        parent ::_initialize();
        $this->model=new \app\admin\model\NewsCategory();
        $this->url=url('admin/newscategory/index');
    }

    /**
     * newscategory list
     * @return \think\response\View
     */
    public function index(){
        $newscategoryData=$this->model->all();
        $this->assign('newscategoryData',$newscategoryData);
        return view();
    }

    /**
     * add newscategory
     * @param Request $request
     *
     * @return \think\response\View
     */
    public function addnewscategory(Request $request){
        if($request->isPost()){
            $this->return_res($this->model->store($request->param()),$this->url);
        }
        return view();
    }

    /**
     * edit newscategory
     * @param Request $request
     *
     * @return \think\response\View
     */
    public function editnewscategory(Request $request){
        $oldData=$this->model->get($request->param('ncid'));
        if($request->isPost()){
            $this->return_res($this->model->store($request->param()),$this->url);
        }
        $this->assign('oldData',$oldData);
        return view();
    }
    public function delnewscategory(Request $request){
        $this->model->destroy($request->param('ncid'));
        echo "<script>alert('删除成功');location.href='" . $this->url . "'</script>";
        exit;
    }
}