<?php
include ROOT.'DB.class.php';
class IndexModel{
    public function index()
    {
        $query = $GLOBALS['db']->getSelect('nav','*');
        //print_r($GLOBALS['db']);
        //var_dump($query);
        echo "<a href='index.php?c=Index&m=add'>添加数据</a>";
        echo "<table width='888' border='1' cellspacing='0' align='center'>
            <tr>
                <th>标题</th>
                <th>简介</th>
                <th>时间</th>
                <th>操作</th>
</tr>";
        while ($assoc = mysqli_fetch_assoc($query)){
            echo "<tr align='center'>
                <td>$assoc[title]</td>
                <td>$assoc[intro]</td>
                <td>$assoc[times]</td>
                <td><a href='#'>修改</a> | <a href='#'>删除</a></td>
</tr>";
}
echo "</table>";
    }
    public function add(){
        return $GLOBALS['db']->getInsert('nav',$_POST);
    }
}