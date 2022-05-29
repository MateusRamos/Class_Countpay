<?php
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Countpay\Page;
use \Countpay\PageAdmin;
use \Countpay\DB\Sql;
use \Countpay\Model\Usuario;

$app = new \Slim\Slim();
$app->config('debug', true);

//Require rotas get admin:
require_once("routes\admin\admin-get.php");

//Require rotas post admin:
require_once("routes\admin\admin-post.php");

//Require rotas get site:
require_once("routes\site\site-get.php");

//Require rotas post site:
require_once("routes\site\site-post.php");


$app->run();

?>




