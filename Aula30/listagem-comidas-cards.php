<?php
session_start();
require "logica-autenticacao.php";

$titulo = "Listagem de comidas";
require 'cabecalho.php';
require 'conexao.php';

$sql = "SELECT id, nome, descricao, preco, urlfoto FROM pratos ORDER BY nome";
$stmt = $conn->query($sql);



?>
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