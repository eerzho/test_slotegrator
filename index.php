<?php

require 'vendor/autoload.php';
require_once 'config/bootstrap.php';

$app = new \App\Components\App();
$app->run($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
//
//foreach ($routes as $route) {
//
//    if (strtoupper($route['method']) == $_SERVER['REQUEST_METHOD'] &&
//        $route['url'] == parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) {
        //        $controllerAndMethod = explode('@', $route['controller']);
        //        $controllerName = str_replace('/', '', strrchr($controllerAndMethod[0], '/'));
        //
        //        require __DIR__ . '/' . $controllerAndMethod[0] . '.php';
        //        $controllerObject = new $controllerName();
        //        $controllerObject->{$controllerAndMethod[1]}();
        //        exit();
//    }
//}
//
//header_remove('Set-Cookie');
//header('Content-Type: application/json');
//header('HTTP/1.1 404');
//echo json_encode([
//    'data' => [
//        'message' => 'Not found'
//    ]
//]);
//exit();

//        $res = json_decode(file_get_contents('php://input'), true);
//    switch ($_SERVER['REQUEST_METHOD']) {
//        case 'GET':
//
//    }
//} else {
//}

//
//if ((isset($uri[2]) && $uri[2] != 'user') || !isset($uri[3])) {
//header("HTTP/1.1 404 Not Found");
//exit();
//}
//
//require PROJECT_ROOT_PATH . "/Controllers/Api/UserController.php";
//
//$objFeedController = new UserController();
//$strMethodName = $uri[3] . 'Action';
//$objFeedController->{$strMethodName}();