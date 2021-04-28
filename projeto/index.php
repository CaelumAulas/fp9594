<?php

/** Configurações Gerais */
require_once "src/config.php";

$marca_id = 0;
if ($_GET)
{
    $marca_id = (int) ($_GET['marca'] ?? 0);
}

$titulo_pagina = "Concessionária de Veículos";
$texto_destaque = "Confira na listagem abaixo os veículos disponíveis em nosso estoque.";
$menu_ativo = 'estoque';
require_once "src/includes/cabecalho.php";

?>
<div class="row mx-0">
    <form class="col-md-3 bg-light p-4" action="index.php" method="GET">
        <div class="form-group">
            <label>Marca:</label>
            <select name="marca" class="form-control">
                <option value="">-- Selecione --</option>

                <?php foreach (get_marcas() as $marca) : ?>
                    <option value="<?= $marca['id'] ?>">
                        <?= $marca['marca'] ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">
                Filtrar Veículos
            </button>
        </div>
    </form>
    <div class="col-md-9 p-4">
        <h1>Estoque</h1>
        <hr>

        <?php foreach (get_veiculos($marca_id) as $veiculo) : ?>

            <div class="row mx-0">
                <div class="col-md-3 px-0">
                    <img src="img/sem-foto.jpg" class="img-thumbnail" alt="" />
                </div>
                <div class="col-md-9">
                    <h3><?= $veiculo['modelo'] ?></h3>
                    <strong>Marca:</strong> <?= $veiculo['marca'] ?: 'SEM MARCA' ?> <br>
                    <strong>Preço:</strong> R$ <?= number_format($veiculo['preco'], 2, ',', '.') ?> <br>
                    <p>
                        <?= $veiculo['descricao'] ?>
                    </p>
                </div>
            </div>

            <hr class="my-4">

        <?php endforeach; ?>

    </div>
</div>

<?php

require_once "src/includes/rodape.php";
