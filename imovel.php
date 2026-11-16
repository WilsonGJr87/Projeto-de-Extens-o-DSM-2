<?php
session_start();

require_once "conexao.php";
require_once "criador_de_template.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: index.php");
    exit();
}

// Busca o imóvel solicitado
$sql = "SELECT * FROM imovel WHERE id_imovel = :id";
$stmt = $conexao->prepare($sql);
$stmt->execute(['id' => $id]);

$imovel = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$imovel) {
    header("Location: index.php");
    exit();
}

// Busca outros imóveis para recomendação
$sql2 = "SELECT * FROM imovel WHERE id_imovel != :id LIMIT 5";
$stmt2 = $conexao->prepare($sql2);
$stmt2->execute(['id' => $id]);

$resultado2 = $stmt2;

// Características do imóvel
$lista = [
    ["info" => $imovel['qt_area_total_imovel'], "title" => "área total", "icon" => "svg/tamanho.svg", "unidade" => " m²"],
    ["info" => $imovel['qt_quarto_imovel'], "title" => "quartos", "icon" => "svg/cama.svg", "unidade" => ""],
    ["info" => $imovel['qt_banheiro_imovel'], "title" => "banheiros", "icon" => "svg/toilet.svg", "unidade" => ""],
    ["info" => $imovel['qt_vaga_imovel'], "title" => "vagas", "icon" => "svg/vaga.svg", "unidade" => ""]
];

// Dados do imóvel
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

function e($valor) {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="imovel.css">
    <link rel="stylesheet" href="cards.css">
    <link rel="stylesheet" href="contato.css">

    <title><?= e($titulo) ?></title>

    <script src="cards.js" defer></script>
</head>

<body>

    <?php mostrar_header("Imagens/logo-topo.png"); ?>

    <main>

        <!-- Modal de contato -->
        <form id="contatoDiv" class="contato-modal" action="#" method="POST">

            <button type="button" class="fechar-btn" onclick="fecharcontato()" aria-label="Fechar formulário">X</button>

            <input type="hidden" name="id_imovel" value="<?= e($imovel['id_imovel']) ?>">

            <div class="campo">
                <label for="modal-nome">Nome</label>
                <input type="text" id="modal-nome" name="nome" required>
            </div>

            <div class="campo">
                <label for="modal-email">E-mail</label>
                <input type="email" id="modal-email" name="email" required>
            </div>

            <div class="campo">
                <label for="modal-telefone">Telefone</label>
                <input type="tel" id="modal-telefone" name="telefone" required>
            </div>

            <div class="campo">
                <label for="modal-mensagem">Mensagem</label>
                <textarea id="modal-mensagem" name="mensagem" rows="5" required>Olá, tenho interesse neste imóvel.</textarea>
            </div>

            <button class="contato-enviar" type="submit">Enviar</button>

        </form>

        <!-- Informações do imóvel -->
        <section class="container">

            <article class="imovel-container">

                <h2><?= e($titulo) ?></h2>

                <hr>

                <h3><?= e($bairro . ' - ' . $cidade . ', ' . $estado) ?></h3>

                <img class="imovel-image" src="Imagens/imagem-teste.png" alt="Imagem do imóvel">

                <h3>Descrição</h3>

                <p><?= e($descricao) ?></p>

                <h3>Características</h3>

                <div class="container-detalhes">

                    <?php foreach ($lista as $categoria): ?>

                        <div class="detalhes-container">

                            <p><?= e($categoria['title']) ?></p>

                            <div class="detalhe">
                                <img src="<?= e($categoria['icon']) ?>" class="detalhe-icon" alt="">
                                <label><?= e($categoria['info']) . e($categoria['unidade']) ?></label>
                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

                <a href="<?= e($link) ?>" target="_blank" rel="noopener noreferrer">Ver localização</a>

            </article>

            <!-- Formulário lateral -->
            <form class="contato-sidebar" action="#" method="POST">

                <h2 id="contato-hr">Valor de venda: R$ <?= e($preco) ?></h2>

                <h3>Tenho interesse nesse imóvel</h3>

                <input type="hidden" name="id_imovel" value="<?= e($imovel['id_imovel']) ?>">

                <div class="campo">
                    <label for="sidebar-nome">Nome</label>
                    <input type="text" id="sidebar-nome" name="nome" required>
                </div>

                <div class="campo">
                    <label for="sidebar-email">E-mail</label>
                    <input type="email" id="sidebar-email" name="email" required>
                </div>

                <div class="campo">
                    <label for="sidebar-telefone">Telefone</label>
                    <input type="tel" id="sidebar-telefone" name="telefone" required>
                </div>

                <div class="campo">
                    <label for="sidebar-mensagem">Mensagem</label>
                    <textarea id="sidebar-mensagem" name="mensagem" rows="5" required>Olá, tenho interesse neste imóvel.</textarea>
                </div>

                <button class="contato-enviar" type="submit">Enviar</button>

            </form>

        </section>

        <hr id="middle">

        <!-- Imóveis recomendados -->
        <section class="container-produtos">

            <h3>Imóveis em destaque</h3>

            <div class="carrossel-produtos">

                <?php while ($recomendacao = $resultado2->fetch(PDO::FETCH_ASSOC)): ?>

                    <?php
                    $listaRecomendacao = [
                        ["info" => $recomendacao['qt_area_total_imovel'], "title" => "área total", "icon" => "svg/tamanho.svg", "unidade" => " m²"],
                        ["info" => $recomendacao['qt_quarto_imovel'], "title" => "quartos", "icon" => "svg/cama.svg", "unidade" => ""],
                        ["info" => $recomendacao['qt_banheiro_imovel'], "title" => "banheiros", "icon" => "svg/toilet.svg", "unidade" => ""],
                        ["info" => $recomendacao['qt_vaga_imovel'], "title" => "vagas", "icon" => "svg/vaga.svg", "unidade" => ""]
                    ];
                    ?>

                    <form class="card-produto" action="imovel.php" method="GET" onclick="verimovel(this)">

                        <input type="hidden" name="id" value="<?= e($recomendacao['id_imovel']) ?>">

                        <img class="card-image" src="Imagens/imagem-teste.png" alt="Imagem do imóvel">

                        <label><?= e($recomendacao['nm_tipo_imovel']) ?></label>

                        <label class="preco-texto">R$ <?= e($recomendacao['vl_preco']) ?></label>

                        <label><?= e($recomendacao['nm_logradouro']) ?> | <?= e($recomendacao['nm_bairro_imovel']) ?></label>

                        <div class="info-prod">

                            <?php foreach ($listaRecomendacao as $info): ?>

                                <div class="info">
                                    <img src="<?= e($info['icon']) ?>" class="prod-icon" alt="">
                                    <label><?= e($info['info']) . e($info['unidade']) ?></label>
                                </div>

                            <?php endforeach; ?>

                        </div>

                        <button type="button" onclick="event.stopPropagation(); abrircontato()">Contatar</button>

                    </form>

                <?php endwhile; ?>

            </div>

        </section>

    </main>

    <?php mostrar_footer("Imagens/logo-rodape.png"); ?>

</body>
</html>