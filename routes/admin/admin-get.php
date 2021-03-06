<?php
use \Countpay\PageAdmin;
use \Countpay\DB\Sql;
use \Countpay\Model\User;
use \Countpay\Model\Visual;


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	   	    Rotas admin                                                      ||
||												    																	 ||
//===========================================================|===========================================================*/


//==============================================  Rota do index do admin:  ==============================================//
$app->get('/admin', function() { 

    $page = new PageAdmin();
  
    User::verifyLoginAdmin();
    
    $usuarioDados = Visual::calculaTotalUsuarios();
    $contaDados = Visual::calculaTotalContas();
    $cartaoDados = Visual::calculaTotalCartoes();
    $lancamentoDados = Visual::calculaTotalLancamentos();

    $page->setTpl("index", array(
        "usuarioDados"=>$usuarioDados[0],
        "contaDados"=>$contaDados[0],
        "cartaoDados"=>$cartaoDados[0],
        "lancamentoDados"=>$lancamentoDados[0]
    )); 
  
});


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	        Rotas logout                                                     ||
||												    																	 ||
//===========================================================|===========================================================*/

//----------------------------------------------------  GET LOGOUT  -----------------------------------------------------// 
$app->get('/admin/sair', function() {

    session_destroy();

    header('Location: /admin/login');
    exit;

});


/*===========================================================|===========================================================\\
||									       																				 ||
||								    			     Rotas admin/login   												 ||
||									    																				 ||
//===========================================================|===========================================================*/



//============================================== Rota do Login para admin: ==============================================//
$app->get('/admin/login', function() {

    $page = new PageAdmin([
        "header"=>false,
        "footer"=>false
    ]);

    $page->setTpl("login");

});


/*===========================================================|===========================================================\\
||																								      					 ||
||											        Rotas admin/usuario   											     ||
||																													     ||
//===========================================================|===========================================================*/

//============================================ Rota para listar os usuarios: ============================================//
$app->get('/admin/usuario', function() {

    $page = new PageAdmin();
    
    User::verifyLoginAdmin();

    //Puxando os dados dos usuarios do banco de dados:
    $usuarios = User::listaTodosUsuarios();

        
    $page->setTpl("lista_usuarios", array(
        "usuarios"=>$usuarios
    ));
    
});


//=========================================== Rota para criar novos usuarios: ===========================================//
$app->get('/admin/usuario/criar', function() {

    $page = new PageAdmin();
    
    User::verifyLoginAdmin();

    $page->setTpl("criarusuario");
        
});


//======================================= Rota para tela de Altera????o de dados: ========================================//
$app->get('/admin/usuario/:id_usuario', function($id_usuario) {

    $page = new PageAdmin();

    User::verifyLoginAdmin();

    $usuario = User::buscaPorId($id_usuario);

    $page->setTpl("alterarusuario", array(
        "usuario"=>$usuario
    )); 
    
});


//====================================!! Rota para EXCLUIR um usuario cadastrado: !!====================================//
$app->get('/admin/usuario/:id_usuario/delete', function($id_usuario) {

    User::verifyLoginAdmin();

    User::deletaUsuario($id_usuario);

    Visual::mostraMensagem("Usu??rio excluido com sucesso!", "/admin/usuario");

});


/*===========================================================|===========================================================\\
||																								      					 ||
||											       Rotas admin/Notificacoes   	   								         ||
||																													     ||
//===========================================================|===========================================================*/

//========================================== Rota para criar novas notifica????es: ========================================//
$app->get('/notificacoes/criar', function() {
    
    $page = new PageAdmin();

    User::verifyLoginAdmin();

    $tipo_notificacoes = User::listaTipoNotificacao();

    $page->setTpl("criar_notificacoes", array(
        "dados" => $tipo_notificacoes
    )); 

});


/*===========================================================|===========================================================\\
||																								      					 ||
||											         Rotas Complementares   	   								         ||
||																													     ||
//===========================================================|===========================================================*/

$app->get('/admin/perfil', function () {

    $page = new PageAdmin();

    $id_usuario = User::verifyLoginAdmin();

    $dados_perfil = User::carregaDadosPerfil($id_usuario);

    $page->setTpl("perfil", array(
        "dados"=>$dados_perfil[0]
    ));

});


$app->get('/admin/contato', function() {

    $page = new PageAdmin();

    $page->setTpl("contato");

});





?>