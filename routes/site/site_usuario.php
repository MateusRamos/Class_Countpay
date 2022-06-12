<?php
use \Countpay\Page;
use \Countpay\DB\Sql;
use \Countpay\Model\User;
use \Countpay\Model\Visual;
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

    $id_usuario = User::verifyLogin();

    Lancamento::verificaLancamentoFixo($id_usuario);

    $ultimos_lancamentos = Visual::listaUltimosLancamentos($id_usuario);
   
    $page->setTpl("index", array(
        "dados"=>$ultimos_lancamentos
    ));

});


//-----------------------------------------------------  GET - Termos S  ------------------------------------------------//
$app->get('/termos', function() {

    $page = new Page([
        "header"=>false,
        "footer"=>false
    ]);

    $page->setTpl("termos_condicoes");

});


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	        Rotas index                                                      ||
||												    																	 ||
//===========================================================|===========================================================*/

//----------------------------------------------------  GET - PERFIL  ---------------------------------------------------//
$app->get('/perfil', function() {

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $dados_perfil = User::carregaDadosPerfil($id_usuario);

    $page->setTpl("perfil", array(
        "dados"=>$dados_perfil[0]
    ));

});


//===================================================  POST - PERFIL  ===================================================//
$app->post('/perfil', function() {

    $id_usuario = User::verifyLogin();


});


//-------------------------------------------------  GET - Mudar Senha  -------------------------------------------------//
$app->get('/mudar_senha', function() {

    $page = new Page();

    User::verifyLogin();

    $page->setTpl("mudar_senha");

});

$app->post('/mudar_senha', function() {

    $id_usuario = User::verifyLogin();

    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];
    $confirma_senha = $_POST['confirma_senha'];

    if($nova_senha == $confirma_senha){
        User::atualizaSenha($id_usuario, $nova_senha, $senha_atual);
    }else{
        User::mostraMensagem('As senhas devem coincidir!', '/mudar_senha');
    }



});

?>