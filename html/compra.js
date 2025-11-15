document.addEventListener('DOMContentLoaded', () => {

    const ulrParametro = new URLSearchParams(window.location.search);

    const veiculoID = ulrParametro.get('id');

    buscarVeiculo(veiculoID);


    document.getElementById('botao-detalhe').addEventListener('click', (e) => {
    e.preventDefault(); 
    window.history.back(); 

})

});


async function buscarVeiculo(veiculoID) {

    try {

        const resposta = await fetch('/Trabalho_DW/php/api_le_catalogo.php');

        const dados = await resposta.json();

        const veiculo = dados.veiculo.find(v => v.id === veiculoID);

        if (veiculo) {

            popularCampos(veiculo);

        } else {

            alert("Veículo não encontrado");
            window.location.href = '../index.php';


        }



    } catch (error) {

        console.error('Erro ao buscar dados do veículo:', error);
        alert('Erro ao carrega dados do produto.');



    }


}

function popularCampos(veiculo) {

    document.querySelector('.foto-compra img').src = '../' + veiculo.foto;
    document.querySelector('.foto-compra img').alt = veiculo.modelo;

    document.getElementById('nome-compra').value = `${veiculo.marca} ${veiculo.modelo}`;
    document.getElementById('preco-compra').value = `R$ ${veiculo.preco}`;

    // Popula os campos *ocultos* do formulário (que irão para o vendas.json)
    document.getElementById('produto-id-hidden').value = veiculo.id;
    document.getElementById('produto-nome-hidden').value = `${veiculo.marca} ${veiculo.modelo}`;
    document.getElementById('produto-preco-hidden').value = veiculo.preco;



}

