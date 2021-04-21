<?php 

ini_set('display_errors', 'Off'); // desabilita a exibição de mensagens de erro do PHP

$conexao = mysqli_connect('localhost', 'root2', 'admin', 'cadastros_caelum');
if (mysqli_connect_errno()) {
    die('Não foi possível se conectar à base de dados!');
}

$lista_registros = array();
$resultado = mysqli_query($conexao, "SELECT * FROM alunos");

if ($resultado) 
{
    $lista_registros = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

print '<pre>';
print_r($lista_registros);
print '</pre>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQLi | CRUD Básico</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body class="p-3">
    
    <div class="container py-5">
        <h1>Alunos | Caelum</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Idade</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista_registros as $registro) : ?>
                    <tr>
                        <td><?= $registro['id'] ?></td>
                        <td><?= $registro['nome'] ?></td>
                        <td><?= $registro['email'] ?></td>
                        <td><?= $registro['idade'] ?> anos</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</body>
</html>