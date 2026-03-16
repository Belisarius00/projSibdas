<?php
session_start();
// If user is already logged in, redirect them to the back office
if (isset($_SESSION['user_id'])) {
    header("Location: ../backoffice/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedTech Solutions | Front Office</title>
    <link href="assets/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">MedTech Solutions</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="#sobre">Sobre Nós</a></li>
                </ul>
                
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" id="loginDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Acesso Hospital
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-4 shadow" style="width: 300px;" aria-labelledby="loginDropdown">
                        <h5 class="mb-3">Login no Sistema</h5>
                        
                        <?php if(isset($_SESSION['login_error'])): ?>
                            <div class="alert alert-danger py-1 px-2" role="alert">
                                <?= $_SESSION['login_error']; unset($_SESSION['login_error']); ?>
                            </div>
                        <?php endif; ?>

                        <form action="../login/login_process.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Entrar no Back Office</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5 text-center">
        <h1 class="display-4 fw-bold text-primary mb-3">Gestão Inteligente de Equipamentos Médicos</h1>
        <p class="lead text-muted mb-5">Apoiamos hospitais no controlo do ciclo de vida tecnológico.</p>
        <img src="assets/img/hero.jpg" class="img-fluid rounded shadow-lg" alt="Hospital Technology">
    </div>

    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>