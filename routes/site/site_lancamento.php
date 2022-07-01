<?php
use \Countpay\Page;
use \Countpay\Model\User;
use \Countpay\Model\Visual;
use \Countpay\Model\Carteira;
use \Countpay\Model\Lancamento;


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	      Rotas Lançamento                                                   ||
||												    																	 ||
//===========================================================|===========================================================*/

//--------------------------------------------------  GET - HISTÓRICO  --------------------------------------------------//
$app->get('/lancamento/historico', function() {

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $page->setTpl("historico_lancamento", array(
        "resultado"=>Lancamento::listaLancamentos($id_usuario),
    ));

});


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	        Rotas DESPESA                                                    ||
||												    																	 ||
//===========================================================|===========================================================*/

//----------------------------------------------------  GET - DESPESA  --------------------------------------------------//
$app->get('/lancamento/despesa', function() {

    $page = new Page();

    User::verifyLogin();   

    $page->setTpl("lancamento_despesa");  
    
});


//-------------------------------------------------  GET - DESPESA ÚNICA  -----------------------------------------------//
$app->get('/lancamento/despesa/unica', function() {     //MUDANÇA NO FRONT

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $page->setTpl("lancamento_despesa_unica", array(
        "categoria"=> Lancamento::listaCategoria(),
        "conta"=> Carteira::listaApelidoConta($id_usuario),
        "cartao"=> Carteira::listaApelidoCartao($id_usuario)
    )); 

});


//=================================================  POST - DESPESA ÚNICA  ==============================================//
$app->post('/lancamento/despesa/unica', function() {

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
        Lancamento::iniciaLancamentoUnico($_POST, $id_usuario);
    }
    else if($tipo_lancamento == "Fixa")
    {
        Lancamento::iniciaLancamentoFixo($_POST, $id_usuario);
    }

});


//------------------------------------------------  GET - DESPESA PARELADA  ---------------------------------------------//
$app->get('/lancamento/despesa/parcelado', function() {

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $page->setTpl("lancamento_despesa_parcelado", array(
        "categoria"=> Lancamento::listaCategoria(),
        "conta"=> Carteira::listaApelidoConta($id_usuario),
        "cartao"=> Carteira::listaApelidoCartao($id_usuario),
        "frequencia"=> Lancamento::listaFrequencia()
    ));

});


//================================================  POST - DESPESA PARELADA  ============================================//
$app->post('/lancamento/despesa/parcelado', function() {

    $id_usuario = User::verifyLogin();
    
    if($_POST['id_cartao'] == "")
    { 
        $_POST['id_cartao'] = NULL; 
    }

    if($_POST['id_conta'] == "")
    { 
        $_POST['id_conta'] = NULL; 
    }

    // Caso o valor de parcelas seja maior que 1 vai entrar na função
    if ($_POST['parcela_total'] > 1 ) {

        // Valor é dividido pelo numero de parcelas
        $_POST['valor'] = ($_POST['valor'] / $_POST['parcela_total']);

        $quant = Lancamento::analisaFrequencia($_POST);

        Lancamento::lancamentoParcelado($_POST, $id_usuario, $quant);

    } else { 

        Lancamento::iniciaLancamentoUnico($_POST, $id_usuario);

    }

    Visual::mostraMensagem('Lançamento realizada com sucesso!','/lancamento/historico');


});


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	        Rotas RECEITA                                                    ||
||												    																	 ||
//===========================================================|===========================================================*/

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
        Lancamento::iniciaLancamentoUnico($_POST, $id_usuario);
    }
    else if($tipo_lancamento == "Fixa")
    {
        Lancamento::iniciaLancamentoFixo($_POST, $id_usuario);
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

    // Caso o valor de parcelas seja maior que 1 vai entrar na função
    if ($_POST['parcela_total'] > 1 ) {

        // Valor é dividido pelo numero de parcelas
        $_POST['valor'] = ($_POST['valor'] / $_POST['parcela_total']);

        $quant = Lancamento::analisaFrequencia($_POST);

        Lancamento::lancamentoParcelado($_POST, $id_usuario, $quant);

    } else { 

        Lancamento::iniciaLancamentoUnico($_POST, $id_usuario);

    }

    Visual::mostraMensagem('Lançamento realizada com sucesso!','/lancamento/historico');


});


/*===========================================================|===========================================================\\
||											    																		 ||
||										    	    Rotas TRANSFERÊNCIA                                                  ||
||												    																	 ||
//===========================================================|===========================================================*/

//------------------------------------------------  GET - TRANSFERÊNCIA  ------------------------------------------------//
$app->get('/lancamento/transferencia', function() {

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $conta = Carteira::listaApelidoConta($id_usuario);

    $page->setTpl("lancamento_transferencia", array(
        "conta"=>$conta,
    ));

});


$app->post('/lancamento/transferencia', function() {

    $id_usuario = User::verifyLogin();

    Lancamento::iniciaLancamentoTransferencia($_POST, $id_usuario);

    Visual::mostraMensagem('Transferência realizada com sucesso!', '/lancamento/historico');

});

?>