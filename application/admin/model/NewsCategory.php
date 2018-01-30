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

class NewsCategory extends Common
{
    protected $table='ht_newscategory';
    protected $pk='ncid';
    public function news(){
        return $this->hasMany('News','ncid','ncid');
    }
}