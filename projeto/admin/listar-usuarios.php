<?php 

// Configurações Gerais
require_once "../src/config.php";

try 
{
    if ($_GET)
    {
        $id = (int) ($_GET['excluir'] ?? 0);
        excluir_usuario($id);
        set_app_mensagem('Usuário excluído com sucesso!');
    }
}
catch(Exception $exc)
{
    set_app_mensagem($exc->getMessage(), 'erro');
}


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

    <?php show_app_mensagem(); ?>

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

            <?php foreach (get_usuarios() as $usuario) : ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= $usuario['login'] ?></td>
                    <td><?= $usuario['ativo'] ? 'Sim' : 'Não' ?></td>
                    <td><a href="editar-usuario.php?id=<?= $usuario['id'] ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
                    <td><a href="listar-usuarios.php?excluir=<?= $usuario['id'] ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
<?php require_once 'includes/rodape-admin.php'; ?>