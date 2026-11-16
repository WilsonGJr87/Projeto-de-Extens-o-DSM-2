
<?php
    // Importa o arquivo responsável pela conexão com o banco de dados
    require_once 'conexao.php';
    require_once 'criador_de_template.php';

    function e($valor) {
        return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
    }
?>

<?php
    // Inicializa as variáveis dos filtros vazias
    $cidade = "";
    $bairro = "";
    $tipo = "";
    $quartos = "";
    $banheiros = "";
    $area_min = "";
    $area_max = "";

    $finalidade = $_GET['finalidade'] ?? "";

    // Verifica se o formulário foi enviado pelo método POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recebe os valores preenchidos nos filtros
        $cidade = $_POST["cidade"] ?? "";
        $bairro = $_POST["bairro"] ?? "";
        $tipo = $_POST["tipo"] ?? "";
        $quartos = $_POST["quartos"] ?? "";
        $banheiros = $_POST["banheiros"] ?? "";
        $area_min = $_POST["area_min"] ?? "";
        $area_max = $_POST["area_max"] ?? "";
    }
?>

<?php
    // Prepara a consulta dos imóveis e também suas imagens
    $consulta = $conexao->prepare("SELECT imovel.*,
    (SELECT caminho
     FROM imagem
     WHERE imagem.id_imovel = imovel.id_imovel
     LIMIT 1) AS caminho
    FROM imovel

    WHERE imovel.nm_cidade_imovel LIKE :cidade
    AND imovel.nm_bairro_imovel LIKE :bairro
    AND imovel.nm_tipo_imovel LIKE :tipo

    AND (:finalidade_vazio = '' OR imovel.nm_finalidade_imovel = :finalidade_valor)

    AND (:quartos_vazio = '' OR imovel.qt_quarto_imovel >= :quartos_valor)
    AND (:banheiros_vazio = '' OR imovel.qt_banheiro_imovel >= :banheiros_valor)

    AND (:area_min_vazio = '' OR imovel.qt_area_total_imovel >= :area_min_valor)
    AND (:area_max_vazio = '' OR imovel.qt_area_total_imovel <= :area_max_valor)");

    // Define os valores dos filtros de texto
    $consulta->bindValue(':cidade', '%' . $cidade . '%');
    $consulta->bindValue(':bairro', '%' . $bairro . '%');
    $consulta->bindValue(':tipo', '%' . $tipo . '%');
    $consulta->bindValue(':finalidade_vazio', $finalidade);
    $consulta->bindValue(':finalidade_valor', $finalidade);

    // Define os valores dos filtros numéricos
    $consulta->bindValue(':quartos_vazio', $quartos);
    $consulta->bindValue(':quartos_valor', $quartos);

    $consulta->bindValue(':banheiros_vazio', $banheiros);
    $consulta->bindValue(':banheiros_valor', $banheiros);

    $consulta->bindValue(':area_min_vazio', $area_min);
    $consulta->bindValue(':area_min_valor', $area_min);

    $consulta->bindValue(':area_max_vazio', $area_max);
    $consulta->bindValue(':area_max_valor', $area_max);

    // Executa a consulta no banco de dados
    $consulta->execute();

    // Guarda os resultados da consulta em um array
    $imoveis = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="pesquisa.css">
        <link rel="stylesheet" href="cards.css">
        <link rel="stylesheet" href="contato.css">

        <title>Pesquisa</title>

        <script src="cards.js" defer></script>
        <script src="home.js" defer></script>
    </head>

    <body>

        <?php mostrar_header(); ?>

        <main>

            <!-- Modal de contato (usado pelo botão "Contatar" dos cards) -->
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

            <div class="layout-pesquisa">

                <aside class="filtros">

                    <form action="pesquisa.php?finalidade=<?= e($finalidade) ?>" method="POST">

                        <div class="botoes">
                            <a id="comprarOPT" href="?finalidade=comprar" class="seletor<?= $finalidade == 'comprar' ? ' ativo' : '' ?>">Comprar</a>
                            <a id="alugarOPT" href="?finalidade=alugar" class="seletor<?= $finalidade == 'alugar' ? ' ativo' : '' ?>">Alugar</a>
                        </div>

                        <label>Cidade:</label>
                        <?php
                            echo '<input type="text" name="cidade" value="' . e($cidade) . '">';
                        ?>

                        <label>Bairro:</label>
                        <?php
                            echo '<input type="text" name="bairro" value="' . e($bairro) . '">';
                        ?>

                        <label>Tipo de imóvel:</label>
                        <select name="tipo">
                            <option value="" <?= $tipo == "" ? 'selected' : '' ?>>Todos</option>
                            <option value="Casa" <?= $tipo == "Casa" ? 'selected' : '' ?>>Casa</option>
                            <option value="Apartamento" <?= $tipo == "Apartamento" ? 'selected' : '' ?>>Apartamento</option>
                            <option value="Kitnet" <?= $tipo == "Kitnet" ? 'selected' : '' ?>>Kitnet</option>
                        </select>

                        <label>Quantidade de quartos:</label>
                        <select name="quartos">
                            <option value="" <?= $quartos == "" ? 'selected' : '' ?>>Qualquer quantidade</option>
                            <option value="1" <?= $quartos == "1" ? 'selected' : '' ?>>1 ou mais</option>
                            <option value="2" <?= $quartos == "2" ? 'selected' : '' ?>>2 ou mais</option>
                            <option value="3" <?= $quartos == "3" ? 'selected' : '' ?>>3 ou mais</option>
                            <option value="4" <?= $quartos == "4" ? 'selected' : '' ?>>4 ou mais</option>
                        </select>

                        <label>Quantidade de banheiros:</label>
                        <select name="banheiros">
                            <option value="" <?= $banheiros == "" ? 'selected' : '' ?>>Qualquer quantidade</option>
                            <option value="1" <?= $banheiros == "1" ? 'selected' : '' ?>>1 ou mais</option>
                            <option value="2" <?= $banheiros == "2" ? 'selected' : '' ?>>2 ou mais</option>
                            <option value="3" <?= $banheiros == "3" ? 'selected' : '' ?>>3 ou mais</option>
                        </select>

                        <label>Área mínima (m²):</label>
                        <?php
                            echo '<input type="number" name="area_min" value="' . e($area_min) . '">';
                        ?>

                        <label>Área máxima (m²):</label>
                        <?php
                            echo '<input type="number" name="area_max" value="' . e($area_max) . '">';
                        ?>

                        <input type="submit" value="Pesquisar">

                    </form>

                </aside>

                <section class="resultados">

                    <h2>Imóveis encontrados</h2>

                    <!-- Lista onde os cards dos imóveis vão ser mostrados -->
                    <div class="lista-imoveis">

                        <?php foreach ($imoveis as $imovel): ?>

                            <?php
                            $lista = [
                                ["info" => $imovel['qt_area_total_imovel'], "title" => "área total", "icon" => "svg/tamanho.svg", "unidade" => " m²"],
                                ["info" => $imovel['qt_quarto_imovel'], "title" => "quartos", "icon" => "svg/cama.svg", "unidade" => ""],
                                ["info" => $imovel['qt_banheiro_imovel'], "title" => "banheiros", "icon" => "svg/toilet.svg", "unidade" => ""],
                                ["info" => $imovel['qt_vaga_imovel'], "title" => "vagas", "icon" => "svg/vaga.svg", "unidade" => ""]
                            ];

                            // Usa a imagem do banco; se o imóvel não tiver, usa a imagem padrão
                            $imagem = !empty($imovel['caminho']) ? $imovel['caminho'] : "Imagens/imagem-teste.png";
                            ?>

                            <form class="card-produto" action="imovel.php" method="GET" onclick="verimovel(this)">

                                <input type="hidden" name="id" value="<?= e($imovel['id_imovel']) ?>">

                                <img class="card-image" src="<?= e($imagem) ?>" alt="Imagem do imóvel">

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

                        <?php endforeach; ?>

                    </div>

                </section>
            </div>
        </main>

        <?php mostrar_footer(); ?>
    </body>
</html>
