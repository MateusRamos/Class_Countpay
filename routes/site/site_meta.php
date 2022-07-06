<?php
use \Countpay\Page;
use \Countpay\Model\User;
use \Countpay\Model\Meta;
use \Countpay\Model\Visual;
use \Countpay\Model\Carteira;


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

    Visual::mostraMensagem('Meta criada com sucesso!', '/minhasmetas');

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

    header('Location: /minhasmetas');
    exit;

});


//-----------------------------------------------  GET - PAUSAR META  ------------------------------------------------//

$app->get('/meta/:id_meta/pausar', function($id_meta) {
    
    $id_usuario = User::verifyLogin();

    $verificaPosse = Meta::verificaPosseMeta($id_usuario, $id_meta);
    $verificaAtiva = Meta::verificaSeMetaEstaAtiva($id_meta);

    if($verificaPosse == 1 && $verificaAtiva == "ativo")
    {
        Meta::pausaMeta($id_meta);

                
        header('Location: /minhasmetas');
        exit;
    }
    else if($verificaPosse == 1 && $verificaAtiva != "ativo")
    {
        Visual::mostraMensagem('A meta precisa estar ativa para ser pausada!', '/minhasmetas');
    }
    else
    {
        Visual::mostraMensagem('Esta meta não te pertençe!', '/minhasmetas');
    }

});


//-----------------------------------------------  GET - PAUSAR META  ------------------------------------------------//

$app->get('/meta/:id_meta/ativar', function($id_meta) {
    
    $id_usuario = User::verifyLogin();

    $verificaPosse = Meta::verificaPosseMeta($id_usuario, $id_meta);
    $verificaAtiva = Meta::verificaSeMetaEstaAtiva($id_meta);
    $id_conta = Meta::buscaIdContaDaMeta($id_meta);

    if($verificaPosse == 1 && $verificaAtiva == "pausado")
    {

        Meta::pausaMetaAtiva($id_conta);

        Meta::ativaMeta($id_meta);
                
        header('Location: /minhasmetas');
        exit;
    }
    else if($verificaPosse == 1 && $verificaAtiva == "ativo")
    {
        Visual::mostraMensagem('Essa meta já está ativa!', '/minhasmetas');
    }
    else if($verificaPosse == 1 && $verificaAtiva == "concluido")
    {
        Visual::mostraMensagem('Essa meta já foi concluída!', '/minhasmetas');
    }
    else
    {
        Visual::mostraMensagem('Esta meta não te pertençe!', '/minhasmetas');
    }

});


//-----------------------------------------------  GET - EXCLUIR META  ------------------------------------------------//
$app->get('/meta/:id_meta/delete', function($id_meta) {

    $id_usuario = User::verifyLogin();

    $verificacao = Meta::verificaPosseMeta($id_usuario, $id_meta);

    if($verificacao == 1)
    {
        Meta::deletaMeta($id_meta);
        Visual::mostraMensagem('Meta excluído com sucesso!','/minhasmetas');
    }
    else
    {
        Visual::mostraMensagem('Essa meta não pertence a este usuário!','/minhasmetas');
    }

});





?>