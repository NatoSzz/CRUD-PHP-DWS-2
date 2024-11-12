<?php

session_start();
require "logica-autenticacao.php";

if (!autenticado()) {
    $SESSION["restrito"] = true;
    redireciona("index.php");
    die();
}

require 'conexao.php';


$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$preco = filter_input(INPUT_POST, "preco", FILTER_SANITIZE_NUMBER_FLOAT);
$urlfoto = filter_input(INPUT_POST, "urlfoto", FILTER_SANITIZE_URL);
$descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);

echo "<strong>ID:</strong> $id";
echo "<strong>Nome:</strong> $nome";
echo "<br><strong>Preço:</strong> $preco";
echo "<br><strong>URL Foto:</strong> $urlfoto";
echo "<br><strong>Descrição do produto:</strong> $descricao";

/**
 * UPDATE pratos SET id = [value-1], nome = [value-2],
 * preco = [value-3], descricao = [value-4] WHERE 1
 */

$sql = "UPDATE pratos SET nome = ?, preco = ?, urlfoto = ?, descricao = ? 
                    WHERE id = ?";


try {
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$nome, $preco, $urlfoto, $descricao, $id]);
    $count = $stmt->rowCount();
} catch (Exception $e) {
    $result = false;
    $count = 0;
    $error = $e->getMessage();
}



if ($result == true && $count >= 1) {
    $_SESSION["result"] = $result;
    $_SESSION["msg_sucesso"] = "Dados alterados com sucesso!";
    redireciona("listagem.php");
} elseif ($result == true && $count >= 0) {
    $_SESSION["result"] = $result;
    $_SESSION["msg_erro"] = "Nenhum dado foi alterado";
    redireciona("formulario-alterar-prato.php?id=$id");
} else {
    $_SESSION["result"] = $result;
    $_SESSION["msg_erro"] = "Falha ao efetuar alteração";
    $_SESSION["erro"] = $error;
    redireciona("formulario-alterar-prato.php?id=$id");
}


?>