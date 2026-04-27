<script>
    var psikologSwiper = new Swiper(".psikologSwiper", {
    slidesPerView: 1,
    spaceBetween: 24,
    centeredSlides: false,
    pagination: {
        el: ".custom-line-pagination",
        clickable: true,
    },
    breakpoints: {
        768: {
            slidesPerView: 2,
        },
        1200: {
            slidesPerView: 3,
        }
    }
});
</script>