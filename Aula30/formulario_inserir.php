<?php

session_start();
require "logica-autenticacao.php";

if(!autenticado()){
    $SESSION["restrito"] = true;
    redireciona();
    die();
}

$titulo = "Formulário de cadastro de comidas";
require 'cabecalho.php';


?>
    <form action="destino_inserir.php" method="POST">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do prato" required>
        </div>

        <br>
        <div class="form-group">
            <label for="preco">Preço:</label>
            <input type="number" class="form-control" id="preco" name="preco" placeholder="Preço do prato" required>
        </div>

        <br>
        <div class="form-group">
            <label for="urlfoto">Url de uma foto/imagem do prato:</label>
            <input type="url" class="form-control" id="urlfoto" name=urlfoto placeholder="Imagem do prato" required>
            <small id="http" class="form-text text-muted">Endereço http de uma imagem da internet</small>
        </div>

        <br>
        <div class="form-group">
            <label for="descricao">Descrição detalhada:</label>
            <textarea class="form-control" id="descricao" name="descricao" required></textarea>
        </div>

        <br><button type="submit" class="btn btn-primary">Gravar</button>
        <button type="reset" class="btn btn-warning">Cancelar</button>
    </form>

<?php




require 'rodape.php';

?>