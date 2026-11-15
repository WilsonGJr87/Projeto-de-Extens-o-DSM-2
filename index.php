<?php

    session_start();

    require_once "conexao.php";

    $sql = "SELECT * FROM imovel LIMIT 10";
    $resultado = $conexao->query($sql);

    if(!isset($_SESSION['id_cliente'])){
        header('Location: login.php');
        exit();
    }
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
                        <button type="button" id="comprarOPT" class="seletor ativo">Comprar</button>
                        <button type="button" id="alugarOPT" class="seletor">Alugar</button>
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
                while ($imovel = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    $lista = [
                        $imovel['qt_area_total_imovel'] => "svg/tamanho.svg",
                        $imovel['qt_quarto_imovel'] => "svg/cama.svg",
                        $imovel['qt_banheiro_imovel'] => "svg/toilet.svg",
                        $imovel['qt_vaga_imovel'] => "svg/vaga.svg"
                    ];
                    echo '
                        <div class="card-produto">
                            <img class="card-image" src="Imagens/imagem-teste.png">
                            <label>'. $imovel['nm_tipo_imovel'] .'</label>
                            <label class="preco-texto">R$ '. $imovel['vl_preco'] .'</label>
                            <label>'. $imovel['nm_logradouro'] . ' | ' . $imovel['nm_bairro_imovel'] .'</label>
                            <div class="info-prod">';
                                $qnt = 0;
                                $index = 0;
                                foreach($lista as $info => $img) {
                                    if ($qnt > 3 )
                                        break;
                                    if (isset($info))
                                    {
                                        $qnt++;
                                        if ($index == 0)
                                            $info = $info.'m²';
                                        echo '<div class="info"><img src="'. $img .'" class="prod-icon">
                                        <label>'. $info .'</label></div>';
                                    }
                                }
                    echo    '</div>
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

    <script>
        const comprarOpt = document.getElementById("comprarOPT");
        const alugarOpt = document.getElementById("alugarOPT");

        comprarOpt.addEventListener("click", () => {
            comprarOpt.classList.add("ativo");
            alugarOPT.classList.remove("ativo");
        });
        alugarOpt.addEventListener("click", () => {
            alugarOpt.classList.add("ativo");
            comprarOpt.classList.remove("ativo");
        });

    </script>
</html>

