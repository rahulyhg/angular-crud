<?php

include_once ('../vendor/autoload.php');

/*** PDO Object to create database connection
 *   Replace localhost with your host name in $host = 'localhost';
 *   Replace angular_crud with your database name in $dbname = 'angular_crud';
 *   Replace root with your database username in $user = 'root'; 
 *   Replace '' with your database password in $pass = '';
 */  

$host = 'localhost';
$dbname = 'angular_crud';
$user = 'root';
$pass = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

/* Initialise NotORM with PDO Details  */

$db = new NotORM($pdo);

/* Initialise Slim Framework Instance */
$app = new \Slim\Slim();

