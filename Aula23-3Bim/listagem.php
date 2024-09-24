<?php

$titulo = "Listagem";
require 'cabecalho.php';
require 'conexao.php';

$sql = "SELECT id, nome, preco, urlfoto, descricao FROM pratos ORDER BY nome";
$stmt = $conn->query($sql);



?>
<style>
    .descri {
        font-size: 0.75em;
    }
</style>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-success">
                <tr>
                    <th scope="col" style="width: 10%;">ID</th>
                    <th scope="col" style="width: 25%;">Nome</th>
                    <th scope="col" style="width: 15%;">Preço</th>
                    <th scope="col" style="width: 15%;">Imagem</th>
                    <th scope="col" style="width: 25%;">Descrição</th>
                    <th scope="col" style="width: 25%;" colspan="2"></th>
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