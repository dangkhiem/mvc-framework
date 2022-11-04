<?php

use App\Application;
use App\Database;
use App\Response;

function dd($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    die();
}

function dump($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
}

function app(string $key = '')
{
    if ($key) {
        return Application::$app->{$key};
    }
    return Application::$app;
}

function db(): Database
{
    return Application::$app->db;
}

function response(): Response
{
    return Application::$app->response;
}

function redirect($path)
{
    return response()->redirect($path);
}

function session()
{
    return Application::$app->session;
}