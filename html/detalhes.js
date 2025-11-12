document.addEventListener('DOMContentLoaded',()=>{

    const urlParams = new URLSearchParams(window.location.search);

    const veiculoId = urlParams.get('id');

    if(!veiculoId){
        window.location.href = '../index.html';
        return;

    }

    fetch('/Trabalho_DW/php/api_le_catalogo.php')

        .then(response =>response.json())

        .then(data =>{

            const veiculo = data.veiculo.find(v => v.id === veiculoId);

            if(veiculo){

                popularPagina(veiculo);


            }else{

                document.getElementById('detalhe-lista').innerHTML ='<li><h2>Veiculo não encontrado.</h2></li>'; 

            }
        })
        .catch(error =>{

            console.error('Erro ao buscar dados do veículo:>', error);
            document.getElementById('detalhe-lista').innerHTML = '<li><h2>Erro ao carregar dados.</h2></li>';



        })



})

function popularPagina(veiculo){

    const imagem = document.getElementById('detalhe-imagem');
    const lista = document.getElementById('detalhe-lista');
    const linkComprar = document.getElementById('link-comprar');

    imagem.src = '../' + veiculo.foto; 
    imagem.alt = `Foto de ${veiculo.modelo}`;

 
    lista.innerHTML = `
        
        <strong id="caracteristicas">Características</strong>
        <div class="crc-lista">
        <li><strong>Marca:</strong> ${veiculo.marca}</li>
        <li><strong>Modelo:</strong> ${veiculo.modelo}</li>
        <li><strong>Ano:</strong> ${veiculo.ano}</li>
        <li><strong>Cor:</strong> ${veiculo.cor}</li>
        <li><strong>Quilometragem:</strong> ${veiculo.quilometragem} km</li>
        <li><strong>Combustível:</strong> ${veiculo.combustvel}</li>
        <li><strong>Câmbio:</strong> ${veiculo.cmbio}</li>
        <li><strong>Preço:</strong> R$ ${veiculo.preco}</li>
        <br>
        <li><strong>Descrição:</strong></li>
        <p class="p-descricao">${veiculo.descricao}</p>
        </div>
    `;

    
    linkComprar.href = `compra.html?id=${veiculo.id}`; 

} 

