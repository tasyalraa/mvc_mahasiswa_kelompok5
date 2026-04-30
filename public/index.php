<?php

define('BASEURL', 'http://localhost/mvc_mahasiswa_kelompok5/public');

require_once '../config/database.php';
require_once '../core/Database.php';
require_once '../core/Controller.php';
require_once '../core/Router.php';

$router = new Router();
$router->run();

