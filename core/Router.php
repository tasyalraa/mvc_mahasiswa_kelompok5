<?php

class Router
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }

        return [];
    }

    public function run()
    {
        $url = $this->parseURL();

        // Routing khusus untuk API
        if (isset($url[0]) && $url[0] === 'api') {
            $this->runApiRoute($url);
            return;
        }

        if (isset($url[0]) && !empty($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';

            if (file_exists(__DIR__ . '/../app/controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($url[0]);
            } else {
                $this->notFound("Controller '$controllerName' tidak ditemukan.");
                return;
            }
        }

        require_once __DIR__ . '/../app/controllers/' . $this->controller . '.php';

        if (!class_exists($this->controller)) {
            $this->notFound("Class '{$this->controller}' tidak ditemukan.");
            return;
        }

        $this->controller = new $this->controller;

        if (isset($url[1]) && !empty($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                $this->notFound("Method '{$url[1]}' tidak ditemukan.");
                return;
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function runApiRoute($url)
    {
        header('Content-Type: application/json; charset=utf-8');

        $resource = $url[1] ?? null;
        $id = $url[2] ?? null;
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if ($resource !== 'mahasiswa') {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Endpoint API tidak ditemukan.'
            ], JSON_PRETTY_PRINT);
            return;
        }

        require_once __DIR__ . '/../app/controllers/ApiMahasiswaController.php';

        $controller = new ApiMahasiswaController();

        if ($requestMethod === 'GET' && $id === null) {
            $controller->index();
            return;
        }

        if ($requestMethod === 'GET' && $id !== null) {
            $controller->show($id);
            return;
        }

        if ($requestMethod === 'POST' && $id === null) {
            $controller->store();
            return;
        }

        if ($requestMethod === 'PUT' && $id !== null) {
            $controller->update($id);
            return;
        }

        if ($requestMethod === 'DELETE' && $id !== null) {
            $controller->delete($id);
            return;
        }

        $controller->methodNotAllowed();
    }

    private function notFound($message = 'Halaman tidak ditemukan.')
    {
        http_response_code(404);
        echo "404 - " . $message;
    }
}