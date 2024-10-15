<?php

session_start();
require "logica-autenticacao.php";

if(!autenticado()){
    $SESSION["restrito"] = true;
    redireciona();
    die();
}

$titulo = "Página de alteração de usuarios";

require 'cabecalho.php';
require 'conexao.php';


        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS);
    
        echo "<strong>ID:</strong> $id";
        echo "<strong>Nome:</strong> $nome";
        echo "<br><strong>Email:</strong> $email";
        echo "<br><strong>Senha:</strong> $senha";
    
        /**
         * UPDATE usuarios SET id = [value-1], nome = [value-2],
         * preco = [value-3], descricao = [value-4] WHERE 1
         */
    
        $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ? 
                    WHERE id = ?";
    
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$nome, $email, $senha, $id]);
    
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
