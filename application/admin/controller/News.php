<?php
/**
 * Created by PhpStorm.
 * User : Leopard
 * Date : 2018/1/4
 * Time : 16:02
 * Email: 417780879@qq.com
 */
namespace app\admin\controller;
use app\common\controller\Common;
use think\Request;

class News extends Common
{
    public function _initialize()
    {
        parent ::_initialize();
        $this->model=new \app\admin\model\News();
        $this->url=url('admin/news/index');
        $this->modelTwo=new \app\admin\model\NewsCategory();
    }
    public function index(){
        $newsData=$this->model->all();
        $oldnewscategoryData=$this->modelTwo->all();
        $newscategoryData=[];
        foreach($oldnewscategoryData as $k=>$v){
            $newscategoryData[$v['ncid']]=$v['ncname'];
        }
        $this->assign('newscategoryData',$newscategoryData);
        $this->assign('newsData',$newsData);
        return view();
    }
    public function addnews(Request $request){
        $newscategoryData=$this->modelTwo->all();
        if($request->isPost()){
            $this->return_res($this->model->store($request->param()),$this->url);
        }
        $this->assign('newscategoryData',$newscategoryData);
        return view();
    }
    public function editnews(Request $request){
        $oldData=$this->model->get($request->param('nid'))->toArray();
        $newscategoryData=$this->modelTwo->all();
        if($request->isPost()){
            $this->return_res($this->model->store($request->param()),$this->url);
        }
        $this->assign('newscategoryData',$newscategoryData);
        $this->assign('oldData',$oldData);
        return view();
    }
    public function delnews(Request $request){
        $this->model->destroy($request->param('nid'));
        echo "<script>alert('删除成功');location.href='" . $this->url . "'</script>";
        exit;
    }
}