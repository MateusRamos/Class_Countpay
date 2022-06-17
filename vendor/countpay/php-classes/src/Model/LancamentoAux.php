<?php 
namespace Countpay\Model;

use \Countpay\DB\Sql;
use \Countpay\Model;


class LancamentoAux extends Model{	

    //Lançamento Único
    public static function iniciaLancamentoUnico($dados_lancamento, $id_usuario)
    {

        $result_verificacao = Visual::verificaVencimento($dados_lancamento['data_lancamento']);

        if($result_verificacao == "amanha")
        {
            LancamentoAux::criaLancamentoUnicoFuturo($dados_lancamento, $id_usuario);
        }
        else
        {
            LancamentoAux::criaLancamentoUnico($dados_lancamento, $id_usuario);
        
            Visual::mostraMensagem('Lançamento criado com sucesso!', '/lancamento/historico');
        
        }

    }


    public static function criaLancamentoUnicoFuturo($dados_lancamento, $id_usuario)
    {

        $sql = new Sql();

        $sql->execQuery("INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_cartao, id_categoria, status_lancamento)
                         VALUES (:DESCRICAO_LANCAMENTO, :TIPO_LANCAMENTO, :VALOR, :DATA_LANCAMENTO, :ID_USUARIO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :STATUS_LANCAMENTO)", array(
                            ":DESCRICAO_LANCAMENTO"=>$dados_lancamento['descricao'],
                            ":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
                            ":VALOR"=>$dados_lancamento['valor'],
                            ":DATA_LANCAMENTO"=>$dados_lancamento['data_lancamento'],
                            ":ID_USUARIO"=>$id_usuario,
                            ":ID_CONTA"=>$dados_lancamento['id_conta'],
                            ":ID_CARTAO"=>$dados_lancamento['id_cartao'],
                            ":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
                            ":STATUS_LANCAMENTO"=>2
                         ));

