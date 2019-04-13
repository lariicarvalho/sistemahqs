<?php
    if ( file_exists("verificalogin.php") )
        include "verificalogin.php"; 
    else 
        include "../verificalogin.php";
?>
<div class="container">
    <div class="coluna">
        <div class="float-right">
            <a href="cadastros/editora" class="btn btn-success"><i class="fas fa-file"></i> Nova</a>
        </div>
        <h1>Lista de Editoras</h1>
        <table class="table table-striped table-bordered" id="myTable">
            <thead>
                <tr>
                    <td width="10%">ID:</td>
                    <td width="20%">Nome:</td>
                    <td width="30%">Site:</td>
                    <td width="20%">Opções:</td>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "select * from editora order by id";
                $consulta = $pdo->prepare($sql);
                $consulta->execute();
                //laço de repetição
                while ( $linha = $consulta->fetch(PDO::FETCH_OBJ) ) {
                    //SEPARAR os dados
                    $id = $linha->id;
                    $nome = $linha->nome;
                    $site = $linha->site;
                echo "<tr><td>$id</td><td>$nome</td><td><p><a href='$site'>$site</a></p></td><td><a href='cadastros/editora/$id' class='btn btn-warning'><i class='fas fa-edit'></i> Editar</a>
                <a href='javascript:excluir($id)' class='btn btn-danger'><i class='fas fa-trash-alt'></i> Excluir</a></td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
//função em js para perguntar se quer mesmo excluir
function excluir(id){
    //perguntar
    if ( confirm("Deseja mesmo excluir?")){
        //chamar a tela de exclusão
        location.href= "excluir/editora/"+id;
    }
}

$(document).ready( function () {
    $('#myTable').DataTable({
        "language": {
            "lengthMenu": "Exibindo _MENU_ resultados por página",
            "zeroRecords": "Nenhum resultado encontrado!",
            "info": "Exibindo página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum resultado",
            "infoFiltered": "(filtrado em _MAX_ resultados)",
            "search": "Busca"
        }
    });
} );
</script>