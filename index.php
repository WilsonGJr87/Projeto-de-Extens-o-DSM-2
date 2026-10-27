<!DOCTYPE HTML>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="home.css">

        <title>Home</title>
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

            <div class="buscar-container">
                <form class="card-form-pesquisar">
                    <h2>Milhões de opções e facilidades pra achar a casa ideal pra sua vida.</h2>
                    <div class=botoes>
                        <button class="seletor">Comprar</button>
                        <button class="seletor">Alugar</button>
                        <button class="seletor">Imovél novo</button>
                    </div>
                    
                    <label> Onde deseja morar? </label>
                        <input class="texto" type="search">

                    <label> Tipo de imóvel </label>
                    <select class="texto"   >
                        <option value="#">Casa</option>
                        <option value="#">Apartamento</option>
                        <option value="#">Kitnet</option>
                    </select>

                        <input class="buscar" type="submit" value="Buscar">
                </form>

                <div class="card-pesquisar"></div>
            </div>

            <h3> Imóveis em destaque </h3>
            <h1> Encontre o seu imóvel ideal para o seu estilo de vida! </h1>

            <div class="container-produtos">
                <div class="card-produto"></div>
            </div>

        </main>

        <footer>
            <p>Direitos reservados para fulano de tal</p>
        </footer>
    </body>
</html>