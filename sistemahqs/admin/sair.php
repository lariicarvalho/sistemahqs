<?php 
session_start();
//encerrar sessão
unset($_SESSION["hqs"]);
//redirecionar página
header("location: index.php");