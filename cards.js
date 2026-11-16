const contato = document.getElementById("contatoDiv");

function abrircontato() {
    contato.classList.add("active");
}

function fecharcontato() {
    contato.classList.remove("active");
}

function verimovel(form) {
    form.submit();
}
