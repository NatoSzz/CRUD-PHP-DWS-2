<?php

require 'cabecalho.php';

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Formulário de cadastro de comidas.</h1>
    </div>
    <br>

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