const commonConfigs = {
    slidesPerView: 4,      // Hiện 4 phim
    slidesPerGroup: 1,     // CHỈ NHẢY 1 PHIM MỖI LẦN
    spaceBetween: 0,       
    loop: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        1024: { slidesPerView: 4 },
        768: { slidesPerView: 2 },
        0: { slidesPerView: 1 }
    }
};

// Khởi tạo phần Đang chiếu
new Swiper(".mySwiper", {
    ...commonConfigs,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

// Khởi tạo phần Sắp chiếu
new Swiper(".mySwiperUpcoming", {
    ...commonConfigs,
    navigation: {
        nextEl: ".upcoming-next",
        prevEl: ".upcoming-prev",
    },
});