<?php
class Controller
{
    public function model($model)
    {
        require_once './model/' . $model . '.php';
        return new $model;
    }

    public function view($view, $data = [])
    {
        require_once './views/' . $view . '.php';
    }

    public function errors($error, $data = [])
    {
        require_once './errors/' . $error . '.php';
        die;
    }
}
