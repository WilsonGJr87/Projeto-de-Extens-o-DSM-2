const botaoWpp = document.querySelector('.botao-whatsapp');

if (botaoWpp) {
    botaoWpp.addEventListener('click', () => {
        const mensagem = encodeURIComponent(botaoWpp.dataset.mensagem || 'Olá, preciso de ajuda!');
        window.open('https://wa.me/' + botaoWpp.dataset.numero + '?text=' + mensagem, '_blank', 'noopener');
    });
}
