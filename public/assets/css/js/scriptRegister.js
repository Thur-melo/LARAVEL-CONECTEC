function nextStep() {
    // Validar os campos do passo 1
    var formStep1 = document.getElementById('formStep1');
    if (formStep1.checkValidity()) {
        // Esconde a Etapa 1 e mostra a Etapa 2
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';

        // Atualiza a barra de progresso
        var progressBar = document.getElementById('progressBar');
        progressBar.style.width = '100%';
        progressBar.innerText = 'Passo 2 de 2';
    } else {
        formStep1.reportValidity();
    }
}


