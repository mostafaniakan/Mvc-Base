<?php

class Controller
{
    public function model($model)
    {
        if (isset($model) && file_exists('../app/models/' . ucwords($model) . '.php')) {
            require_once '../app/models/' . ucwords($model) . '.php';
            return new $model;
        }
    }

    public function view($view, $data = [])
    {
        if (file_exists('../app/views/' . ucwords($view) . '.php')) {
            require_once '../app/views/' . ucwords($view) . '.php';
        } else {
            die ("Not Exists View");
        }
    }
}