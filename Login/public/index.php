<?php

// INICIALIZA A SESSÃO
session_start();

//define uma constante de controle
define('CONTROL', true);

//verifica se o usuário está logado
$usuario_logado = $_SESSION['usuario'] ?? null;

//verificar qual é a rota da URL
if(empty($usuario_logado)){
    $rota = 'login';
} else{
    $rota = $_GET['rota'] ?? 'home';
}

// se o usuário está logado, mas a rota é login, então redirecina para home
if (!empty($usuario_logado) && $rota == 'login') {
    $rota = 'home';
} 

// analisa as rotas
$rotas = [
    'login' => 'login.php',
    'home' => 'home.php',
    'page1' => 'page1.php',
    'page2' => 'page2.php',
    'logout' => 'logout.php'
];

if(!array_key_exists($rota, $rotas)){
    die('Acesso negado!');
}

require_once $rotas[$rota];