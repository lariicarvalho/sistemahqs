<?php
    if ( file_exists("verificalogin.php") )
        include "verificalogin.php"; 
    else 
        include "../verificalogin.php";

    $id = $titulo = $numero = $data = $capa = $resumo = $valor = $editora_id = $tipo_id = "";

?>
<div class="container">
    <div class="coluna">
        <h1 class="float-left">Cadastro de Quadrinhos</h1>
        <div class="float-right">
            <a href="cadastros/quadrinho" class="btn btn-success"><i class="fas fa-file"></i> Novo</a>
            <a href="listar/quadrinho" class="btn btn-info"><i class="fas fa-file"></i> Listar Quadrinhos</a>
        </div>
        <div class="clearfix"></div>
        <!--enctype permite o envio de arquivos através do formulário-->
        <form name="cadastro" id="postForm" action="salvar/quadrinho" method="POST" enctype="multipart/form-data" data-parsley-validate  onsubmit="return postForm()">
            <label for="id">ID:</label>
            <input type="text" class="form-control" name="id" value="<?=$id;?>" readonly>
            <br>
            <label for="titulo">Titulo do Quadrinho:</label>
            <input type="text" class="form-control" name="titulo" value="<?=$titulo;?>" required data-parsley-required-message="<i class='fas fa-info-circle'></i> Preencha o Título" maxlenght="100">
            <br>
            <label for="numero">Número:</label>
            <input type="text" class="form-control" name="numero" value="<?=$numero;?>" data-mask="9?99" required data-parsley-required-message="<i class='fas fa-info-circle'></i> Preencha o Número">
            <br>
            <label for="data">Data:</label>
            <input type="text" class="form-control" name="data" value="<?=$data;?>" data-mask="99/99/9999" required data-parsley-required-message="<i class='fas fa-info-circle'></i> Preencha uma Data">
            <br>
            <label for="capa">Foto da Capa (JPG):</label>
            <input type="file" class="form-control" name="capa" required data-parsley-required-message="<i class='fas fa-info-circle'></i> Selecione um Arquivo" accept=".jpg">
            <br>
            <div class="summernote">
            <label for="resumo">Resumo:</label>
            <textarea class="form-control" name="resumo" id="summernote" row="5" required data-parsley-required-message="<i class='fas fa-info-circle'></i> Preencha o Resumo!"></textarea>
            </div>
            <br>
            <label for="valor">Valor:</label>
            <input type="text" class="form-control" name="valor" id="valor" value="<?=$valor;?>" required data-parsley-required-message="<i class='fas fa-info-circle'></i> Preencha o Valor!">
            <br>
            <label for="tipo_id">Tipo</label>
            <select name="tipo_id" class="form-control" required data-parsley-required-message="<i class='fas fa-info-circle'></i> Selecione um Tipo">
                <option value="">Selecione</option>
                <?php
                    //selecionar tipo
                    $sql = "select id, tipo from tipo order by tipo";
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();
                    while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        $id = $dados->id;
                        $tipo = $dados->tipo;
                        echo "<option value='$id'> $tipo</option>";
                    }
                ?>
            </select>
            <br>
            <label for="editora_id">Editora</label>
            <select name="editora_id" class="form-control" required data-parsley-required-message="<i class='fas fa-info-circle'></i> Selecione uma Editora">
                <option value="">Selecione</option>
                <?php 
                    $tabela = "editora";
                    $campo = "nome";
                   carregarDados($tabela, $campo, $pdo);
                ?>
            </select>
            <br>
            <button type="submit" class="btn btn-success"> Cadastrar</button>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //aplicando summernote
        $("#summernote").summernote({
            placeholder: "Digite o resumo",
            height: 200,
            lang: 'pt-BR'
        });
        //var markupStr = $('#summernote').summernote('code');
        var postForm = function() {
        var resumo = $('textarea[name="resumo"]').html($('#summernote').code());
        }
        //}
        //aplicando mascara de valor
        $("#valor").maskMoney({
            thousands: ".",
            decimal: ","
        })
    })
</script>