<?php
use \Countpay\Page;
use \Countpay\Model\User;
use \Countpay\Model\Visual;
use \Countpay\Model\Carteira;

/*===========================================================|===========================================================\\
||											    																		 ||
||										    	        Rotas Cartão                                                     ||
||												    																	 ||
//===========================================================|===========================================================*/

//------------------------------------------------  GET - LISTA CARTÃO  -------------------------------------------------//
$app->get('/cartao', function() {

    $page = new Page();

    $resultado_id = User::verifyLogin();

    $cartao = Carteira::listaCartao($resultado_id);

    $page->setTpl("listar_cartoes", array(
        "cartao"=>$cartao
    ));

});


//------------------------------------------------  GET - CRIAR CARTÃO  -------------------------------------------------//
$app->get('/cartao/criar', function() {

    $page = new Page();

    $resultado_id = User::verifyLogin();

    $instituicao = Carteira::listaInstituicao();

    $page->setTpl("criar_cartao", array(
        "instituicao"=>$instituicao
    ));

});


//===============================================  POST - CRIAR CARTÃO  =================================================//
$app->post('/cartao/criar', function() {

    $page = new Page();

    $id_usuario = User::verifyLogin();

    Carteira::criaCartao($_POST, $id_usuario);

    header('Location: /cartao');
    exit; 

});


//-----------------------------------------------  GET - ALTERAR CARTÃO  ------------------------------------------------//
$app->get('/cartao/:id_cartao', function($id_cartao) {      
    
    $page = new Page();

    User::verifyLogin();

    $cartoes = Carteira::carregaDadosCartao($id_cartao);

    $instituicao = Carteira::listaInstituicao();

    $page->setTpl("alterar_cartao", array(
        "cartao"=> $cartoes,
        'instituicao'=>$instituicao
    ));  
    
});


//==============================================  POST - ALTERAR CARTÃO  ================================================//
$app->post('/cartao/alterar', function() {
    
    Carteira::alteraCartao($_POST);

    Visual::mostraMensagem('Alteração realizada com sucesso!', '/cartao');
    
});


//-----------------------------------------------  GET - EXCLUIR CARTÃO  ------------------------------------------------//
$app->get('/cartao/:id_cartao/delete', function($id_cartao) {

    $id_usuario = User::verifyLogin();

    $verificacao = User::verifyDeleteCartao($id_usuario, $id_cartao);

    if($verificacao == 1)
    {
        Carteira::deletaCartao($id_cartao);
        Visual::mostraMensagem('Cartão excluído com sucesso!','/cartao');
    }
    else
    {
        Visual::mostraMensagem('Esse cartão não pertence a este usuário!','/cartao');
    }

});


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	        Rotas Conta                                                      ||
||												    																	 ||
//===========================================================|===========================================================*/

//-------------------------------------------------  GET - LISTA CONTA:  ------------------------------------------------//
$app->get('/conta', function() {

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $contas = Carteira::listaConta($id_usuario);
    
    $page->setTpl("listar_contas",array(
        "contas"=>$contas
    ));

});


//-------------------------------------------------  GET - CRIAR CONTA  -------------------------------------------------//
$app->get('/conta/criar', function() {

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $instituicao = Carteira::listaInstituicao();

    $page->setTpl("criar_conta",array(
        "instituicao"=>$instituicao
    ));

});


//=================================================  POST - CRIAR CONTA  ================================================//
$app->post('/conta/criar', function() {

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $resultado = Carteira::criaConta($_POST, $id_usuario);

    header('Location: /conta');
    exit;

    }

);


//-------------------------------------------------  GET - ALTERAR CONTA  -----------------------------------------------//
$app->get('/conta/:id_conta', function($id_conta) {

    $page = new Page();

    User::verifyLogin();

    $conta = Carteira::carregaDadosconta($id_conta);

    $instituicao = Carteira::listaInstituicao();
    var_dump($conta);
    $page->setTpl("alterar_conta", array(
        "conta"=>$conta[0],
        'instituicao'=>$instituicao
    )); 
    
});


//================================================  POST - ALTERAR CONTA  ===============================================//
$app->post('/conta/alterar', function() {       //Erro front


    Carteira::alteraConta($_POST);

    Visual::mostraMensagem('Alteração realizada com sucesso!', '/conta');

});

//-------------------------------------------------  GET - EXCLUIR CONTA  -----------------------------------------------//
$app->get('/conta/:id_conta/delete', function($id_conta) {

    $id_usuario = User::verifyLogin();

    $verificacao = User::verifyDeleteConta($id_usuario, $id_conta);

    if($verificacao == 1)
    {
        Carteira::deletaConta($id_conta);
        Visual::mostraMensagem('Conta excluída com sucesso!','/conta');
    }
    else
    {
        Visual::mostraMensagem('Essa conta não pertence a este usuário!','/conta');
    }

});




?>