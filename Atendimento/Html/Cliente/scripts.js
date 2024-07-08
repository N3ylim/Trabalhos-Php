let contadorNormal = 1;
let contadorPrioritario = 1;

function gerarSenha(tipo) {
    let senha = '';
    if (tipo === 'normal') {
        senha = 'N' + contadorNormal++;
    } else if (tipo === 'prioritario') {
        senha = 'E' + contadorPrioritario++;
    }
    
    const senhaGerada = document.getElementById('senhaGerada');
    senhaGerada.textContent = `Sua senha é: ${senha}`;
    senhaGerada.style.display = 'block';

    // Enviar os dados para o backend
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../../Php/save_atendimento.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send("tipo=" + tipo + "&senha=" + senha);

    // Adicionando um feedback sonoro
    const audio = new Audio('success.mp3'); // Certifique-se de ter um arquivo de som adequado
    audio.play();
}
