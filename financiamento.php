<?php
/*
 * Simulador de financiamento imobiliário
 * Sistemas: Price (parcelas fixas) e SAC (parcelas decrescentes)
 */

// Número do WhatsApp: só dígitos, com código do país e DDD (ex.: 55 + 13 + número)
$wppNum = '5513900000000';

function lerNumero(string $valor): ?float
{
    $valor  = str_replace(',', '.', trim($valor));
    $numero = filter_var($valor, FILTER_VALIDATE_FLOAT);

    return $numero === false ? null : (float) $numero;
}

function reais(float $valor): string
{
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

function simularFinanciamento(float $financiado, float $jurosAnual, int $meses, string $sistema): array
{
    // taxa efetiva anual convertida para taxa mensal equivalente
    $i = pow(1 + $jurosAnual / 100, 1 / 12) - 1;

    $saldo          = $financiado;
    $total          = 0.0;
    $parcelas       = [];
    $parcelaPrice   = 0.0;
    $amortizacaoSac = 0.0;

    if ($sistema === 'sac') {
        // amortização constante: a parcela diminui a cada mês
        $amortizacaoSac = $financiado / $meses;
    } else {
        // Price: parcela fixa
        $parcelaPrice = $i > 0
            ? $financiado * $i / (1 - pow(1 + $i, -$meses))
            : $financiado / $meses;
    }

    for ($mes = 1; $mes <= $meses; $mes++) {
        $juros = $saldo * $i;

        if ($sistema === 'sac') {
            $amortizacao = $amortizacaoSac;
            $parcela     = $amortizacao + $juros;
        } else {
            $parcela     = $parcelaPrice;
            $amortizacao = $parcela - $juros;
        }

        $saldo  = max(0.0, $saldo - $amortizacao);
        $total += $parcela;

        $parcelas[] = [
            'numero'      => $mes,
            'parcela'     => round($parcela, 2),
            'amortizacao' => round($amortizacao, 2),
            'juros'       => round($juros, 2),
            'saldo'       => round($saldo, 2),
        ];
    }

    return [
        'financiado'  => $financiado,
        'meses'       => $meses,
        'taxa_mensal' => $i * 100,
        'primeira'    => $parcelas[0]['parcela'],
        'ultima'      => $parcelas[$meses - 1]['parcela'],
        'total'       => round($total, 2),
        'total_juros' => round($total - $financiado, 2),
        'parcelas'    => $parcelas,
    ];
}

$sistemas = [
    'price' => 'Price (parcelas fixas)',
    'sac'   => 'SAC (parcelas decrescentes)',
];

$dados     = ['valor' => '', 'entrada' => '', 'anos' => '30', 'juros' => '', 'sistema' => 'price'];
$erros     = [];
$avisos    = [];
$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($dados as $campo => $padrao) {
        $dados[$campo] = trim((string) ($_POST[$campo] ?? ''));
    }

    $valor   = lerNumero($dados['valor']);
    $entrada = $dados['entrada'] === '' ? 0.0 : lerNumero($dados['entrada']);
    $anos    = filter_var($dados['anos'], FILTER_VALIDATE_INT);
    $juros   = lerNumero($dados['juros']);

    if ($valor === null || $valor <= 0) {
        $erros[] = 'Informe o valor do imóvel.';
    }

    if ($entrada === null || $entrada < 0) {
        $erros[] = 'A entrada deve ser zero ou um valor positivo.';
    } elseif ($valor !== null && $valor > 0 && $entrada >= $valor) {
        $erros[] = 'A entrada deve ser menor que o valor do imóvel.';
    }

    if ($anos === false || $anos < 1 || $anos > 35) {
        $erros[] = 'O prazo deve ficar entre 1 e 35 anos.';
    }

    if ($juros === null || $juros < 0 || $juros > 50) {
        $erros[] = 'Informe uma taxa de juros anual entre 0% e 50%.';
    }

    if (!isset($sistemas[$dados['sistema']])) {
        $erros[] = 'Escolha um sistema de amortização válido.';
    }

    if (!$erros) {
        $resultado = simularFinanciamento($valor - $entrada, $juros, $anos * 12, $dados['sistema']);

        // x + y = z  ->  valor do imóvel + juros = total que você vai pagar
        $totalPago = round($valor + $resultado['total_juros'], 2);

        $resultado += [
            'valor'      => $valor,
            'entrada'    => $entrada,
            'anos'       => $anos,
            'sistema'    => $dados['sistema'],
            'total_pago' => $totalPago,
            'perc_a_mais' => $resultado['total_juros'] / $valor * 100,
            'perc_juros'  => $resultado['total_juros'] / $totalPago * 100,
        ];

        if ($entrada / $valor < 0.2) {
            $avisos[] = 'Muitos bancos exigem entrada de cerca de 20% do valor do imóvel. Confirme a regra com a instituição.';
        }
    }
}

