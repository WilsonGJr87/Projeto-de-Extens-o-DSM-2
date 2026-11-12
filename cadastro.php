<?php

    $mensagem1 = "";
    $mensagem2 = "";
    $email = "";
    $cpfcnpj = "";
    $emailExiste = "";
    $cpfcnpjExiste = "";

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $nome = trim($_POST['nome']);
        $cpfcnpj = preg_replace('/\D/', '', $_POST['cpfcnpj']);
        $telefone = preg_replace('/\D/', '', $_POST['telefone']);
        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);

        $emailExiste = false;
        if(isset($_POST['email']) && isset($_POST['senha'])){
            $arquivo = fopen("usuarios.txt", "r");
            $conteudo = fread($arquivo, filesize("usuarios.txt"));
            fclose($arquivo);

            $usuarios = explode("\n", $conteudo);
            array_pop($usuarios); 

                
                foreach ($usuarios as $user){
                    $u = explode("|", $user);
                    if (isset($u) && strtolower($u[3]) === strtolower($email)){
                        $emailExiste = true;
                        break;
                    }
                    if (isset($u) && $u[1] === $cpfcnpj){
                        $cpfcnpjExiste = true;
                        break;
                    }
                }
        }
    }

    if ($emailExiste || $cpfcnpjExiste){
        if ($emailExiste) {
            $mensagem1 = "Este email já possui conta cadastrada!";
        }

        if ($cpfcnpjExiste) {
            $mensagem2 = "Este CPF/CNPJ já possui conta cadastrada!";
        }

    } else{
        $usuario = [$nome, $cpfcnpj, $telefone, $email, $senha];
        $arquivo = fopen("usuarios.txt", "a");
        fwrite($arquivo, implode("|", $usuario) . "\n");

        fclose($arquivo);
        
        $mensagem = "Conta criada com sucesso!";
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
            <input type="text" name="cpfcnpj" maxlength="18" inputmode="numeric" pattern="[0-9./-]+" placeholder="Seu CPF/CNPJ" required>
            <input type="tel" name="telefone" maxlength="15" inputmode="tel" placeholder="Seu telefone" required>
            <input type="email" name="email" placeholder="Seu email" required>
            <input type="password" name="senha" placeholder="Sua senha" required>
            </div>
            <?php 
                if ($mensagem1 !== ""): ?>
                    <p class="mensagemSucesso">
                        <?= ($mensagem1) ?>
                    </p>
                <?php endif;

                if ($mensagem2 !== ""): ?>
                    <p class="mensagemSucesso">
                        <?= ($mensagem2) ?>
                    </p>
                <?php endif;
                ?>
            <input type="submit" value="Criar Conta">
            <p class="mensagemCadLog">Já possui conta? <a href='login.php'>Faça seu login</a></p>
        </form>

    </main>

    <footer>
        <p>Direitos reservados para fulano de tal</p>
    </footer>
</body>
</html>