<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoCaelum | Concessionária de Veículos</title>
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
            <img src="img/logo-autocaelum.png" class="mx-auto d-block" alt="AutoCaelum" />
            <hr class="my-4">
            <p class="lead text-center">
                Confira na listagem abaixo os veículos disponíveis em nosso estoque.
            </p>
        </header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mr-auto">
                    <a class="nav-item nav-link active" href="index.php">Estoque</a>
                    <a class="nav-item nav-link" href="sobre.php">Sobre</a>
                    <a class="nav-item nav-link" href="contato.php">Contato</a>
                </div>
                <a href="admin/login.php" class="btn btn-primary">
                    <i class="fas fa-lock"></i> Área Administrativa
                </a>
            </div>
        </nav>
        <hr class="m-0">
        <main class="py-4">
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
        </main>
        <hr>
        <footer class="text-center">
            <p>Copyright &copy; AutoCaelum - Todos os direitos reservados.</p>
        </footer>
    </div>
</body>
</html>