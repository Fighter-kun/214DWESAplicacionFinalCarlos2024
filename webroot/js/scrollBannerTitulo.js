// Agregar una clase al hacer scroll
window.addEventListener('scroll', function () {
    var header = document.querySelector('.navbar');
    var titulo = document.querySelector('.titulo');
    var scrolled = window.scrollY > 10; // Cambiar 10 por la cantidad de píxeles que desees

    header.classList.toggle('scrolled', scrolled);
    titulo.classList.toggle('scrolled', scrolled);
});