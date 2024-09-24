<?php

$titulo = "Destino do formulário (inserir)";

require 'cabecalho.php';
require 'conexao.php';


?>


    <?php
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $preco = filter_input(INPUT_POST, "preco", FILTER_SANITIZE_NUMBER_FLOAT);
    $urlfoto = filter_input(INPUT_POST, "urlfoto", FILTER_SANITIZE_URL);
    $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);

    echo "<strong>Nome:</strong> $nome";
    echo "<br><strong>Preço:</strong> $preco";
    echo "<br><strong>URL Foto:</strong> $urlfoto";
    echo "<br><strong>Descrição do produto:</strong> $descricao";

    /**
     * INSERT INTO pratos(nome, preco, urlfoto, descricao) 
     * VALUES ([value-1],[value-2],[value-3],[value-3])
     */

    $sql = "INSERT INTO pratos (nome, preco, urlfoto, descricao) VALUES (?, ?, ?, ?) ";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$nome, $preco, $urlfoto, $descricao]);

    if ($result == true) {
        // deu certo o insert
        ?>
        <div class="alert alert-success" role="alert">
            <h4>Dados gravados com sucesso.</h4>
        </div>
        <?php
    } else {
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