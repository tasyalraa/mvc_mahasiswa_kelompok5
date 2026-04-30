<?php

define('BASEURL', 'http://localhost/mvc_mahasiswa_kelompok5/public');

require_once '../config/database.php';

$url = $_GET['url'] ?? 'home/index';
$url = trim($url, '/');
$urlParts = explode('/', $url);

$controllerName = !empty($urlParts[0])
    ? ucfirst($urlParts[0]) . 'Controller'
    : 'HomeController';

$methodName = $urlParts[1] ?? 'index';
$params = array_slice($urlParts, 2);

$controllerFile = '../app/controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;

    if (class_exists($controllerName)) {
        $controller = new $controllerName;

        if (method_exists($controller, $methodName)) {
            call_user_func_array([$controller, $methodName], $params);
        } else {
            echo "404 - Method '$methodName' tidak ditemukan.";
        }

    } else {
        echo "404 - Class '$controllerName' tidak ditemukan.";
    }

} else {
    echo "404 - Controller '$controllerName' tidak ditemukan.";
}
