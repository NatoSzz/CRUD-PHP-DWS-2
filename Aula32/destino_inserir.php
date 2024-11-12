<?php
session_start();
require "logica-autenticacao.php";

/** Tratamento de permissões */
if (!autenticado()){
    $_SESSION["restrito"] = true;
    redireciona("index.php");
    $_SESSION["msg_erro"] = "Falha ao efetuar gravação";
    die();
}
/** Tratamento de permissões */

require 'conexao.php';


    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $preco = filter_input(INPUT_POST, "preco", FILTER_SANITIZE_NUMBER_FLOAT);
    $urlfoto = filter_input(INPUT_POST, "urlfoto", FILTER_SANITIZE_URL);
    $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);


    $sql = "INSERT INTO pratos (nome, preco, urlfoto, descricao) VALUES (?, ?, ?, ?) ";

    try {
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$nome, $preco, $urlfoto, $descricao]);
    } catch (Exception $e) {
        $result = false;
        $error = $e->getMessage();
    }

    if ($result == true) {
       $_SESSION["result"] = $result;
       $_SESSION["msg_sucesso"] = "Dados gravados com sucesso!";
    } else {
        $_SESSION["result"] = $result;
        $_SESSION["msg_erro"] = "Falha ao efetuar gravação";
        $_SESSION["erro"] = $error;
    }

    redireciona("formulario_inserir.php");
    ?>