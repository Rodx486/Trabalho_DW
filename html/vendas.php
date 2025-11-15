<?php
session_start();

if (isset($_SESSION['logado']) && $_SESSION['logado'] === true){
    // usuário logado, continua normalmente
} else {
    // Armazena mensagem e redireciona
    echo "<script>alert('Você precisa estar logado primeiro');</script>";
    header('Location: login.php');
    exit;
}
?>