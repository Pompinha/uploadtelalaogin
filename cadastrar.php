<?php
	require_once 'CLASSES/usuarios.php';
	$u = new usuario;
?>


<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Login AÇAI SOFT</title>
	<link rel="stylesheet" href="CSS/estilo.css">
</head>
<body>
	<div id="corpo-form">
	<h1>Cadastrar</h1>
	<form method="POST">
		<input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
		<input type="text" name="cpf" placeholder="Cpf" maxlength="11ch">
		<input type="email" name="email" placeholder="Usuário" maxlength="40">
		<input type="password" name="senha" placeholder="Senha" minlength="8ch" maxlength="32">
		<input type="password" name="confSenha" placeholder="Confirmar Senha" minlength="8ch" maxlength="32">
		<input type="submit" value="Cadastrar">
	</form>
</div>

<?php
//verificar ase clicou no botao
if(isset($_POST['nome']))
{
	$nome = addslashes($_POST['nome']);
	$cpf = addslashes($_POST['cpf']);
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);
	$confirmarSenha = addslashes($_POST['confSenha']);
	//verificar se esta preenchido
	if(!empty($nome) && !empty($cpf) && !empty($email) && !empty($senha) && !empty($confirmarSenha)) 
	{
		$u->conectar("projeto_acai","localhost","root","");
		if($u->msgErro =="")// ta vazia e ok
		{
			if($senha == $confirmarSenha)
			{
				if($u->cadastrar($nome,$cpf,$email,$senha))
				{

					?>
					<div id="msg-sucesso">
					"Cadastrado com sucesso! Acesse para entrar";
					</div> 
					<?php
				}
				else
				{
					?>
					<div class="msg-erro">
					"Email já acadastrado!";
					</div> 
					<?php
				}
	
		}	
		else
		{
			?>
			<div class="msg-erro">
			"Senha e confirmar a senha não correspondem!";
			</div> 
			<?php
		}	
	}	
		else
		{
			?>
			<div class="msg-erro">
			"Erro: ".$u->msgErro;
			</div> 
			<?php
		}

	}else
	{
		?>
		<div class="msg-erro">
		"Preencha atodos os campos";
		</div> 
		<?php
	}


}

?>

</body>
</html>