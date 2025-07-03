<?php
// Ativar exibição de erros para depuração (REMOVER EM PRODUÇÃO!)
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// // Imprimir todos os dados recebidos via POST e parar a execução
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;
//iniciar sessao
session_start();

//não mostrar erros
error_reporting(~E_ALL & ~E_NOTICE & ~E_WARNING);

//autoload
include_once 'autoload.php';

// //validar sessao
// $objController = new Controller();
// if (!isset($_POST['recuperar_senha'])) {
//     $objController->validarSessao();
// }


//router
include_once 'router.php';