<?php

	session_start();//exportar valor de variáveis

	require_once('db.class.php');

	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];

	$sql = " SELECT usuario, email FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha' ";

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){
		$dados_usuario = mysqli_fetch_array($resultado_id);//recupera o sql em formato de array

		if(isset($dados_usuario['usuario'])){
			$_SESSION['usuario'] = $dados_usuario['usuario']; //colocando o retorno da query
			$_SESSION['email'] = $dados_usuario['email'];

			header('Location: home.php');
		} else {
			header('Location: index.php?erro=1');
		}

	} else {
		echo 'Erro na execução da consulta, favor entrar em contato com o admin do site';
	}


	


?>