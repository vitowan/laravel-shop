<?php
class F{
    public static $abc = 'abc';
    const K = 123;
    static function asd()
    {
        echo 123;
    }
    function a()
    {
       // echo self::$abc;
        //self::asd();
        //echo self::K;
         echo 123;
    }
}
/*echo F::K;
echo F::asd();*/

/*$a = new F();
$a->a();*/
echo F::asd();
echo F::K;
