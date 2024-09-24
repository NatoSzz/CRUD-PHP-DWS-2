<?php

$titulo = "Autenticação";
require 'cabecalho.php';

?>

<br>

<div class="row">
    <div class="col-4 offset-4">
        <br><br>
        <form action="login.php" method="POST">
            <h1 class="h3 mb-3 fw-normal">Por favor, se identifique.</h1>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" placeholder="nome@gmail.com" name="email">
                <label for="email">Endereço de Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="senha" placeholder="Senha" name="senha">
                <label for="senha">Senha</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>

           
        </form>
    </div>
</div>


<?php

require 'rodape.php';

?>