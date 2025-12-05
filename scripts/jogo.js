// Seleção dos elementos para exibição do Status do jogo
const areaStatus = document.getElementById('status-area');
const elementoTempo = document.getElementById('tempo');
const elementoVelocidade = document.getElementById('velocidade');
const elementoPrecisao = document.getElementById('precisao');
const elementoAcertos = document.getElementById('acertos');
const elementoErros = document.getElementById('erros');

// Seleção dos elementos para exibição dos resultados finais
const resultado = document.getElementById('resultado-area');
const elementoVelocidadeFinal = document.getElementById('velocidade-final');
const elementoPrecisaoFinal = document.getElementById('precisao-final');
const elementoAcertosFinal = document.getElementById('acertos-final');
const elementoErrosFinal = document.getElementById('erros-final');
const botaoReiniciar = document.getElementById('btn-jogar-novamente');

// Seleção dos elementos da área de digitação
const quadroPalavras = document.getElementById('quadro-palavras');
const inputDigitacao = document.getElementById('input-digitacao');
const areaJogo = document.getElementById('jogo-area');

// Variáveis de controle do jogo
let velocidade;
let precisao;
let totalLetrasDigitadas;
let acertos;
let erros;
let tempo;

//Lê arquivo JSON, com as palavras
let listaDePalavras = [];
fetch('palavras.json')
  .then((resposta) => resposta.json())
  .then((dados) => {
    listaDePalavras = dados;
    console.log('Dicionário carregado!', listaDePalavras);
    iniciarJogo();
  })
  .catch((erro) => console.error('Erro ao carregar palavras:', erro));

// Função para pegar uma palavra aleatório de listaDePalavras
function gerarPalavra() {
  const indice = Math.floor(Math.random() * listaDePalavras.length);
  return listaDePalavras[indice];
}

// Função para gerar o parágrafo de palavras no quadro de digitação
function gerarParagrafo() {
  quadroPalavras.innerHTML = '';
  const paragrafoQuadro = document.createElement('p');

  for (let i = 0; i < 100; i++) {
    const palavraNova = gerarPalavra();
    // Cada letra da palavra é transformada em um span
    palavraNova.split('').forEach((c) => {
      const caractereAdicionado = document.createElement('span');
      caractereAdicionado.textContent = c;
      paragrafoQuadro.appendChild(caractereAdicionado);
    });
    // Adiciona um espaço entre as palavras
    const espaco = document.createElement('span');
    espaco.textContent = ' ';
    paragrafoQuadro.appendChild(espaco);
  }
  quadroPalavras.appendChild(paragrafoQuadro);
  quadroPalavras.querySelectorAll('span').forEach((span) => {
    span.classList.remove('letra-ativa', 'letra-correta', 'letra-errada');
  });
  const primeiraLetra = quadroPalavras.querySelector('span');
  // Define a primeira letra como ativa
  if (primeiraLetra) {
    primeiraLetra.classList.add('letra-ativa');
  }
}

// Inicializa o jogo, resetando todas as variáveis e preparando o quadro de palavras
function iniciarJogo() {
  if (cronometro) {
    clearInterval(cronometro);
  }
  velocidade = 0;
  precisao = 0;
  totalLetrasDigitadas = 0;
  acertos = 0;
  erros = 0;
  tempo = 60;
  inputDigitacao.value = '';

  gerarParagrafo();

  elementoTempo.textContent = tempo;
  elementoVelocidade.textContent = velocidade;
  elementoPrecisao.textContent = precisao + '%';
  elementoAcertos.textContent = acertos;
  elementoErros.textContent = erros;

  inputDigitacao.focus();
}

// Cronômetro do jogo
let cronometro;
function iniciarCronometro() {
  cronometro = setInterval(() => {
    if (tempo <= 0) {
      // Quando o tempo acabar, finaliza o jogo
      fimDeJogo();
      clearInterval(cronometro);
      return;
    }
    tempo--;
    elementoTempo.textContent = tempo;
    calcularVelocidade(); // Atualiza a velocidade a cada segundo
  }, 1000);
}

// Evento que captura a digitação do usuário
inputDigitacao.addEventListener('keydown', (event) => {
  if (event.key.length > 1) {
    return;
  }

  if (totalLetrasDigitadas === 0) {
    iniciarCronometro(); //Caso seja a primeira letra digitada, inicia o cronômetro
  }

  const teclaPressionada = event.key;
  const letraAtivaElemento = document.querySelector('.letra-ativa');

  if (!letraAtivaElemento || teclaPressionada.length > 1) {
    return;
  }

  event.preventDefault();

  let letraAtiva = letraAtivaElemento.textContent;
  const proximoElemento = letraAtivaElemento.nextElementSibling;

  letraAtivaElemento.classList.remove('letra-ativa');

  if (teclaPressionada === letraAtiva) {
    letraAtivaElemento.classList.add('letra-correta');
    acertos++;
    elementoAcertos.textContent = acertos;
  } else {
    letraAtivaElemento.classList.add('letra-errada');
    erros++;
    elementoErros.textContent = erros;
  }

  totalLetrasDigitadas++;

  if (proximoElemento) {
    proximoElemento.classList.add('letra-ativa');
  } else {
    console.log('Fim de jogo');
    clearInterval(cronometro);
    fimDeJogo();
  }

  inputDigitacao.value = '';

  calcularPrecisao();
});

//Função que calcula a precisão, divindo acerto pelo total de letras digitadas
function calcularPrecisao() {
  if (totalLetrasDigitadas > 0) {
    precisao = Math.floor((acertos / totalLetrasDigitadas) * 100);
  } else {
    precisao = 0;
  }
  elementoPrecisao.textContent = precisao + '%';
}

//Função para calcula a velocidade (PPM), considerando o tamanho de palavra de 5 caracteres
function calcularVelocidade() {
  const tempoPassado = 60 - tempo;
  if (tempoPassado > 0) {
    velocidade = Math.round(acertos / 5 / (tempoPassado / 60));
    elementoVelocidade.textContent = velocidade;
  } else {
    elementoVelocidade.textContent = 0;
  }
}

//Função para salvar partida no banco de dados, enviados requisição para o arquivo salvarPartida.php
function salvarPartidas() {
  const dadosParaEnviar = {
    velocidade: velocidade,
    precisao: precisao,
    acertos: acertos,
    erros: erros,
  };

  fetch('salvarPartida.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(dadosParaEnviar),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.sucesso) {
        console.log('Partida salva com sucesso!');
      } else {
        console.error('Erro ao salvar: ', data.erro);
      }
    })
    .catch((error) => console.error('Erro na requisiçao: ', error));
}

//Função para o FIM DE JOGO - retira status e área do jogo, e mostra o resultado
function fimDeJogo() {
  areaStatus.classList.add('d-none');
  areaJogo.classList.add('d-none');
  resultado.classList.remove('d-none');
  resultado.classList.add('d-flex');
  elementoPrecisaoFinal.textContent = precisao + '%';
  elementoVelocidadeFinal.textContent = velocidade;
  elementoAcertosFinal.textContent = acertos;
  elementoErrosFinal.textContent = erros;
  salvarPartidas();
}

//Função que gera o mesmo formato do ínicio do jogo, retira o resultado, e coloca novamente a área do jogo
function reiniciarJogo() {
  iniciarJogo();
  resultado.classList.remove('d-flex');
  resultado.classList.add('d-none');
  areaJogo.classList.remove('d-none');
  areaStatus.classList.remove('d-none');
}

//Reinicia o jogo ao botão Jogar Novamente ser clicado
botaoReiniciar.addEventListener('click', (event) => {
  reiniciarJogo();
});
