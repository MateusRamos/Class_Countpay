<?php
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Countpay\Page;
use \Countpay\PageAdmin;

$app = new \Slim\Slim();
$app->config('debug', true);

//Require rotas get admin:
require_once("routes\admin\admin-get.php");

//Require rotas post admin:
require_once("routes\admin\admin-post.php");

//Require rotas site - Usuario:
require_once("routes\site\site_usuario.php");

//Require rotas site - Carteira:
require_once("routes\site\site_carteira.php");

//Require rotas site - Lancamento:
require_once("routes\site\site_lancamento.php");

//Require rotas site - Metas:
require_once("routes\site\site_meta.php");

//Require rotas site - Projeções:
require_once("routes\site\site_projecoes.php");


$app->run();

?>




