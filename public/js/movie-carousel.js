const commonConfigs = {
    slidesPerView: 4,      // Cố định 4 phim
    slidesPerGroup: 1,     
    spaceBetween: 20,      // Khoảng cách giữa các phim
    loop: true,
    centeredSlides: false, // Giữ các slide sát lề
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        // Màn hình lớn (PC): 4 phim
        1024: { 
            slidesPerView: 4,
            spaceBetween: 20
        },
        // Màn hình máy tính bảng: 3 phim
        768: { 
            slidesPerView: 3,
            spaceBetween: 15
        },
        // Màn hình điện thoại: 1 hoặc 2 phim
        0: { 
            slidesPerView: 1.5, // Hiện 1 phim rưỡi để người ta biết là còn phim bên cạnh
            spaceBetween: 10
        }
    }
};

// Khởi tạo Phim Đang Chiếu
new Swiper(".mySwiper", {
    ...commonConfigs,
    navigation: {
        nextEl: ".main-next",
        prevEl: ".main-prev",
    },
});

// Khởi tạo Phim Sắp Chiếu
new Swiper(".mySwiperUpcoming", {
    ...commonConfigs,
    navigation: {
        nextEl: ".upcoming-next",
        prevEl: ".upcoming-prev",
    },
});