<?php
namespace app\index\validate;
use think\Validate;

class Rule extends Validate{
	protected  $rule = [
		'password'=>'require|max:25',
		//'repassword'=>'require|confirm'
		//'password'=>'require|confirm' 
		//'password'=>'confirm':'repassword'

	];

	protected  $message=[ 
		'password.require' => '名称必须',
        'password.max'     => '名称最多不能超过25个字符'
    ];
}






?>