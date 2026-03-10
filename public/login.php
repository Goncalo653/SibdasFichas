<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISEP Ginásio - Login</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="shortcut icon" href="assets/images/gym125.png" type="image/png">
    <link rel="stylesheet" href="assets/fontawesome/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container-fluid mt-5"> 
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-sm-8 col-10">
                <div class="card p-4">
                    <div class="d-flex align-items-center justify-content-center my-4"> 
                        <img src="assets/images/gym125.png" alt="Logótipo do ISEP Ginásio">
                        <h2><strong>ISEP - Ginásio</strong></h2>
                    </div>

                    <div class="row">
                        <div class="col">
                            <form action="../private/index.php" method="post"> 
                                <div class="mb-3">
                                    <label for="email" class="form-label">Utilizador</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <div class="mb-3 text-center">
                                    <button type="submit" class="btn btn-secondary px-4">
                                        Entrar <i class="fa-solid fa-right-to-bracket ms-2"></i>
                                    </button>
                                </div>
                                <div class="alert alert-danger p-2 text-center"> 
                                    Erro: Utilizador não registado
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script> 
</body>
</html>