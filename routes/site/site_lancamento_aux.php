<?php
use \Countpay\Page;
use \Countpay\DB\Sql;
use \Countpay\Model\User;
use \Countpay\Model\Meta;
use \Countpay\Model\Visual;
use \Countpay\Model\Carteira;
use \Countpay\Model\Lancamento;

use \Countpay\Model\LancamentoAux;

//----------------------------------------------------  GET - RECEITA  --------------------------------------------------//
$app->get('/lancamento/receita', function() {

    $page = new Page();

    User::verifyLogin();  

    $page->setTpl("lancamento_receita");  
    
});


//-------------------------------------------------  GET - RECEITA ÚNICA  -----------------------------------------------//
$app->get('/lancamento/receita/unica', function() {

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $page->setTpl("lancamento_receita_unica", array(
        "categoria"=> Lancamento::listaCategoria(),
        "conta"=> Carteira::listaApelidoConta($id_usuario),
        "cartao"=> Carteira::listaApelidoCartao($id_usuario),
    )); 

});


//================================================  POST - RECEITA ÚNICA  ===============================================//
$app->post('/lancamento/receita/unica', function() {

    $id_usuario = User::verifyLogin();

    $tipo_lancamento = substr($_POST['tipo_lancamento'], 8, 13);


    if($_POST['id_cartao'] == "")
    { 
        $_POST['id_cartao'] = NULL; 
    }

    if($_POST['id_conta'] == "")
    { 
        $_POST['id_conta'] = NULL; 
    }


    if($tipo_lancamento == "Única")
    {
        LancamentoAux::iniciaLancamentoUnico($_POST, $id_usuario);
    }
    else if($tipo_lancamento == "Fixa")
    {
        LancamentoAux::iniciaLancamentoFixo($_POST, $id_usuario);
    }

});







//-----------------------------------------------  GET - RECEITA PARCELADA  ---------------------------------------------//
$app->get('/lancamento/receita/parcelado', function() {         //MUDANÇA NO FRONT

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $page->setTpl("lancamento_receita_parcelado", array(
        "categoria"=> Lancamento::listaCategoria(),
        "conta"=> Carteira::listaApelidoConta($id_usuario),
        "cartao"=> Carteira::listaApelidoCartao($id_usuario),
        "frequencia"=> Lancamento::listaFrequencia()
    ));

});


//===============================================  POST - RECEITA PARCELADA  ============================================//
$app->post('/lancamento/receita/parcelado', function() {

    $id_usuario = User::verifyLogin();

    
    if($_POST['id_cartao'] == "")
    { 
        $_POST['id_cartao'] = NULL; 
    }

    if($_POST['id_conta'] == "")
    { 
        $_POST['id_conta'] = NULL; 
    }


    if ($_POST['parcela'] <= 1 )
    {
        $_POST['tipo_lancamento'] = "Receita Única";

        LancamentoAux::iniciaLancamentoUnico($_POST, $id_usuario);

    } 
    else 
    { 
        LancamentoAux::iniciaLancamentoParcelado($_POST, $id_usuario);
    }


});















?>