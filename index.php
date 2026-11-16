<?php
session_start();

require_once "conexao.php";
require_once "criador_de_template.php";

$sql = "SELECT *,
        (SELECT caminho
         FROM imagem
         WHERE imagem.id_imovel = imovel.id_imovel
         LIMIT 1) AS caminho_imagem
        FROM imovel
        LIMIT 10";
$resultado = $conexao->query($sql);

function e($valor) {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$opt = "comprar";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="cards.css">
    <link rel="stylesheet" href="contato.css">

    <title>Home</title>

    <script src="cards.js" defer></script>
    <script src="home.js" defer></script>
</head>

<body>

    <?php mostrar_header(); ?>

    <main>

        <!-- Modal de contato -->
        <form id="contatoDiv" class="contato-modal" action="#" method="POST">

            <button type="button" class="fechar-btn" onclick="fecharcontato()" aria-label="Fechar formulário">X</button>

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

        <!-- Pesquisa de imóveis -->
        <section class="buscar-container">

            <form class="card-form-pesquisar" action="pesquisar.php?finalidade=<?php echo $opt; ?>" method="POST">

                <h2>Milhões de opções e facilidades pra achar a casa ideal pra sua vida.</h2>

                <div class="botoes">
                    <button type="button" id="comprarOPT" class="seletor ativo">Comprar</button>
                    <button type="button" id="alugarOPT" class="seletor">Alugar</button>
                </div>

                <label for="localizacao">Onde deseja morar?</label>
                <input class="texto" type="search" id="localizacao" name="localizacao">

                <label for="tipo-imovel">Tipo de imóvel</label>
                <select class="texto" id="tipo-imovel" name="tipo">
                    <option value="casa">Casa</option>
                    <option value="apartamento">Apartamento</option>
                    <option value="kitnet">Kitnet</option>
                </select>

                <button class="buscar" type="submit">Buscar</button>

            </form>

        </section>

        <h1>Encontre o seu imóvel ideal para o seu estilo de vida!</h1>

        <!-- Imóveis em destaque -->
        <section class="container-produtos">

            <h3>Imóveis em destaque</h3>

            <div class="carrossel-produtos">

                <?php while ($imovel = $resultado->fetch(PDO::FETCH_ASSOC)): ?>

                    <?php
                    $lista = [
                        ["info" => $imovel['qt_area_total_imovel'], "title" => "área total", "icon" => "svg/tamanho.svg", "unidade" => " m²"],
                        ["info" => $imovel['qt_quarto_imovel'], "title" => "quartos", "icon" => "svg/cama.svg", "unidade" => ""],
                        ["info" => $imovel['qt_banheiro_imovel'], "title" => "banheiros", "icon" => "svg/toilet.svg", "unidade" => ""],
                        ["info" => $imovel['qt_vaga_imovel'], "title" => "vagas", "icon" => "svg/vaga.svg", "unidade" => ""]
                    ];
                    ?>

                    <form class="card-produto" action="imovel.php" method="GET" onclick="verimovel(this)">

                        <input type="hidden" name="id" value="<?= e($imovel['id_imovel']) ?>">

                        <img class="card-image" src="<?= e($imovel['caminho_imagem'] ?? 'Imagens/imagem-teste.png') ?>" alt="Imagem do imóvel">

                        <label><?= e($imovel['nm_tipo_imovel']) ?></label>

                        <label class="preco-texto">R$ <?= number_format((float) $imovel['vl_preco'], 2, ',', '.') ?></label>

                        <label><?= e($imovel['nm_logradouro']) ?> | <?= e($imovel['nm_bairro_imovel']) ?></label>

                        <div class="info-prod">

                            <?php foreach ($lista as $info): ?>

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

    <?php mostrar_footer(); ?>

</body>
    <script>
        const comprarOpt = document.getElementById("comprarOPT");
        const alugarOpt = document.getElementById("alugarOPT");

        comprarOpt.addEventListener("click", () => {
            comprarOpt.classList.add("ativo");
            alugarOPT.classList.remove("ativo");
            <?php $opt = "comprar"; ?>
        });
        alugarOpt.addEventListener("click", () => {
            alugarOpt.classList.add("ativo");
            comprarOpt.classList.remove("ativo");
            <?php $opt = "alugar"; ?>
        });
        
    </script>
</html>