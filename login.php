<?php

    require_once "conexao.php";
    require_once "criador_de_template.php";

    function e($valor) {
        return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
    }

    session_start();

    $email = "";
    $mensagem = "";

    if (isset($_COOKIE['cliente'])) {
    $email = $_COOKIE['cliente'];
    }

    if($_SERVER['REQUEST_METHOD'] ==="POST"){
            
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        $sql = "SELECT * FROM cliente WHERE nm_email_cliente = :email";
        $consulta = $conexao->prepare($sql);
        $consulta->execute([':email' => $email]);

        $cliente = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($cliente) {
            if (password_verify($senha, $cliente['cd_senha_cliente'])) {
                $_SESSION['id_cliente'] = $cliente['id_cliente'];
                $_SESSION['nome_cliente'] = $cliente['nm_cliente'];
                $_SESSION['email_cliente'] = $cliente['nm_email_cliente'];

                if (isset($_POST['lembre'])) {
                    setcookie("cliente", $email, time() + 3600, "/");
                } else {
                    setcookie("cliente", $email, 0, "/");
                }

                header("Location: index.php");
                exit();
            } else{
                $mensagem = "Senha incorreta!";
            }
        
        } else{
            $mensagem = "Email não encontrado!";
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
    <?php mostrar_header(); ?>

    <main>
        <form action="#" method="post">
            <legend>Acesse sua conta</legend>
            
            <div class="login">
            <input type="email" name="email" placeholder="Seu email" value="<?php $email ?>" required>
            <input type="password" name="senha" placeholder="Sua senha" required>
            <p class="lembre"><input type="checkbox" name="lembre">Lembre-me</p>
            </div>
            <?php if ($mensagem !== ""): ?>
            <p class="mensagem">
                <?= ($mensagem) ?>
            </p>
            <?php endif; ?>
            <input type="submit" value="Entrar">
            <p class="mensagemCadLog">Não possui conta? <a href='cadastro.php'>Cadastre-se aqui</a></p>
        </form>

    </main>

    <?php mostrar_footer(); ?>
</body>
</html>
