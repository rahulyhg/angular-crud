<?php

include_once ('../vendor/autoload.php');

$pdo = new PDO('mysql:host=localhost;dbname=angular_crud;charset=utf8', 'root', '');
$db = new NotORM($pdo);

$app = new \Slim\Slim();

