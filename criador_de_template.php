<?php

function mostrar_header() {
?>
    <header>
        <img src="Imagens/logo.png" alt="Premium Imóveis">

        <nav>
            <a href="pesquisa.php?finalidade=comprar">Comprar</a>
            <a href="pesquisa.php?finalidade=alugar">Alugar</a>
            <a href="#">Vender</a>
            <a href="pesquisa.php">Descobrir</a>
            <a href="ajuda.php">Ajuda</a>
        </nav>
    </header>
<?php
}

function mostrar_footer() {
?>
    <footer class="rodape">

        <div class="superior">

            <img src="Imagens/logo.png" alt="Premium Imóveis">

            <a href="pesquisa.php?finalidade=comprar">Comprar</a>
            <a href="pesquisa.php?finalidade=alugar">Alugar</a>
            <a href="#">Vender</a>
            <a href="pesquisa.php">Descobrir</a>
            <a href="ajuda.php">Ajuda</a>

        </div>

        <section class="inferior">

            <div>
                <div class="localizacao">
                    <p>Cubatão/SP (CRECI: 288709-F)</p>
                    <p>R. São José, 238</p>
                </div>

                <div class="telefone">
                    <p>Plantão de Vendas</p>
                    <p>(13) 3372-1501</p>
                </div>
            </div>

            <div>
                <div class="localizacao">
                    <p>Cubatão/SP (CRECI: 288709-F)</p>
                    <p>R. São José, 238</p>
                </div>

                <div class="telefone">
                    <p>Plantão de Vendas</p>
                    <p>(13) 3372-1501</p>
                </div>
            </div>

            <div>
                <div class="localizacao">
                    <p>Cubatão/SP (CRECI: 111308)</p>
                    <p>R. São José, 238</p>
                </div>

                <div class="telefone">
                    <p>Plantão de Vendas</p>
                    <p>(13) 3372-1501</p>
                </div>

                <div class="whatsapp">
                    <p>Whatsapp</p>
                    <p>(13) 99775-7680</p>
                </div>
            </div>

        </section>

        <div class="copyright">
            <p>© Copyright 2026 Premium Imóveis -</p>
        </div>

    </footer>
<?php
}