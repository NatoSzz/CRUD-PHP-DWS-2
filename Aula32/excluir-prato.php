<?php
session_start();
require "logica-autenticacao.php";

/** Tratamento de permissões */
if(!autenticado()){
    $SESSION["restrito"] = true;
    redireciona("index.php");
    die();
}
/** Tratamento de permissões */


require 'conexao.php';


$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);


/**
 * DELETE FROM pratos WHERE 0
 */

$sql = "DELETE FROM pratos WHERE id= ?";

try {
    $stmt = $conn->prepare($sql);
   
    $result = $stmt->execute([$id]);
    $count = $stmt->rowCount();
} catch (Exception $e) {
    $result = false;
    $count = 0;
    $error = $e->getMessage();
}

/*
    POOStatement::rowCount

    Returns the number of rows affected by the last SQL statement

    https://www.php.net/manual/en/pdostatement.rowcount.php
    */

if ($result == true && $count >= 1) {
    $_SESSION["result"] = $result;
    $_SESSION["msg_sucesso"] = "Dados excluidos com sucesso!";

} elseif ($result == true && $count == 0) {
    $_SESSION["result"] = $result;
    $_SESSION["msg_erro"] = "Falha ao efetuar exclusão";
    $_SESSION["erro"] = "Não foi encontrado nenhum registro com o ID = ($id)";
} else {
    $_SESSION["result"] = $result;
    $_SESSION["msg_erro"] = "Falha ao efetuar exclusão";
    $_SESSION["erro"] = $error;
    $errorArray = $stmt->errorInfo();
}

redireciona("listagem.php");
?>