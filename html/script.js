
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

const slides = banner.querySelectorAll('img');

setInterval(() => {

    slides[indice].classList.remove('active');
    indice = (indice + 1) % slides.length;
    slides[indice].classList.add('active');
}, 3000);




