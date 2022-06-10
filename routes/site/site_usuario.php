<?php
use \Countpay\Page;
use \Countpay\DB\Sql;
use \Countpay\Model\User;
use \Countpay\Model\Carteira;
use \Countpay\Model\Lancamento;

/*===========================================================|===========================================================\\
||											    																		 ||
||										    	        Rotas login                                                      ||
||												    																	 ||
//===========================================================|===========================================================*/

//----------------------------------------------------  GET - LOGIN  ----------------------------------------------------//
$app->get('/login', function() {

    $page = new Page([
        "header"=>false,
        "footer"=>false
    ]);

    $page->setTpl("login");

});


//====================================================  POST - LOGIN  ===================================================//
$app->post('/login', function() {

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    User::loginNormal($login, $senha);
    
});


//---------------------------------------------------  GET - CADASTRO  --------------------------------------------------//
$app->get('/cadastro', function(){

    $page = new Page([
        "header"=>false,
        "footer"=>false
    ]);

    $page->setTpl("cadastro");
});


//====================================================  POST - LOGIN  ===================================================//
$app->post('/cadastro', function(){

    $existeCadastro = User::verificaDadosCadastro($_POST);

    if($existeCadastro == 0)
    {
        User::mostraMensagem('E-mail ou login já cadastrado, tente novamente!', '/cadastro');
    } else {
        
        $dados_usuario = User::cadastraUsuario($_POST);

        $_SESSION['usuario'] = $dados_usuario[0]['id_usuario'];
        header("Location: /");
        exit;
        
    }

});
//----------------------------------------------------  GET LOGOUT  -----------------------------------------------------// 
$app->get('/sair', function() {

    session_destroy();

    header('Location: /login');
    exit;

});


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	        Rotas index                                                      ||
||												    																	 ||
//===========================================================|===========================================================*/

//-----------------------------------------------------  GET - DASHBOARD  -----------------------------------------------//
$app->get('/', function() {

    $page = new Page();

    User::verifyLogin();

    $page->setTpl("index");

});


//-----------------------------------------------------  GET - Termos S  ------------------------------------------------//
$app->get('/termos', function() {

    $page = new Page([
        "header"=>false,
        "footer"=>false
    ]);

    $page->setTpl("termos_condicoes");

});

?>