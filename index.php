<?php 
	session_start();

	$_SESSION['Permissao'] = "ok";

?>

<html>
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	</head>

	<body>

		<div class="container">  

			<div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular!</p>
			</div>

      		<div class="row">
      			<div class="col-md-12">
  				
					<div class="card-body font-weight-bold">
						<form action="backEnd.php" method="POST">
							<div class="form-group">
								<label for="para">Para</label>
								<span class="c-circular-progress c-circular-progress--4"></span>
								<input name="destinatario" type="text" class="form-control" id="para" placeholder="joao@dominio.com.br">
							</div>

							<div class="form-group">
								<label for="assunto">Assunto</label>
								<input name="assunto" type="text" class="form-control" id="assunto" placeholder="Assundo do e-mail">
							</div>

							<div class="form-group">
								<label for="mensagem">Mensagem</label>
								<textarea name="mensagem" class="form-control" id="mensagem"></textarea>
							</div>
							<?php 
							if (isset($_GET["error"]) && $_GET['error'] == "dados") { ?>
								
								<div>
									<p class="text-danger">
										Por favor, todos os campos devem ser preenchidos para um melhor entendimento.
									</p>
								</div> 

							<?php }else if(isset($_GET["error"]) && $_GET['error'] = "error1"){ ?>

								<div>
									<p class="text-danger">
										Por favor, Preencha os campos para executar todas as funcões devidas.
									</p>
								</div> 


							<?php }

							if(isset($_GET["task"]) && $_GET['task'] == "fail"){ ?>

								<div>
									<p class="text-danger">
										erro ao enviar e-mail, verifique os dados e tente novamente.
									</p>
								</div> 


							<?php }else if(isset($_GET["task"]) && $_GET['task'] = "enviado"){ ?>

								<div>
									<p class="text-success">
										<label>E-mail enviado com Sucesso!.</label>
									</p>
								</div> 

							<?php }
							?>

							<button type="submit" class="btn btn-primary btn-lg">Enviar Mensagem</button>
						</form>
					</div>

				</div>
      		</div>
      	</div>

	</body>
</html>