<?php  

Class usuario
{
	private $pdo;
	public $msgErro = "";//tudo ok

	public function conectar($nome, $host, $usuario, $senha)
	{
		global $pdo, $msgErro;
		try {
			$pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
		} catch (PDOException $e) {
			$msgErro = $e->getMessage();
		}
		
	}

	public function cadastrar($nome, $cpf, $email, $senha)
	{	

		global $pdo, $msgErro;
		//verificar se existe email cadastrado no banco de dados utilizando validação de ID//
		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
		$sql->bindValue(":e",$email);
		$sql->execute();
		if($sql->rowCount() > 0)
		{
			return false; //está cadastrada
		}
		else
		{
			//se não, Cadastrar
			$sql = $pdo->prepare("INSERT INTO usuarios (nome, cpf, email, senha) VALUES (:n, :c, :e, :s)");
			$sql->bindValue(":n",$nome);
			$sql->bindValue(":c",$cpf);
			$sql->bindValue(":e",$email);
			$sql->bindValue(":s",md5($senha));
			$sql->execute();
			return true;

		}
	}
	

	public function logar($email, $senha)
	{
		global $pdo,$msgErro;
		//verificar se o email e senha estão cadastrados, se sim:
		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
		$sql->bindValue(":e",$email);
		$sql->bindValue(":s",md5($senha));
		$sql->execute();
		if($sql->rowCount() > 0)
		{
			//entrar no sistema (sessao)
			$dado = $sql->fetch();
			session_start();
			$_SESSION['id_usuario'] = $dado['id_usuario'];
			return true; //Logado com sucesso
		}
		else
		{
			return false;//não conseguiu logar
		}

	}

}


?>