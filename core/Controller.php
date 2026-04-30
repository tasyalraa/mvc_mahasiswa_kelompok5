<?php

class Controller
{
    public function view($view, $data = [])
    {
        extract($data);

        $viewFile = __DIR__ . '/../app/views/' . $view . '.php';

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            echo "View '$view' tidak ditemukan.";
        }
    }

    public function model($model)
    {
        $modelFile = __DIR__ . '/../app/models/' . $model . '.php';

        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $model;
        }

        echo "Model '$model' tidak ditemukan.";
        return null;
    }
}
