<?php
session_start();
require "logica-autenticacao.php";

$titulo = "Listagem";
require 'cabecalho.php';
require 'conexao.php';


if(isset($_POST["busca"]) && !empty($_POST["busca"])){

    $busca = filter_input(INPUT_POST, "busca", FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo_busca = filter_input(INPUT_POST, "tipo_busca", FILTER_SANITIZE_SPECIAL_CHARS);

    if($tipo_busca == "nome") {
        $sql = "SELECT id, nome, preco, urlfoto, descricao FROM pratos WHERE nome = ? ORDER BY nome";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$busca]);
    }
}else{
    $sql = "SELECT id, nome, preco, urlfoto, descricao FROM pratos ORDER BY nome";
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
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="table-success">
            <tr>
                <th scope="col" style="width: 10%;">ID</th>
                <th scope="col" style="width: 25%;">Nome</th>
                <th scope="col" style="width: 15%;">Preço</th>
                <th scope="col" style="width: 15%;">Imagem</th>
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
                            <a class="btn btn-sm btn-warning" href="formulario-alterar-prato.php?id=<?= $row["id"] ?>">
                                <span data-feather="edit"></span>
                                Editar
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-danger" href="excluir-prato.php?id=<?= $row["id"] ?>"
                                onclick="if(!confirm('Tem certeza que deseja excluir?')) return false;">
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
</div>


<?php

require 'rodape.php';

?>