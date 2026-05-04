<?php

class Controller
{
   public function view($view, $data = [])
{
    extract($data);

    ob_start();
    require_once '../app/views/' . $view . '.php';
    $content = ob_get_clean();

    require_once '../app/views/layouts/header.php';
    echo $content;
    require_once '../app/views/layouts/footer.php';
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

    public function setFlash($type, $message)
    {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }

    public function flash()
    {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }

        return null;
    }

    public function redirect($path)
    {
        header('Location: ' . BASEURL . '/' . ltrim($path, '/'));
        exit;
    }
}