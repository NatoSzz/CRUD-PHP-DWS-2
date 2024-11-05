<?php
session_start();
require "logica-autenticacao.php";

$titulo = "Listagem de usuarios";
require 'cabecalho.php';
require 'conexao.php';

$sql = "SELECT id, nome, email FROM usuarios ORDER BY nome";
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
                <th scope="col" style="width: 15%;">Email</th>
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
                    <td><?= $row["email"] ?></td>
                    <?php
                    if (autenticado()) {
                        ?>
                        <td>
                            <a class="btn btn-sm btn-warning" href="formulario-alterar-usuarios.php?id=<?= $row["id"] ?>">
                                <span data-feather="edit"></span>
                                Editar
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-danger" href="excluir-usuarios.php?id=<?= $row["id"] ?>"
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