<?php
    // Importa o arquivo responsável pela conexão com o banco de dados
    require 'conexao.php';
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
    WHERE imovel.nm_cidade_imovel LIKE :cidade");

    // Define o valor que será utilizado no filtro de cidade e dps executa a consulta
    $consulta->bindValue(':cidade', '%' . $cidade . '%');
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

        <title>Pesquisa de Imóveis</title>
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

            <h1>Encontre seu imóvel ideal</h1>

            <div class="layout-pesquisa">

                <aside class="filtros">

                    <form action="pesquisa.php" method="POST">

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
                        <?php
                            // Percorre todos os imóveis encontrados no banco de dados (aulinha do ale)
                            foreach ($imoveis as $imovel) {
                        ?>

                        <!-- Div que cria os cards que vao apresentar as informações de um imóvel -->
                        <div class="card-imovel">

                            <!-- Exibe a imagem do imóvel -->
                            <img src="<?php echo $imovel['caminho']; ?>" alt="Imagem do imóvel">

                            <!-- Área que reúne as informações do imóvel -->
                            <div class="informacoes-imovel">
                                <h3>
                                    <?php echo $imovel['nm_tipo_imovel'] . " em " . $imovel['nm_cidade_imovel']; ?>
                                </h3>

                                <!-- Exibe o bairro e o tipo do imóvel -->
                                <p><strong>Bairro:</strong> <?php echo $imovel['nm_bairro_imovel']; ?></p>
                                <p><strong>Tipo:</strong> <?php echo $imovel['nm_tipo_imovel']; ?></p>

                                <!-- Organiza os detalhes do imóvel em uma gradezinha -->
                                <div class="detalhes-imovel">
                                    <p><strong>Quartos:</strong> <?php echo $imovel['qt_quarto_imovel']; ?></p>
                                    <p><strong>Banheiros:</strong> <?php echo $imovel['qt_banheiro_imovel']; ?></p>

                                    <!-- Exibe as áreas total e contruída -->
                                    <p><strong>Área total:</strong> <?php echo $imovel['qt_area_total_imovel']; ?>m²</p>
                                    <p><strong>Área construída:</strong> <?php echo $imovel['qt_area_construida_imovel']; ?>m²</p>
                                </div>

                                <button class="botao-imovel">Ver imóvel</button>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                </section>
            </div>
        </main>

        <footer class="rodape">
            <p>© Copyright 2026 Premium Imóveis -</p>
        </footer>
    </body>
</html>
