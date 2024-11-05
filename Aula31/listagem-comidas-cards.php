<style>
    .float{
        float: right;
    }
</style>


<?php
session_start();
require "logica-autenticacao.php";

$titulo = "Listagem de comidas";
require 'cabecalho.php';
require 'conexao.php';

$sql = "SELECT id, nome, descricao, preco, urlfoto FROM pratos ORDER BY nome";
$stmt = $conn->query($sql);

if (isset($_GET["ordem"]) && !empty($_GET["ordem"])) {
    $ordem = filter_input(INPUT_GET, "ordem", FILTER_SANITIZE_SPECIAL_CHARS);
} else {
    $ordem = "nome";
}


if (isset($_POST["busca"]) && !empty($_POST["busca"])) {

    $busca = filter_input(INPUT_POST, "busca", FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo_busca = filter_input(INPUT_POST, "tipo_busca", FILTER_SANITIZE_SPECIAL_CHARS);
    $buscaOriginal = $busca;

    if ($tipo_busca == "nome") {

        $busca = "%" . $busca . "%";

        $sql = "SELECT id, nome, preco, urlfoto, descricao FROM pratos WHERE nome like ? ORDER BY $ordem";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$busca]);

    } elseif ($tipo_busca == "id") {
        $sql = "SELECT id, nome, preco, urlfoto, descricao FROM pratos WHERE id = ? ORDER BY $ordem";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$busca]);

    } elseif ($tipo_busca == "descricao") {

        $busca = "%" . $busca . "%";

        $sql = "SELECT id, nome, preco, urlfoto, descricao FROM pratos WHERE descricao like ? ORDER BY $ordem";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$busca]);

    } else {

        $buscaInt = intval($busca);

        $busca = "%" . $busca . "%";

        $sql = "SELECT id, nome, preco, urlfoto, descricao FROM pratos WHERE nome like ? OR descricao like ? OR id = ? ORDER BY $ordem";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$busca, $busca, $buscaInt]);
    }
} else {
    $sql = "SELECT id, nome, preco, urlfoto, descricao FROM pratos ORDER BY $ordem";
    $stmt = $conn->query($sql);
}

?>



<div class="row">
    <div class="col">
        <form action="" class="row" role="search" method="POST">

            <label for="tipo_busca" class="fs-5 col-sm-2 col-form-label col-form-label-sm text-end">Buscar por</label>
            <div class="col-sm-2">
                <select name="tipo_busca" id="tipo_busca" class="form-select">
                    <option value="">Todos os campos</option>
                    <option value="id">ID</option>
                    <option value="nome">Nome</option>
                    <option value="descricao">Descrição</option>
                </select>
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control me-2" type="search" name="busca" placeholder="Search"
                    aria-label="Search">
            </div>
            <div class="col-sm-2">
                <button class="btn btn-primary" type="submit">
                    <i data-feather="search"></i> <span class="px-2">Pesquisar</span>
                </button>
            </div>
        </form>
    </div>
</div>
<br>

<?php
if (isset($_POST["busca"]) && !empty($_POST["busca"])) {
    ?>
    <div class="row mt-3">
        <div class="col">
            <div class="alert alert-light fs-4 mb-0" role="alert">
                Você está buscando por "<mark class="fst-italic"><?= $buscaOriginal ?></mark>", <a
                    href="listagem-comidas-cards.php?ordem=<?=$ordem?>">limpar</a>.
            </div>
        </div>
    </div>
    <hr>
    <?php
}
?>
    <div class="table table-striped d-flex justify-content-end">
        <thead>
            <tr>
            <div class="mr-2">
                <p class="float">Ordenar por:</p>
            </div>

                <?php
                if ($ordem == "nome") {
                    ?>
                    <th scope="col" style="width: 25%;">
                        <a class="btn btn-outline-primary btn-sm">Nome</a><i data-feather="chevron-down"></i>
                    </th>
                    <th scope="col" style="width: 15%;">
                        <a href="?ordem=preco" class="btn btn-outline-primary btn-sm">Preço</a><i data-feather="chevron-down"></i>
                    </th>
                    <?php
                } elseif ($ordem == "preco desc") {
                    ?>
                    <th scope="col" style="width: 25%;">
                        <a href="?ordem=nome" class="btn btn-outline-primary btn-sm">Nome</a><i data-feather="chevron-down"></i>
                    </th>
                    <th scope="col" style="width: 15%;">
                        <a href="?ordem=preco desc" class="btn btn-outline-primary btn-sm">Preço</a><i data-feather="chevron-up"></i>
                    </th>
                    <?php
                } else {
                    ?>
                    <th scope="col" style="width: 25%;">
                        <a href="?ordem=nome" class="btn btn-outline-primary btn-sm">Nome</a><i data-feather="chevron-down"></i>
                    </th>
                    <th scope="col" style="width: 15%;">
                        <a href="?ordem=preco desc" class="btn btn-outline-primary btn-sm">Preço</a><i data-feather="chevron-down"></i>
                    </th>
                    <?php
                }
                ?>
    </div>
<div class="album py-5 bg-light">
    <div class="conteiner">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            <?php
            while ($row = $stmt->fetch()) {
            ?>
                <div class="card shadow-sm">
                    <img src="<?= $row['urlfoto'] ?>" alt="<?= $row['nome'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['nome'] ?></h5>
                        <p class="card-text mb-2"><?= $row['descricao'] ?></p>
                        <hr class="mt-0 mb-2">
                        <p class="card-text text-end">Preço: <b>R$ <?= $row['preco'] ?></b></p>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

    </div>
</div>



<?php

require 'rodape.php';

?>