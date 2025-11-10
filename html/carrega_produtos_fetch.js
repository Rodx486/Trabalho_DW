document.addEventListener("DOMContentLoaded", () => {

    fetch("/Trabalho_DW/data/catalogo.json")

        .then(response => {

            if (!response.ok) {

                throw new Error('Erro na resposta:' + response.statusText);

            }
            return response.json();
        })


        .then(data => {

            carregaVeiculos(data.veiculo);

        })

        .catch(error => {

            console.error('Problema o carregar os veículos', error);
            const container = document.getElementById('main-produtos');
            container.innerHTML = "<p> Não foi possível carregar os veículos.</p>";

        });



});

function carregaVeiculos(veiculo) {
    const container = document.getElementById('main-produtos');

    container.innerHTML = '';

    veiculo.forEach(veiculo => {

        const card = document.createElement('div');
        card.className = 'produto';

        card.innerHTML = `
        
            <img class="img_produto" src="${veiculo.foto}" alt="produto_img">
            <h1 class="nome_produto">${veiculo.marca} Modelo:${veiculo.modelo}</h1>
            <h2 class="nome_produto">Preço: R$ ${veiculo.preco}</h2>
            <a href="\Trabalho_DW\html\compra.html" class="botao-comprar">COMPRAR</a>
            <a href="\Trabalho_DW\html\detalhes.html" class="botao-detalhe">DETALHES</a>
        
        

        `;

        container.appendChild(card);

    });





}

