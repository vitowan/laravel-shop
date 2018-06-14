<?php
namespace app\admin\model;

class Cate extends \think\Model{

 	public function cate_list($data,$pid=0,$level=1){
 		//由父类id得到全部子类
 		global $arr; //或者写成static $arr=[]; 不能单独写$arr ,因为对于下面的递归时，他在函数外部
 		foreach ($data as $key => $value) {
 			if ($value['pid']==$pid) {
 				$value['level']=$level;//给每个value数组加个level字段
 				$value['str'] = str_repeat('———', $value['level']-1);//给每个value数组加个level字段,前端输出和name拼接到一块
 				$arr[] = $value;
 				$this->cate_list($data,$value['id'],$level+1);//递归调用自己，且当每次调用，层级level+1
 			}
 		}
 		return $arr;
 	}




}




?>