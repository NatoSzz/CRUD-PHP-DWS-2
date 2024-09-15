<?php

require 'cabecalho.php';

$id = filter_input(INPUT_GET , "id", FILTER_SANITIZE_NUMBER_INT);

if(empty($id)){
?>
    <div class="alert alert-danger" role="alert">
        <h4>Falha ao abrir o formulário para edição.</h4>
        <p>ID do produto está vazio.</p>
   </div>
<?php
    exit;
}

require 'conexao.php';

$sql = "SELECT nome, preco, urlfoto, descricao FROM pratos WHERE id= ?";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$id]);

$rowPrato = $stmt->fetch();

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Formulário de alteração de comidas.</h1>
    </div>
    <br>

    <form action="alterar-produto.php" method="POST">
        <input type="hidden" name="id" id="id" value="<?= $id?>">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do prato" required
            value ="<?=$rowPrato['nome']?>">
        </div>

        <br>
        <div class="form-group">
            <label for="preco">Preço:</label>
            <input type="number" class="form-control" id="preco" name="preco" placeholder="Preço do prato" required
            value ="<?=$rowPrato['preco']?>">
        </div>

        <br>
        <div class="form-group">
            <label for="urlfoto">Url de uma foto/imagem do prato:</label>
            <input type="url" class="form-control" id="urlfoto" name=urlfoto placeholder="Imagem do prato" required
            value ="<?=$rowPrato['urlfoto']?>">
            <small id="http" class="form-text text-muted">Endereço http de uma imagem da internet</small>
        </div>

        <br>
        <div class="form-group">
            <label for="descricao">Descrição detalhada:</label>
            <textarea class="form-control" id="descricao" name="descricao" required
            value ="<?=$rowPrato['descricao']?>"></textarea>
        </div>

        <br><button type="submit" class="btn btn-primary">Gravar</button>
        <button type="reset" class="btn btn-warning">Cancelar</button>

        <div class="col-3">
            <img src="<?=$rowPrato['urlfoto']?>" 
             alt="<?=$rowPrato['nome']?>" class="img-thumbnail" id="image-preview">
        </div>
    </form>

    <?php

    require 'rodape.php';

    ?>