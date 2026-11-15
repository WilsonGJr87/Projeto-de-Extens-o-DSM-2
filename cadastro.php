<?php

    require_once "conexao.php";

    $mensagem = "";
    $mensagem1 = "";
    $mensagem2 = "";
    $email = "";
    $cpfcnpj = "";
    $emailExiste = false;
    $cpfcnpjExiste = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = trim($_POST['nome']);
        $cpfcnpj = preg_replace('/\D/', '', $_POST['cpfcnpj']);
        $telefone = preg_replace('/\D/', '', $_POST['telefone']);
        $email = trim($_POST['email']);
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM cliente WHERE nm_email_cliente = :email";
        $consulta = $conexao->prepare($sql);
        $consulta->execute([':email' => $email]);
        $emailExiste = $consulta->fetch() ? true : false;

        $sql = "SELECT * FROM cliente WHERE cd_cpf_cnpj_cliente = :cpfcnpj";
        $consulta = $conexao->prepare($sql);
        $consulta->execute([':cpfcnpj' => $cpfcnpj]);
        $cpfcnpjExiste = $consulta->fetch() ? true : false;

        if ($emailExiste || $cpfcnpjExiste){
            if ($emailExiste) {
                $mensagem1 = "Este email já possui conta cadastrada!";
            }

            if ($cpfcnpjExiste) {
                $mensagem2 = "Este CPF/CNPJ já possui conta cadastrada!";
            }

        } else{
            $senha = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO cliente (nm_cliente, cd_cpf_cnpj_cliente, cd_telefone_cliente, nm_email_cliente, cd_senha_cliente) VALUES (:nome, :cpfcnpj, :telefone, :email, :senha)";
            
            $consulta = $conexao->prepare($sql);

            $consulta->execute([
                ':nome' => $nome,
                ':cpfcnpj' => $cpfcnpj,
                ':telefone' => $telefone,
                ':email' => $email,
                ':senha' => $senha
            ]);
            
            $mensagem = "Conta criada com sucesso!";
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
                    <p class="mensagem">
                        <?= ($mensagem1) ?>
                    </p>
                <?php endif;

                if ($mensagem2 !== ""): ?>
                    <p class="mensagem">
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