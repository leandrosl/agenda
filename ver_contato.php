<?php

require_once './config.php';
require_once './vendor/autoload.php';

$controller = new Agenda\Controllers\ContatoController;

if (isset($_GET['id'])) {
    $contato = $controller->getContatoPorId($_GET['id']);    
}
else {
    $contato = null;
}

?>

<?php

include_once './parts/header.php';
include_once './parts/navbar.php';

?>
    <div class="container">
        <?php if ($contato): ?>
            <div class="row">
                <div class="col-md-6">
                    <h3>Nome:</h3>
                </div>
                <div class="col-md-6">
                    <h3>Sobrenome:</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $contato->nome; ?>
                </div>
                <div class="col-md-6">
                    <?= $contato->sobrenome; ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-9">
                    <h3>Endereço:</h3>
                </div>
                <div class="col-md-3">
                    <h3>Nº:</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <?= $contato->endereco; ?>
                </div>
                <div class="col-md-3">
                    <?= $contato->num_endereco; ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-7">
                    <h3>Cidade:</h3>
                </div>
                <div class="col-md-5">
                    <h3>Telefone:</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <?= $contato->cidade; ?>
                </div>
                <div class="col-md-5">
                    <?= $contato->telefone; ?>
                </div>
            </div>
        <?php else: ?>
            <h3>Nenhum contato encontrado</h3>
        <?php endif; ?>
    </div>

<?php include_once './parts/footer.php'; ?>