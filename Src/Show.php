<?php
/**
 * Created by PhpStorm.
 * User: MGZ2018072718B
 * Date: 2018/11/14
 * Time: 15:35
 */

namespace services;
class Show
{
    public $aa = 0;

    public function showMoney ()
    {
        return 1;
    }

    public function sum ($a, $b)
    {
        return $a+$b;
    }

    public function intSum ($a, $b)
    {
        if (is_float($a) || is_float($b))
        {
            throw new \Exception('This is a Bug', 666);
        }
        return $a + $b;
    }

}