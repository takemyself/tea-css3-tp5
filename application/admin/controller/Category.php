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
        $this->modelTwo=new CategoryContent();
        $this->url=url('admin/category/index');
    }

    /**
     * category lists
     * @return \think\response\View
     */
    public function index(){
        $categoryData=$this->model->all();
        $this->assign('categoryData',$categoryData);
        return view();
    }

    /**
     * add category
     * @param Request $request
     *
     * @return \think\response\View
     */
    public function addindex(Request $request){
        if($request->isPost()){
            Cache::rm('service');
            $data=$request->param();
            Db::startTrans();
            try{
                $pk=$this->model->trans_store($data);
                $data['cid']=$pk;
                $this->modelTwo->trans_store($data);
                Db::commit();
            }catch(\Exception $e){
                Db::rollback();
                echo "<script>alert('失败');history.go(-1)</script>";
                exit;
            }
            $this->redirect('admin/category/index');
        }
        return view();
    }

    /**
     * edit category
     * @param Request $request
     *
     * @return \think\response\View
     */
    public function editindex(Request $request){
        $oldData=$this->modelTwo->with('Category')->find($request->param('cid'))->toArray();
        if($request->isPost()){
            Cache::rm('service');
            $data=$request->param();
            $data['clid']=$oldData['clid'];
            try{
                $this->model->trans_store($data);
                $this->modelTwo->trans_store($data);
                Db::commit();
            }catch(\Exception $e){
                Db::rollback();
                echo "<script>alert('编辑失败');history.go(-1)</script>";
                exit;
            }
            echo "<script>alert('编辑成功');location.href='" . $this->url . "'</script>";
            exit;
        }
        $this->assign('oldData',$oldData);
        return view();
    }
}