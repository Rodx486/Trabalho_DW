
// armazenamos as imagems do banner em um array
const imagens = [

    '/Trabalho_DW/data/img/banner/banner_1.jpg',
    '/Trabalho_DW/data/img/banner/banner_2.jpg',
    '/Trabalho_DW/data/img/banner/banner_3.jpg',
    '/Trabalho_DW/data/img/banner/banner_4.jpg'

];


// fazemos uma referencia onde as imagens do banner devem ser exibidas
const banner = document.getElementById('banner'); 

let indice = 0;


// aqui iniciamos a percorria pelos elementos do array que armazena as imagens

imagens.forEach((src, i) => {

    const img = document.createElement('img'); // cira um elemento img

    img.src = src; // define o src (source)  com o caminho da imagem

    if (i === 0) img.classList.add('active');
    
    banner.appendChild(img);


});


// aqui selecionamos todas as imagens do banner e cria uma lista de nós com os img que acabara de ser inseridos
// para manipulação

const img_banner = banner.querySelectorAll('img');


// percorre a lista de nós e troca a cada 3 segundos para trocar a visibilidade das imagens
setInterval(() => {

    img_banner[indice].classList.remove('active');

    indice = (indice + 1) % img_banner.length;

    img_banner[indice].classList.add('active');
}, 3000);

//----------------------------------------------------------------
// Script para permitir que o usuário adicione sua foto de perfil, quando clicar na imagem de exemplo
const fotoPerfil = document.getElementById('fotoPerfil');
const inputFoto = document.getElementById('input-foto');


if (fotoPerfil && inputFoto) {

    fotoPerfil.addEventListener('click', () => {

        console.log('Clicou na imagem, disparando input-foto');

        inputFoto.click();

    })


}







