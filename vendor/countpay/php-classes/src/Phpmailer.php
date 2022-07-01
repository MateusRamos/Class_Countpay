<?php

// Importa classes PHPMailer para o namespace global
// Eles devem estar no topo do seu script, não dentro de uma função
use Countpay\PHPMailer\PHPMailer;
use Countpay\PHPMailer\SMTP;


if (isset($_POST['operacao']) && $_POST['operacao'] === 'enviar_curriculo'){

    //dados recebidos do form
    @$nome            = $_POST["nome"];
    @$email           = $_POST["email"];
    @$assunto         = "Contato - $nome";
    @$mensagem        = $_POST["mensagem"];
    
  
    //corpo do email (conteudo)
    $mensagemConcatenada = 'Contato recebido de Usuário via Site'.'<br/>'; 
    $mensagemConcatenada .= '-------------------------------<br/><br/>';
    $mensagemConcatenada .= 'Nome: '.$nome. '<br/>'; 
    $mensagemConcatenada .= 'E-mail: '.$email. '<br/>';
    $mensagemConcatenada .= 'Mensagem: '.$mensagem. '<br/>'; 
    $mensagemConcatenada .= '-------------------------------<br/><br/>';  



$mailer = new PHPMailer(); 

//Server settings
$mailer->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
$mailer->isSMTP();                                            //Send using SMTP
$mailer->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
$mailer->SMTPAuth   = true;                                   //Enable SMTP authentication
$mailer->Username   = 'suporte.countpay@gmail.com';           //SMTP username
$mailer->Password   = 'nrkyxwumfrercoxi';                     //SMTP password
$mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
$mailer->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`



//Recipients
$mail->setFrom('suporte.countpay@gmail.com', 'Countpay');
$mail->addAddress('suporte.countpay@gmail.com', 'Countpay Recebido');     //Add a recipient

 //Content
 $mail->isHTML(true);
 $mail->Subject = $assunto;
 $mail->MsgHTML($mensagemConcatenada);

 if(!$mailer->Send()){
    $retorno = 'Não foi possível enviar'; 
  } else {
    $retorno = 'Recebemos seu E-mail. Obrigado!';
  } 

  echo json_encode($retorno);

}


?>