<?php

session_start();
require "logica-autenticacao.php";

$titulo = "Formulário de alteração de usuarios";
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
        <p>ID do usuario está vazio.</p>
    </div>
<?php
    exit;
} else {

    require 'conexao.php';

    $sql = "SELECT nome, email, senha FROM usuarios WHERE id= ?";

    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$id]);

    $rowUsuario = $stmt->fetch();

?>
    <form action="alterar-usuarios.php" method="POST">
        <input type="hidden" name="id" id="id" value="<?= $id ?>">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do usuario" required value="<?= $rowUsuario['nome'] ?>">
        </div>

        <br>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email do usuario" required value="<?= $rowUsuario['email'] ?>">
        </div>

        <br>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="number" class="form-control" id="senha" name=senha placeholder="Senha do usuario" required value="<?= $rowUsuario['senha'] ?>">
        </div>


        <br><button type="submit" class="btn btn-primary">Gravar</button>
        <button type="reset" class="btn btn-warning">Cancelar</button>

    </form>

<?php
}


require 'rodape.php';

?>