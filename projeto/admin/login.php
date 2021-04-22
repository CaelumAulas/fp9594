<?php 

$titulo_pagina = "Login";
require_once 'includes/cabecalho-admin.php';
?>
    <header class="bg-secondary d-flex justify-content-between align-items-center p-4 mb-3">
        <h2 class="text-white">
            Login 
        </h2>
    </header>
    <p>
        Preencha o formulário abaixo para ter acesso à Área Administrativa:
    </p>
    <hr>
    <form action="" class="row" method="POST">
        <div class="input-group col-6">
            <div class="input-group-prepend">
                <label class="input-group-text" for="usuario"><i class="fas fa-user-circle"></i></label>
            </div>
            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuário:" />
        </div>
        <div class="input-group col-6">
            <div class="input-group-prepend">
                <label class="input-group-text" for="senha"><i class="fas fa-key"></i></label>
            </div>
            <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha:" />
        </div>
        <div class="form-group col-12 mt-3">
            <button class="btn btn-primary px-5">
                <i class="fas fa-sign-in-alt"></i> Entrar
            </button>
        </div>
    </form>

<?php require_once 'includes/rodape-admin.php'; ?>