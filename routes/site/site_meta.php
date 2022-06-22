<?php
use \Countpay\Page;
use \Countpay\Model\User;
use \Countpay\Model\Meta;
use \Countpay\Model\Visual;
use \Countpay\Model\Carteira;


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

    Meta::criaGuardando($_POST, $id_usuario);

    Visual::mostraMensagem('Meta criada com sucesso!', '/');

});

$app->get('/minhasmetas', function() {

    $page = new Page();

    User::verifyLogin();

    $page->setTpl("minhas_metas");

});






?>