<?php

namespace App\Form;

use App\Model;

class Form
{
    public static function begin($action, $method)
    {
        echo sprintf('<form aciton="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end()
    {
        return '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new Field($model, $attribute);
    }
}
