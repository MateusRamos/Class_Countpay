<?php

use \Countpay\Page;
use \Countpay\DB\Sql;

/****************************************************************************************************************************************************/
/****************************************************************************************************************************************************/
// ROTA DO INDEX
$app->get('/login', function() {

    $page = new Page([
        "header"=>false,
        "footer"=>false
    ]);

    $page->setTpl("login");

});

/****************************************************************************************************************************************************/
/****************************************************************************************************************************************************/
// POST DO LOGIN PARA O ADMINISTRADOR
$app->post('/login', function() {

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = new Sql();

    $array_resultado = $sql->select("SELECT id_usuario, login, senha, id_tipo_usuario FROM usuario WHERE login = :LOGIN AND senha = :SENHA",
    array(
        ":LOGIN"=>$login,
        ":SENHA"=>$senha
    ));

    // Se existe algo no array, atribua as variaveis com o resultado dos array na posição.
    if (!empty($array_resultado)) {

    $resultado_id = $array_resultado[0]['id_usuario'];
    $resultado_login = $array_resultado[0]['login'];
    $resultado_senha = $array_resultado[0]['senha']; 
    $resultado_tipo_usuario = $array_resultado[0]['id_tipo_usuario'];

    } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Login ou Senha invalido!');window.location.href='/login';</script>";
    }

    if ($resultado_login == $login && $resultado_senha == $senha && $resultado_tipo_usuario == 2) {
    
    // ARMAZENA A SESSÃO SE O LOGIN SER EFETIVADO
    $_SESSION['usuario'] = $resultado_id;
    header("Location: /");
    exit;

    } else {
    echo "<script language='javascript' type='text/javascript'>
    alert('Usuário ou Senha incorreto!');window.location.href='/login';</script>";
    }
    
    });

/****************************************************************************************************************************************************/
/****************************************************************************************************************************************************/
// ROTA DO INDEX
$app->get('/', function() {

    $page = new Page();

    if (!isset($_SESSION['usuario']))
    {
        header('Location: /login');
        exit;
    }

    $page->setTpl("index");

});


// ROTA DO POST RECEITA UNICA
$app->get('/lancamento/historico', function() {

    $page = new Page();
    $sql = new Sql();

    $resultado_id = $_SESSION['usuario'];

    $resultado = $sql->select("SELECT 
    lancamento.descricao_lancamento, lancamento.tipo_lancamento, lancamento.valor, categoria.descricao, lancamento.data_lancamento, IF(conta.apelido <> NULL, NULL, conta.apelido) 'conta', cartao.apelido 'cartao', lancamento.quantidade_parcelas, lancamento.frequencia
    FROM lancamento															
    INNER JOIN categoria ON lancamento.id_categoria = categoria.id_categoria AND lancamento.id_usuario = :ID_USUARIO
    LEFT OUTER JOIN cartao ON lancamento.id_cartao = cartao.id_cartao
    LEFT OUTER JOIN conta ON lancamento.id_conta = conta.id_conta", array(
        ":ID_USUARIO"=>$resultado_id
    ));

    
    $page->setTpl("historico_lancamento", array(
        "resultado"=>$resultado));

});


// ROTA PARA ESCOLHER O LANÇAMENTO
$app->get('/lancamento/receita', function() {

    $page = new Page();
    $page->setTpl("lancamento_receita");  
    
});























