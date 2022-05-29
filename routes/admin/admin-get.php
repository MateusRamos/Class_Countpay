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
    User::verifyLogin();

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

    //Puxando os dados dos usuarios do banco de dados:
    $usuarios = User::loadAllUsers();

    //Verificando se está logado:
    User::verifyLogin();
        
    $page->setTpl("lista_usuarios", array("usuarios"=>$usuarios));
    
});


//=========================================== Rota para criar novos usuarios: ===========================================//
$app->get('/admin/usuario/criar', function() {

    $page = new PageAdmin();

    //Verificando se está logado:
    User::verifyLogin();

    $page->setTpl("criarusuario");
        
});


//======================================= Rota para tela de Alteração da dados: ========================================//
$app->get('/admin/usuario/:id_usuario', function($id_usuario) {

    $page = new PageAdmin();

    //Verificando se está logado:
    User::verifyLogin();

    //Carregando as informações do usuario do banco de dados:
    $usuario = User::loadById($id_usuario);

    //Colocando os dados coletados no formulário pelo Slim:
    $page->setTpl("alterarusuario", array(
        "usuario"=>$usuario
    )); 
    
});


//====================================!! Rota para EXCLUIR um usuario cadastrado: !!====================================//
$app->get('/admin/usuario/:id_usuario/delete', function($id_usuario) {

    $user = new User();

    //Executado a exclusão da row do banco de dados de acordo com o ID selecionado:
    $user->deleteUser($id_usuario);

    //Mensagem de Exclusão bem sucedida:
    $mensagem = "Usuário excluido com sucesso!";
    $rota = "/admin/usuario";
    User::mostraMensagem($mensagem, $rota);

});

?>