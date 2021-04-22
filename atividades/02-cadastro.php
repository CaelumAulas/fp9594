<?php 

// insira sua lógica aqui

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
            Utilize o formulário abaixo para realizar o cadastro de e-mails para recebimento de newsletter:
        </p>

        <!-- Exibir a mensagem de erro ou de sucesso aqui -->

        <form method="POST" action="">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" class="form-control" />
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" class="form-control" />
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
                    <th width="5%"></th>
                </tr>
            </thead>
            <tbody>
                
                    <tr>
                        <td>1</td>
                        <td>Alberto</td>
                        <td>alberto@gmail.com</td>
                        <td>
                            <a href="02-cadastro.php?excluir=" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
</body>
</html>