<?php 

// Configurações Gerais
require_once "../src/config.php";
use AutoCaelum\DAO\VeiculoDAO;

try 
{
    $veiculoDao = new VeiculoDAO();

    if ($_GET)
    {
        $id = (int) ($_GET['excluir'] ?? 0);
        $veiculoDao->excluir($id);
        set_app_mensagem('Veículo excluído com sucesso!');
    }
}
catch(Exception $exc)
{
    set_app_mensagem($exc->getMessage(), 'erro');
}

$titulo_pagina = "Veículos";
require_once 'includes/cabecalho-admin.php';
?>
    <header class="bg-secondary d-flex justify-content-between align-items-center p-4 mb-3">
        <h2 class="text-white">
            Veículos
        </h2>
    </header>
    <p>
        Confira abaixo a lista dos veículos cadastradas.
    </p>

    <?php show_app_mensagem(); ?>

    <table class="table table-hover">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="10%">Foto</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Preço</th>
                <th colspan="2" width="10%"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($veiculoDao->listar() as $veiculo) : ?>
                <tr>
                    <td><?= $veiculo->getId() ?></td>
                    <td>
                        <img src="../img/veiculos/<?= $veiculo->getFoto() ?: "../sem-foto.jpg" ?>" class="img-thumbnail" />
                    </td>
                    <td><?= $veiculo->getModelo() ?></td>
                    <td><?= $veiculo->getMarca()->getNome() ?: 'SEM MARCA' ?></td>
                    <td>R$ <?= number_format($veiculo->getPreco(), 2, ',', '.') ?></td>
                    <td><a href="editar-veiculo.php?id=<?= $veiculo->getId() ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
                    <td><a href="listar-veiculos.php?excluir=<?= $veiculo->getId() ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php require_once 'includes/rodape-admin.php'; ?>