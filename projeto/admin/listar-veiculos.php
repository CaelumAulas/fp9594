<?php 

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
            <tr>
                <td>1</td>
                <td>
                    <img src="../img/sem-foto.jpg" class="img-thumbnail" />
                </td>
                <td>Cruze</td>
                <td>Chevrolet</td>
                <td>R$ 18.000,00</td>
                <td><a href="editar-veiculo.php" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
                <td><a href="#" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
            </tr>
        </tbody>
    </table>
<?php require_once 'includes/rodape-admin.php'; ?>