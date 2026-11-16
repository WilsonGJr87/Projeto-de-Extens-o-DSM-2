<?php

require_once "criador_de_template.php";

function e($valor) {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$wppNum = '5513900000000';
?>

<!DOCTYPE HTML>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="ajuda.css">

        <script src="faq.js" defer></script>

        <title>Ajuda</title>
    </head>

    <body>
        <?php mostrar_header(); ?>

        <main>

            <div class="buscar-container">
                <h1> Como podemos ajudar? </h1>
                <p> Encontre respostas para suas dúvidas. </p>

                <form class="card-form-pesquisar">
                    <input class="texto" id="busca-faq" type="search" name="q" autocomplete="off" aria-label="Buscar nas perguntas frequentes" placeholder="Digite sua dúvida...">
                </form>
            </div>

            <h2> Escolha um assunto </h2>
            <div class="container-categorias">
                <a class="card-categoria" href="#">Comprar imóvel</a>
                <a class="card-categoria" href="#">Alugar imóvel</a>
                <a class="card-categoria" href="#">Vender imóvel</a>
                <a class="card-categoria card-financiamento" href="financiamento.php">Financiamento</a>
            </div>

            <h2> Perguntas frequentes </h2>

            <div class="container-faq">
                <details>
                    <summary>Como agendar uma visita?</summary>
                    <p>Abra a página do imóvel que você gostou e clique em "Agendar visita". Escolha o dia e o horário disponíveis e confirme. Você receberá a confirmação por e-mail e poderá remarcar ou cancelar em "Agendamentos".</p>
                </details>

                <details>
                    <summary>Quais documentos preciso para alugar?</summary>
                    <p>Em geral, são pedidos documento de identidade, CPF, comprovante de renda e comprovante de residência. Os documentos exigidos podem variar conforme o imóvel e a garantia escolhida (fiador, seguro-fiança ou caução).</p>
                </details>

                <details>
                    <summary>Como funciona o financiamento?</summary>
                    <p>Você escolhe o imóvel, faz a simulação com o banco e envia a documentação para análise de crédito. Aprovado o financiamento, o imóvel passa por avaliação e, por fim, o contrato é assinado e registrado em cartório.</p>
                </details>

                <details>
                    <summary>Como anunciar meu imóvel?</summary>
                    <p>Acesse "Vender" ou "Alugar" no menu, preencha os dados do imóvel e envie as fotos. Depois de revisado pela nossa equipe, o anúncio é publicado no site.</p>
                </details>
            </div>

            <p class="faq-status" id="faq-status" role="status" aria-live="polite"></p>

            <div class="card-whatsapp">
                <h2> Ainda precisa de ajuda? </h2>
                <p>Nossa equipe está pronta para atender você.</p>
                <button type="button" class="botao-whatsapp" data-numero="<?= htmlspecialchars($wppNum) ?>">Fale pelo WhatsApp</button>
            </div>

        </main>
        <?php mostrar_footer(); ?>
    </body>
</html>
