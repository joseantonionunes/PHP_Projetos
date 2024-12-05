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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<Style>

    *{
        margin: 0px;
        padding: 0px;
    }

    header{
        text-align: center;
        height: 100px;
        background-color: whitesmoke;
        color: black;
        /* margin-bottom: 150px; */
        h1{
            text-align: center;
        }
    }

    main{
        min-height: 90vh;
        background-image: url(../img/2.png);
        position: relative;
        div{
            display: flex;
            justify-content: center;
            align-items: center;
            
            form{
                text-align: center;
                background-color: red;
                border-radius: 10px;
                width: 240px;
                height: 150px;
                position: absolute;
                margin-top: 500px;
                h3{
                    font-size: 25px;
                }
                div{
                    padding-top: 10px;
                    button{
                        padding: 15px;
                        border-radius: 15px;
                        background-color: black;
                        color: white;
                        cursor: pointer;
                    }
                }
            }
        }
    }
</Style>
<body>

    <header>
        <h1>Login</h1>
    </header>
    <main>
        <div>
            <form action="index.php?rota=login" method="post">
                <h3>Login</h3>
                <div>
                    <label for="usuario">Usuário:</label>
                    <input type="text" name="usuario" id="usuario">
                </div>
                <div>
                    <label for="senha"> Senha: </label>
                    <input type="password" name="senha" id="senha">
                </div>
                <div>
                    <button type="submit">Entrar</button>
                </div>
            </form>
        </div>
    </main>
    <?php if(!empty($erro)): ?>
        <p style="color: red"><?= $erro ?></p>
    <?php endif; ?>

</body>
</html>