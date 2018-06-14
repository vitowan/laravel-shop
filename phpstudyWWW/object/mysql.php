<?php
header('Content-type:text/html;charset=utf-8');
class DB{
    private $link;

    public function __construct()
    {
        include 'config.php';

        $this->link = mysqli_connect(HOST,USER,PASSWORD,DB) or die('连接数据库失败！！！');

        mysqli_query($this->link,'set names utf8');
    }

    private function getChar($value)
    {
        return '`'.$value.'`';
    }

    private function getString($value)
    {
        return '\''.$value.'\'';
    }

    private function getQuery($sql)
    {
        return mysqli_query($this->link,$sql);
    }

    private function getAff()
    {
        return mysqli_affected_rows($this->link);
    }

    public function getDelete($table,$args)//删除
    {
        $table = $this->getChar($table);

        list($key,$value) = each($args);

        $keys = $this->getChar($key);

        $values = $this->getString($value);

        $where = 'where'.$keys.'='.$values;

        $sql = "delete from $table $where";

        $this->getQuery($sql);

       return $this->getAff();
    }


    function getInsert($table,$arr){//增加
    	$table = $this->getChar($table);
    	$keys=array_keys($arr);
    	$keys=implode("`,`",$keys);
    	$keys="(`".$keys."`)";
    	//echo $keys;
    	$values=array_values($arr);
    	$values=implode("','",$values);
    	$values="('".$values."')";
    	//echo $values;
    	$sql="insert into {$table}{$keys} values{$values}";
    	echo $sql;
    	$this->getQuery($sql);
    	return $this->getAff();
    }

/*    function getUpdate($table,$arr,$arr1){//更改
    	$table = $this->getChar($table);
    	foreach($arr as $keys=>$values){
    		$arr2[]="`".$keys."`='".$values."'";
    	}
    	$m=implode(",",$arr2);
    	//echo $m;
    	list($key,$value) = each($arr1);

        $keys = $this->getChar($key);

        $values = $this->getString($value);
		$where = 'where '.$keys.' = '.$values;
		$sql="update $table set $m $where";
		//echo $sql;
		$this->getQuery($sql);
		return $this->getAff();

    }*/

    function getUpdate($table,$arr){//更改
    	$table = $this->getChar($table);
    	$arr1=array_slice($arr,0,count($arr)-1);
    	foreach($arr1 as $key=>$value){
    		$key=$this->getChar($key);
    		$value=$this->getString($value);
    		$arr2[]=$key.'='.$value;
    	}
    	$str=implode(',',$arr2);
    	$arr0=array_slice($arr,count($arr)-1,1);
    	$k=key($arr0);
    	$v=current($arr0);
    	$sql="update $table set $str where $k = $v";
    	$this->getQuery($sql);
    	return $this->getAff();
    }


/*    function getSelect($table,$data){//选择(后面不带where)
	//select * from $table;
		$table = $this->getChar($table);
		if(is_string($data)){
			$dd=$data;
		}else if(is_array($data)){
			$data=implode("`,`",$data);
			$data=$this->getChar($data);
		}
		$sql="select $data from $table";
		echo  $sql;
		return $this->getQuery($sql);

	}*/

	    function getSelect($table,$data,$arr){//选择(后面带where的)
		//select * from $table;
		$table = $this->getChar($table);
		if(is_string($data)){
			$dd=$data;
		}else if(is_array($data)){
			$data=implode("`,`",$data);
			$data=$this->getChar($data);
		}
		list($key,$value)=each($arr);
		$key=$this->getChar($key);
		$value=$this->getString($value);
		$where='where '. $key.'='.$value;
		$sql="select $data from $table $where";
		//echo  $sql;
		return $this->getQuery($sql);

	}
}
$db = new DB();

//$aff = $db->getDelete('tab',array('id'=>3));

/*if ($aff > 0)
{
    echo "<script>alert('删除成功！！！')</script>";
}
else
{
    echo "<script>alert('删除失败！！！')</script>";
}
*/
//$db->getInsert('user',array('id'=>'2','user'=>'wan','password'=>'110'));//插入
//$db->getUpdate('user',array('user'=>'lili','password'=>'333','id'=>2));//更改

$query=$db->getSelect('user','*',array('id'=>2));
$query=mysqli_fetch_assoc($query);
//var_dump($query);

