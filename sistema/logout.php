<?php
//Encerrando a seessão
session_start();
session_unset();
session_destroy();

header('Location:login.php');
?>