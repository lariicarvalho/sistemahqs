<?php 
//verificar de existe uma váriavel página
	if ( !isset ( $pagina ) ) {
		header("location: index.php");
	}
?>
<div class="conatiner">
    <h1 class="text-center">Página não encontrada!</h1>
    <p class="text-center">A página que está tentando acessar não existe!</p>
</div>