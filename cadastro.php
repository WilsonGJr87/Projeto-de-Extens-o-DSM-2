<?php

    if(isset($_COOKIE['email'])){
        $email = $_COOKIE['email'];
    }
    else{
        $email="";
    }

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="cadastroLogin.css">

    <title>Cadastro</title>
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
            <legend>Faça seu cadastro</legend>
            <div class="cadastro">
            <input type="text" name="nome" placeholder="Seu nome" required>
            <input type="tel" name="telefone" placeholder="Seu telefone" required>
            <input type="email" name="email" placeholder="Seu email" required>
            <input type="password" name="senha" placeholder="Sua senha" required>
            </div>
            <input type="submit" value="Criar Conta">
            <p class="mensagemCadLog">Já possui conta? <a href='login.php'>Faça seu login</a></p>
        </form>

    </main>

    <footer>
        <p>Direitos reservados para fulano de tal</p>
    </footer>
</body>
</html>

<?php

    if($_SERVER['REQUEST_METHOD'] ==="POST"){

        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        try{
            $usuario = [$nome, $telefone, $email, $senha];
            $arquivo = fopen("usuarios.txt", "a");
            fwrite($arquivo, implode("|", $usuario) . "\n");

            fclose($arquivo);
            
            $mensagem = "Conta criada com sucesso!";
        } catch(Exception $e){
            $mensagem = "Não foi possível criar a conta!";
        }
    }

?>