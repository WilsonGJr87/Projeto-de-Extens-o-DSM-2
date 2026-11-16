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
    $cidade="";
    $bairro = "";
    $tipo = "";
    $quartos = "";
    $banheiros = "";
    $area_min = "";
    $area_max = "";

    $finalidade = $_GET['finalidade'] ?? "";
    // Verifica se o formulário foi enviado pelo método POST tudo certinho
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Recebe os valores preenchidos nos filtros (vc se matou pra entender isso)
        $cidade = $_POST["cidade"];
        $bairro = $_POST["bairro"];
        $tipo = $_POST["tipo"];
        $quartos = $_POST["quartos"];
        $banheiros = $_POST["banheiros"];
        $area_min = $_POST["area_min"];
        $area_max = $_POST["area_max"];
    }
?>

<?php
    // Prepara a consulta dos imóveis e tbm suas imagens (aulinha da simone ai)
    $consulta = $conexao->prepare("SELECT imovel.*, imagem.caminho
    FROM imovel LEFT JOIN imagem
    ON imovel.id_imovel = imagem.id_imovel

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
                            <a id="comprarOPT" href="?finalidade=comprar" class="seletor ativo">Comprar</a>
                            <a type="button" id="alugarOPT" href="?finalidade=alugar" class="seletor">Alugar</a>
                        </div>
                        <label>Cidade:</label>
                        <?php
                            echo '<input type="text" name="cidade" value="' . $cidade . '">';
                        ?>

                        <label>Bairro:</label>
                        <?php
                            echo '<input type="text" name="bairro" value="' . $bairro . '">';
                        ?>

                        <label>Tipo de imóvel:</label>
                        <select name="tipo">
                            <?php
                                if ($tipo == "") {
                                    echo '<option value="" selected>Todos</option>';
                                } else {
                                    echo '<option value="">Todos</option>';
                                }

                                if ($tipo == "Casa") {
                                    echo '<option value="Casa" selected>Casa</option>';
                                } else {
                                    echo '<option value="Casa">Casa</option>';
                                }

                                if ($tipo == "Apartamento") {
                                    echo '<option value="Apartamento" selected>Apartamento</option>';
                                } else {
                                    echo '<option value="Apartamento">Apartamento</option>';
                                }

                                if ($tipo == "Kitnet") {
                                    echo '<option value="Kitnet" selected>Kitnet</option>';
                                } else {
                                    echo '<option value="Kitnet">Kitnet</option>';
                                }
                            ?>
                        </select>

                        <label>Quantidade de quartos:</label>
                        <select name="quartos">
                            <?php
                                if ($quartos == "") {
                                    echo '<option value="" selected>Qualquer quantidade</option>';
                                } else {
                                    echo '<option value="">Qualquer quantidade</option>';
                                }

                                if ($quartos == "1") {
                                    echo '<option value="1" selected>1 ou mais</option>';
                                } else {
                                    echo '<option value="1">1 ou mais</option>';
                                }

                                if ($quartos == "2") {
                                    echo '<option value="2" selected>2 ou mais</option>';
                                } else {
                                    echo '<option value="2">2 ou mais</option>';
                                }

                                if ($quartos == "3") {
                                    echo '<option value="3" selected>3 ou mais</option>';
                                } else {
                                    echo '<option value="3">3 ou mais</option>';
                                }

                                if ($quartos == "4") {
                                    echo '<option value="4" selected>4 ou mais</option>';
                                } else {
                                    echo '<option value="4">4 ou mais</option>';
                                }
                            ?>
                        </select>

                        <label>Quantidade de banheiros:</label>
                        <select name="banheiros">
                            <?php
                                if ($banheiros == "") {
                                    echo '<option value="" selected>Qualquer quantidade</option>';
                                } else {
                                    echo '<option value="">Qualquer quantidade</option>';
                                }

                                if ($banheiros == "1") {
                                    echo '<option value="1" selected>1 ou mais</option>';
                                } else {
                                    echo '<option value="1">1 ou mais</option>';
                                }

                                if ($banheiros == "2") {
                                    echo '<option value="2" selected>2 ou mais</option>';
                                } else {
                                    echo '<option value="2">2 ou mais</option>';
                                }

                                if ($banheiros == "3") {
                                    echo '<option value="3" selected>3 ou mais</option>';
                                } else {
                                    echo '<option value="3">3 ou mais</option>';
                                }
                            ?>
                        </select>

                        <label>Área mínima (m²):</label>
                        <?php
                            echo '<input type="number" name="area_min" value="' . $area_min . '">';
                        ?>

                        <label>Área máxima (m²):</label>
                        <?php
                            echo '<input type="number" name="area_max" value="' . $area_max . '">';
                        ?>

                        <input type="submit" value="Pesquisar">

                    </form>

                </aside>

                <section class="resultados">

                    <h2>Imóveis encontrados</h2>

                    <!-- Lista onde os cards dos imóveis vao ser mostrados -->
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

                                <label class="preco-texto">R$ <?= e($imovel['vl_preco']) ?></label>

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