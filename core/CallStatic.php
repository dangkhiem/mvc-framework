<?php

namespace App;

class CallStatic
{
    public static function __callStatic($methodName, $arguments)
    {
        return self::$methodName($arguments);
    }
}
