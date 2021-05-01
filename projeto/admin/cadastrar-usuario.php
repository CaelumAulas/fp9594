<?php 

// Configurações Gerais
require_once '../src/config.php';
use AutoCaelum\DAO\UsuarioDAO;
use AutoCaelum\Models\Usuario;

try 
{
    if ($_POST)
    {
        $login = $_POST['usuario'] ?? "";
        $senha = $_POST['senha'] ?? "";
        $csenha = $_POST['csenha'] ?? "";
        $ativo = isset($_POST['ativo']);
        
        $user = new Usuario( $login, $senha, $ativo );
        if ($senha != $csenha) {
            throw new Exception('Senha e confirmação de senha devem ser iguais!');
        }

        $userDao = new UsuarioDAO($user);
        $userDao->cadastrar();
        
        unset($_POST);
        set_app_mensagem('Usuário cadastrado com sucesso!');
    }
}
catch(Exception $exc)
{
    set_app_mensagem($exc->getMessage(), 'erro');
}

$titulo_pagina = "Cadastrar Usuário";
require_once 'includes/cabecalho-admin.php';
?>
    <header class="bg-secondary d-flex justify-content-between align-items-center p-4 mb-3">
        <h2 class="text-white">
            <span class="text-light font-weight-light">
                Usuários
            </span> / Cadastrar
        </h2>
    </header>
    <p>
        Utilize o formulário abaixo para cadastrar um novo usuário.
    </p>

    <?php show_app_mensagem(); ?>

    <form method="POST" class="row">
        <div class="input-group col-md-12 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="usuario">Usuário:</label>
            </div>
            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="" value="<?= $_POST['usuario'] ?? '' ?>" />
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
                    <input type="checkbox" id="ativo" name="ativo" <?= (isset($_POST['ativo'])) ? 'checked' : null ?> />
                </div>
            </div>
            <label class="form-control" for="ativo">Ativo?</label>
        </div>
        <div class="input-group col-12">
            <button class="btn btn-primary px-5">
                <i class="far fa-save"></i> Salvar
            </button>
        </div>
    </form>
<?php require_once 'includes/rodape-admin.php'; ?>