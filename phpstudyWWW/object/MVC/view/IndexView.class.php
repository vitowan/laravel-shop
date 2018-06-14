<?php
class IndexView{
    public function index()
    {
        echo '这是index视图中的index方法';
    }
    public function add()
    {
        echo "<form method='post' action='index.php?c=Index&m=insert'>
        标题：<input type='text' name='title' /><br /><br />
        简介：<input type='text' name='intro' /><br /><br />
        <input type='submit' value='添加' /><br /><br />
</form>";
    }
}