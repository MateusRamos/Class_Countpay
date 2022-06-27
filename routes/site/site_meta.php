<?php
use \Countpay\Page;
use \Countpay\Model\User;
use \Countpay\Model\Meta;
use \Countpay\Model\Visual;
use \Countpay\Model\Carteira;
use \Countpay\Model\Lancamento;


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	        Rotas Metas                                                      ||
||												    																	 ||
//===========================================================|===========================================================*/

//------------------------------------------------  GET - Minhas Metas  -------------------------------------------------//
$app->get('/minhasmetas', function() {

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $metas = Meta::listaMetas($id_usuario);

    $page->setTpl("minhas_metas", array(
        "metas"=>$metas
    ));

});


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	      Rotas Guardando                                                    ||
||												    																	 ||
//===========================================================|===========================================================*/

$app->get('/metas/criar', function() {

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $conta = Carteira::listaConta($id_usuario);

    $page->setTpl("meta_guardando", array(
        "conta"=>$conta
    ));

});


$app->post('/metas/criar', function() {

    $id_usuario = User::verifyLogin();

    Meta::criaGuardando($_POST, $id_usuario);

    Visual::mostraMensagem('Meta criada com sucesso!', '/');

});


$app->get('/metas/:id_meta', function($id_meta) {

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $meta = Meta::BuscaDadosMeta($id_meta);
    $id_conta = $meta[0]['id_conta']; 
    $conta = Carteira::listaApelidoConta($id_usuario);

    foreach($conta as $key => $value)
    {
        if($conta[$key]['id_conta'] == $id_conta)
        {
            $conta[$key]['id_conta'] = 'value="'. $id_conta .'" selected';
        }
        else
        {
            $conta[$key]['id_conta'] = 'value="'. $conta[$key]['id_conta'] .'"';
        }
    }

    $page->setTpl("meta_guardando_alterar", array(
        'meta'=>$meta[0],
        'conta'=>$conta
    ));

});


$app->post('/metas/alterar', function() {

    $id_usuario = User::verifyLogin();

    Meta::alteraGuardandoUmaGrana($_POST, $id_usuario);

});





?>