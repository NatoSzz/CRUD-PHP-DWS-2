<?php
session_start();
require "logica-autenticacao.php";

$titulo = "Listagem";
require 'cabecalho.php';
require 'conexao.php';

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
                <input type="text" class="form-control me-2" type="search" name="busca" placeholder="Search" aria-label="Search">
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
                Você está buscando por "<mark class="fst-italic"><?= $buscaOriginal ?></mark>", <a href="listagem.php?ordem=<?= $ordem ?>">limpar</a>.
            </div>
        </div>
    </div>
    <hr>
<?php
}
?>

<div class="table-responsive">
    <table class="table table-striped">
        <thead class="table-success">
            <tr>
                <?php
                if ($ordem == "nome") {
                ?>
                    <th scope="col" style="width: 10%;">
                        <a href="?ordem=id">ID</a>
                    </th>
                    <th scope="col" style="width: 25%;">
                        Nome<i data-feather="chevron-down"></i>
                    </th>
                    <th scope="col" style="width: 15%;">
                        <a href="?ordem=preco">Preço</a>
                    </th>
                <?php
                } elseif ($ordem == "id") {
                ?>
                    <th scope="col" style="width: 10%;">
                        ID<i data-feather="chevron-down"></i>
                    </th>
                    <th scope="col" style="width: 25%;">
                        <a href="?ordem=nome">Nome</a><i data-feather="chevron-down"></i>
                    </th>
                    <th scope="col" style="width: 15%;">
                        <a href="?ordem=preco">Preço</a><i data-feather="chevron-down"></i>
                    </th>
                <?php
                } elseif ($ordem == "preco desc") {
                ?>
                    <th scope="col" style="width: 10%;">
                        <a href="?ordem=id">ID</a><i data-feather="chevron-down"></i>
                    </th>
                    <th scope="col" style="width: 25%;">
                        <a href="?ordem=nome">Nome</a><i data-feather="chevron-down"></i>
                    </th>
                    <th scope="col" style="width: 15%;">
                        <a href="?ordem=preco desc">Preço</a><i data-feather="chevron-up"></i>
                    </th>
                <?php
                } else {
                ?>
                    <th scope="col" style="width: 10%;">
                        <a href="?ordem=id">ID</a><i data-feather="chevron-down"></i>
                    </th>
                    <th scope="col" style="width: 25%;">
                        <a href="?ordem=nome">Nome</a><i data-feather="chevron-down"></i>
                    </th>
                    <th scope="col" style="width: 15%;">
                        <a href="?ordem=preco desc">Preço</a><i data-feather="chevron-down"></i>
                    </th>
                <?php
                }
                ?>

                <th scope="col" style="width: 15%;">Imagem</th>I
                <th scope="col" style="width: 25%;">Descrição</th>
                <?php
                if (autenticado()) {
                ?>
                    <th scope="col" style="width: 25%;" colspan="2"></th>
                <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $stmt->fetch()) {
            ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row["nome"] ?></td>
                    <td><?= $row["preco"] ?></td>
                    <td>
                        <a target="_blank" href="<?= $row["urlfoto"] ?>">
                            Link Imagem
                        </a>
                    </td>
                    <td class="descri">
                        <?= $row["descricao"] ?>
                    </td>
                    <?php
                    if (autenticado()) {
                    ?>
                        <td>
                            <a class="btn btn-sm btn-warning" href="formulario-alterar-prato.php?id=<?= $row["id"]; ?>">
                                <span data-feather="edit"></span>
                                Editar
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-danger" href="excluir-prato.php?id=<?= $row["id"]; ?>" onclick="if(!confirm('Tem certeza que deseja excluir?')) return false;">
                                <span data-feather="trash-2"></span>
                                Excluir
                            </a>
                        </td>
                    <?php
                    }
                    ?>
                </tr>
            <?php

            }

            ?>
        </tbody>
    </table>
    <?php

    if (isset($_SESSION["result"])) {

        if ($_SESSION["result"] == true) {
    ?>
            <div class="row mt-3">
                <div class="col-8 offset-2">
                    <div class="alert alert-success" role="alert">
                        <h4><?= $_SESSION["msg_sucesso"] ?></h4>
                    </div>
                </div>
            </div>
        <?php
            unset($_SESSION["msg_sucesso"]);
        } else {
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
    ?>
</div>


<?php

require 'rodape.php';

?>