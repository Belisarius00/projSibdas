<?php
// backoffice/views/localizacoes/delete.php
session_start();

// We need the DB connection, but NOT the header/footer since this page never actually "displays"
require_once __DIR__ . '/../../../config/db_connect.php';

// Security check: only logged in users can delete
if (!isset($_SESSION['user_id'])) {
    header("Location: /PROJECTO/frontoffice/index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM localizacoes WHERE id = :id");
        $stmt->execute([':id' => $id]);
        
        // If it worked, set a success message
        $_SESSION['success_msg'] = "Localização removida com sucesso!";
        
    } catch (PDOException $e) {
        // SQLSTATE 23000 is the specific code for a Foreign Key Constraint Violation
        if ($e->getCode() == 23000) {
            $_SESSION['error_msg'] = "Não é possível remover esta localização porque existem equipamentos registados nela.";
        } else {
            // Some other database error
            $_SESSION['error_msg'] = "Erro ao remover a localização: " . $e->getMessage();
        }
    }
}

// Bounce back to the listing page
header("Location: index.php");
exit;