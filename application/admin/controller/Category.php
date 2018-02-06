<?php
/**
 * Created by PhpStorm.
 * User : Leopard
 * Date : 2018/1/3
 * Time : 10:03
 * Email: 417780879@qq.com
 */
namespace app\admin\controller;
use app\admin\model\CategoryContent;
use app\common\controller\Common;
use think\Cache;
use think\Db;
use think\Request;

class Category extends Common
{
    public function _initialize()
    {
        parent ::_initialize();
        $this->model=new \app\admin\model\Category();
        $this->url=url('admin/category/index');
    }

    public function index(){
        $categoryData=$this->model->order('sort desc')->select();
        $this->assign('categoryData',$categoryData);
        return view();
    }

    public function addindex(Request $request){
        if($request->isPost()){
            $data=$request->param();
            $this->return_res($this->model->store($data),$this->url);
        }
        return view();
    }

    public function editindex(Request $request){
        $oldData=$this->model->get($request->param('cid'));
        if($request->isPost()){
            $data=$request->param();
            $this->return_res($this->model->store($data),$this->url);
        }
        $this->assign('oldData',$oldData);
        return view();
    }

    public function delcategory(Request $request){
        if($request->isGet()){
            $id=$request->param('id');
            $num=$this->model->destroy($id);
            $this->return_del($num,$this->url);
        }
    }

    public function ajaxEditSort(Request $request)
    {
        if($request->isAjax()){
            $data=$request->param();
            return $this ->model -> editsort($data);
        }
    }
}