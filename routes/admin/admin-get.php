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
$app->get('/admin', function() {   //talvez mudar

    $sql = new Sql();
    $page = new PageAdmin();
  
    //Verificando se está logado:
    User::verifyLoginAdmin();
    
    //Puxando os dados do banco para mostrar no Dashboard:
    $usuarioDados = Visual::calculaTotalUsuarios();
    $contaDados = Visual::calculaTotalContas();
    $cartaoDados = Visual::calculaTotalCartoes();
    $lancamentoDados = Visual::calculaTotalLancamentos();

    //Enviando dados do banco para o Dashboard:
    $page->setTpl("index", array(
        "usuarioDados"=>$usuarioDados[0],
        "contaDados"=>$contaDados[0],
        "cartaoDados"=>$cartaoDados[0],
        "lancamentoDados"=>$lancamentoDados[0]
    )); 
  
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
    
    //Verificando se está logado:
    User::verifyLoginAdmin();

    $page->setTpl("criarusuario");
        
});


//======================================= Rota para tela de Alteração de dados: ========================================//
$app->get('/admin/usuario/:id_usuario', function($id_usuario) {

    $page = new PageAdmin();

    //Verificando se está logado:
    User::verifyLoginAdmin();

    //Carregando as informações do usuario do banco de dados:
    $usuario = User::buscaPorId($id_usuario);

    //Colocando os dados coletados no formulário pelo Slim:
    $page->setTpl("alterarusuario", array(
        "usuario"=>$usuario
    )); 
    
});


//====================================!! Rota para EXCLUIR um usuario cadastrado: !!====================================//
$app->get('/admin/usuario/:id_usuario/delete', function($id_usuario) {

    User::verifyLoginAdmin();

    //Executado a exclusão da row do banco de dados de acordo com o ID selecionado:
    User::deletaUsuario($id_usuario);

    User::mostraMensagem("Usuário excluido com sucesso!", "/admin/usuario");

});


/*===========================================================|===========================================================\\
||																								      					 ||
||											       Rotas admin/Notificacoes   	   								         ||
||																													     ||
//===========================================================|===========================================================*/

//========================================== Rota para criar novas notificações: ========================================//
$app->get('/notificacoes/criar', function(){
    
    $page = new PageAdmin();

    User::verifyLoginAdmin();

    $tipo_notificacoes = User::listaTipoNotificacao();

    $page->setTpl("criar_notificacoes", array(
        "dados" => $tipo_notificacoes
    )); 

});





?>