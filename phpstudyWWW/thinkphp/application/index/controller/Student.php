<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\Students;



class Student extends Controller{

	function update(){

		$student=new Students();

		echo $student->save(['password'=>'123123'],['id'=>'2']);

	}

	function select(){
		$user=new Students();
		$arr=$user::all();
		//dump($arr);
		$this->assign('arr',$arr);
		return view('index/student');



	}
}









?>