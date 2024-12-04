<?php
defined('CONTROL') or die('Acesso negado!');

 // verifica se o formulário foi enviado
 if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // verifica se o usuário e a password foram submetidas
    $usuario = $_POST['usuario'] ?? null;
    $senha = $_POST['senha'] ?? null;
    $erro = null;

    if(empty($usuario) || empty($senha)){
        $erro = "usuário e senha são obrigatorios!";
    }

    // verifica se o usuário e password são válidos
    if(empty($erro)){

        $usuarios = require_once __DIR__ . '/../inc/usuario.php';
        
        foreach($usuarios as $user){
            if($user['usuario'] == $usuario && password_verify($senha, $user['senha'])){

                // efetua o login
                $_SESSION['usuario'] = $usuario;

                // volta para a página inicial
                header('location: index.php?rota=home');
            }
        }

        $erro = "Usuário e/ou senha inválidos!";
    }

 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <form action="index.php?rota=login" method="post">
        <h3>Login</h3>
        <div>
            <label for="usuario">Usuário:</label>
            <input type="text" name="usuario" id="usuario">
        </div>
        <div>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha">
        </div>
        <div>
            <button type="submit">Entrar</button>
        </div>
    </form>

    <?php if(!empty($erro)): ?>
        <p style="color: red"><?= $erro ?></p>
    <?php endif; ?>

</body>
</html>