<?php 

// Configurações Gerais
require_once '../src/config.php';
use AutoCaelum\Models\Marca;
use AutoCaelum\DAO\MarcaDAO;

try
{
    $marcaDao = new MarcaDAO();

    if ($_POST)
    {
        $id = (int) ($_POST['marca_id'] ?? 0);
        $nome_marca = $_POST['marca'] ?? "";
    
        $marca = new Marca($nome_marca, $id);
        $marcaDao->setDataObj($marca);
        $marcaDao->atualizar();

        set_app_mensagem('Marca atualizada com sucesso!');
    }
}
catch(Exception $exc)
{
    set_app_mensagem($exc->getMessage(), 'erro');
}

$id = (int) ($_GET['id'] ?? 0);
$marca_info = $marcaDao->getPorId($id);

if (!$marca_info) {
    header('Location: listar-marcas.php');
    exit;
}

$titulo_pagina = "Editar Marca";
require_once 'includes/cabecalho-admin.php';
?>
    <header class="bg-secondary d-flex justify-content-between align-items-center p-4 mb-3">
        <h2 class="text-white">
            <span class="text-light font-weight-light">
                Marcas
            </span> / Editar
        </h2>
    </header>
    <p>
        Utilize o formulário abaixo para atualizar uma marca.
    </p>

    <?php show_app_mensagem(); ?>

    <form method="POST" class="row">
        <div class="input-group col-md-9">
            <div class="input-group-prepend">
                <label class="input-group-text" for="marca">Nome da Marca:</label>
            </div>
            <input type="text" name="marca" id="marca" class="form-control" placeholder="" value="<?= $marca_info->getNome(); ?>" />
        </div>
        <div class="input-group col-md-3">
            <button class="btn btn-primary px-5 w-100">
                <i class="far fa-save"></i> Salvar
            </button>
            <input type="hidden" name="marca_id" value="<?= $marca_info->getId(); ?>" />
        </div>
    </form>
<?php require_once 'includes/rodape-admin.php'; ?>