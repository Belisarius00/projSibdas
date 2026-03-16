<?php
// login/login_process.php
session_start();
// PATH CHANGE: Tell PHP to go up one level (../) to find the config folder
require_once '../config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    try {
        $stmt = $pdo->prepare("SELECT id, nome, email, password, perfil FROM utilizadores WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nome'] = $user['nome'];
            $_SESSION['user_perfil'] = $user['perfil'];

            header("Location: ../backoffice/dashboard.php");
            exit;
        } else {
            $_SESSION['login_error'] = "Credenciais inválidas.";
            header("Location: ../frontoffice/index.php"); // Path change here too
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['login_error'] = "Erro no sistema: " . $e->getMessage();
        header("Location: ../frontoffice/index.php"); // Path change here too
        exit;
    }
} else {
    header("Location: ../frontoffice/index.php"); // Path change here too
    exit;
}
?>