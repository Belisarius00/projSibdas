<?php
// backoffice/includes/header.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /PROJECTO/frontoffice/index.php");
    exit;
}

require_once __DIR__ . '/../../config/db_connect.php';
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMMS Hospitalar</title>
    <link href="/PROJECTO/backoffice/assets/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="/PROJECTO/backoffice/assets/css/styles.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <nav id="top-navbar" class="navbar navbar-dark bg-primary fixed-top shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold m-0" id="menu-toggle" title="Clique para esconder/mostrar o menu">
                🏥 CMMS Hospitalar
            </span>
        </div>
    </nav>

    <div id="wrapper">