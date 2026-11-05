<?php
    $cidade="";
    $bairro = "";
    $tipo = "";
    $quartos = "";
    $banheiros = "";
    $area_min = "";
    $area_max = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $cidade = $_POST["cidade"];
        $bairro = $_POST["bairro"];
        $tipo = $_POST["tipo"];
        $quartos = $_POST["quartos"];
        $banheiros = $_POST["banheiros"];
        $area_min = $_POST["area_min"];
        $area_max = $_POST["area_max"];
    }

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
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo "<h2>Dados recebidos:</h2>";
                    echo "Cidade: " . $cidade . "<br>";
                    echo "Bairro: " . $bairro . "<br>";
                    echo "Tipo de imóvel: " . $tipo . "<br>";
                    echo "Quartos: " . $quartos . "<br>";
                    echo "Banheiros: " . $banheiros . "<br>";
                    echo "Área mínima: " . $area_min . "<br>";
                    echo "Área máxima: " . $area_max . "<br>";
                }
            ?>
        </main>

        <footer class="rodape">
            <p>Direitos reservados para fulano de tal</p>
        </footer>
    </body>
</html>