<?php

if (isset($_POST['email'])  && isset($_POST['senha'])) {
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');

    $sql = "select * from usuario where email ='{$email}'";
    $resultado = mysqli_query($conexao,$sql);
    $totalDeRegistros = mysqli_num_rows($resultado);
    $usuario = mysqli_fetch_array($resultado);

    if (($totalDeRegistros == 1) && (password_verify($senha, $usuario['senha']))) {        
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id']    = $usuario['id'];
            $_SESSION['nome_completo']  = $usuario['nome_completo'];
            $_SESSION['email'] = $usuario['email'];

            header('location: Admin/IndexAdmin.php');
            die();
        
    }else{
        $mensagem = "Usuário/Senha inválidos";
        header("location: login.php?mensagem={$mensagem}");
        die();
    }

    



}



