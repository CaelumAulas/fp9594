<?php 

ini_set('display_errors', 'Off'); // desabilita a exibição de mensagens de erro do PHP

$msg = null;
$conexao = mysqli_connect('localhost', 'root2', 'admin', 'cadastros_caelum');
if (mysqli_connect_errno()) {
    die('Não foi possível se conectar à base de dados!');
}

try 
{
    // Se foram enviados dados via POST...
    if ($_POST)
    {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING) ?: throw new Exception('Nome é obrigatório!');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?: throw new Exception('E-mail inválido!'); // PHP 8
        $idade = filter_input(INPUT_POST, 'idade', FILTER_VALIDATE_INT, array(
                'options' => array( 'min_range' => 1, 'max_range' => 130 )
            )
        ) ?: throw new Exception('Idade inválida!');

        $sql = "INSERT INTO alunos(nome, email, idade) VALUES('$nome', '$email', $idade)";
        $resultado = mysqli_query($conexao, $sql);

        if (!$resultado) {
            throw new Exception('Erro ao realizar o cadastro das informações!');
        }

        $msg = "
            <div class=\"alert alert-success\">
                Cadastro realizado com sucesso!
            </div>
        ";
    }
}
catch(Exception $ex)
{
    $msg = "
        <div class=\"alert alert-danger\">
            {$ex->getMessage()}
        </div>
    ";
}

$lista_registros = array();
$resultado = mysqli_query($conexao, "SELECT * FROM alunos");

if ($resultado) 
{
    $lista_registros = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

// print '<pre>';
// print_r($lista_registros);
// print '</pre>';

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

        <?= $msg ?? '' ?>

        <form method="POST" class="my-4">
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="nome" class="form-control" value="<?= $_POST['nome'] ?? '' ?>" />
            </div>

            <div class="form-group">
                <label>E-mail:</label>
                <input type="email" name="email" class="form-control" value="<?= $_POST['email'] ?? '' ?>" />
            </div>

            <div class="form-group">
                <label>Idade:</label>
                <input type="number" name="idade" class="form-control" value="<?= $_POST['idade'] ?? '' ?>" />
            </div>

            <div class="form-group">
                <button class="btn btn-primary">
                    Cadastrar
                </button>
            </div>
        </form>

        <table class="table table-bordered my-4">
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