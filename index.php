<?php

    session_start();

    require_once "conexao.php";

    $sql = "SELECT * FROM imovel LIMIT 10";
    $resultado = $conexao->query($sql);

    // $emailuser="";

    // if(!empty($_SESSION['email-user'])){
    //     $emailuser = $_SESSION['email-user'];
    // }
    // else{
    //     header('Location: login.php');
    //     exit();
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

            <img src="Imagens/logo-topo.png">

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

                <!-- <div class="card-pesquisar"></div> -->
            </div>

            <h1> Encontre o seu imóvel ideal para o seu estilo de vida! </h1>

            
            <div class="container-produtos">
                <h3> Imóveis em destaque </h3>
                <div class="carrossel-produtos">
                <?php
                    while ($imovel = $resultado->fetch(PDO::FETCH_ASSOC)) {
                        $lista = [
                            [
                                "info" => $imovel['qt_area_total_imovel'],
                                "title" => "área total", 
                                "icon" => "svg/tamanho.svg",
                                "unidade" => "m²",
                            ],
                            [
                                "info" => $imovel['qt_quarto_imovel'],
                                "title" => "quartos", 
                                "icon" => "svg/cama.svg",
                                "unidade" => "",
                            ], 
                            [
                                "info" => $imovel['qt_banheiro_imovel'],
                                "title" => "banheiros", 
                                "icon" => "svg/toilet.svg",
                                "unidade" => "",
                            ],
                            [
                                "info" => $imovel['qt_vaga_imovel'],
                                "title" => "vagas", 
                                "icon" => "svg/vaga.svg",
                                "unidade" => "",
                            ],  
                        ];
                        echo '
                            <form class="card-produto" action="imovel.php" method="GET">
                                <input type="hidden" name="id" value="'. $imovel['id_imovel'] .'">
                                <img class="card-image" src="Imagens/imagem-teste.png">
                                <label>'. $imovel['nm_tipo_imovel'] .'</label>
                                <label class="preco-texto">R$ '. $imovel['vl_preco'] .'</label>
                                <label>'. $imovel['nm_logradouro'] . ' | ' . $imovel['nm_bairro_imovel'] .'</label>
                                <div class="info-prod">';
                                    $qnt = 1;
                                    $index = 0;
                                    foreach($lista as $info) {
                                        if (isset($info))
                                        {
                                            echo '<div class="info"><img src="'. $info['icon'] .'" class="prod-icon">
                                            <label>'. $info['info'].$info['unidade'] .'</label></div>';
                                        }
                                    }
                        echo    '</div>
                                <button>contatar</button>
                            </form>
                            ';
                    }
                ?>
                </div>
            </div>
        </main>

        <footer class="rodape">
            <div class="superior">
                <img src="Imagens/logo-rodape.png">
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

