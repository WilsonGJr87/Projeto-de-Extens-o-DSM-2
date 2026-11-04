<!DOCTYPE HTML>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="ajuda.css">

        <title>Ajuda</title>
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
                    <input class="texto" type="search" placeholder="Digite sua dúvida...">
                </form>
            </div>

            <h3> Como podemos ajudar você? </h3>
            <div class="container-categorias">
                <a class="card-categoria" href="#">Comprar imóvel</a>
                <a class="card-categoria" href="#">Alugar imóvel</a>
                <a class="card-categoria" href="#">Vender imóvel</a>
                <a class="card-categoria" href="#">Financiamento</a>
                <a class="card-categoria" href="#">Minha conta</a>
                <a class="card-categoria" href="#">Agendamentos</a>
            </div>

            <h3> Perguntas frequentes </h3>

            <div class="container-faq">
                <details>
                    <summary>Como agendar uma visita?</summary>
                    <p>Resposta sobre agendamento de visitas.</p>
                </details>

                <details>
                    <summary>Quais documentos preciso para alugar?</summary>
                    <p>Resposta sobre documentos para locação.</p>
                </details>

                <details>
                    <summary>Como funciona o financiamento?</summary>
                    <p>Resposta sobre financiamento imobiliário.</p>
                </details>

                <details>
                    <summary>Como anunciar meu imóvel?</summary>
                    <p>Resposta sobre anúncio de imóveis.</p>
                </details>
            </div>

            <div class="card-whatsapp">
                <h3> Ainda precisa de ajuda? </h3>
                <p>Nossa equipe está pronta para atender você.</p>
                <a class="botao-whatsapp" href="https://wa.me/<?php echo $wppNum; ?>" target="_blank">Fale pelo WhatsApp</a>
            </div>

        </main>

        <footer class="rodape">
            <p>Direitos reservados para fulano de tal</p>
        </footer>
    </body>
</html>
