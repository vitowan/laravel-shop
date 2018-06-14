<?php

header('Content-type:text/html;charset=utf-8');

abstract class Father{
    protected $num1;

    protected $num2;

    public function __construct($one,$two)
    {
        $this->num1 = $one;

        $this->num2 = $two;
    }

    abstract function result();
}
class Add extends Father {
    function result()
    {
        return $this->num1 + $this->num2;
    }
}
class min extends Father{
    function result()
    {
        return $this->num1 - $this->num2;
    }
}
class mul extends Father{
    function result()
    {
        return $this->num1 * $this->num2;
    }
}
class div extends Father{
    function result()
    {
        if ($this->num2 != 0) {
            return $this->num1 / $this->num2;
        }
        else
        {
            return "被除数不能为零";
        }
    }
}

class GetResult{

    public static $obj;
    public static function get($S,$A,$B)
    {
        switch ($S)
        {
            case '+':
                self::$obj = new Add($A,$B);
                break;
            case '-':
                self::$obj = new min($A,$B);
                break;
            case 'x':
                self::$obj = new mul($A,$B);
                break;
            case '/':
                self::$obj = new div($A,$B);
        }
        return self::$obj;
    }
}

$r = GetResult::get('/',12,0);
echo $r->result();
