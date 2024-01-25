const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    autoplay: {
        delay: 3000, // Cada 3 segundos se cambia la imagen
        pauseOnMouseEnter: true // Si pongo el cursor encima se para la imagen
    },

    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        type: 'bullets'
    }
});
