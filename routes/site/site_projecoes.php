<?php
use \Countpay\Page;
use \Countpay\DB\Sql;
use \Countpay\Model\User;
use \Countpay\Model\Visual;
use \Countpay\Model\Carteira;
use \Countpay\Model\Lancamento;


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	        Rotas Projeções                                                  ||
||												    																	 ||
//===========================================================|===========================================================*/

//------------------------------------------------  GET - PROJEÇOES FUTURAS----------------------------------------------//

// Cria a rota /projeção
$app->get('/projecao', function() {

// Utiliza a classe Page que busca templates dentro da pasta Views 
$page = new Page([
    "header"=>true,
    "footer"=>true]);

// Busca o template informado entre () dentro da pasta views, caso tenha ela setTPL que é para exibir
$page->setTpl("projecoes_futuras");

});