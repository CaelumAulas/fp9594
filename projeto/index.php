<?php

/** Configurações Gerais */
require_once "src/config.php";

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
                <option value="1">Marca 1</option>
                <option value="2">Marca 2</option>
                <option value="3">Marca 3</option>
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

        <div class="row mx-0">
            <div class="col-md-3 px-0">
                <img src="img/sem-foto.jpg" class="img-thumbnail" alt="" />
            </div>
            <div class="col-md-9">
                <h3>Veículo #1</h3>
                <strong>Marca:</strong> Chevrolet <br>
                <strong>Preço:</strong> R$ 25.000,00 <br>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, quisquam? Sunt nesciunt dolores repellat nemo natus, accusantium repellendus pariatur minima necessitatibus rem minus inventore, ullam vel ducimus, libero iusto illum!
                </p>
            </div>
        </div>

        <hr class="my-4">

        <div class="row mx-0">
            <div class="col-md-3 px-0">
                <img src="img/sem-foto.jpg" class="img-thumbnail" alt="" />
            </div>
            <div class="col-md-9">
                <h3>Veículo #1</h3>
                <strong>Marca:</strong> Chevrolet <br>
                <strong>Preço:</strong> R$ 25.000,00 <br>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, quisquam? Sunt nesciunt dolores repellat nemo natus, accusantium repellendus pariatur minima necessitatibus rem minus inventore, ullam vel ducimus, libero iusto illum!
                </p>
            </div>
        </div>

    </div>
</div>

<?php

require_once "src/includes/rodape.php";
