
let todosVeiculos = []; 

let paginaAtual = 1; 

const itensPorPagina = 6; 





document.addEventListener("DOMContentLoaded", () => {

  
    fetch('/Trabalho_DW/php/api_le_catalogo.php')
        
        .then(response => response.json())
        
        .then(data => {
  
            todosVeiculos = data.veiculo; 
            
      
            mostrarPagina(); 
        })
        .catch(error => {
            console.error('Problema ao buscar os veículos:', error);
        });

    

    
 
    const btnProximo = document.getElementById('btnProximo');
    const btnAnterior = document.getElementById('btnAnterior');

    btnProximo.addEventListener('click', (evento) => {
        evento.preventDefault(); 
        

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

});




function mostrarPagina() {
   
    const indiceInicio = (paginaAtual - 1) * itensPorPagina;
    
   
    const indiceFim = indiceInicio + itensPorPagina;


    const veiculosDaPagina = todosVeiculos.slice(indiceInicio, indiceFim);

 
    carregaVeiculo(veiculosDaPagina);

    atualizarBotoes();
}


function atualizarBotoes() {
    const btnProximo = document.getElementById('btnProximo');
    const btnAnterior = document.getElementById('btnAnterior');


    const totalPaginas = Math.ceil(todosVeiculos.length / itensPorPagina);

    
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



function carregaVeiculo(listaDeVeiculos) { 
    const container = document.getElementById('main-produtos');

    container.innerHTML = ''; 
    
    listaDeVeiculos.forEach(veiculo => {
        const card = document.createElement('div');
        card.className = 'produto';

        card.innerHTML = `
            <img class="img_produto" src="${veiculo.foto}" alt="produto_img">
            <h1 class="nome_produto">${veiculo.marca} Modelo:${veiculo.modelo}</h1>
            <h2 class="nome_produto">Preço: R$ ${veiculo.preco}</h2>
            <a href="/Trabalho_DW/html/compra.html?$id=${veiculo.id}" class="botao-comprar">COMPRAR</a>
            <a href="/Trabalho_DW/html/detalhes.html?id=${veiculo.id}" class="botao-detalhe">DETALHES</a>
        `;

        container.appendChild(card);
    });
}




































