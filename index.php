<?php 
	require_once 'CLASSES/usuarios.php';
	$u = new usuario
	
?>

<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login AÇAI SOFT</title>
	<link rel="stylesheet" href="CSS/estilo.css">
</head>
<body>
	<div id="corpo-form">
	<h1>Entrar</h1>
	<form method="POST">
		<input type="email" name="email" placeholder="Usuário">
		<input type="password" name="senha" placeholder="Senha">
		<input type="submit" value="ACESSAR">
		<a href="cadastrar.php">Ainda não é inscrito?<strong> Cadastre-se!</strong></a>
	</form>
</div>


<?php 

if(isset($_POST['email']))
{
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);
	//verificar se esta preenchido
	if(!empty($email) && !empty($senha)) 
	{ 
		$u->conectar("projeto_acai","localhost","root","");
		if ($u->msgErro == "") 
		{
			
		
		if($u->logar($email,$senha))
		{
			header("location: AreaPrivada.php");
		}
		else
		{

			?>
			 <div class="msg-erro">
			 "Email e/ou senha estão incorretos!";
			</div>
			 <?php
		}

		}else
		{	

			?> 
			<div class="msg-erro">
			"Erro "$u->msgErro;
			 </div>
			 <?php
			
		}
	}
	else
	{
		?> 
		<div class="msg-erro">
		"Preencha todos os campos!";
		</div>
		<?php
	
	}
}




?>



</body>
</html>