var swiper = new Swiper(".mySwiper", {
    slidesPerView: 4,      // Hiển thị 4 phim cùng lúc
    spaceBetween: 20,      // Khoảng cách giữa các phim
    slidesPerGroup: 1,     // Nhích 1 phim mỗi lần
    loop: true,            // Cuộn vòng
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {         // Responsive
        320: { slidesPerView: 1 },
        576: { slidesPerView: 2 },
        768: { slidesPerView: 3 },
        992: { slidesPerView: 4 }
    }
});
var swiperUpcoming = new Swiper(".mySwiperUpcoming", {
    slidesPerView: 4,
    spaceBetween: 20,
    navigation: {
        nextEl: ".upcoming-next",
        prevEl: ".upcoming-prev",
    },
    loop: true,
    breakpoints: {
        0: { slidesPerView: 1 },
        576: { slidesPerView: 2 },
        768: { slidesPerView: 3 },
        992: { slidesPerView: 4 },
    },
});
