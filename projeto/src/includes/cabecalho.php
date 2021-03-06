<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?> | <?= $titulo_pagina ?? '' ?></title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <style>
        .jumbotron { border-radius: 0; }
    </style>
</head>
<body>
    <div class="container">
        <header class="jumbotron pt-5 pb-3 my-0">
            <img src="img/logo-autocaelum.png" class="mx-auto d-block" alt="<?= SITE_NAME ?>" />
            <hr class="my-4">
            <p class="lead text-center">
                <?= $texto_destaque ?? '' ?>
            </p>
        </header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mr-auto">

                    <?php foreach (get_menu() as $chave => $menu_item) : ?>
                        <a class="nav-item nav-link <?= ($chave == $menu_ativo) ? "active" : null ?>" href="<?= $menu_item['url'] ?>">
                            <?= $menu_item['texto'] ?>
                        </a>
                    <?php endforeach; ?>

                </div>
                <a href="admin/login.php" class="btn btn-primary">
                    <i class="fas fa-lock"></i> ??rea Administrativa
                </a>
            </div>
        </nav>
        <hr class="m-0">
        <main class="py-4">