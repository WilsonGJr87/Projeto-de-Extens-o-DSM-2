<?php
// session_start();

// $emailuser="";

// if(isset($_SESSION['email-user'])){
//     $emailuser = $_SESSION['email-user'];
// }
// else{
//     header('Location:login.php');
//     exit;
// }

// if (isset ($_POST['lembre'])){
//     setcookie('email',$email,time()+3600);
// }

?>

<!DOCTYPE HTML>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="home.css">

        <title>Home</title>
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

            <div class="buscar-container">
                <form class="card-form-pesquisar">
                    <h2>Milhões de opções e facilidades pra achar a casa ideal pra sua vida.</h2>
                    <div class=botoes>
                        <button class="seletor">Comprar</button>
                        <button class="seletor">Alugar</button>
                        <button class="seletor">Imovél novo</button>
                    </div>
                    
                    <label> Onde deseja morar? </label>
                        <input class="texto" type="search">

                    <label> Tipo de imóvel </label>
                    <select class="texto"   >
                        <option value="#">Casa</option>
                        <option value="#">Apartamento</option>
                        <option value="#">Kitnet</option>
                    </select>

                        <input class="buscar" type="submit" value="Buscar">
                </form>

                <div class="card-pesquisar"></div>
            </div>

            <h3> Imóveis em destaque </h3>
            <h1> Encontre o seu imóvel ideal para o seu estilo de vida! </h1>
            <div class="container-produtos">
            <?php
                for ($i = 0; $i < 10; $i++) {
                    echo '
                        <div class="card-produto">
                            <img class="card-image" src="Imagens/imagem-teste.png">
                            <label>Apartamento</label>
                            <label class="preco-texto">R$ 198.700</label>
                            <label>Av. Pizzaria Freddy Fazbear</label>
                            <div class="info-prod">
                                <div class="info"><img src="Imagens/loc.png" class="prod-icon"><label>oi</label></div>
                            </div>
                            <button>contatar</button>
                        </div>
                        ';
                }
            ?>
            </div>
        </main>

        <footer class="rodape">
            <div class="superior">
                <img src="https://imgs.search.brave.com/pFuXyL40XNW9Oa0CY8o8C2n1kqRWZlzlkctFQ3VsW34/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdGF0/aWMucmZzdGF0LmNv/bS9yZW5kZXJmb3Jl/c3QvaW1hZ2VzL3Yy/L2xvZ28taG9tZXBh/Z2UvbG9nby01LTEu/cG5n">
                <a href="#">Comprar</a>
                <a href="#">Alugar</a>
                <a href="#">Vender</a>
                <a href="#">Descobrir</a>
                <a href="#">Ajuda</a>
            </div>
            <section class="inferior">
                <div>
                    <div class="localizacao">
                        <p>Blumenau/SC (CRECI: 2962-J)</p>
                        <p>R. Eng. Rodolfo Ferraz, 255</p>
                        <p>Plantão de Vendas - R. Sete de Setembro, 1560</p>
                    </div>
                    <div class="telefone">
                        <p>Blumenau/SC (CRECI: 2962-J)</p>
                        <p>R. Eng. Rodolfo Ferraz, 255</p>
                    </div>
                </div>
                <div>
                    <div class="localizacao">
                        <p>Blumenau/SC (CRECI: 2962-J)</p>
                        <p>R. Eng. Rodolfo Ferraz, 255</p>
                        <p>Plantão de Vendas - R. Sete de Setembro, 1560</p>
                    </div>
                    <div class="telefone">
                        <p>Blumenau/SC (CRECI: 2962-J)</p>
                        <p>R. Eng. Rodolfo Ferraz, 255</p>
                    </div>
                </div>
                <div>
                    <div class="localizacao">
                        <p>Blumenau/SC (CRECI: 2962-J)</p>
                        <p>R. Eng. Rodolfo Ferraz, 255</p>
                    </div>
                    <div class="telefone">
                        <p>Blumenau/SC (CRECI: 2962-J)</p>
                        <p>R. Eng. Rodolfo Ferraz, 255</p>
                    </div>
                    <div class="whatsapp">
                        <p>Blumenau/SC (CRECI: 2962-J)</p>
                        <p>R. Eng. Rodolfo Ferraz, 255</p>
                    </div>
                </div>
            </section>
            <div class="copyright"><p>© Copyright 2026 Premium Imóveis -</p></div>
        </footer>
    </body>
</html>