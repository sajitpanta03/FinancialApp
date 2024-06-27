<?php

class hello 
{
    private static $hello = "hello";

    public function hello()
    {
        $open = self::$hello;
        echo $open;
    }
}

$bye = new hello();
$bye->hello();