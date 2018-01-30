<?php
namespace app\common\controller;
use app\admin\model\Login;
use think\Controller;
use think\Request;
use think\Session;
header("Content-Type: text/html; charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/29
 * Time: 14:08
 */
class Common extends Controller
{
    //登录标识
    protected $adminid;
    //添加、编辑后跳转地址
    protected $url;
    //实例化模型
    protected $model;
    //实例化模型
    protected $modelTwo;

    public function _initialize()
    {
        parent ::_initialize();
        $this -> adminid = Session ::get('admin.id');
        if (!$this -> adminid) {
            $this -> redirect('admin/login/index');
        }
        $adminDate = Login ::get($this -> adminid) -> visible(['id', 'name']) -> toArray();
        $this -> assign('adminDate', $adminDate);
    }
    public function out(Request $request){
        if ($request->isAjax()){
            Session::delete('admin.id');
            return 1;
        }
    }
    /**
     * 判断跳转
     * @param $res 执行操作后返回的数组
     * @param $url 跳转的地址
     */
    public function return_res($res, $url)
    {
        if ($res['valid'] == 1) {
            echo "<script>alert('" . $res['msg'] . "');location.href='" . $url . "'</script>";
            exit;
        } else {
            echo "<script>alert('" . $res['msg'] . "');history.go(-1)</script>";
            exit;
        }
    }

    /**
     * 图片上传
     */
    public function uploads()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file=\request()->file();
        $file = current($file);
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file -> validate(['size' => 1024000, 'ext' => 'jpg,png,jpeg,gif']) -> move(ROOT_PATH . 'public' . DS . 'uploads');
        if ($info) {
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            $picpath=str_replace('\\','/',$info -> getSaveName());
            $res = ['valid' => 1, 'msg' => $picpath];
            echo json_encode($res);
        } else {
            // 上传失败获取错误信息
            echo $file -> getError();
        }
    }

    /**
     * 删除图片
     * @param Request $request
     */
    public function delimg(Request $request)
    {
        if ($request -> isAjax()) {
            $path = $request -> param('path');
            unlink(ROOT_PATH . 'public' . DS . 'uploads/' . $path);
        }
    }
}