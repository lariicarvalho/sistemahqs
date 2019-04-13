<?php
	$msg = "";
	//verificar se foi dado o $_post
	if ( $_POST ) {
		$login = $senha = "";
		if ( isset ( $_POST["login"] ) )
			$login = trim ( $_POST["login"] );
		if ( isset ( $_POST["senha"] ) )
			$senha = trim ( $_POST["senha"]);
		
		// verificar se os campos estão em branco
		if ( empty( $login ) ) {
			mensagem("Preencha o Login!");
		} else if (empty( $senha)) {
			mensagem("Preencha a Senha!");
		} else {
			// Campos preenchidos, buscar usuario no banco
			$sql = "select id, nome, login, senha, foto, ativo from usuario where login = ? and ativo = 'S' limit 1";
			//preparar o sql para execução
			$consulta = $pdo->prepare($sql);
			//passar o parâmetro
			$consulta->bindParam(1, $login);
			//executar
			$consulta->execute();
			//recuperar os dados da consulta
			$dados = $consulta->fetch(PDO::FETCH_OBJ); 

			if ( isset( $dados->id ) ){
				//verificar se trouxe algum resultado
				if ( !password_verify($senha, $dados->senha) ) {
					//verificar se senha não é verdadeira
					$msg = "Senha Inválida!";
					mensagem($msg);
				
				} else {
					//guardar dados na sessão
					$_SESSION["hqs"] = array(
						"id"=>$dados->id,
						"nome"=>$dados->nome,
						"login"=>$dados->login,
						"foto"=>$dados->foto
					);
					//verificar array
					//print_r( $_SESSION["hqs"] );
					//redirecionar a tela para home com js
					echo "<script>location.href='paginas/home'</script>";
					exit;
				}
			} else {
				//não trouxe
				$msg = "Usuário Inexistente ou Desativado";
				mensagem($msg);
			}
		}
	}
?>
<div class="login">
	<div class="row">
		<div class="col-6">
			<img src="images/login.png">
			<h1>SCHQs<br>Sistema de Controle de HQs</h1>
		</div>
		<div class="col-6">
			<h2>Efetuar Login</h2>
			<form name="formLogin" method="post" data-parsley-validate>
				<input type="text" name="login" class="input" placeholder="Preencha o Login" required data-parsley-required-message="<i class='fas fa-info-circle'></i> Por favor informe seu Nome!">
				<input type="password" name="senha" class="input" placeholder="Digite sua Senha" required data-parsley-required-message="<i class='fas fa-info-circle'></i> Por favor informe sua Senha!">
				<button type="submit"><i class="fas fa-check"></i> Efetuar Login</button>
			</form>
		</div>
	</div>
</div>
<script>
	$('.alert').alert()
</script>