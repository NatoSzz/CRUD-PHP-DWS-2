<?php
session_start();
require "logica-autenticacao.php";


$titulo = "Destino do formulário (inserir)";

require 'cabecalho.php';
require 'conexao.php';


?>


    <?php
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, "senha");

    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    echo "<strong>Nome:</strong> $nome";
    echo "<br><strong>Email:</strong> $email";
    echo "<br><strong>Senha:</strong> $senha_hash";

    /**
     * INSERT INTO `usuarios`(`id`, `nome`, `email`, `senha`) 
     * VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')
     */

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$nome, $email, $senha_hash]);

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