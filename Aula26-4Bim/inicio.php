<?php
session_start();
require "logica-autenticacao.php";

$titulo = "Inicio";
require 'cabecalho.php';


?>

<p class="display-4">
    Seja bem vindo ao restaurante <strong>"CRUD PHP"</strong>.
</p>
<p class="display-4">
    Esta é a página inicial.
</p>
<?php

    if (isset($_SESSION["restrito"]) && $_SESSION["restrito"]) {
        ?>
        <div class="alert alert-danger" role="alert">
            <h4>Esta é uma página PROTEGIDA!!.</h4>
            <p>Você está tentando acessar conteúdo restrito.</p>
        </div>

        <?php
        unset($_SESSION["restrito"]);
    }

require 'rodape.php';

?>