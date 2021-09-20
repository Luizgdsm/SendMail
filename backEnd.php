<?php 
	session_start();
 

	if(!isset($_SESSION['Permissao']) && $_SESSION['Permissao'] != "ok"){//tratamento session de acesso
		header("Location: index.php?error=session");
	}

	require "./biblioteca/Exception.php";//importando biblioteca de PHPMAILER (envio de Email)
	require "./biblioteca/OAuth.php";
	require "./biblioteca/PHPMailer.php";
	require "./biblioteca/POP3.php";
	require "./biblioteca/SMTP.php";
	
	$_POST;

	if($_POST['destinatario'] == "" || $_POST['assunto'] == "" || $_POST['mensagem'] == ""){//tratamento de campo
		header("Location: index.php?error=dados");
		die();
	}

	$EmailsDestinatario = explode(",", $_POST["destinatario"]);//tratamento para email multiplo


	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;


	class Mensagem{//criando o objeto para mensagem
	private	$destinatario;
	private	$assunto;
	private	$mensagem;
	public $testeEnvio;

		public function __construct($destinatario, $assunto, $mensagem){//metodo __construct para assegurar que 																os campos estao devidamente preenchidos.
			$this->destinatario = $destinatario;
			$this->assunto = $assunto;
			$this->mensagem = $mensagem;
		}

		public function __getSet($acao, $atributo, $valor){//adaptação do get/set mágico, incluindo campo acao
			if($acao == "get"){
				return $this->$atributo;
			}else if($acao == "set"){
				$this->$atributo = $valor;
			}else{
				echo "Ação não reconhecida, use set ou get";
			}
		}

		public function ValidaMensagem(){

		}
	}

	$mensagemObjeto = new mensagem($_POST['destinatario'], $_POST['assunto'], $_POST['mensagem']);//instanciando objeto mesnagem

   $mail = new PHPMailer(true);

   foreach($EmailsDestinatario as $email){//envio para multiplos email

   try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                           //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                 //Enable SMTP authentication
    $mail->Username   = 'Emaildeteste@---.com';         //SMTP username
    $mail->Password   = 'SenhaTeste';                     //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                  //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('sendmailappteste@gmail.com', 'SendMail Bussines');//endereço de remetente

    
    	$mail->addAddress($email, 'Cliente');//endereço de destinatário
    
    
    //$mail->addAddress('ellen@example.com'); //Name is optional
    $mail->addReplyTo('sendmailappteste@gmail.com', 'Duvidas?');//endereço para respostas de destinatário
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');   //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML

    //utilizando o objeto para o get das informações fornecidas pelo usuário de forma dinamica.
    $mail->Subject = $mensagemObjeto->__getSet("get", "assunto", 0);
    $mail->Body    = $mensagemObjeto->__getSet("get", "mensagem", 0);
    $mail->AltBody = $mensagemObjeto->__getSet("get", "mensagem", 0);


    //Area de debug
    $mail->send();
    header("Location: index.php?task=enviado"); 	
    
} catch (Exception $e) {
    //echo "Mensagem Não enviada. Mailer Error: {$mail->ErrorInfo}";
    header("Location: index.php?task=fail");
}

}



	

?>