<?php

session_start();

$titulo = "Página de exclusão de pratos";
require 'cabecalho.php';
require 'conexao.php';

if (!isset($_SESSION["email"])) {
    ?>
        <div class="alert alert-danger" role="alert">
            <h4>Esta é uma página PROTEGIDA!!.</h4>
            <p>Você está tentando acessar conteúdo restrito.</p>
        </div>
    <?php
    } else {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

echo "<strong>ID:</strong> $id";

/**
 * DELETE FROM pratos WHERE 0
 */

$sql = "DELETE FROM pratos WHERE id= ?";
$stmt = $conn->prepare($sql);
$result = $stmt->execute([$id]);
/*
    POOStatement::rowCount

    Returns the number of rows affected by the last SQL statement

    https://www.php.net/manual/en/pdostatement.rowcount.php
    */

$count = $stmt->rowCount();

if ($result == true && $count > -1) {
    // deu certo o insert
?>
    <div class="alert alert-success" role="alert">
        <h4>Prato excluido com sucesso.</h4>
    </div>
<?php
} elseif ($count == 0) {
?>
    <div class="alert alert-danger" role="alert">
        <h4>Falha ao efetuar a exclusão.</h4>
        <p>Não foi encontrado nenhum registro com o ID = <?= $id; ?></p>
    </div>
<?php
} else {
    //não deu certo
    $errorArray = $stmt->errorInfo();
?>
    <div class="alert alert-danger" role="alert">
        <h4>Falha ao efetuar a exclusão.</h4>
        <p><?= $errorArray[2]; ?></p>
    </div>
<?php
}
?>

<?php

}
?>

<?php
require 'rodape.php';
?>