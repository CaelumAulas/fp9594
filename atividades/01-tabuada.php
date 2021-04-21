<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabuada</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
</head>
<body>
    <div class="container py-5">
        <h2>Tabuada</h2>
        <p>
            Informe um número qualquer para visualizar a tabuada:
        </p>

        <form method="POST" action="">
            <div class="form-group">
                <label for="numero">Número:</label>
                <input type="number" name="numero" class="form-control" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary">
                    Ver Tabuada
                </button>
            </div>
        </form>
        
        <hr>

        <?php

            // Insira sua lógica aqui conforme o passo a passo abaixo
            # 01) Crie uma variável chamada $numero que receba o valor do parâmetro 'numero' (caso exista) ou null caso não exista
            # 02) Verifique se o valor da variável $numero é TRUTHY
            # 03) Se for, crie um looping FOR de 1 a 10
            # 04) Crie uma variável chamada $resultado e guarde nela resultado do cálculo de cada linha da tabuada
            # 05) Exiba o resultado no formato "NUMERO x CONTADOR = RESULTADO"

            $numero = $_POST['numero'] ?? null;

            if ($numero) 
            {
                for ($c = 1; $c <= 10; $c++)
                {
                    $resultado = $numero * $c;
                    print "$numero x $c = $resultado <br>";
                }
            }

        ?>
    </div>
</body>
</html>