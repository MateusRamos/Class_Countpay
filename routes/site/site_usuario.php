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


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	       Rotas cadastro                                                    ||
||												    																	 ||
//===========================================================|===========================================================*/

//---------------------------------------------------  GET - CADASTRO  --------------------------------------------------//
$app->get('/cadastro', function(){

    $page = new Page([
        "header"=>false,
        "footer"=>false
    ]);

    $page->setTpl("cadastro");
});


//==================================================  POST - CADASTRO  ==================================================//
$app->post('/cadastro', function(){

    $existeCadastro = User::verificaDadosCadastro($_POST);

    if($existeCadastro == 0)
    {
        Visual::mostraMensagem('E-mail ou login já cadastrado, tente novamente!', '/cadastro');
    } else {
        
        $dados_usuario = User::cadastraUsuario($_POST);

        $_SESSION['usuario'] = $dados_usuario[0]['id_usuario'];
        header("Location: /");
        exit;
        
    }

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
||										    	        Rotas logout                                                     ||
||												    																	 ||
//===========================================================|===========================================================*/

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

    
    Lancamento::verificaLancamentoFixo($id_usuario); // Status = 1
    Lancamento::verificaLancamentoUnicoFuturo($id_usuario);  // Status = 2
    Lancamento::verificaLancamentoParceladoFuturo($id_usuario);  // Status = 3
    
    $ultimos_lancamentos = Visual::listaUltimosLancamentos($id_usuario);

    $page->setTpl("index", array(
        "dados"=>$ultimos_lancamentos,
    ));

});




/*===========================================================|===========================================================\\
||											    																		 ||
||										    	        Rotas Header                                                     ||
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

    $verificando = User::verificaDadosPerfil($id_usuario);

    if($verificando == 0){
        User::alteraDadosPerfil($id_usuario, $_POST);
        Visual::mostraMensagem('Perfil de usuario alterado com sucesso!!!!', '/perfil');
    }else{
        User::insereDadoPerfil($id_usuario, $_POST);
        Visual::mostraMensagem('Perfil de usuário criado com sucesso!', '/perfil');
    }

});


//-------------------------------------------------  GET - Mudar Senha  -------------------------------------------------//
$app->get('/mudar_senha', function() {

    $page = new Page();

    User::verifyLogin();

    $page->setTpl("mudar_senha");

});


//------------------------------------------------  POST - Mudar Senha  -------------------------------------------------//
$app->post('/mudar_senha', function() {

    $id_usuario = User::verifyLogin();

    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];
    $confirma_senha = $_POST['confirma_senha'];

    if($nova_senha == $confirma_senha){
        User::atualizaSenha($id_usuario, $nova_senha, $senha_atual);
    }else{
        Visual::mostraMensagem('As senhas devem coincidir!', '/mudar_senha');
    }



});


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	        Rotas Sidebar                                                    ||
||												    																	 ||
//===========================================================|===========================================================*/

//---------------------------------------------------  GET - Contato  ---------------------------------------------------//
$app->get('/contato', function() {

    $page = new Page();

    $page->setTpl("contato");

});


$app->post('/contato', function() {

    

});



?>