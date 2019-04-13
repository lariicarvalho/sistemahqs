<?php 
	//conexão com banco usando PDO
	
	$servidor = "172.16.1.215";
	$usuario = "4903";
	$senha = "4903";
	$banco = "4903_hqs";
	
	
	/*
	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$banco = "hqs";
	*/

	$charset = "utf8";

	try {
		//conexao com pdo
		$pdo = new PDO("mysql:host=$servidor;dbname=$banco;charset=$charset", $usuario, $senha);
	} catch (PDOException $erro) {
		$msg = $erro -> getMessage();
		echo "<p>Erro ao conectar no DB: $msg</p>";
	}  

?>