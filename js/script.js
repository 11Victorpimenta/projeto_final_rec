document.addEventListener('DOMContentLoaded', function () {

    var notaInput = document.querySelector('#nota');
    var estrelas = document.querySelectorAll('.estrela-botao');
    var comentario = document.querySelector('#comentario');
    var erro = document.querySelector('.erro-avaliacao');

    if (notaInput && estrelas.length) {
        var notaInicial = parseInt(notaInput.value, 10) || 0;

        function marcarEstrelas(valor) {
            estrelas.forEach(function (estrela) {
                var valorEstrela = parseInt(estrela.dataset.value, 10);
                estrela.classList.toggle('ativa', valorEstrela <= valor);
            });
        }

        if (notaInicial) {
            marcarEstrelas(notaInicial);
        }

        estrelas.forEach(function (estrela) {
            estrela.addEventListener('click', function () {
                var valor = parseInt(estrela.dataset.value, 10);
                notaInput.value = valor;
                marcarEstrelas(valor);
            });

            estrela.addEventListener('mouseenter', function () {
                var valorHover = parseInt(estrela.dataset.value, 10);

                estrelas.forEach(function (s) {
                    var v = parseInt(s.dataset.value, 10);
                    s.style.color = v <= valorHover ? '#ff5a1f' : '';
                });
            });

            estrela.addEventListener('mouseleave', function () {
                var notaAtual = parseInt(notaInput.value, 10) || 0;

                marcarEstrelas(notaAtual);

                estrelas.forEach(function (s) {
                    s.style.color = '';
                });
            });
        });
    }

    var form = document.querySelector('.avaliacao-form');

    if (form) {
        form.addEventListener('submit', function (event) {
            var nota = notaInput ? parseInt(notaInput.value, 10) : 0;
            var texto = comentario ? comentario.value.trim() : '';

            if (nota < 1 || nota > 5 || texto === '') {
                event.preventDefault();

                if (erro) {
                    if (nota < 1) {
                        erro.textContent = 'Selecione uma nota de 1 a 5 estrelas.';
                    } else {
                        erro.textContent = 'Escreva um comentário antes de enviar.';
                    }
                }
            }
        });
    }

    var campoPesquisaProduto = document.getElementById('pesquisarProduto');
    var cards = document.querySelectorAll('.card-produto');

    if (campoPesquisaProduto && cards.length) {
        campoPesquisaProduto.addEventListener('input', function () {
            var termo = campoPesquisaProduto.value.toLowerCase().trim();

            cards.forEach(function (card) {
                var titulo = card.querySelector('h3');
                var descricao = card.querySelector('p');

                var textoTitulo = titulo ? titulo.textContent.toLowerCase() : '';
                var textoDescricao = descricao ? descricao.textContent.toLowerCase() : '';

                if (textoTitulo.includes(termo) || textoDescricao.includes(termo)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    var campoPesquisaAvaliacao = document.getElementById('pesquisarAvaliacao');
    var linhasAvaliacoes = document.querySelectorAll('.linha-avaliacao');

    if (campoPesquisaAvaliacao && linhasAvaliacoes.length) {
        campoPesquisaAvaliacao.addEventListener('input', function () {
            var termo = campoPesquisaAvaliacao.value.toLowerCase().trim();

            linhasAvaliacoes.forEach(function (linha) {
                var textoLinha = linha.textContent.toLowerCase();

                if (textoLinha.includes(termo)) {
                    linha.style.display = '';
                } else {
                    linha.style.display = 'none';
                }
            });
        });
    }

});