        Visual::mostraMensagem('Lançamento criado com sucesso!', '/lancamento/historico');

    } 


    public static function criaLancamentoUnico($dados_lancamento, $id_usuario)
    {

        $sql = new Sql();

        $sql->execQuery("INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_cartao, id_categoria, status_lancamento)
                         VALUES (:DESCRICAO_LANCAMENTO, :TIPO_LANCAMENTO, :VALOR, :DATA_LANCAMENTO, :ID_USUARIO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :STATUS_LANCAMENTO)", array(
                            ":DESCRICAO_LANCAMENTO"=>$dados_lancamento['descricao'],
                            ":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
                            ":VALOR"=>$dados_lancamento['valor'],
                            ":DATA_LANCAMENTO"=>$dados_lancamento['data_lancamento'],
                            ":ID_USUARIO"=>$id_usuario,
                            ":ID_CONTA"=>$dados_lancamento['id_conta'],
                            ":ID_CARTAO"=>$dados_lancamento['id_cartao'],
                            ":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
                            ":STATUS_LANCAMENTO"=>0
                         ));

        $array_id = array(
            "id_conta"=>$dados_lancamento['id_conta'],
            "id_cartao"=>$dados_lancamento['id_cartao'],
            "id_categoria"=>$dados_lancamento['id_categoria']
        );

        Carteira::atualizaSaldoConta($dados_lancamento, $array_id);
        Meta::analisaMeta($dados_lancamento, $array_id, $id_usuario);

    }



    



    //Lançamento Fixo:
    public static function iniciaLancamentoFixo($dados_lancamento, $id_usuario)
    {

        $result_verificacao = Visual::verificaVencimento($dados_lancamento['data_lancamento']);

        if($result_verificacao == "amanha")
        {
            LancamentoAux::criaLancamentoFixo($dados_lancamento, $id_usuario);
        }
        else
        {
            LancamentoAux::criaLancamentoUnico($dados_lancamento, $id_usuario);

            LancamentoAux::criaLancamentoFixoFuturo($dados_lancamento, $id_usuario);

            Visual::mostraMensagem('Lançamento criado com sucesso!', '/lancamento/historico');
            
        }

    }

    
    public static function criaLancamentoFixo($dados_lancamento, $id_usuario)
    {
        
        $sql = new Sql();

        $sql->execQuery("INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_cartao, id_categoria, status_lancamento)
                         VALUES (:DESCRICAO_LANCAMENTO, :TIPO_LANCAMENTO, :VALOR, :DATA_LANCAMENTO, :ID_USUARIO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :STATUS_LANCAMENTO)", array(
                            ":DESCRICAO_LANCAMENTO"=>$dados_lancamento['descricao'],
                            ":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
                            ":VALOR"=>$dados_lancamento['valor'],
                            ":DATA_LANCAMENTO"=>$dados_lancamento['data_lancamento'],
                            ":ID_USUARIO"=>$id_usuario,
                            ":ID_CONTA"=>$dados_lancamento['id_conta'],
                            ":ID_CARTAO"=>$dados_lancamento['id_cartao'],
                            ":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
                            ":STATUS_LANCAMENTO"=>1
                         ));

        Visual::mostraMensagem('Lançamento criado cmo sucesso!', '/lancamento/historico');

    }


    public static function criaLancamentoFixoFuturo($dados_lancamento, $id_usuario)
    {

        $sql = new Sql();

		$sql->execQuery("INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_cartao, id_categoria, status_lancamento)
						 VALUES (:DESCRICAO, :TIPO_LANCAMENTO, :VALOR, date_add(:DATA_LANCAMENTO, interval 1 month), :ID_USUARIO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :STATUS_LANCAMENTO)", array(
							":DESCRICAO"=>$dados_lancamento['descricao'],
							":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
							":VALOR"=>$dados_lancamento['valor'],
							":DATA_LANCAMENTO"=>$dados_lancamento['data_lancamento'],
							":ID_USUARIO"=>$id_usuario,
							":ID_CONTA"=>$dados_lancamento['id_conta'],
							":ID_CARTAO"=>$dados_lancamento['id_cartao'],
							":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
							":STATUS_LANCAMENTO"=>1
						 ));

    }







    //Lançamento Parcelado:
    public static function iniciaLancamentoParcelado($dados_lancamento, $id_usuario)
    {
        $dados_lancamento['valor'] = $dados_lancamento['valor'] / $dados_lancamento['parcela'];

        $result_verificacao = Visual::verificaVencimento($dados_lancamento['data_lancamento']);

        if($result_verificacao == "amanha")
        {

            $parcela_atual = 1;
            $data_lancamento = $dados_lancamento['data_lancamento'];

            LancamentoAux::criaPrimeiraParcelaFutura($dados_lancamento, $id_usuario, $parcela_atual, $data_lancamento);

            Visual::mostraMensagem('Lançamento criado com sucesso!', '/lancamento/historico');

        }
        else
        {

            LancamentoAux::criaPrimeiraParcela($dados_lancamento, $id_usuario);

            LancamentoAux::criaSegundaParcela($dados_lancamento, $id_usuario);

            Visual::mostraMensagem('Lançamento criado com sucesso!', '/lancamento/historico');
            
        }


    }

    public static function criaPrimeiraParcelaFutura($dados_lancamento, $id_usuario, $parcela_atual, $data_lancamento)
    {

        $sql = new Sql();

        $sql->execQuery("INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_cartao, id_categoria, parcela_total, parcela_atual, frequencia, status_lancamento)
                         VALUES (:DESCRICAO_LANCAMENTO, :TIPO_LANCAMENTO, :VALOR, :DATA_LANCAMENTO, :ID_USUARIO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :PARCELA_TOTAL, :PARCELA_ATUAL, :FREQUENCIA, :STATUS_LANCAMENTO)", array(
                            ":DESCRICAO_LANCAMENTO"=>$dados_lancamento['descricao'],
                            ":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
                            ":VALOR"=>$dados_lancamento['valor'],
                            ":DATA_LANCAMENTO"=>$data_lancamento,
                            ":ID_USUARIO"=>$id_usuario,
                            ":ID_CONTA"=>$dados_lancamento['id_conta'],
                            ":ID_CARTAO"=>$dados_lancamento['id_cartao'],
                            ":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
                            ":PARCELA_ATUAL"=>$parcela_atual,
                            ":PARCELA_TOTAL"=>$dados_lancamento['parcela'],
                            ":FREQUENCIA"=>$dados_lancamento['frequencia'],
                            ":STATUS_LANCAMENTO"=>3
                        ));

    }


    public static function criaPrimeiraParcela($dados_lancamento, $id_usuario)
    {

        $sql = new Sql();

        $sql->execQuery("INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_cartao, id_categoria, parcela_total, parcela_atual, frequencia, status_lancamento)
                         VALUES (:DESCRICAO_LANCAMENTO, :TIPO_LANCAMENTO, :VALOR, :DATA_LANCAMENTO, :ID_USUARIO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :PARCELA_TOTAL, :PARCELA_ATUAL, :FREQUENCIA, :STATUS_LANCAMENTO)", array(
                            ":DESCRICAO_LANCAMENTO"=>$dados_lancamento['descricao'],
                            ":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
                            ":VALOR"=>$dados_lancamento['valor'],
                            ":DATA_LANCAMENTO"=>$dados_lancamento['data_lancamento'],
                            ":ID_USUARIO"=>$id_usuario,
                            ":ID_CONTA"=>$dados_lancamento['id_conta'],
                            ":ID_CARTAO"=>$dados_lancamento['id_cartao'],
                            ":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
                            ":PARCELA_ATUAL"=>1,
                            ":PARCELA_TOTAL"=>$dados_lancamento['parcela'],
                            ":FREQUENCIA"=>$dados_lancamento['frequencia'],
                            ":STATUS_LANCAMENTO"=>0
                        ));

        $array_id = array(
            "id_conta"=>$dados_lancamento['id_conta'],
            "id_cartao"=>$dados_lancamento['id_cartao'],
            "id_categoria"=>$dados_lancamento['id_categoria']
        );

        Carteira::atualizaSaldoConta($dados_lancamento, $array_id);
        Meta::analisaMeta($dados_lancamento, $array_id, $id_usuario);

    }


    public static function criaSegundaParcela($dados_lancamento, $id_usuario)
    {

        $parcela_atual = 2;

        $frequencia = LancamentoAux::analisaFrequencia($dados_lancamento, $parcela_atual);

        if($frequencia['frequencia'] == "dias")
        {
            LancamentoAux::criaParcelaFuturaDias($dados_lancamento, $id_usuario, $parcela_atual, $frequencia);
        }
        else
        {
            LancamentoAux::criaParcelaFuturaMeses($dados_lancamento, $id_usuario, $parcela_atual, $frequencia);
        }


    }


    public static function analisaFrequencia($dados_lancamento, $parcela_atual)
    {

        $sql = new Sql();

        if($dados_lancamento['frequencia'] <= 2)
        {

            $results = $sql->select("SELECT dias FROM frequencia WHERE id_frequencia = :ID_FREQUENCIA", array(
                ":ID_FREQUENCIA"=>$dados_lancamento['frequencia']
            ));

            $results[0]['frequencia'] = "dias";

            return $results[0];

        }
        else
        {

            $results = $sql->select("SELECT mes FROM frequencia WHERE id_frequencia = :ID_FREQUENCIA", array(
                ":ID_FREQUENCIA"=>$dados_lancamento['frequencia']
            ));

            $results[0]['frequencia'] = "meses";

            return $results[0];

        }


    }
    

    public static function criaParcelaFuturaDias($dados_lancamento, $id_usuario, $parcela_atual, $frequencia)
    {
        
        $sql = new Sql();

        $sql->execQuery("CALL sp_lancamento_parcelado_dias(:ID_USUARIO, :TIPO_LANCAMENTO, :DESCRICAO_LANCAMENTO, :VALOR, :PARCELA_ATUAL, :PARCELA_TOTAL, :DATA_LANCAMENTO, :FREQUENCIA, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :STATUS_LANCAMENTO, :INTERVALO)", array(
            ":ID_USUARIO"=>$id_usuario,
            ":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
            ":DESCRICAO_LANCAMENTO"=>$dados_lancamento['descricao'],
            ":VALOR"=>$dados_lancamento['valor'],
            ":PARCELA_ATUAL"=>$parcela_atual,
            ":PARCELA_TOTAL"=>$dados_lancamento['parcela'],
            ":DATA_LANCAMENTO"=>$dados_lancamento['data_lancamento'],
            ":FREQUENCIA"=>$dados_lancamento['frequencia'],
            ":ID_CONTA"=>$dados_lancamento['id_conta'],
            ":ID_CARTAO"=>$dados_lancamento['id_cartao'],
            ":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
            ":STATUS_LANCAMENTO"=>3,
            ":INTERVALO"=>$frequencia['dias']
            ));

    }


    public static function criaParcelaFuturaMeses($dados_lancamento, $id_usuario, $parcela_atual, $frequencia)
    {
        
        $sql = new Sql();

        $sql->execQuery("CALL sp_lancamento_parcelado_meses(:ID_USUARIO, :TIPO_LANCAMENTO, :DESCRICAO_LANCAMENTO, :VALOR, :PARCELA_ATUAL, :PARCELA_TOTAL, :DATA_LANCAMENTO, :FREQUENCIA, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :STATUS_LANCAMENTO, :INTERVALO)", array(
            ":ID_USUARIO"=>$id_usuario,
            ":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
            ":DESCRICAO_LANCAMENTO"=>$dados_lancamento['descricao'],
            ":VALOR"=>$dados_lancamento['valor'],
            ":PARCELA_ATUAL"=>$parcela_atual,
            ":PARCELA_TOTAL"=>$dados_lancamento['parcela'],
            ":DATA_LANCAMENTO"=>$dados_lancamento['data_lancamento'],
            ":FREQUENCIA"=>$dados_lancamento['frequencia'],
            ":ID_CONTA"=>$dados_lancamento['id_conta'],
            ":ID_CARTAO"=>$dados_lancamento['id_cartao'],
            ":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
            ":STATUS_LANCAMENTO"=>3,
            ":INTERVALO"=>$frequencia['mes']
            ));


    }







}
?>