?>

<!DOCTYPE HTML>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="financiamento.css">

        <script src="financiamento.js" defer></script>

        <title>Simular financiamento</title>
    </head>

    <body>
        <header>

            <img src="https://imgs.search.brave.com/pFuXyL40XNW9Oa0CY8o8C2n1kqRWZlzlkctFQ3VsW34/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdGF0/aWMucmZzdGF0LmNv/bS9yZW5kZXJmb3Jl/c3QvaW1hZ2VzL3Yy/L2xvZ28taG9tZXBh/Z2UvbG9nby01LTEu/cG5n" alt="Logo">

            <nav>
                <a href="#">Comprar</a>
                <a href="#">Alugar</a>
                <a href="#">Vender</a>
                <a href="#">Descobrir</a>
                <a href="ajuda.php">Ajuda</a>
            </nav>
        </header>

        <main>

            <a class="link-voltar" href="ajuda.php">&larr; Voltar para a Ajuda</a>

            <div class="simular-container">
                <h1> Simule seu financiamento </h1>
                <p> Veja quanto você vai pagar de verdade, com juros. </p>
            </div>

            <div class="container-simulador">

                <form class="card-form-simulador" method="post" action="financiamento.php#resultado">
                    <h2> Dados da simulação </h2>

<?php if ($erros): ?>
                    <div class="alerta-erro" role="alert">
<?php foreach ($erros as $erro): ?>
                        <p><?= htmlspecialchars($erro) ?></p>
<?php endforeach; ?>
                    </div>
<?php endif; ?>

                    <div class="campos-simulador">

                        <div class="campo-simulador">
                            <label for="valor">Valor do imóvel (R$)</label>
                            <input class="texto" id="valor" name="valor" type="number" min="1" step="0.01" inputmode="decimal" placeholder="Ex.: 500000" value="<?= htmlspecialchars($dados['valor']) ?>" required>
                        </div>

                        <div class="campo-simulador">
                            <label for="entrada">Valor da entrada (R$)</label>
                            <input class="texto" id="entrada" name="entrada" type="number" min="0" step="0.01" inputmode="decimal" placeholder="Ex.: 100000" value="<?= htmlspecialchars($dados['entrada']) ?>">
                        </div>

                        <div class="campo-simulador">
                            <label for="anos">Prazo (anos)</label>
                            <input class="texto" id="anos" name="anos" type="number" min="1" max="35" step="1" inputmode="numeric" value="<?= htmlspecialchars($dados['anos']) ?>" required>
                        </div>

                        <div class="campo-simulador">
                            <label for="juros">Juros (% ao ano)</label>
                            <input class="texto" id="juros" name="juros" type="number" min="0" max="50" step="0.01" inputmode="decimal" placeholder="Ex.: 11.5" value="<?= htmlspecialchars($dados['juros']) ?>" required>
                        </div>

                        <div class="campo-simulador campo-largo">
                            <label for="sistema">Sistema de amortização</label>
                            <select class="texto" id="sistema" name="sistema">
<?php foreach ($sistemas as $chave => $nome): ?>
                                <option value="<?= $chave ?>"<?= $dados['sistema'] === $chave ? ' selected' : '' ?>><?= htmlspecialchars($nome) ?></option>
<?php endforeach; ?>
                            </select>
                            <p class="dica">Price: parcelas iguais do início ao fim. SAC: começa mais alta e diminui a cada mês.</p>
                        </div>

                    </div>

                    <button type="submit" class="buscar">Simular</button>
                </form>

<?php if ($resultado): ?>
                <section class="card-resultado" id="resultado" aria-live="polite">
                    <h2> Resultado da simulação </h2>

                    <div class="parcela-destaque">
<?php if ($resultado['sistema'] === 'sac'): ?>
                        <span>Primeira parcela</span>
                        <strong><?= reais($resultado['primeira']) ?></strong>
                        <small>A última parcela será de <?= reais($resultado['ultima']) ?></small>
<?php else: ?>
                        <span>Parcela mensal (<?= $resultado['meses'] ?> parcelas iguais)</span>
                        <strong><?= reais($resultado['primeira']) ?></strong>
