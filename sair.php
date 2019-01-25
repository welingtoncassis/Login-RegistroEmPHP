<?php 

    //pagina de logout, usando unset para eliminar o conteudo das sessions

    session_start(); //abrindo a sessão


    

    unset($_SESSION['usuario']);
    unset($_SESSION['email']);

    header('Location: index.php');

    
    
?>