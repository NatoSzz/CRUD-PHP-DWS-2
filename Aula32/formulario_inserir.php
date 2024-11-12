<?php

session_start();
require "logica-autenticacao.php";

if (!autenticado()) {
    $SESSION["restrito"] = true;
    redireciona("index.php");
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

if (isset($_SESSION["result"])){

    if($_SESSION["result"] == true){
?>
        <div class="row mt-3">
            <div class="col-8">
                <div class="alert alert-success" role="alert">
                    <h4><?= $_SESSION["msg_sucesso"] ?></h4>
                </div>
            </div>
        </div>
<?php
      unset($_SESSION["msg_sucesso"]);
    }else{
        ?>
        <div class="row mt-3">
            <div class="col-8">
                <div class="alert alert-danger" role="alert">
                    <h4><?= $_SESSION["msg_erro"] ?></h4>
                    <p><?= $_SESSION["erro"] ?></p>
                </div>
            </div>
        </div>
<?php
        unset($_SESSION["msg_erro"]);
        unset($_SESSION["erro"]);
    }
    unset($_SESSION["result"]);
}


require 'rodape.php';

?>