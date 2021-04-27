<?php 

// Configurações Gerais
require_once "../src/config.php";

try 
{
    if ($_POST)
    {
        $modelo = $_POST['modelo'] ?? '';
        $marca_id = (int) ($_POST['marca'] ?? 0);
        $preco = (float) ($_POST['preco'] ?? 0);
        $foto = $_POST['foto'] ?? '';
        $descricao = $_POST['descricao'] ?? '';

        cadastrar_veiculo($modelo, $marca_id, $preco, $foto, $descricao);
        unset($_POST);
        set_app_mensagem('Veículo cadastrado com sucesso!');
    }
}
catch(Exception $exc)
{
    set_app_mensagem($exc->getMessage(), 'erro');
}

$titulo_pagina = "Cadastrar Veículo";
require_once 'includes/cabecalho-admin.php';
?>
    <header class="bg-secondary d-flex justify-content-between align-items-center p-4 mb-3">
        <h2 class="text-white">
            <span class="text-light font-weight-light">
                Veículos
            </span> / Cadastrar
        </h2>
    </header>
    <p>
        Utilize o formulário abaixo para cadastrar um novo veículo.
    </p>

    <?php show_app_mensagem(); ?>

    <form method="POST" class="row">
        <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="marca">Modelo:</label>
            </div>
            <input type="text" name="modelo" id="modelo" class="form-control" placeholder="" value="<?= $_POST['modelo'] ?? '' ?>" />
        </div>
        <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="marca">Marca:</label>
            </div>
            <select class="custom-select" id="marca" name="marca">
                <option>Selecione...</option>

                <?php $marca_id = $_POST['marca'] ?? 0; ?>
                <?php foreach (get_marcas() as $marca) : ?>
                    <option value="<?= $marca['id'] ?>" <?= ($marca_id == $marca['id']) ? 'selected' : null ?> >
                        <?= $marca['marca'] ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </div>
        <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="preco">Preço:</label>
            </div>
            <input type="number" name="preco" id="preco" class="form-control" placeholder="" value="<?= $_POST['preco'] ?? '' ?>" />
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
            <textarea class="form-control" name="descricao" id="descricao" rows="5"><?= $_POST['descricao'] ?? '' ?></textarea>
        </div>
        <div class="input-group col-md-12">
            <button class="btn btn-primary px-5">
                <i class="far fa-save"></i> Salvar
            </button>
        </div>
    </form>
<?php require_once 'includes/rodape-admin.php'; ?>