<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoCaelum | <?= $titulo_pagina ?? 'Admin' ?></title>
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <style>
        .jumbotron { border-radius: 0; }
        .custom-file-label::after { content: "Selecionar"}
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
        <a class="navbar-brand" href="index.php">
            <img src="../img/logo-admin.png" width="30" height="30" class="d-inline-block align-top logo mr-2" alt="">
            Administração
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="##navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Veículos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="cadastrar-veiculo.php">Cadastrar Veículo</a>
                        <a class="dropdown-item" href="listar-veiculos.php">Listar Veículos</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Usuários
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <a class="dropdown-item" href="cadastrar-usuario.php">Cadastrar Usuário</a>
                        <a class="dropdown-item" href="listar-usuarios.php">Listar Usuários</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Marcas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                        <a class="dropdown-item" href="cadastrar-marca.php">Cadastrar Marca</a>
                        <a class="dropdown-item" href="listar-marcas.php">Listar Marcas</a>
                    </div>
                </li>
            </ul>

            <span class="d-inline-block mr-3 text-white">Olá, <strong>admin@admin.com.br</strong></span>
            <a href="index.php" class="btn btn-danger btn-sm">
                Logout
            </a>
        </div>
    </nav>
    <main class="container bg-white px-4 pb-4 pt-0 border border-top-0">