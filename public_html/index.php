<?php
require __DIR__ . '/../vendor/autoload.php';


$request = new \Alexandr\Animator\Base\Request(); // получаем запрос
session_start();
//var_dump($_SESSION['id']);
$file = __DIR__ . '/../config.json';
$app = new \Alexandr\Animator\Base\Application($file);
$response = $app->handleRequest($request);  // обрабатываем запрос
$response->send();