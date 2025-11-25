let todosVeiculos = [];

let paginaAtual = 1;

const itensPorPagina = 6;

// Quando carregar a página o conteúdo dentro das chaves é executado. Nesse caso, é feita uma chamada da função pegaProduto()
document.addEventListener("DOMContentLoaded", () => {

    pegaProduto();

});

//---------------------------------------------------------------------------------------------------------------------------

// Função assincrona que tem como objetivo pegar os produtos no banco de dados que é um arquivo .joson
async function pegaProduto() {

    const url = '/Trabalho_DW/php/api_le_catalogo.php';

    // bloco para tratamento de erros
    try {

        const response = await fetch(url);

        if (!response.ok) {  // verifica se a response foi "ok", caso negativo, executa o que está dento do if

            throw new Error(`Response estatus: ${response.status}`); // aqui é lançado um novo objeto da classe "Error" que chama o método "status" da response

        }
        const resultado = await response.json(); // converte o corpo da response em objeto javascript e armazena em resultado

        todosVeiculos = resultado.veiculo; 

        mostrarPagina();
    }

    //caso algum erro aconteça, o bloco do catch entra em ação
    catch (error) {
        console.error(error.message);
    }

    const btnProximo = document.getElementById('btnProximo');
    const btnAnterior = document.getElementById('btnAnterior');


    // fica escutando por um "click" no botão para executar uma ação
    btnProximo.addEventListener('click', (evento) => {
        evento.preventDefault();

        // o total de página vai depender do toal de veículos dividido por 6  que é a quantidade de exibição por página
        const totalPaginas = Math.ceil(todosVeiculos.length / itensPorPagina);


        if (paginaAtual < totalPaginas) {
            paginaAtual++;
            mostrarPagina();
        }
    });


    btnAnterior.addEventListener('click', (evento) => {
        evento.preventDefault();


        if (paginaAtual > 1) {
            paginaAtual--;
            mostrarPagina();
        }
    });



}

//------------------------------------------------------------------------------------------------------------------------



function mostrarPagina() {

    const indiceInicio = (paginaAtual - 1) * itensPorPagina;


    const indiceFim = indiceInicio + itensPorPagina;

    //aqui é criado um array com apenas os itens da página atual
    const veiculosDaPagina = todosVeiculos.slice(indiceInicio, indiceFim); 


    carregaVeiculo(veiculosDaPagina);

    atualizarBotoes();
}




//-----------------------------------------------------------------------------------------------------


// dependendo da página, os botões "próximo" e "anterior" são desativados.
function atualizarBotoes() {

    const btnProximo = document.getElementById('btnProximo');
    const btnAnterior = document.getElementById('btnAnterior');


    const totalPaginas = Math.ceil(todosVeiculos.length / itensPorPagina); // Math.ceil sempre arredonta para cima 


    if (paginaAtual === 1) {
        btnAnterior.classList.add('disabled');
    } else {
        btnAnterior.classList.remove('disabled');
    }

    if (paginaAtual === totalPaginas) {
        btnProximo.classList.add('disabled');
    } else {
        btnProximo.classList.remove('disabled');
    }
}



//----------------------------------------------------------------------------------------------------

// carrega os veículos na pagina recebendo como argumento a listaDeVeiculos referente a página atual
function carregaVeiculo(listaDeVeiculos) {
   
    const container = document.getElementById('main-produtos');

    container.innerHTML = '';

    // percorremos a o array que tem os veículos da página atual e montamos uma
    // estrutura para exibir cada um deles
    listaDeVeiculos.forEach(veiculo => {

        const card = document.createElement('div');

        card.className = 'produto';
        
        // aqui é construido em memória(aida não sai para exibição) "card" para cada um dos elementos dentro de 
        // "listaDeVeiculos" que é percorrido pelo "forEach"
        card.innerHTML = `
            <img class="img_produto" src="${veiculo.foto}" alt="produto_img">
            <h1 class="nome_produto">${veiculo.marca} Modelo:${veiculo.modelo}</h1>
            <h2 class="nome_produto">Preço: R$ ${veiculo.preco}</h2>
            <a href="/Trabalho_DW/html/compra.php?id=${veiculo.id}" class="botao-comprar">COMPRAR</a>
            <a href="/Trabalho_DW/html/detalhes.php?id=${veiculo.id}" class="botao-detalhe">DETALHES</a>
        `;

        // adicionamos dentor do container da página cada um dos "cards" 
        // que possuem a foto e infomração do produto que agora sim saem para exibição
        container.appendChild(card);
    });
}




































