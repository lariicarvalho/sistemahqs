<?php
    if ( file_exists("verificalogin.php") )
        include "verificalogin.php"; 
    else 
        include "../verificalogin.php";
    
    /*
    echo "<br><br>";
    print_r( $_POST );
    echo "<br><br>";
    print_r( $_GET );
    echo "<br><br>";
    print_r( $_FILES );
    */

    //iniciar uma transação
    $pdo->beginTransaction();

    //se os dados vierem por POST
    if ( $_POST ) {
        //iniciar as variaveis
        $id = $titulo = $resumo = $data = $valor = $numero = $editora_id = $tipo_id = $capa = "";

        //recuperar as variavéis
        foreach ($_POST as $key => $value) {
            //echo "<p>$key $value</p>";
            //$key - nome do campo
            //$value - valor do campo (digitado)
            if ( isset ( $_POST[$key] ) ) {
                $$key = trim ( $value );
            }
        }

        //formatar o valor
        $valor = formataValor ( $valor );

        //formatar a data
        $data = formataData ( $data );

        //se o id for vazio insere - se não atualiza/update!
        $capa = time();

        if ( empty ($id) ) {
            //insert
            $sql = "insert into quadrinho(id, titulo, numero, valor, resumo, capa, tipo_id, editora_id, data) values (NULL, :titulo, :numero, :valor, :resumo, :capa, :tipo_id, :editora_id, :data";

            $consulta = $pdo->prepare ( $sql );
            $consulta->bindValue(":titulo",$titulo);
            $consulta->bindValue(":numero",$numero);
            $consulta->bindValue(":valor",$valor);
            $consulta->bindValue(":resumo",$resumo);
            $consulta->bindValue(":capa",$capa);
            $consulta->bindValue(":tipo_id",$tipo_id);
            $consulta->bindValue(":editora_id",$editora_id);
            $consulta->bindValue(":data",$data);

        } else {
            //update
            $sql = "";
        }

        //executar
        if ( $consulta->execute() ) {

            //copiar o arquivo para a pasta
            if ( !copy( $_FILES["capa"]["tmp_name"], "../fotos/".$_FILES["capa"]["name"] ) ) {

                $msg = "Erro ao copiar a foto";
                mensagem( $msg );
            }

            echo $capa;

            $pastaFotos = "../fotos/";
            $imagem = $_FILES["capa"]["name"];

            redimensionarImagem($pastaFotos,$imagem,$capa);

            exit;
            
            $msg = "Registro inserido com sucesso!";
            sucesso( $msg, "listar/quadrinho");

        } else {
            echo $consulta->errorInfo()[2];
            exit;
            
            $msg = "Erro ao salvar o quadrinho";
            mensagem( $msg );
        }

    } else {
        //se não veio do formulario
        $msg = "Requisição inválida";
        mensagem( $msg );
    }