<?php
    if ( file_exists("verificalogin.php") )
        include "verificalogin.php"; 
    else 
        include "../verificalogin.php";

        if ( isset ( $p[2] ) ) {
            $id = (int)$p[2];
            //echo "<pre>";
            //var_dump($id);
            //var_dump($id);
            //verificar se existe um quadrinho com este tipo
            $sql = "select id from quadrinho where editora_id = ? limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(1, $id);
            $consulta->execute();
            $dados = $consulta->fetch(PDO::FETCH_OBJ);
            //verificar se trouxe algum id
            if ( isset ( $dados->id) ) {
                $msg = "Editora não pode ser excluido, pois existe um quadrinho relacionado!";
                mensagem($msg);
            }
            //excluir quadrinho
            $sql = "delete from editora where id = ? limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(1, $id);
            //verificar se o registro foi excluido
            if ( $consulta->execute() ) {
                $msg = "Editora excluido com Sucesso!";
                mensagem($msg);
            } else {
                $msg = "Erro ao excluir registro!";
                mensagem($msg);
            }
        } else {
            $msg = "Ocorreu um erro ao Excluir";
            mensagem($msg);
        }