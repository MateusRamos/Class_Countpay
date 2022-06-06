<?php
use \Countpay\PageAdmin;
use \Countpay\DB\Sql;
use \Countpay\Model\User;


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	   	    Rotas admin                                                      ||
||												    																	 ||
//===========================================================|===========================================================*/


//==============================================  Rota do index do admin:  ==============================================//
$app->get('/admin', function() {

    $sql = new Sql();
    $page = new PageAdmin();
  
    //Verificando se está logado:
    User::verifyLoginAdmin();

    //Puxando os dados do banco para mostrar no Dashboard:
    $usuarioDados = $sql->select("SELECT quantidade_usuario FROM usuario_dados"); 
    $contaDados = $sql->select("SELECT quantidade_conta FROM conta_dados");
    $cartaoDados = $sql->select("SELECT quantidade_cartao FROM cartao_dados");
    $lancamentoDados = $sql->select("SELECT lancamento_total FROM lancamento_dados");

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
    $usuarios = User::ListaTodosUsuarios();

        
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

?>