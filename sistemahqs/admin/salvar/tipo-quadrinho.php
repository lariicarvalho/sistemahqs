<?php
    if ( file_exists("verificalogin.php") )
        include "verificalogin.php"; 
    else 
        include "../verificalogin.php";

        //verificar se os dados foram enviados pelo método post
        if ( $_POST){
            //recuperar os dados
            if ( isset ( $_POST["id"] ) )
            $id = trim ( $_POST["id"] );
                if ( isset ( $_POST["tipo"] ) )
                $tipo = trim ( $_POST["tipo"]);  
        //validar para verificar se não existe nenhum tipo de quadrinho com o nome que será inserido
        if ( empty ($id) ) {
            $sql = "select id from tipo where tipo = ? limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(1, $tipo);
        } else {
            $sql = "select id from tipo where tipo = ? and id <> ? limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(1, $tipo);
            $consulta->bindParam(2, $id);
        }
        //consultar sql
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        //verificar se os dados trouxeram algum resultado
        if ( isset ( $dados->id) ) {
            $msg = "$tipo - Este tipo já está cadastrado na sua base de dados";
            mensagem($msg);
        }
        // id vazio - INSERT
        // id não vazio - UPDATE
        if ( empty ( $id) ) {
            //inserir
            $sql = "insert into tipo (tipo) values ( ? )";
            //instanciar a conexao PDO e preparar o sql para ser executado
            $consulta = $pdo->prepare($sql);
			//passar o parâmetro
			$consulta->bindParam(1, $tipo);
        } else {
            //atualizar
            $sql = "update tipo set tipo = ? where id = ? limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(1, $tipo);
            $consulta->bindParam(2, $id);
        }
        //verificar se o comando será executado corretamente
        if ( $consulta->execute() ){
            $msg = "Registro Inserido com Sucesso!";
            $link = "listar/tipo-quadrinho";
            sucesso($msg, $link);
        } else {
            //erro
            $msg = "Erro ao Inserir/Atualizar registro!";
            mensagem($msg);
        } 
    } else {
        $msg = "Erro de Requisição!" ;
        mensagem($msg);   
    }