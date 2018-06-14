<?php
header('Content-type:text/html;charset=utf-8');
class DB{
    private $link;

    public function __construct()
    {
        include 'conf.php';

        $this->link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('连接数据库失败！！！');

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

    public function getDelete($table,$args)
    {
        $table = $this->getChar($table);

        list($key,$value) = each($args);

        $keys = $this->getChar($key);

        $values = $this->getString($value);

        $where = 'where '.$keys.' = '.$values;

        $sql = "delete from $table $where";

        $this->getQuery($sql);

        return $this->getAff();
    }
}
$db = new DB();

$aff = $db->getDelete('tab',array('id'=>3));

if ($aff > 0)
{
    echo "<script>alert('删除成功！！！')</script>";
}
else
{
    echo "<script>alert('删除失败！！！')</script>";
}
