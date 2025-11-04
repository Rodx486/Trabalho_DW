// Banner dinâmico
const imagens = [

    '/Trabalho_DW/data/img/banner/banner_1.jpg',
    '/Trabalho_DW/data/img/banner/banner_2.jpg',
    '/Trabalho_DW/data/img/banner/banner_3.jpg',
    '/Trabalho_DW/data/img/banner/banner_4.jpg'

];
const banner = document.getElementById('banner');

let indice = 0;

imagens.forEach((src, i) => {

    const img = document.createElement('img');
    img.src = src;
    if (i === 0) img.classList.add('active');
    banner.appendChild(img);


});

const img_banner = banner.querySelectorAll('img');

setInterval(() => {

    img_banner[indice].classList.remove('active');
    
    indice = (indice + 1) % img_banner.length;

    img_banner[indice].classList.add('active');
}, 3000);

//----------------------------------------------------------------

const foto = document.getElementById('fotoPerfil');
const inputFoto = document.getElementById('input-foto');

foto.addEventListener('click',()=>{
    inputFoto.click();

});
