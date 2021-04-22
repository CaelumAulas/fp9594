<?php 

$titulo_pagina = "Usuários";
require_once 'includes/cabecalho-admin.php';
?>
    <header class="bg-secondary d-flex justify-content-between align-items-center p-4 mb-3">
        <h2 class="text-white">
            Usuários
        </h2>
    </header>
    <p>
        Confira abaixo a lista dos usuários cadastrados.
    </p>
    <table class="table table-hover">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Usuário</th>
                <th>Ativo?</th>
                <th colspan="2" width="10%"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>user1@site.com.br</td>
                <td>Sim</td>
                <td><a href="editar-usuario.php" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
                <td><a href="#" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
            </tr>
        </tbody>
    </table>
<?php require_once 'includes/rodape-admin.php'; ?>