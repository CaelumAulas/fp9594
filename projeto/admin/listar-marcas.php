<?php 

// Configurações Gerais 
require_once '../src/config.php';
use AutoCaelum\DAO\MarcaDAO;

try 
{
    $marcaDao = new MarcaDAO();

    if ($_GET)
    {
        $id = (int) ($_GET['excluir'] ?? 0);
        $marcaDao->excluir($id);
        set_app_mensagem('Marca excluída com sucesso!');
    }
}
catch(Exception $exc)
{
    set_app_mensagem($exc->getMessage(), 'erro');
}

$titulo_pagina = "Marcas";
require_once 'includes/cabecalho-admin.php';
?>
    <header class="bg-secondary d-flex justify-content-between align-items-center p-4 mb-3">
        <h2 class="text-white">
            Marcas
        </h2>
    </header>
    <p>
        Confira abaixo a lista das marcas cadastradas.
    </p>

    <?php show_app_mensagem(); ?>

    <table class="table table-hover">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Marcas</th>
                <th colspan="2" width="10%"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($marcaDao->listar() as $marca) : ?>
                <tr>
                    <td><?= $marca->getId() ?></td>
                    <td><?= $marca->getNome() ?></td>
                    <td><a href="editar-marca.php?id=<?= $marca->getId() ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
                    <td><a href="listar-marcas.php?excluir=<?= $marca->getId() ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php require_once 'includes/rodape-admin.php'; ?>