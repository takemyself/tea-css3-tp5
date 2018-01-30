<?php
namespace app\common\model;
use think\Model;
header("Content-Type: text/html; charset=UTF-8");
class Common extends Model
{
   /**
	* 去空格
	* @param $date
	* @return mixed
	*/
	protected function trimdata($date){
	   foreach ($date as $k=>$v){
	      $date[$k]=trim($v);
	   }
	   return $date;
	}

   /**
	* 验证器返回数据判断
	* @param $result 返回结果
	* @param $info 成功提示信息
	* @return array 返回标识
	*/
   protected function judegRes($result,$info){
	  if(false === $result){
		 // 验证失败 输出错误信息
		 return ['valid'=>0,'msg'=>$this->getError()];
	  }
	  return ['valid'=>1,'msg'=>$info];
   }

   /**
	* 添加\编辑
	* @param $data
	* @return array
	*/
   public function store($data){
//	  $newDate=$this->trimdata($data);
	  if (isset($data[$this->pk])){
		 return $this->judegRes($this->allowField(true)->save($data,[$this->pk=>$data[$this->pk]]),'编辑成功');
	  }
	  return $this->judegRes($this->allowField(true)->save($data),'添加成功');
   }
   public function editsort($data){
	  if (isset($data[$this->pk])){
		 return $this->judegRes($this->allowField($this->sort)->save($data,[$this->pk=>$data[$this->pk]]),'编辑成功');
	  }
	  return ['valid'=>0,'msg'=>'操作失败，请重新操作'];
   }

    /**
     * 事物操作返回id
     * @param $data
     *
     * @return mixed
     */
    public function trans_store($data){
        if (isset($data[$this->pk])){
            return $this->allowField(true)->save($data,[$this->pk=>$data[$this->pk]]);
        }
        $this->allowField(true)->save($data);
        $id=$this->pk;
        return $this->$id;
    }
}