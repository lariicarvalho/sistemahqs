<?php
    if ( file_exists("verificalogin.php") )
        include "verificalogin.php"; 
    else 
        include "../verificalogin.php";

        $id = $nome = $site = "";
            if ( isset ( $p[2] ) ) {
                //selecionar dados conforme id
                $sql = "select * from editora where id = ? limit 1";
                $consulta = $pdo->prepare($sql);
                $consulta->bindParam(1, $p[2]);
                $consulta->execute();
                //recuperar os dados
                $dados = $consulta->fetch(PDO::FETCH_OBJ);
                    $id = $dados->id;
                    $nome = $dados->nome;
                    $site = $dados->site;
            }

?>
<div class="container">
    <div class="coluna">
    <h1 class="float-left">Cadastro de Editoras</h1>
        <div class="float-right">
            <a href="cadastros/editora" class="btn btn-success"><i class="fas fa-file"></i> Nova</a>
            <a href="listar/editora" class="btn btn-info"><i class="fas fa-search"></i> Listar Editora</a>
        </div>
        <div class="clearfix"></div>
        <form name="cadastro" method="POST" action="salvar/editora" data-parsley-validate>
        <label for="id">ID:</label>
        <input type="text" name="id" value="<?=$id;?>" class="form-control" readonly>
        <br>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?=$nome;?>" class="form-control" required data-parsley-required-message="<i class='fas fa-info-circle'></i> Por favor Preencha o Nome!">
        <br>
        <label for="site">Site:</label>
        <input type="text" name="site" value="<?=$site;?>" class="form-control" required placeholder="exemplo.com" data-parsley-required-message="<i class='fas fa-info-circle'></i> Por favor Informe o Site!">
        <br>
        <button type="submit" class="btn btn-success">Salvar <i class="fas fa-check"></i></button> 
        </form>        
    </div>
</div>