<?php 

    print '<pre>';
    print_r($_POST);
    print '</pre>';

    $opcoes_linguagens = array('PHP', 'JavaScript', 'ColdFusion', 'C#', 'Java', 'Go', 'Python');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$_GET e $_POST</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>

<body class="p-4">

    <form method="POST" class="container py-5">

        <?php if ($_POST) : ?>
            <div class="alert alert-success">
                <strong>Nome: </strong> <?= $_POST['nome'] ?: 'Não informado!' ?> <br>
                <strong>E-mail: </strong> <?= $_POST['email'] ?: 'Não informado!' ?> <br>
                <strong>Mensagem: </strong> <?= $_POST['mensagem'] ?: 'Não informado!' ?> <br>
                <strong>Sexo:</strong> <?= $_POST['sexo'] ?? 'Não informado!' ?> <br>
                <strong>Linguagens Preferidas:</strong> <?= (isset($_POST['linguagens_preferidas'])) ? implode(', ', $_POST['linguagens_preferidas']) : 'Não informado!' ?>
            </div>
        <?php endif; ?>

        <h1>Processando dados com PHP</h1>
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" />
        </div>

        <div class="form-group">
            <label>E-mail:</label>
            <input type="email" name="email" class="form-control" />
        </div>

        <div class="form-group">
            <label>Mensagem:</label>
            <textarea name="mensagem" class="form-control" rows="10"></textarea>
        </div>

        <div class="form-group">
            <strong>Sexo:</strong><br>
            <label>
                <input type="radio" name="sexo" value="M"> Masculino
            </label>
            <label>
                <input type="radio" name="sexo" value="F"> Feminino
            </label>
        </div>

        <div class="form-group">
            <strong>Linguagens Preferidas:</strong><br>
            <?php foreach ($opcoes_linguagens as $linguagem) : ?>
                <label>
                    <input type="checkbox" name="linguagens_preferidas[]" value="<?= $linguagem ?>" /> <?= $linguagem ?>
                </label>
            <?php endforeach; ?>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">
                Enviar
            </button>
        </div>
    </form>


</body>

</html>