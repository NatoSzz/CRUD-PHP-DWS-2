<?php

session_start();

$titulo = "Formulário de cadastro de animais";
require 'cabecalho.php';

if (!isset($_SESSION["email"])) {
?>
    <div class="alert alert-danger" role="alert">
        <h4>Esta é uma página PROTEGIDA!!.</h4>
        <p>Você está tentando acessar conteúdo restrito.</p>
    </div>
<?php
} else {
?>
    <form action="destino_inserir.php" method="POST">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do animal" required>
        </div>

        <br>
        <div class="form-group">
            <label for="preco">Peso:</label>
            <input type="number" class="form-control" id="peso" name="peso" placeholder="Preço do animal" required>
        </div>

        <br>
        <div class="form-group">
            <label for="urlfoto">Url de uma foto/imagem do animal:</label>
            <input type="url" class="form-control" id="imagem" name="imagem" placeholder="Imagem do animal" required>
            <small id="http" class="form-text text-muted">Endereço http de uma imagem da internet</small>
        </div>


        <br><button type="submit" class="btn btn-primary">Gravar</button>
        <button type="reset" class="btn btn-warning">Cancelar</button>
    </form>

<?php
}



require 'rodape.php';

?>