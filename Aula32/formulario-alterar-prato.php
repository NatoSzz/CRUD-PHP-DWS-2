<?php

session_start();
require "logica-autenticacao.php";

/** Tratamento de permissões */
if(!autenticado()){
    $SESSION["restrito"] = true;
    redireciona("index.php");
    die();
}
/** Tratamento de permissões */

$titulo = "Formulário de alteração de comidas";
require 'cabecalho.php';


$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);


if (!isset($_SESSION["email"])) {
?>
    <div class="alert alert-danger" role="alert">
        <h4>Esta é uma página PROTEGIDA!!.</h4>
        <p>Você está tentando acessar conteúdo restrito.</p>
    </div>
<?php
} elseif (empty($id)) {
?>
    <div class="alert alert-danger" role="alert">
        <h4>Falha ao abrir o formulário para edição.</h4>
        <p>ID do produto está vazio.</p>
    </div>
<?php
    exit;
} else {

    require 'conexao.php';

    $sql = "SELECT nome, preco, urlfoto, descricao FROM pratos WHERE id= ?";

    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$id]);

    $rowPrato = $stmt->fetch();

?>
    <script>
        function imagePreview(valor) {
            var img = document.getElementbyId('image-preview');
            if (valor) {
                img.setAttribute('src', valor);
                img.style.display = 'inline';
            } else {
                img.style.display = 'none';
            }
        }
    </script>
    <form action="alterar-prato.php" method="POST">
        <input type="hidden" name="id" id="id" value="<?= $id ?>" required>
        <div class="row">
            <div class="col-8">
                <div class="mb-3">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do prato" required value="<?= $rowPrato['nome'] ?>">
                </div>
                <div class="mb-3">
                    <label for="preco">Preço:</label>
                    <input type="number" class="form-control" id="preco" name="preco" placeholder="Preço do prato" required value="<?= $rowPrato['preco'] ?>">
                </div>
                <div class="mb-3">
                    <label for="urlfoto">Url de uma foto/imagem do prato:</label>
                    <input type="url" class="form-control" id="urlfoto" name=urlfoto placeholder="Imagem do prato" required value="<?= $rowPrato['urlfoto'] ?>">
                    <small id="http" class="form-text text-muted">Endereço http de uma imagem da internet</small>
                </div>
                <div class="mb-3">
                    <label for="descricao">Descrição detalhada:</label>
                    <textarea class="form-control" id="descricao" name="descricao" required value="<?= $rowPrato['descricao'] ?>"></textarea>
                </div>
                <div class="col-3">
                    <img src="<?= $rowPrato['urlfoto'] ?>" alt="<?= $rowPrato['nome'] ?>" class="img-thumbnail" id="image-preview">
                </div>

                <button type="submit" class="btn btn-primary">Gravar</button>
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


}


require 'rodape.php';

?>