DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cartao_inserir`(

	papelido VARCHAR(100),
    ptipo_cartao VARCHAR(45),
    pvence_dia INT,
    plimite DECIMAL(10,2),
    pid_usuario INT,
    pid_instituicao INT

)
BEGIN

	INSERT INTO cartao (apelido, tipo_cartao, vence_dia, limite, id_usuario, id_instituicao) VALUES 
					   (papelido, ptipo_cartao, pvence_dia, plimite, pid_usuario, pid_instituicao);
                       
                       SELECT * FROM cartao WHERE id_cartao = LAST_INSERT_ID();

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_conta_inserir`(

	papelido VARCHAR(100),
    ptipo_conta VARCHAR(35),
    psaldo DECIMAL(10,2),
    pid_usuario INT,
    pid_instituicao INT
    

)
BEGIN

	INSERT INTO conta (apelido, tipo_conta, saldo, id_usuario, id_instituicao) VALUES
					  (papelido, ptipo_conta, psaldo, pid_usuario, pid_instituicao);
                      
                      SELECT * FROM conta WHERE id_conta = LAST_INSERT_ID();

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_lancamento_normal`(
	
    pid_usuario INT,
    pdescricao_lancamento VARCHAR(100),
    pvalor DECIMAL(10,2),
    ptipo_lancamento VARCHAR(100),
    pdata_lancamento DATE,
    pid_conta INT,
    pid_cartao INT,
    pid_categoria INT
    
    
)
BEGIN

	INSERT INTO lancamento (id_usuario, descricao_lancamento, valor, tipo_lancamento, data_lancamento, id_conta, id_cartao, id_categoria) VALUES
						   (pid_usuario, pdescricao_lancamento, pvalor, ptipo_lancamento, pdata_lancamento, pid_conta, pid_cartao, pid_categoria);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_lancamento_parcelado`(

	pid_usuario INT,
    ptipo_lancamento VARCHAR(100),
    pdescricao_lancamento VARCHAR(100),
    pvalor DECIMAL(10,2),
    pparcela VARCHAR(30),
    pdata_lancamento DATE,
    pfrequencia VARCHAR(100),
    pid_conta INT,
    pid_cartao INT,
    pid_categoria INT
    
    

)
BEGIN

	INSERT INTO lancamento (id_usuario, tipo_lancamento, descricao_lancamento, valor, quantidade_parcelas, data_lancamento, frequencia, id_conta, id_cartao, id_categoria) VALUES
						   (pid_usuario, ptipo_lancamento, pdescricao_lancamento, pvalor, pparcela, pdata_lancamento, pfrequencia, pid_conta, pid_cartao, pid_categoria);
                           
	SELECT id_lancamento FROM lancamento WHERE id_lancamento = LAST_INSERT_ID();

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_lancamento_transferencia`(

	papelido VARCHAR(50),
    ptipo_lancamento VARCHAR(50),
    pvalor DECIMAL(10,2),
    pdata_lancamento DATE,
    pid_usuario INT,
    pid_conta INT,
    pid_categoria INT
    
    
)
BEGIN

	INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_categoria) VALUES
						  (papelido, ptipo_lancamento, pvalor, pdata_lancamento, pid_usuario, pid_conta, pid_categoria);

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usuario_atualizar`(
pid_usuario INT,
pnome VARCHAR(100),
psobrenome VARCHAR(100),
pemail VARCHAR(200),
pdata_nascimento DATE,
plogin VARCHAR(100),
psenha VARCHAR(500)

)
BEGIN

	UPDATE usuario
    SET
    nome = pnome,
    sobrenome = psobrenome,
    email = pemail,
    data_nascimento = pdata_nascimento,
    login = plogin
    
    WHERE id_usuario = pid_usuario;
    
    SELECT * FROM usuario WHERE id_usuario = pid_usuario;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usuario_inserir`(

pnome VARCHAR(100),
psobrenome VARCHAR(100),
pemail VARCHAR(200),
pdata_nascimento DATE,
plogin VARCHAR(100),
psenha VARCHAR(500),
pid_tipo_usuario INT

)
BEGIN

	INSERT INTO USUARIO (nome, sobrenome, email, data_nascimento, login, senha, id_tipo_usuario) VALUES (pnome, psobrenome, pemail, pdata_nascimento, plogin, psenha, pid_tipo_usuario);
	
    SELECT * FROM USUARIO WHERE id_usuario = LAST_INSERT_ID();
    
END$$
DELIMITER ;





