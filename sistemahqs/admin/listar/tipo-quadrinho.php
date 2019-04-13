<?php
    if ( file_exists("verificalogin.php") )
        include "verificalogin.php"; 
    else 
        include "../verificalogin.php";
?>
<div class="container">
    <div class="coluna">
    <div class="float-right">
            <a href="cadastros/tipo-quadrinho" class="btn btn-success"><i class="fas fa-file"></i> Nova</a>
        </div>
        <h1>Listagem de Tipo de Quadrinhos</h1>
        <table class="table table-hover table-striped table-bordered" id="myTable">
            <thead>
                <tr>
                    <td width="10%">ID:</td>
                    <td width="50%">Tipo de Quadrinho:</td>
                    <td width="20%">Opções:</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    //selecionar os dados do tipo-quadrinho
                    $sql = "select * from tipo order by tipo";
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();
                    //laço de repetição para separar as linhas
                    while ( $linha = $consulta->fetch(PDO::FETCH_OBJ) ) {
                        //SEPARAR os dados
                        $id = $linha->id;
                        $tipo = $linha->tipo;
                    //montar as linhas e colunas da tabela
                    echo "<tr><td>$id</td><td>$tipo</td><td><a href='cadastros/tipo-quadrinho/$id' class='btn btn-warning'><i class='fas fa-edit'></i> Editar</a>
                    <a href='javascript:excluir($id)' class='btn btn-danger'><i class='fas fa-trash-alt'></i> Excluir</a>
                    </td></tr>";
                    }
                ?>
            </tbody>
        </table>
</div>
<script type="text/javascript">
//função em js para perguntar se quer mesmo excluir
function excluir(id){
    //perguntar
    if ( confirm("Deseja mesmo excluir?")){
        //chamar a tela de exclusão
        location.href= "excluir/tipo-quadrinho/"+id;
    }
}
$(document).ready( function () {
    $('#myTable').DataTable( {
        "language": {
            "lengthMenu": "Exibindo _MENU_ resultados por página",
            "zeroRecords": "Nenhum resultado encontrado!",
            "info": "Exibindo página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum resultado",
            "infoFiltered": "(filtrado em _MAX_ resultados)",
            "search": "Busca"
        }
    } );
} );
</script>
