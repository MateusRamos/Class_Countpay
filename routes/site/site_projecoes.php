<?php
use \Countpay\Page;
use \Countpay\Model\User;
use \Countpay\Model\Visual;
use \Countpay\Model\Carteira;
use \Countpay\Model\Lancamento;
use \Countpay\Model\Projecoes;
use \Countpay\DB\Sql;


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	        Rotas Projeções                                                  ||
||												    																	 ||
//===========================================================|===========================================================*/

//------------------------------------------------  GET - PROJEÇOES FUTURAS----------------------------------------------//

$app->get('/projecao', function() {

    $page = new Page([
        "header"=>true,
        "footer"=>false
    ]);

    $id_usuario = User::verifyLogin();

    $dados = Projecoes::coletaDadosMes($id_usuario);

    $page->setTpl("projecoes_futuras", array(
        "dados"=>$dados
    ));


});