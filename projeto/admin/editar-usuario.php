<?php 

// Configurações Gerais
require_once "../src/config.php";
use AutoCaelum\DAO\UsuarioDAO;
use AutoCaelum\Models\Usuario;

try 
{
    $userDao = new UsuarioDAO();

    if ($_POST)
    {
        $id = (int) ($_POST['usuario_id'] ?? 0);
        $login = $_POST['usuario'] ?? "";
        $senha = $_POST['senha'] ?? "";
        $csenha = $_POST['csenha'] ?? "";
        $ativo = isset($_POST['ativo']);

        $user = new Usuario( $login, ativo: $ativo, id: $id );

        if ($senha || $csenha) 
        {
            if ($senha == $csenha) {
                $user->setSenha($senha);
            }
            else {
                throw new Exception('Senha e confirmação devem ser iguais!');
            }
        }

        $userDao->setDataObj($user);
        $userDao->atualizar();
        set_app_mensagem('Usuário atualizado com sucesso!');
    }
}
catch(Exception $exc)
{
    set_app_mensagem($exc->getMessage(), 'erro');
}

$id = (int) ($_GET['id'] ?? 0);
$usuario_info = $userDao->getPorId($id);

if (!$usuario_info) {
    header('Location: listar-usuarios.php');
    exit;
}

$titulo_pagina = "Editar Usuário";
require_once 'includes/cabecalho-admin.php';
?>
    <header class="bg-secondary d-flex justify-content-between align-items-center p-4 mb-3">
        <h2 class="text-white">
            <span class="text-light font-weight-light">
                Usuários
            </span> / Editar
        </h2>
    </header>
    <p>
        Utilize o formulário abaixo para atualizar um usuário.
    </p>

    <?php show_app_mensagem(); ?>

    <form method="POST" class="row">
        <div class="input-group col-md-12 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="usuario">Usuário:</label>
            </div>
            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="" value="<?= $usuario_info->getLogin() ?>" />
        </div>
        <div class="input-group col-md-4 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="senha">Senha:</label>
            </div>
            <input type="password" name="senha" id="senha" class="form-control" placeholder="" />
        </div>
        <div class="input-group col-md-4 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="csenha">Confirmar Senha:</label>
            </div>
            <input type="password" name="csenha" id="csenha" class="form-control" placeholder="" />
        </div>
        <div class="input-group col-md-4 mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="checkbox" id="ativo" name="ativo" <?= $usuario_info->getAtivo() ? 'checked' : null ?> />
                </div>
            </div>
            <label class="form-control" for="ativo">Ativo?</label>
        </div>
        <div class="input-group col-12">
            <button class="btn btn-primary px-5">
                <i class="far fa-save"></i> Salvar
            </button>
            <input type="hidden" name="usuario_id" value="<?= $usuario_info->getId() ?>" />
        </div>
    </form>
<?php require_once 'includes/rodape-admin.php'; ?>