<?php

    require_once('db.class.php');

    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']); //criptografia md5 na senha

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $usuario_existe = false;
    $email_exite = false;

    //verificando se o  email já está cadastrado no banco.
	$sql1 = "SELECT * FROM usuarios WHERE email = '$email'";
	
	$resultado_id = mysqli_query($link, $sql1);
	$dados_usuario = mysqli_fetch_array($resultado_id);

	if(isset($dados_usuario['email'])){
		$email_existe = true;
    }
    
    //verificando se o usuario já está cadastrado no banco
	$sql2 = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
	
	$resultado_id =  mysqli_query($link, $sql2);
	$dados_usuario = mysqli_fetch_array($resultado_id);

	if(isset($dados_usuario['usuario'])){
		$usuario_existe = true;
    }
    
    //adicionando valor a variavel de retorno para tratar o erro
    if($usuario_existe || $email_existe){

		$retorno_get = '';

		if($usuario_existe){
			$retorno_get.="erro_usuario=1&";
		}

		if($email_existe){
			$retorno_get.="erro_email=1&";
		}

		header('Location: inscrevase.php?'.$retorno_get);

		die();
	}

    $sql3 = "INSERT INTO usuarios (usuario, email, senha) VALUES ('$usuario', '$email', '$senha')";

    //executar a query
    if(mysqli_query($link, $sql3)){
        echo "Usuário registrado com sucesso!";
    }else{
        echo "Erro ao registrar o usuário!";
    }

?>