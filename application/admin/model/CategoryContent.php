<?php
/**
 * Created by PhpStorm.
 * User : Leopard
 * Date : 2018/1/3
 * Time : 10:08
 * Email: 417780879@qq.com
 */
namespace app\admin\model;
use app\common\model\Common;

class CategoryContent extends Common
{
    protected $table='ht_category_content';
    protected $pk='clid';
    public function category(){
        return $this->hasOne('Category','cid');
    }
}