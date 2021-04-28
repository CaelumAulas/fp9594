<?php 

// Configurações Gerais
require_once "../src/config.php";

try 
{
    if ($_POST)
    {
        $id = (int) ($_POST['veiculo_id'] ?? 0);
        $modelo = $_POST['modelo'] ?? '';
        $marca_id = (int) ($_POST['marca'] ?? 0);
        $preco = (float) ($_POST['preco'] ?? 0);
        $foto = upload_imagem('foto', 'veiculos');
        $descricao = $_POST['descricao'] ?? '';

        atualizar_veiculo($modelo, $marca_id, $preco, $foto, $descricao, $id);
        unset($_POST);
        set_app_mensagem('Veículo atualizado com sucesso!');
    }
}
catch(Exception $exc)
{
    set_app_mensagem($exc->getMessage(), 'erro');
}

$id = (int) ($_GET['id'] ?? 0);
$veiculo_info = get_veiculo_por_id($id);
if (!$veiculo_info) {
    header('Location: listar-veiculos.php');
    exit;
}

$titulo_pagina = "Editar Veículo";
require_once 'includes/cabecalho-admin.php';
?>
    <header class="bg-secondary d-flex justify-content-between align-items-center p-4 mb-3">
        <h2 class="text-white">
            <span class="text-light font-weight-light">
                Veículos
            </span> / Editar
        </h2>
    </header>
    <p>
        Utilize o formulário abaixo para atualizar um veículo.
    </p>

    <?php show_app_mensagem(); ?>

    <form method="POST" class="row" enctype="multipart/form-data">
        <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="marca">Modelo:</label>
            </div>
            <input type="text" name="modelo" id="modelo" class="form-control" placeholder="" value="<?= $veiculo_info['modelo'] ?>" />
        </div>
        <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="marca">Marca:</label>
            </div>
            <select class="custom-select" id="marca" name="marca">
                <option>Selecione...</option>

                <?php $marca_id = $veiculo_info['marca_id']; ?>
                <?php foreach (get_marcas() as $marca) : ?>
                    <option value="<?= $marca['id'] ?>" <?= $marca_id == $marca['id'] ? 'selected' : null ?>>
                        <?= $marca['marca'] ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </div>
        <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="preco">Preço:</label>
            </div>
            <input type="number" name="preco" id="preco" class="form-control" placeholder="" value="<?= $veiculo_info['preco'] ?>" />
        </div>
        <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="foto">Foto:</label>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="foto" name="foto">
                <label class="custom-file-label" for="inputGroupFile01">Escolher arquivo...</label>
            </div>
        </div>
        <div class="input-group col-md-12 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="descricao">Descrição:</label>
            </div>
            <textarea class="form-control" name="descricao" id="descricao" rows="5"><?= $veiculo_info['descricao'] ?></textarea>
        </div>
        <div class="input-group col-md-12">
            <button class="btn btn-primary px-5">
                <i class="far fa-save"></i> Salvar
            </button>
            <input type="hidden" name="veiculo_id" value="<?= $veiculo_info['id'] ?>" />
        </div>
    </form>
<?php require_once 'includes/rodape-admin.php'; ?>