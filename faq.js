(() => {
    const campo = document.getElementById('busca-faq');
    const itens = document.querySelectorAll('.container-faq details');
    const status = document.getElementById('faq-status');
    const botaoWpp = document.querySelector('.botao-whatsapp');

    // minúsculas e sem acento: "Visíta" passa a casar com "visita"
    const limpar = texto => texto
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '');

    if (campo) {
        campo.closest('form').addEventListener('submit', e => e.preventDefault());

        campo.addEventListener('input', () => {
            const palavras = limpar(campo.value).split(/\s+/).filter(Boolean);
            const visiveis = [];

            itens.forEach(item => {
                const texto = limpar(item.textContent);
                const bate = palavras.every(palavra => texto.includes(palavra));

                item.hidden = !bate;
                if (bate) visiveis.push(item);
            });

            // 1 resultado: já abre a resposta; busca vazia: fecha tudo
            itens.forEach(item => {
                item.open = palavras.length > 0 && visiveis.length === 1 && !item.hidden;
            });

            if (palavras.length === 0) {
                status.textContent = '';
            } else if (visiveis.length === 0) {
                status.textContent = 'Nenhuma pergunta encontrada. Tente outras palavras ou fale com a gente pelo WhatsApp.';
            } else {
                status.textContent = visiveis.length + (visiveis.length === 1 ? ' resultado encontrado.' : ' resultados encontrados.');
            }
        });
    }

    // Botão em vez de link: o navegador não mostra a URL no canto da tela ao passar o mouse
    if (botaoWpp) {
        botaoWpp.addEventListener('click', () => {
            const mensagem = encodeURIComponent('Olá, preciso de ajuda!');
            window.open('https://wa.me/' + botaoWpp.dataset.numero + '?text=' + mensagem, '_blank', 'noopener');
        });
    }
})();
