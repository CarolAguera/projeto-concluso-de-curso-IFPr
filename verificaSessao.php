<?php

session_start();

if (!isset($_SESSION['id'])) {
    $mensagem = "Sessão Expirada. Faça login novamente! ";
    header("location: ../login.php?mensagem={$mensagem}");
    die();
}
