<?php

$titulo = "Destino do formulário (inserir)";

require 'cabecalho.php';
require 'conexao.php';


?>


    <?php
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $peso = filter_input(INPUT_POST, "peso", FILTER_SANITIZE_NUMBER_FLOAT);
    $imagem = filter_input(INPUT_POST, "imagem", FILTER_SANITIZE_URL);

    echo "<strong>Nome:</strong> $nome";
    echo "<br><strong>Peso:</strong> $peso";
    echo "<br><strong>URL Foto:</strong> $imagem";

    /**
     * INSERT INTO Animais(nome, peso, imagem) 
     * VALUES ([value-1],[value-2],[value-3],[value-3])
     */

    $sql = "INSERT INTO Animais (nome, peso, imagem) VALUES (?, ?, ?) ";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$nome, $peso, $imagem]);

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