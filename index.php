<?php

require_once __DIR__ . '/config.php';
require_once  __DIR__ . "/vendor/autoload.php";

$controller = new Agenda\Controllers\ContatoController();

$contatos = $controller->getContatos();

?>

<?php include_once "parts/header.php"; ?>


<div class="container">
    <h1>Todos os Contatos</h1>
    <a href="novo_contato.php">Novo Contato</a>

    <?php if ( count($contatos) > 0 ): ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Endereço</th>
                    <th>N°</th>
                    <th>Cidade</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $contatos as $contato ): ?>
                <tr>
                    <td><?= $contato->nome ?></td>
                    <td><?= $contato->sobrenome ?></td>
                    <td><?= $contato->endereco ?></td>
                    <td><?= $contato->num_endereco ?></td>
                    <td><?= $contato->cidade ?></td>
                    <td><?= $contato->telefone ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include_once  "parts/footer.php"; ?>