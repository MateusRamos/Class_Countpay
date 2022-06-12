<?php
use \Countpay\Page;
use \Countpay\DB\Sql;
use \Countpay\Model\User;
use \Countpay\Model\Metas;
use \Countpay\Model\Visual;
use \Countpay\Model\Carteira;
use \Countpay\Model\Lancamento;


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	      Rotas Lançamento                                                   ||
||												    																	 ||
//===========================================================|===========================================================*/

//--------------------------------------------------  GET - HISTÓRICO  --------------------------------------------------//
$app->get('/metas', function() {

    $page = new Page();

    User::verifyLogin();

    $page->setTpl("metas");

});

$app->get('/metas/guardando', function() {

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $conta = Carteira::listaConta($id_usuario);

    $page->setTpl("meta_guardando", array(
        "conta"=>$conta
    ));

});

$app->post('/metas/guardando', function() {

    $id_usuario = User::verifyLogin();

    $apelidoConta = $_POST['conta'];

    $id_conta = Carteira::buscaConta($apelidoConta, $id_usuario);

    Metas::criaGuardando($_POST, $id_usuario, $id_conta);

    Visual::mostraMensagem('Meta criada com sucesso!', '/');

});








?>