<?php endif; ?>
                    </div>

                    <div class="conta-bloco">
                        <h3> Quanto você vai pagar de verdade </h3>

                        <div class="conta">
                            <div class="conta-item">
                                <span class="conta-valor"><?= reais($resultado['valor']) ?></span>
                                <span class="conta-legenda">Valor do imóvel</span>
                            </div>

                            <span class="conta-sinal">+</span>

                            <div class="conta-item conta-juros">
                                <span class="conta-valor"><?= reais($resultado['total_juros']) ?></span>
                                <span class="conta-legenda">Juros (parcelas a mais)</span>
                            </div>

                            <span class="conta-sinal">=</span>

                            <div class="conta-item conta-total">
                                <span class="conta-valor"><?= reais($resultado['total_pago']) ?></span>
                                <span class="conta-legenda">Total pago (entrada + parcelas)</span>
                            </div>
                        </div>

                        <p class="conta-resumo">
                            Os juros fazem o imóvel custar <strong class="texto-juros"><?= number_format($resultado['perc_a_mais'], 1, ',', '.') ?>% a mais</strong>.
                        </p>

                        <div class="barra-proporcao" aria-hidden="true">
                            <span class="barra-imovel" style="width: <?= number_format(100 - $resultado['perc_juros'], 2, '.', '') ?>%"></span>
                            <span class="barra-juros" style="width: <?= number_format($resultado['perc_juros'], 2, '.', '') ?>%"></span>
                        </div>

                        <p class="barra-legenda">
                            <span>Imóvel: <?= number_format(100 - $resultado['perc_juros'], 1, ',', '.') ?>% do total</span>
                            <span class="texto-juros">Juros: <?= number_format($resultado['perc_juros'], 1, ',', '.') ?>% do total</span>
                        </p>
                    </div>

                    <dl class="resultado-lista">
                        <div><dt>Entrada (<?= number_format($resultado['entrada'] / $resultado['valor'] * 100, 1, ',', '.') ?>%)</dt><dd><?= reais($resultado['entrada']) ?></dd></div>
                        <div><dt>Valor financiado</dt><dd><?= reais($resultado['financiado']) ?></dd></div>
                        <div><dt>Prazo</dt><dd><?= $resultado['meses'] ?> parcelas (<?= $resultado['anos'] ?> anos)</dd></div>
                        <div><dt>Taxa mensal equivalente</dt><dd><?= number_format($resultado['taxa_mensal'], 2, ',', '.') ?>% a.m.</dd></div>
                        <div><dt>Soma das parcelas</dt><dd><?= reais($resultado['total']) ?></dd></div>
                        <div><dt>Juros pagos</dt><dd class="texto-juros"><?= reais($resultado['total_juros']) ?></dd></div>
                    </dl>

                    <details class="detalhes-parcelas">
                        <summary>Ver como ficam as parcelas com juros</summary>

                        <p>Em cada parcela, uma parte abate a dívida (amortização) e outra é juros, em vermelho.</p>

                        <div class="tabela-parcelas">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Parcela</th>
                                        <th>Valor</th>
                                        <th>Amortização</th>
                                        <th>Juros</th>
                                        <th>Saldo devedor</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php foreach ($resultado['parcelas'] as $p): ?>
                                    <tr>
                                        <td><?= $p['numero'] ?>/<?= $resultado['meses'] ?></td>
                                        <td><?= reais($p['parcela']) ?></td>
                                        <td><?= reais($p['amortizacao']) ?></td>
                                        <td class="texto-juros"><?= reais($p['juros']) ?></td>
                                        <td><?= reais($p['saldo']) ?></td>
                                    </tr>
<?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Total</td>
                                        <td><?= reais($resultado['total']) ?></td>
                                        <td><?= reais($resultado['financiado']) ?></td>
                                        <td class="texto-juros"><?= reais($resultado['total_juros']) ?></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </details>

<?php foreach ($avisos as $aviso): ?>
                    <p class="aviso"><?= htmlspecialchars($aviso) ?></p>
<?php endforeach; ?>

                    <p class="aviso">Simulação apenas informativa. Não inclui seguros, tarifas, taxa de avaliação nem correção monetária (como a TR). O valor final depende da instituição financeira.</p>

<?php
$mensagemWpp = sprintf(
    'Olá! Fiz uma simulação de financiamento: imóvel de %s, entrada de %s, prazo de %d anos, sistema %s. Com juros, o total seria %s. Gostaria de falar com um consultor.',
    reais($resultado['valor']),
    reais($resultado['entrada']),
    $resultado['anos'],
    strtoupper($resultado['sistema']),
    reais($resultado['total_pago'])
);
?>
                    <button type="button" class="botao-whatsapp" data-numero="<?= htmlspecialchars($wppNum) ?>" data-mensagem="<?= htmlspecialchars($mensagemWpp) ?>">Falar com um consultor</button>
                </section>
<?php endif; ?>

            </div>

        </main>

        <footer class="rodape">
            <div class="superior">
                <img src="https://imgs.search.brave.com/pFuXyL40XNW9Oa0CY8o8C2n1kqRWZlzlkctFQ3VsW34/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdGF0/aWMucmZzdGF0LmNv/bS9yZW5kZXJmb3Jl/c3QvaW1hZ2VzL3Yy/L2xvZ28taG9tZXBh/Z2UvbG9nby01LTEu/cG5n" alt="Logo">
                <a href="#">Comprar</a>
                <a href="#">Alugar</a>
                <a href="#">Vender</a>
                <a href="#">Descobrir</a>
                <a href="ajuda.php">Ajuda</a>
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
