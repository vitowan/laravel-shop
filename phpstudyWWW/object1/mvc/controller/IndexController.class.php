<?php
//include ROOT.'DB.class.php';
class IndexController{
	function index(){
		//echo "我在controller控制器里面";
		MVCFunction::M('Index')->index();
        MVCFunction::V('Index')->index();
	}

	function show()
    {
        echo '这是index控制器中的show方法';
    }

    function add(){
    	//MVCFunction::V('Index')->add();
        if(!isset($_SESSION['name'])){
         echo "<script>  location.href='index.php?c=user&m=register';</script>";
        }

        $smarty=MVCFunction::S();
        $smarty->display('add.html');

    }
    function insert(){
    	$aff=MVCFunction::M('Index')->add();
    	if($aff){
            echo "<script>alert('添加成功！！！');location.href='index.php';</script>";
        }
        else
        {
            echo "<script>alert('添加失败！！！');location.href='index.php';</script>";
        }
    }
    function delete(){

    	$aff=MVCFunction::M('Index')->delete();

    	if($aff){
            echo "<script>alert('删除成功！！！');location.href='index.php';</script>";
        }
        else
        {
            echo "<script>alert('删除失败！！！');location.href='index.php';</script>";
        }

    }

    function update(){
    	//echo $_GET['id'];
    	$query=$GLOBALS['db']->getSelect1('nav','*',array('id'=>$_GET['id']));
    	$result=mysqli_fetch_assoc($query);
    	// var_dump($result);
    	//MVCFunction::V('Index')->update($result);

        if(!isset($_SESSION['name'])){
        echo "<script>  location.href='index.php?c=user&m=register';</script>";
        }

        $smarty=MVCFunction::S();
        $smarty->assign('arr',$result);
        $smarty->display('update.html');
    }

	function update1(){
		$aff=MVCFunction::M('Index')->update();
		if($aff){
            echo "<script>alert('修改成功！！！');location.href='index.php';</script>";
        }
        else
        {
            echo "<script>alert('修改失败！！！');location.href='index.php';</script>";
        }
	}
	


}





?>