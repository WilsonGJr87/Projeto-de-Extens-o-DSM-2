<?php
// Número do WhatsApp: só dígitos, com código do país e DDD (ex.: 55 + 13 + número)
$wppNum = '5513900000000';
?>
<!DOCTYPE HTML>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="ajuda.css">

        <title>Ajuda</title>

        <script src="faq.js" defer></script>
    </head>

    <body>
        <header>

            <img src="https://imgs.search.brave.com/pFuXyL40XNW9Oa0CY8o8C2n1kqRWZlzlkctFQ3VsW34/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdGF0/aWMucmZzdGF0LmNv/bS9yZW5kZXJmb3Jl/c3QvaW1hZ2VzL3YyL2xvZ28taG9tZXBh/Z2UvbG9nby01LTEucG5n">

            <nav>
                <a href="#">Comprar</a>
                <a href="#">Alugar</a>
                <a href="#">Vender</a>
                <a href="#">Descobrir</a>
                <a href="#">Ajuda</a>
            </nav>
        </header>

        <main>

            <div class="buscar-container">
                <h1> Como podemos ajudar? </h1>
                <p> Encontre respostas para suas dúvidas. </p>

                <form class="card-form-pesquisar">
                    <input class="texto" type="search" name="q" autocomplete="off" aria-label="Buscar nas perguntas frequentes" placeholder="Digite sua dúvida...">
                </form>
            </div>

            <h2> Escolha um assunto </h2>
            <div class="container-categorias">
                <a class="card-categoria" href="#">Comprar imóvel</a>
                <a class="card-categoria" href="#">Alugar imóvel</a>
                <a class="card-categoria" href="#">Vender imóvel</a>
                <a class="card-categoria" href="#">Financiamento</a>
                <a class="card-categoria" href="#">Minha conta</a>
                <a class="card-categoria" href="#">Agendamentos</a>
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
                <button type="button" class="botao-whatsapp" data-numero="<?php echo htmlspecialchars($wppNum); ?>">Fale pelo WhatsApp</button>
            </div>

        </main>

        <footer class="rodape">
            <p>&copy; <?php echo date('Y'); ?> Todos os direitos reservados.</p>
        </footer>
    </body>
</html>
