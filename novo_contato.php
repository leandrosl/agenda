<?php

require_once __DIR__ . '/config.php';
require_once  __DIR__ . "/vendor/autoload.php";

$controller = new Agenda\Controllers\ContatoController();

if ($_POST) {
    $controller->novoContato($_POST);
}

?>

<?php

include_once __DIR__ . '/parts/header.php';
include_once __DIR__ . '/parts/navbar.php';

?>

<div class="container">
    <div class="row">
        <h4>Novo Contato</h4>
    </div>
    <div class="row">
        <form method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome_contato">Nome:</label>
                        <input id="nome_contato" class="form-control" type="text" name="nome" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sobrenome_contato">Sobrenome:</label>
                        <input id="sobrenome_contato" class="form-control" type="text" name="sobrenome" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="endereco_contato">Endereço:</label>
                        <input id="endereco_contato" class="form-control" type="text" name="endereco" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="num_endereco_contato">N°:</label>
                        <input id="num_endereco_contato" class="form-control" type="text" name="num_endereco" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="cidade_contato">Cidade:</label>
                        <input id="cidade_contato" class="form-control" type="text" name="cidade" required>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="telefone_contato">Telefone:</label>
                        <input id="telefone_contato" class="form-control" type="text" name="telefone" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-default">Cadastrar</button>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/parts/footer.php'; ?>