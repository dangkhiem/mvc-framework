<?php

namespace App;

class Controller extends CallStatic
{
    public string $layout = 'main';
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}
