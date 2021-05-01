<?php 

// Configurações Gerais
require_once "../src/config.php";
use AutoCaelum\DAO\UsuarioDAO;

try 
{
    $userDao = new UsuarioDAO();

    if ($_GET)
    {
        $id = (int) ($_GET['excluir'] ?? 0);
        $userDao->excluir($id);
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

            <?php foreach ($userDao->listar() as $usuario) : ?>
                <tr>
                    <td><?= $usuario->getId() ?></td>
                    <td><?= $usuario->getLogin() ?></td>
                    <td><?= $usuario->getAtivo() ? 'Sim' : 'Não' ?></td>
                    <td><a href="editar-usuario.php?id=<?= $usuario->getId() ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
                    <td><a href="listar-usuarios.php?excluir=<?= $usuario->getId() ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
<?php require_once 'includes/rodape-admin.php'; ?>