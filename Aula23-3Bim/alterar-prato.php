<?php
require 'cabecalho.php';
require 'conexao.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Página de alteração de produtos </h1>
    </div>
    <br>

    <?php
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

    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$nome, $preco, $urlfoto, $descricao, $id]);

    if ($result == true && $count >= 1) {
        // deu certo o insert
        ?>
        <div class="alert alert-success" role="alert">
            <h4>Dados alterados com sucesso.</h4>
        </div>
        <?php
    } elseif($result == true && $count >= 0){
        ?>
        <div class="alert alert-secondary" role="alert">
            <h4>Nenhum dado foi alterado.</h4>
        </div>
        <?php
    }else {
        //não deu certo
        $errorArray = $stmt->errorInfo();
        ?>
        <div class="alert alert-danger" role="alert">
            <h4>Falha ao efetuar gravação.</h4>
            <p><?= $errorArray[2]; ?></p>
        </div>
        <?php
    }
    ?>

    <?php
    require 'rodape.php';
    ?>
