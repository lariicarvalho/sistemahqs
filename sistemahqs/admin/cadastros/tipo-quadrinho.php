<?php
    if ( file_exists("verificalogin.php") )
        include "verificalogin.php"; 
    else 
        include "../verificalogin.php";

    //adicionando vazio no id e no tipo
    $id = $tipo = "";
    //$p[1] -> index.php (id do registro)
    if ( isset ( $p[2] ) ) {
        //selecionar dados conforme id
        $sql = "select * from tipo where id = ? limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $p[2]);
        $consulta->execute();
        //recuperar os dados
        $dados = $consulta->fetch(PDO::FETCH_OBJ);
            $id = $dados->id;
            $tipo = $dados->tipo;
    }
?> 
<div class="container">
    <div class="coluna">
        <h1 class="float-left">Cadastro de Tipo de Quadrinhos</h1>
        <div class="float-right">
        <a href="cadastros/tipo-quadrinho" class="btn btn-success"><i class="fas fa-file"></i> Novo</a>
        <a href="listar/tipo-quadrinho" class="btn btn-info"><i class="fas fa-search"></i> Listar Quadrinho</a>
        </div>
        <div class="clearfix"></div>
        <form name="cadastro" method="POST" action="salvar/tipo-quadrinho" data-parsley-validate>
            <label for="id">ID:</label>
            <input type="text" name="id" value="<?=$id;?>" class="form-control" readonly>
            <br>
            <label for="tipo">Tipo de Quadrinho:</label>
            <input type="text" name="tipo" value="<?=$tipo;?>" required class="form-control" data-parsley-required-message="<i class='fas fa-info-circle'></i> Por favor Preencha este campo!">
            <br>
            <button type="submit" class="btn btn-success">Gravar <i class="fas fa-check"></i></button>
        </form>
    </div>
</div>