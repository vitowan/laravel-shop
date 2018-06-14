<?php
class IndexController
{
    public function index()
    {
        MVCFunction::M('Index')->index();
    }
    public function show()
    {
        echo '这是index控制器中的show方法';
    }
    public function add()
    {
        MVCFunction::V('Index')->add();
    }
    public function insert()
    {
        $aff = MVCFunction::M('Index')->add();
        if ($aff > 0)
        {
            echo "<script>alert('添加成功！！！')</script>";
        }
        else
        {
            echo "<script>alert('添加失败！！！')</script>";
        }
    }
}