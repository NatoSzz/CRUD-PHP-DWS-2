<?php
session_start();

$titulo = "Login (Autenticação)";
require 'cabecalho.php';



//require 'conexao.php';
?>


    <?php
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS);


    echo "<strong>Email:</strong> $email <br>";
    echo "<br><strong>Senha:</strong> $senha";

    if ($email == "makemeyourlove56@gmail.com" && $senha == 123321) {
        //Deu certo

        $_SESSION["email"] = $email;
        $_SESSION["nome"] = "Renato Vinícius";

    ?>
        <br><div class="alert alert-success" role="alert">
            <h4>Autenticado com sucesso.</h4>
        </div>
    <?php
    } else {
        //Não deu certo, SENHA OU EMAIL INCORRETOS.

        unset($_SESSION["email"]);
        unset($_SESSION["nome"]);


    ?>
        <div class="alert alert-danger" role="alert">
            <h4>Falha ao efetuar a autenticação.</h4>
            <p>Usuário ou senha incorretos.</p>
        </div>
    <?php
    }



    require 'rodape.php';
    ?>