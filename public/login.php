<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISEP Ginásio</title>
    <!-- Bootstrap CSS & custom CSS -->
    <link rel="stylesheet" href="../frontend/assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../frontend/assets/css/estilos.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="../frontend/assets/img/gym125.png" type="image/png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../frontend/assets/fontawesome/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-sm-8 col-10">
                <!-- Card e restante conteúdo -->
            </div>
        </div>
    </div>
    <div class="card p-4 ">
        <div class="d-flex align-items-center justify-content-center my-4">
            <!-- Imagem do ginásio + texto -->
            <img src="../frontend/assets/img/gym125.png">
            <h2><strong>ISEP - Ginásio</strong></h2>
        </div>

        <div class="row">
            <div class="col">
                <!-- Formulário -->
                <form action="../backend/index.html" method="post"><!-- Action permite enviar o utilizar para uma nova pagina após o formulário enquanto o post permite leva os dados em segurança-->
                    <div class="mb-3">
                        <!-- Utilizador -->
                        <label for="email" class="form-label">Utilizador</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <!-- Submit -->
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-secondary px-4">
                            Entrar <i class="fa-solid fa-right-to-bracket ms-2"></i>
                        </button>
                    </div>
                    <!-- Registo -->
                    <p>Não tem conta? <a href="#">Registe-se aqui</a></p>
                    <div>
                        <!-- Erros -->
                        <div class="alert alert-danger p-2 text-center">
                            Erro: Utilizador não registado
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    </div>
    </div>
    </div>
    <!-- Bootstrap JS and custom JS -->
    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>