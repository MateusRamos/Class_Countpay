<?php
use \Countpay\Page;
use \Countpay\DB\Sql;
use \Countpay\Model\User;
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
        "conta" => buscaConta($_POST['id_conta'], $id_usuario),
        "cartao" => buscaCartao($_POST['id_cartao'], $id_usuario),
        'categoria' => buscaCategoria($_POST['id_categoria'])
    );

    $result = criaLancamentoUnico($dados_lancamento, $array_id, $id_usuario);

    if ($result > 0) {

        User::mostraMensagem('Lançamento realizado com sucesso!', '/lancamento/historico');

    } else {

        User::mostraMensagem('Algo deu errado! Tente novamente...', '/lancamento/despesa/unica');

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

    #$tipo_lancamento = $_POST['tipo_lancamento'];   ///mudar no front
    #$data_lancamento = $_POST['data_lancamento'];   ///mudar no front

    // Consulta no banco de dados para a conversão de string recebido do front-end para o ID dos campos selecionados
    $arrai_id = array (
        "id_usuario" => $id_usuario,
        "resultado_conta" => buscaConta($_POST['id_conta'], $id_usuario),
        "resultado_cartao" => buscaCartao($_POST['id_cartao'], $id_usuario),
        'resultado_categoria' => buscaCategoria($_POST['id_categoria'])
    );

    // Caso o valor de parcelas seja maior que 1 vai entrar na função
    if ($_POST['parcela'] > 1 ) {

        // Valor é dividido pelo numero de parcelas
        $valor = ($valor / $parcela);

        Lancamento::analisaFrequencia($_POST);

        lancamentoParcelado($_POST, $id_usuario, $array_id, $quant);

    } else { 
        
        Lancamento::criaLancamentoUnico($_POST, $array_id, $id_usuario);

    }

    User::mostraMensagem('Lançamento realizada com sucesso!','/lancamento/historico');

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

   /*
    $usuario = $sql->select("SELECT id_usuario FROM usuario WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$id_usuario)); 
    $categoria = $sql->select("SELECT descricao FROM categoria ORDER BY descricao ASC");
    $conta = $sql->select("SELECT apelido FROM conta WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$id_usuario));
    $cartao = $sql->select("SELECT apelido FROM cartao WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$id_usuario));
    */

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
        User::mostraMensagem('Lançamento realizado com sucesso!','/lancamento/historico');
    } else {
        User::mostraMensagem('Algo deu errado! Tente novamente...','/lancamento/receita/unica');
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

    User::mostraMensagem('Lançamento realizado com sucesso!', '/lancamento/historico');

});

?>