<?php
use \Countpay\Page;
use \Countpay\Model\User;
use \Countpay\Model\Visual;
use \Countpay\Model\Carteira;
use \Countpay\Model\Lancamento;
use \Countpay\Model\Projecoes;


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	        Rotas Projeções                                                  ||
||												    																	 ||
//===========================================================|===========================================================*/

//------------------------------------------------  GET - PROJEÇOES FUTURAS----------------------------------------------//

$app->get('/projecao', function() {

 
$page = new Page([
    "header"=>true,
    "footer"=>false]);


$page->setTpl("projecoes_futuras");


});