<?php 

// ini_set('display_errors', 'Off');

$conexao = mysqli_connect('localhost', 'root2', 'admin', 'caelum');
if (mysqli_connect_errno()) {
    die('Não foi possível se conectar à base de dados!');
}

try 
{
    // Se há dados enviados por POST
    if ($_POST)
    {
        // throw expression = PHP 8.0+
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Nome é obrigatório!');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?: throw new Exception('E-mail inválido!');
        $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Assunto é obrigatório!');
        $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Mensagem é obrigatório!');       

        $sql = "INSERT INTO mensagens_contato (nome_completo, email, assunto, mensagem) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, 'ssss', $nome, $email, $assunto, $mensagem);
        $resultado = mysqli_stmt_execute($stmt);
        
        if (!$resultado) {
            throw new Exception('Erro ao realizar o cadastro da mensagem!');
        }

        unset($_POST);
        $msg = "
            <div class=\"alert alert-success\">
                Cadastro realizado com sucesso!
            </div>
        ";
    }

    if ($_GET)
    {
        $id = filter_input(INPUT_GET, 'excluir_id', FILTER_VALIDATE_INT);
        if ($id === false or $id <= 0) {
            throw new Exception('ID informado é inválido!');
        }

        $sql = "DELETE FROM mensagens_contato WHERE id = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        /**
         * s = string
         * i = integer
         * d = double/decimal/float
         * b = blob
         */
        mysqli_stmt_bind_param($stmt, 'i', $id);
        $resultado = mysqli_stmt_execute($stmt);
        $linhas_afetadas = mysqli_stmt_affected_rows($stmt); // retorna quantas linhas foram afetadas pela operação DELETE, INSERT ou UPDATE

        if (!$resultado) {
            throw new Exception('Erro ao realizar a exclusão da informação!');
        }

        if (!$linhas_afetadas) {
            throw new Exception('Nenhum registro encontrado para o ID fornecido!');
        }

        $msg = "
            <div class=\"alert alert-success\">
                Exclusão realizada com sucesso!
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

$lista_contatos = array();
$resultado = mysqli_query($conexao, "SELECT * FROM mensagens_contato");

if ($resultado)
{
    $lista_contatos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de E-mails</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>
<body>
    <div class="container py-5">

        <h2>Cadastro de E-mails</h2>
        <p>
            Utilize o formulário abaixo para realizar o cadastro de mensagens de e-mails:
        </p>

        <!-- Exibir a mensagem de erro ou de sucesso aqui -->
        <?= $msg ?? null ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nome">Nome completo:</label>
                <input type="text" name="nome" class="form-control" value="<?= $_POST['nome'] ?? '' ?>" />
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" class="form-control" value="<?= $_POST['email'] ?? '' ?>" />
            </div>
            <div class="form-group">
                <label for="assunto">Assunto:</label>
                <input type="text" name="assunto" class="form-control" value="<?= $_POST['assunto'] ?? '' ?>" />
            </div>
            <div class="form-group">
                <label for="mensagem">Mensagem:</label>
                <textarea name="mensagem" class="form-control" rows="5"><?= $_POST['mensagem'] ?? '' ?></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">
                    Salvar
                </button>
            </div>
        </form>

        <hr>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Assunto</th>
                    <th>Mensagem</th>
                    <th width="5%"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_contatos as $contato) : ?>
                    <tr>
                        <td><?= $contato['id'] ?></td>
                        <td><?= $contato['nome_completo'] ?></td>
                        <td><?= $contato['email'] ?></td>
                        <td><?= $contato['assunto'] ?></td>
                        <td><?= $contato['mensagem'] ?></td>
                        <td>
                            <a href="02-cadastro.php?excluir_id=<?= $contato['id'] ?>" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>