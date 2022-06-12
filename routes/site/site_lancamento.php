<?php
use \Countpay\Page;
use \Countpay\DB\Sql;
use \Countpay\Model\User;
use \Countpay\Model\Metas;
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

    $resultado = Lancamento::listaLancamentos($id_usuario);

    $page->setTpl("historico_lancamento", array(
        "resultado"=>$resultado
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

    $dados = array(
        "categoria"=>Lancamento::listaCategoria(),
        "conta"=>Carteira::listaApelidoConta($id_usuario),
        "cartao"=>Carteira::listaApelidoCartao($id_usuario),
        "tipo_receita"=>Lancamento::listaTipoReceita()          //???????????????????????????????????????????????//
    );  

    $page->setTpl("lancamento_despesa_unica", array(
        "dados"=>$dados
    )); 

});


//=================================================  POST - DESPESA ÚNICA  ==============================================//
$app->post('/lancamento/despesa/unica', function() {

    $id_usuario = User::verifyLogin();

    $array_id = array(
        "id_conta" => Carteira::buscaConta($_POST['id_conta'], $id_usuario),
        "id_cartao" => Carteira::buscaCartao($_POST['id_cartao'], $id_usuario),
        'id_categoria' => Lancamento::buscaCategoria($_POST['id_categoria'])
    );

    $result = Lancamento::criaLancamentoUnico($_POST, $array_id, $id_usuario);

    if ($result > 0) {

        Visual::mostraMensagem('Lançamento realizado com sucesso!', '/lancamento/historico');

    } else {

        Visual::mostraMensagem('Algo deu errado! Tente novamente...', '/lancamento/despesa/unica');

    }

});


//------------------------------------------------  GET - DESPESA PARELADA  ---------------------------------------------//
$app->get('/lancamento/despesa/parcelado', function() {

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $dados = array(
        "categoria"=> Lancamento::listaCategoria(),
        "conta"=> Carteira::listaApelidoConta($id_usuario),
        "cartao"=> Carteira::listaApelidoCartao($id_usuario),
        "frequencia"=> Lancamento::listaFrequencia()
    );

    $page->setTpl("lancamento_despesa_parcelado", array(
        "dados"=>$dados
    ));

});


//================================================  POST - DESPESA PARELADA  ============================================//
$app->post('/lancamento/despesa/parcelado', function() {

    $id_usuario = User::verifyLogin();

    // Consulta no banco de dados para a conversão de string recebido do front-end para o ID dos campos selecionados
    $array_id = array (
        "id_usuario" => $id_usuario,
        "id_conta" => Carteira::buscaConta($_POST['id_conta'], $id_usuario),
        "id_cartao" => Carteira::buscaCartao($_POST['id_cartao'], $id_usuario),
        'id_categoria' => Lancamento::buscaCategoria($_POST['id_categoria'])
    );

    // Caso o valor de parcelas seja maior que 1 vai entrar na função
    if ($_POST['parcela'] > 1 ) {

        // Valor é dividido pelo numero de parcelas
        $_POST['valor'] = ($_POST['valor'] / $_POST['parcela']);

        $quant = Lancamento::analisaFrequencia($_POST);

        Lancamento::lancamentoParcelado($_POST, $id_usuario, $array_id, $quant);

    } else { 
        
        Lancamento::criaLancamentoUnico($_POST, $array_id, $id_usuario);

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
$app->get('/lancamento/receita/unica', function() {     //MUDANÇA NO FRONT

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $dados = array(
        "categoria"=> Lancamento::listaCategoria(),
        "conta"=> Carteira::listaApelidoConta($id_usuario),
        "cartao"=> Carteira::listaApelidoCartao($id_usuario)
    );

    $page->setTpl("lancamento_receita_unica", array(
        "dados"=>$dados
    )); 

});



//================================================  POST - RECEITA ÚNICA  ===============================================//
$app->post('/lancamento/receita/unica', function() {

    $id_usuario = User::verifyLogin();

    //Sql de string para ID:
    $array_id = array(
        "id_conta" => Carteira::buscaConta($_POST['id_conta'], $id_usuario),
        "id_cartao" => Carteira::buscaCartao($_POST['id_cartao'], $id_usuario),
        "id_categoria" => Lancamento::buscaCategoria($_POST['id_categoria'])
    );

    $resultado = Lancamento::criaLancamentoUnico($_POST, $array_id, $id_usuario); 

    if ($resultado > 0) {

        Visual::mostraMensagem('Lançamento realizado com sucesso!','/lancamento/historico');
    } else {
        Visual::mostraMensagem('Algo deu errado! Tente novamente...','/lancamento/receita/unica');
    }

});


//-----------------------------------------------  GET - RECEITA PARCELADA  ---------------------------------------------//
$app->get('/lancamento/receita/parcelado', function() {         //MUDANÇA NO FRONT

    $page = new Page();

    $id_usuario = User::verifyLogin();

    $dados = array(
        "categoria"=> Lancamento::listaCategoria(),
        "conta"=> Carteira::listaApelidoConta($id_usuario),
        "cartao"=> Carteira::listaApelidoCartao($id_usuario),
        "frequencia"=> Lancamento::listaFrequencia()
    );
    
    $page->setTpl("lancamento_receita_parcelado", array(
        "dados"=>$dados
    ));

});


//===============================================  POST - RECEITA PARCELADA  ============================================//
$app->post('/lancamento/receita/parcelado', function() {

    $id_usuario = User::verifyLogin();

    //Sql de string para ID:
    $array_id = array(
        "id_conta" => Carteira::buscaConta($_POST['id_conta'], $id_usuario),
        "id_cartao" => Carteira::buscaCartao($_POST['id_cartao'], $id_usuario),
        "id_categoria" => Lancamento::buscaCategoria($_POST['id_categoria'])
    );

    // Caso o valor de parcelas seja maior que 1 vai entrar na função
    if ($_POST['parcela'] > 1 ) {

        // Valor é dividido pelo numero de parcelas
        $_POST['valor'] = ($_POST['valor'] / $_POST['parcela']);

        $quant = Lancamento::analisaFrequencia($_POST);
        
        Lancamento::lancamentoParcelado($_POST, $id_usuario, $array_id, $quant);

    } else { 

        $_POST['tipo_receita'] = "Receita";

        Lancamento::criaReceitaUnica($_POST, $array_id, $id_usuario);

    }

    Visual::mostraMensagem('Lançamento realizado com sucesso!', '/lancamento/historico');

});

?>