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

class Product extends Common
{
    public function _initialize()
    {
        parent ::_initialize();
        $this->model=new \app\admin\model\Product();
        $this->url=url('admin/product/index');
    }


    public function index(Request $request){
        $productData=current($this->model->select()->toArray());
        $productData['advers']=json_decode($productData['advers']);
        if($request->isPost()){
            $data=$request->param();
            $data['id']=1;
            $data['advers']=json_encode($data['advers']);
            $this->return_res($this->model->store($data),$this->url);
        }
        $this->assign('productData',$productData);
        return view();
    }
}