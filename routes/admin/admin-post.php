<?php

use \Countpay\PageAdmin;
use \Countpay\DB\Sql;
use \Countpay\Model\User;
use \Countpay\Model\Visual;


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	      Rota admin/login                                                   ||
||												    																	 ||
//===========================================================|===========================================================*/

//==============================================  Post do login do admin  ===============================================//
$app->post('/admin/login', function() {

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    User::loginAdmin($login, $senha);

});


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	     Rota admin/usuario                                                  ||
||												    																	 ||
//===========================================================|===========================================================*/

//==========================================  Post de criar usuario do admin  ===========================================//
$app->post('/admin/usuario/criar', function() {
    
    $page = new PageAdmin();

    User::verifyLoginAdmin();

    $existeCadastro = User::verificaDadosCadastro($_POST); //$email, $login

    if($existeCadastro == 0)
    {
        User::mostraMensagem('E-mail ou login já cadastrado, tente novamente!', '/admin/usuario/criar');
    } else {
        
        User::cadastraUsuario($_POST);
        
        User::mostraMensagem('Usuário cadastrado com sucesso!', '/admin/usuario');
        
    }

});


//========================================  Post de alterar usuario do admin  ===========================================//
$app->post('/admin/usuario/alterar', function() {

    User::verifyLoginAdmin();

    $verificaCad = User::verificaAlteracao($_POST);

    if($verificaCad == 1 )
    {
        User::alteraUsuario($_POST);

        User::mostraMensagem('Usuário alterado com sucesso!','/admin/usuario');

    } else {
        User::mostraMensagem('E-mail ou login já cadastrados!', '/admin/usuario');
    }
    
    
});


//=======================================  Post de alterar criar notificações  ==========================================//
$app->post('/admin/notificacoes/criar', function() {

    $id_usuario = User::BuscaEmail($_POST);
    $id_tipo_notificacao = User::BuscaTipoNotificacao($_POST);

    User::criaNotificacao($_POST, $id_usuario, $id_tipo_notificacao);

    Visual::mostraMensagem('Notificação enviada com sucesso!', '/admin');

});



?>