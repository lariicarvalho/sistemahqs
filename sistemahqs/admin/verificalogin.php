<?php
    //VERIFICA SE A SESSÃO ESTÁ ATIVA, VERIFICA SE EXISTE O ID NA SESSÃO HQS,
    // SE NÃO EXISTIR UM DOS DOIS MOSTRA A MENSAGEM E DA EXIT NA PÁGINA
    if (  ( session_status() != PHP_SESSION_ACTIVE ) or
         (!isset( $_SESSION["hqs"]["id"] ) ) )
    	{
            echo "<p>Esta página não pode ser exibida, por favor efetuar login!</p>";
            exit;
        }
