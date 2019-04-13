<?php
    if ( file_exists("verificalogin.php") )
        include "verificalogin.php"; 
    else 
        include "../verificalogin.php";

        if ( $_POST ) {
            if ( isset( $_POST["id"]) ) 
            $id = trim ( $_POST["id"] );
                if ( isset ( $_POST["nome"]) )
                $nome = trim ( $_POST["nome"] );
                    if ( isset ( $_POST["site"] ) )
                    $site = trim ($_POST["site"] );
            
                //echo "$id $nome $site";
                if ( empty( $id ) ) {
                    $sql = "select id from editora where nome = ? limit 1";
                    $consulta = $pdo->prepare($sql);
                    $consulta->bindParam(1, $nome);
                } else {
                    $sql = "select id from editora where nome = ? and id <> ? limit 1";
                    $consulta = $pdo->prepare($sql);
                    $consulta->bindParam(1, $nome);
                    $consulta->bindParam(2, $id);
                }
                $consulta->execute();
                $dados = $consulta->fetch(PDO::FETCH_OBJ);
                    if ( isset( $dados->id) ) {
                        $msg = "Esta Editora já esta cadastrada na sua base de Dados!";
                        mensagem($msg);
                    }
                        if ( empty( $id ) ) {
                            //inserir
                            $sql = "insert into editora (nome, site) values (?, ?)";
                            $consulta = $pdo->prepare($sql);  
                            $consulta->bindParam(1, $nome);
                            $consulta->bindParam(2, $site);
                        } else {
                            //atualiza
                            $sql = "update editora set nome = ?, site = ? where id = ? limit 1";
                            $consulta = $pdo->prepare($sql);
                            $consulta->bindParam(1, $nome);
                            $consulta->bindParam(2, $site);
                            $consulta->bindParam(3, $id);
                        } 
                            if ( $consulta->execute() ) {
                                $msg = "Editora cadastrada/atualizada com Sucesso!";
                                $link = "listar/editora";
                                sucesso($msg,$link);
                            } else {
                                $msg = "Erro ao inserir/atualizar Editora!";
                                mensagem($msg);
                            }
        } else {
            $msg = "Erro de Requisição!";
            mensagem($msg);
        }