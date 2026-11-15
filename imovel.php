<?php

    session_start();

    require_once "conexao.php";

    $id = $_GET['id'];

    $sql = "SELECT * FROM imovel WHERE id_imovel = '$id'";
    $sql2 =  "SELECT * FROM imovel WHERE id_imovel != '$id' LIMIT 5";

    $resultado = $conexao->query($sql);
    $resultado2 = $conexao->query($sql2);

    $imovel = $resultado->fetch(PDO::FETCH_ASSOC);

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

    $tipo = $imovel['nm_tipo_imovel'];
    $area = $imovel['qt_area_construida_imovel'];
    $condicao = $imovel['nm_condicao_imovel'];
    $logradouro = $imovel['nm_logradouro'];

    $rua = $imovel['nm_rua'];
    $numero = $imovel['cd_numero_imovel'];
    $bairro = $imovel['nm_bairro_imovel'];
    $cidade = $imovel['nm_cidade_imovel'];
    $estado = $imovel['sg_estado'];

    $descricao = $imovel['ds_imovel'];
    $preco = $imovel['vl_preco'];

    $titulo = $rua . ', ' . $numero . ', ' . $bairro . ', ' . $cidade . ', ' . $estado;
    $link = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($titulo);

    // if(!isset($_SESSION['id_cliente'])){    
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
        <link rel="stylesheet" href="imovel.css">

        <title><?php echo $titulo; ?></title>
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
            <div class="container">
                <div class="imovel-container">
                    <h2><?php echo $titulo; ?></h2>
                    <hr>
                    <h3><?php echo $bairro . ' - ' . $cidade . ', ' . $estado; ?></h3>
                    <img class="imovel-image" src="Imagens/imagem-teste.png">
                    <h3>Descrição</h3>
                    <label>
                        <?php 
                            echo $descricao;
                        ?> 
                    </label>
                    <h3>Características</h3>
                    <div class="container-detalhes">
                        <?php
                            foreach($lista as $categoria) {
                                if (isset($categoria))
                                {
                                    echo '<div class="detalhes-container">
                                        <p>'. $categoria['title'] .'</p>
                                        <div class="detalhe">
                                            <img src="'. $categoria['icon'] .'" class="detalhe-icon">
                                            <label>'. $categoria['info'] . $categoria['unidade'] .'</label>
                                        </div>
                                    </div>';
                                }
                            }
                        ?>
                    </div>
                    <a href="<?php echo $link; ?>">Ver localização</a>
                </div>

                <form class="contato-container">
                    <h2 id="contato-hr">Valor de venda: R$: <?php echo $preco; ?></h3>

                    <h3>TENHO INTERESSE NESSE IMÓVEL</h3>
                    <input type="hidden" name="id_imovel" value="<?php echo $imovel['id_imovel']; ?>">

                    <div class="campo">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>

                    <div class="campo">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="campo">
                        <label for="telefone">Telefone</label>
                        <input type="tel" id="telefone" name="telefone" required>
                    </div>

                    <div class="campo">
                        <label for="mensagem">Mensagem</label>
                        <textarea id="mensagem" name="mensagem" rows="5" required>Olá, tenho interesse neste imóvel.</textarea>
                    </div>

                    <button class="submit" type="submit">Enviar interesse</button>
                </form>

            </div>

            <hr id="middle">

            <section class="container-produtos">
                <h3> Imóveis em destaque </h3>
                <div class="carrossel-produtos">
                <?php
                    while ($recomendacao = $resultado2->fetch(PDO::FETCH_ASSOC)) {
                        $lista = [
                            [
                                "info" => $recomendacao['qt_area_total_imovel'],
                                "title" => "área total", 
                                "icon" => "svg/tamanho.svg",
                                "unidade" => "m²",
                            ],
                            [
                                "info" => $recomendacao['qt_quarto_imovel'],
                                "title" => "quartos", 
                                "icon" => "svg/cama.svg",
                                "unidade" => "",
                            ], 
                            [
                                "info" => $recomendacao['qt_banheiro_imovel'],
                                "title" => "banheiros", 
                                "icon" => "svg/toilet.svg",
                                "unidade" => "",
                            ],
                            [
                                "info" => $recomendacao['qt_vaga_imovel'],
                                "title" => "vagas", 
                                "icon" => "svg/vaga.svg",
                                "unidade" => "",
                            ],  
                        ];
                        echo '
                            <form class="card-produto" action="imovel.php" method="GET">
                                <input type="hidden" name="id" value="'. $recomendacao['id_imovel'] .'">
                                <img class="card-image" src="Imagens/imagem-teste.png">
                                <label>'. $recomendacao['nm_tipo_imovel'] .'</label>
                                <label class="preco-texto">R$ '. $recomendacao['vl_preco'] .'</label>
                                <label>'. $recomendacao['nm_logradouro'] . ' | ' . $recomendacao['nm_bairro_imovel'] .'</label>
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
            </section>
            
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
</html>