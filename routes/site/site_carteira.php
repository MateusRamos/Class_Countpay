<?php
use \Countpay\Page;
use \Countpay\DB\Sql;
use \Countpay\Model\User;
use \Countpay\Model\Carteira;
use \Countpay\Model\Lancamento;

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

    // Busca o Id da instituição, se n retorna NULL:
    $id_instituicao = Carteira::buscaInstituicao($_POST);
    
    Carteira::criaCartao($_POST, $id_usuario, $id_instituicao);
    
    header('Location: /cartao');
    exit; 

});


//-----------------------------------------------  GET - ALTERAR CARTÃO  ------------------------------------------------//
$app->get('/cartao/:id_usuario', function($id_cartao) {
    
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
    
    $instituicao = Carteira::buscaInstituicao($_POST);

    Carteira::alteraCartao($_POST, $instituicao);

    User::mostraMensagem('Alteração realizada com sucesso!', '/cartao');
    
});


//-----------------------------------------------  GET - EXCLUIR CARTÃO  ------------------------------------------------//
$app->get('/cartao/:id_cartao/delete', function($id_cartao) {

    User::verifyLogin();

    Carteira::deletaCartao($id_cartao);

    User::mostraMensagem('Cartão excluído com sucesso!','/conta');

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

    // Select id da instituição do usuario pelo nome do select.
    $instituicao = Carteira::buscaInstituicao($_POST);
    
    $resultado = Carteira::criaConta($_POST, $instituicao, $id_usuario);

    header('Location: /conta');
    exit;

    }

);


//-------------------------------------------------  GET - ALTERAR CONTA  -----------------------------------------------//
$app->get('/conta/:id_usuario', function($id_conta) {

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

    $instituicao = Carteira::buscaInstituicao($_POST);

    Carteira::alteraConta($_POST, $instituicao);

    User::mostraMensagem('Alteração realizada com sucesso!', '/conta');

});

//-------------------------------------------------  GET - EXCLUIR CONTA  -----------------------------------------------//
$app->get('/conta/:id_conta/delete', function($id_conta) {

    $sql = new Sql();
    
    User::verifyLogin();

    Carteira::deletaConta($id_conta);

    User::mostraMensagem('Conta excluída com sucesso!','/conta');

});




?>