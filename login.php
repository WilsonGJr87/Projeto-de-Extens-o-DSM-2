<?php

    if(isset($_COOKIE['email'])){
        $email = $_COOKIE['email'];
    }
    else{
        $email="";
    }

    $mensagem = "";

    if($_SERVER['REQUEST_METHOD'] ==="POST"){
        if(isset($_POST['email']) && isset($_POST['senha'])){
            
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            if(isset($_POST['lembre'])){
                setcookie('email',$email,time()+3600);
            }

            $arquivo = fopen("usuarios.txt", "r");
            $conteudo = fread($arquivo, filesize("usuarios.txt"));
            fclose($arquivo);

            $usuarios = explode("\n", $conteudo);
            array_pop($usuarios); 

            foreach($usuarios as $user){
            $u = explode("|", $user);

                if($email==$u[2] && $senha==$u[3]){
                    session_start();
                    $_SESSION['email-user'] = $email;
                    header('Location:index.php');
                    exit();
                }
            }
            
            $mensagem = "Email ou senha incorretos!";
            
        }

    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="cadastroLogin.css">

    <title>Login</title>
</head>
<body>
    <header>
        <img src="https://imgs.search.brave.com/pFuXyL40XNW9Oa0CY8o8C2n1kqRWZlzlkctFQ3VsW34/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdGF0/aWMucmZzdGF0LmNv/bS9yZW5kZXJmb3Jl/c3QvaW1hZ2VzL3Yy/L2xvZ28taG9tZXBh/Z2UvbG9nby01LTEu/cG5n">

        <nav>
            <a href="#">Comprar</a>
            <a href="#">Alugar</a>
            <a href="#">Vender</a>
            <a href="#">Descobrir</a>
            <a href="#">Ajuda</a>
        </nav>
    </header>

    <main>
        <form action="#" method="post">
            <legend>Acesse sua conta</legend>
            
            <div class="login">
            <input type="email" name="email" placeholder="Seu email" required>
            <input type="password" name="senha" placeholder="Sua senha" required>
            <p class="lembre"><input type="checkbox" name="lembre">Lembre-me</p>
            </div>
            <?php if ($mensagem !== ""): ?>
            <p class="mensagemSucesso">
                <?= ($mensagem) ?>
            </p>
            <?php endif; ?>
            <input type="submit" value="Entrar">
            <p class="mensagemCadLog">Não possui conta? <a href='cadastro.php'>Cadastre-se aqui</a></p>
        </form>

    </main>

    <footer>
        <p>Direitos reservados para fulano de tal</p>
    </footer>
</body>
</html>
