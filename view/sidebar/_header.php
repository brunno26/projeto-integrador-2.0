<?php
// view/_header.php
// Este arquivo contém o início do HTML, o cabeçalho <head> e o começo do <body> e da estrutura de layout.

// A sessão é iniciada aqui para garantir que esteja disponível em todas as páginas
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SFP-GZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="static/style.css" rel="stylesheet">


</head>
<body>

    <header class="bg-light p-3 border-bottom">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand fs-3 m-0" href="index.php?principal">SFP-GZ</a>
            <button class="btn btn-primary d-lg-none btn-toggle-sidebar" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarResponsive" aria-controls="sidebarResponsive">
                <span class="navbar-toggler-icon"></span> Menu
            </button>
        </div>
    </header>

    <div class="d-flex flex-grow-1">