// ROTA DE LANÇAMENTO ÚNICO OU NORMAL
$app->get('/lancamento/receita/unica', function() {

    $page = new Page();
    $sql = new Sql();

    $resultado_id = $_SESSION['usuario'];

    $usuario = $sql->select("SELECT id_usuario FROM usuario WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id)); 
    $categoria = $sql->select("SELECT descricao FROM categoria ORDER BY descricao ASC");
    $conta = $sql->select("SELECT apelido FROM conta WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id));
    $cartao = $sql->select("SELECT apelido FROM cartao WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id));
    $tipo_receita = $sql->select("SELECT descricao FROM tipo_receita WHERE id_tipo_receita < 3");

     $page->setTpl("lancamento_receita_unica", array(
        "usuario"=>$usuario[0],
        "categoria"=>$categoria,
        "conta"=>$conta,
        "cartao"=>$cartao,
        "tipo_receita"=>$tipo_receita
    )); 

});


// ROTA DO POST RECEITA UNICA
$app->post('/lancamento/receita/unica', function() {

    $sql = new Sql();

    // COLETA DADOS DO FRONT-END
    $descricao = $_POST['descricao'];
    $tipo_lancamento = $_POST['tipo_receita'];
    $valor = $_POST['valor'];
    $data_lancamento = $_POST['data_receita'];
    $id_usuario = $_POST['id_usuario'];
    $desc_conta = $_POST['id_conta'];
    $desc_cartao = $_POST['id_cartao'];
    $desc_categoria = $_POST['id_categoria'];

    // ID COLETADO NA SESSIÃO
    $usuario = $_SESSION['usuario'];


    // CONSULTA NO BANCO PARA A CONVERSÃO
    $resultado_conta = $sql->select("SELECT id_conta FROM conta WHERE apelido = :APELIDO AND id_usuario = :ID_USUARIO",
    array (
    ":APELIDO"=>$desc_conta,
    ':ID_USUARIO'=>$usuario
    ));

    $resultado_cartao = $sql->select("SELECT id_cartao FROM cartao WHERE apelido = :APELIDO AND id_usuario = :ID_USUARIO",
    array (
    ":APELIDO"=>$desc_cartao,
    ':ID_USUARIO'=>$usuario
    ));

    $resultado_categoria = $sql->select("SELECT id_categoria FROM categoria WHERE descricao = :DESCRICAO",
    array (
    ":DESCRICAO"=>$desc_categoria
    ));


    // CONVERSÃO DE DADOS QUE É RECEBIDO COMO TEXTO PARA INT
    if (!empty($resultado_conta)){
        $conta = $resultado_conta[0]['id_conta'];
    } else {
        $conta = NULL;
    }

    if (!empty($resultado_cartao)){
        $cartao = $resultado_cartao[0]['id_cartao'];
    } else {
        $cartao = NULL;
    }

    if (!empty($resultado_categoria)){
        $categoria = $resultado_categoria[0]['id_categoria'];
    } else {
        $categoria = NULL;
    }


    $resultado = $sql->select("CALL sp_lancamento_normal(:ID_USUARIO, :DESCRICAO, :VALOR, :TIPO_LANCAMENTO, :DATA_LANCAMENTO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA)", array(
        ':ID_USUARIO'=>$id_usuario,
        ':DESCRICAO'=>$descricao,
        ':VALOR'=>$valor,
        ':TIPO_LANCAMENTO'=>$tipo_lancamento,
        ':DATA_LANCAMENTO'=>$data_lancamento,
        ':ID_CONTA'=>$conta,
        ':ID_CARTAO'=>$cartao,
        ':ID_CATEGORIA'=>$categoria
    ));

    // CASO A INSERÇÃO FOI REALIZADA, EXIBI A MENSAGEM DE CADASTRO COM SUCESSO.
    if ($resultado > 0) {
        echo "<script language='javascript' type='text/javascript'>
        alert('Lançamento realizado com sucesso!');window.location.href='/lancamento/historico';</script>";
    } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Algo deu errado! Tente novamente...');window.location.href='/';</script>";
    }

});






























// ROTA DO INDEX
$app->get('/lancamento/receita/parcelado', function() {

    $page = new Page();
    $sql = new Sql();

    $resultado_id = $_SESSION['usuario'];
    $usuario = $sql->select("SELECT id_usuario FROM usuario WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id)); 
    $categoria = $sql->select("SELECT descricao FROM categoria ORDER BY descricao ASC");
    $conta = $sql->select("SELECT apelido FROM conta WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id));
    $cartao = $sql->select("SELECT apelido FROM cartao WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id));
    $frequencia = $sql->select("SELECT descricao FROM frequencia");
    $tipo = $sql->select("SELECT descricao FROM tipo_receita WHERE id_tipo_receita = 3");
    

    $page->setTpl("lancamento_receita_parcelado", array(
        "usuario"=>$usuario[0],
        "categoria"=>$categoria,
        "conta"=>$conta,
        "cartao"=>$cartao,
        "frequencia"=>$frequencia,
        "tipo"=>$tipo[0]
    ));

});


// ROTA DO POST RECEITA UNICA
$app->post('/lancamento/receita/parcelado', function() {

    $sql = new Sql();

    // COLETA DADOS DO FRONT-END
    $id_usuario = $_POST['id_usuario'];
    $tipo_lancamento = $_POST['tipo_receita'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $parcela = $_POST['parcela'];
    $data_receita = $_POST['data_receita'];
    $frequencia = $_POST['frequencia'];
    $desc_conta = $_POST['id_conta'];
    $desc_cartao = $_POST['id_cartao'];
    $desc_categoria = $_POST['id_categoria'];

    // CONSULTA NO BANCO PARA A CONVERSÃO
    $resultado_conta = $sql->select("SELECT id_conta FROM conta WHERE apelido = :APELIDO AND id_usuario = :ID_USUARIO",
    array (
    ":APELIDO"=>$desc_conta,
    ':ID_USUARIO'=>$id_usuario
    ));

    $resultado_cartao = $sql->select("SELECT id_cartao FROM cartao WHERE apelido = :APELIDO AND id_usuario = :ID_USUARIO",
    array (
    ":APELIDO"=>$desc_cartao,
    ':ID_USUARIO'=>$id_usuario
    ));

    $resultado_categoria = $sql->select("SELECT id_categoria FROM categoria WHERE descricao = :DESCRICAO",
    array (
    ":DESCRICAO"=>$desc_categoria
    ));


    // CONVERSÃO DE DADOS QUE É RECEBIDO COMO TEXTO PARA INT
    if (!empty($resultado_conta)){
        $conta = $resultado_conta[0]['id_conta'];
    } else {
        $conta = NULL;
    }

    if (!empty($resultado_cartao)){
        $cartao = $resultado_cartao[0]['id_cartao'];
    } else {
        $cartao = NULL;
    }

    if (!empty($resultado_categoria)){
        $categoria = $resultado_categoria[0]['id_categoria'];
    } else {
        $categoria = NULL;
    }

    //If pra somar o valor parcelado:
    if ($parcela > 1 ) {

        //Valor total é dividido em parcelas:
        $valor = ($valor / $parcela);

        //Divido entre frequencia de dias ou mês:
        if ($frequencia == 'Semanalmente' || $frequencia == 'Quinzenalmente')
        {
            //Quantidade é selecionada a partir da coluna "dia" da tabela frequencia:
            $quantidade = $sql->select("SELECT dias FROM frequencia WHERE descricao = :FREQUENCIA", array(
                ':FREQUENCIA'=>$frequencia
            ));

            // quantAux recebe a quantidade depois de simplificar de array pra string:
            $quantAux = $quantidade[0]['dias'];

        } else {
            //Quantidade é selecionada a partir da coluna "mes" da tabela frequencia:
            $quantidade = $sql->select("SELECT mes FROM frequencia WHERE descricao = :FREQUENCIA", array(
                ':FREQUENCIA'=>$frequencia
            ));

            // quantAux recebe a quantidade depois de simplificar de array pra string:
            $quantAux = $quantidade[0]['mes'];

        }

        //Início do loop de parcelamento:
        for ($i=1; $i < $parcela+1; $i++) {

            //INSERT do lançamento do loop, devolvendo id_lancamento:
            $resultado = $sql->select("CALL sp_lancamento_parcelado(:ID_USUARIO, :TIPO_LANCAMENTO, :DESCRICAO, :VALOR, :PARCELA, :DATA_LANCAMENTO, :FREQUENCIA, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA)", array(
                ':ID_USUARIO'=>$id_usuario,
                ':TIPO_LANCAMENTO'=>$tipo_lancamento,
                ':DESCRICAO'=>$descricao,
                ':VALOR'=>$valor,
                ':PARCELA'=>$i.' / '.$parcela,
                ':DATA_LANCAMENTO'=>$data_receita,
                ':FREQUENCIA'=>$frequencia,
                ':ID_CONTA'=>$conta,
                ':ID_CARTAO'=>$cartao,
                ':ID_CATEGORIA'=>$categoria
            ));

            // quant recebe a quantidade de dias/mês multiplicada pelo contador:
            $quant = $quantAux * ($i-1);


            //IF para saber se o UPDATE é em dias ou meses (por causa do "INTERVAL X MONTH/DAY")
            if ($frequencia == 'Semanalmente' || $frequencia == 'Quinzenalmente')
            {

                //UPDATE do ultimo lançamento de parcela, mudando a data_lancamento:
                $sql->execQuery("UPDATE lancamento SET data_lancamento = date_add(data_lancamento, INTERVAL :DIAS DAY)
                WHERE id_lancamento = :ID_LANCAMENTO;", 
                array(
                    ':ID_LANCAMENTO'=> $resultado[0]['id_lancamento'],
                    ':DIAS'=> $quant
                ));

            } else {

                //UPDATE do ultimo lançamento de parcela, mudando a data_lancamento:
                $sql->execQuery("UPDATE lancamento SET data_lancamento = date_add(data_lancamento, INTERVAL :DIAS MONTH)
                WHERE id_lancamento = :ID_LANCAMENTO;", 
                array(
                    ':ID_LANCAMENTO'=> $resultado[0]['id_lancamento'],
                    ':DIAS'=> $quant
                ));
            }
        }

    } else { 

        $resultado = $sql->select("CALL sp_lancamento_parcelado(:ID_USUARIO, :TIPO_LANCAMENTO, :DESCRICAO, :VALOR, :PARCELA, :DATA_LANCAMENTO, :FREQUENCIA, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA)", array(
            ':ID_USUARIO'=>$id_usuario,
            ':TIPO_LANCAMENTO'=>$tipo_lancamento,
            ':DESCRICAO'=>$descricao,
            ':VALOR'=>$valor,
            ':PARCELA'=>$parcela,
            ':DATA_LANCAMENTO'=>$data_receita,
            ':FREQUENCIA'=>$frequencia,
            ':ID_CONTA'=>$conta,
            ':ID_CARTAO'=>$cartao,
            ':ID_CATEGORIA'=>$categoria
        ));

    }

    

    // CASO A INSERÇÃO FOI REALIZADA, EXIBI A MENSAGEM DE CADASTRO COM SUCESSO.
    if ($resultado > 0) {
        echo "<script language='javascript' type='text/javascript'>
        alert('Usuário cadastrado com sucesso!');window.location.href='/lancamento/historico';</script>";
    }

});
































?>