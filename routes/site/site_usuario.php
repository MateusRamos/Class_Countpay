<?php
use \Countpay\Page;
use \Countpay\Model\User;
use \Countpay\Model\Visual;
use \Countpay\Model\Lancamento;
use \Countpay\Model\Projecoes;

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

    if($existeCadastro == 1)
    {
        Visual::mostraMensagem('E-mail ou login já cadastrado, tente novamente!', '/cadastro');
    } 
    else
    {
        
        $dados_usuario = User::cadastraUsuario($_POST);

        $_SESSION['usuario'] = $dados_usuario['id_usuario'];
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


    $ultimos_lancamentos = Visual::listaUltimosLancamentos($id_usuario);
    $receitaUsuario = Visual::calculaReceitaUsuario($id_usuario);
    $despesaUsuario = Visual::calculaDespesaUsuario($id_usuario);
    $transferencia = Visual::calculaTransferenciaUsuario($id_usuario);

    $dados_aux = Projecoes::coletaDadosMes($id_usuario);
    $dados = Projecoes::coletaDadosFixo($dados_aux, $id_usuario);

    $page->setTpl("index", array(
        "dados"=>$ultimos_lancamentos,
        "receita"=>$receitaUsuario,
        "despesa"=>$despesaUsuario,
        "grafico"=>$dados,
        "transferencia"=>$transferencia
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

    if($verificando == 1){
        User::alteraDadosPerfil($id_usuario, $_POST);
        Visual::mostraMensagem('Perfil de usuario alterado com sucesso!!!!', '/perfil');
    }else{
        User::insereDadosPerfil($id_usuario, $_POST);
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