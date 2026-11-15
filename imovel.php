<?php

    session_start();

    require_once "conexao.php";

    $id = $_GET['id'];

    $sql = "SELECT * FROM imovel WHERE id_imovel = '$id'";
    $resultado = $conexao->query($sql);

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

    $cep = $imovel['cd_cep_imovel'];
    $data = $imovel['dt_construcao_imovel'];
    $preco = $imovel['vl_preco'];

    $titulo = $rua . ', ' . $numero . ', ' . $bairro . ', ' . $cidade . ', ' . $estado;

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
                    <h3>Características</h3>
                    <div class="container-info">
                        <?php
                            foreach($lista as $categoria) {
                                if (isset($categoria))
                                {
                                    echo '<div class="info-container">
                                        <p>'. $categoria['title'] .'</p>
                                        <div class="info">
                                            <img src="'. $categoria['icon'] .'" class="prod-icon">
                                            <label>'. $categoria['info'] . $categoria['unidade'] .'</label>
                                        </div>
                                    </div>';
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="contato-container">
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
</html>

