<?php
header('content-type:text/html;charset=utf-8');

class DB{
	private $link;
	private static $obj;
	private function __construct(){
		/*define ('HOST','localhost');
		define ('USER','root');
		define ('PASSWORD' ,'root');
		define ('DB','demo');*/
		include 'config.php';

		$this->link=mysqli_connect(HOST,USER,PASSWORD,DB) or die('链接数据库失败');
		mysqli_query($this->link,'set names utf8');
	}

//单例模式
	static function getInterface(){
		if(is_null(self::$obj)){
			$c=__CLASS__;//得到当前类名
			self::$obj=new $c();//new一个对象时，如果不用传参，可以不加括号
		}
		return self::$obj;
	}


	private function getQuery($sql){
		return mysqli_query($this->link,$sql);
	}

	private function getChar($a){
		$a='`'.$a.'`';
		return $a;
	}

	private function getString($b){
		$b="'".$b."'";
		return $b;
	}

	private function aff(){
		return mysqli_affected_rows($this->link);
	}


	function getDelete($table,$arr){
		//delete from user where id=1;
		//$table='`'.$table.'`';
		$table=$this->getChar($table);
		list($key,$value)=each($arr);
		//$key="'".$key."'";
		$key=$this->getChar($key);
		$value=$this->getString($value);
		$where='where '.$key.' = '.$value;

		$sql="delete from $table $where";
		echo $sql;
		$this->getQuery($sql);
		
		return $this->aff();
	}

}

$GLOBALS['db']=DB::getInterface();
/*$a=$db->getDelete('user',array('id'=>'4'));

if($a){
	echo "<script>alert('删除成功')</script>";
}else{
	echo "<script>alert('删除失败')</script>";
}
*/



?>

