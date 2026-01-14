const commonConfigs = {
    slidesPerView: 4,      
    slidesPerGroup: 1,     
    spaceBetween: 0,       
    loop: true,
    // THÊM TỰ ĐỘNG CHẠY MỖI 3 GIÂY
    //autoplay: {
        //delay: 3000,
        //disableOnInteraction: false, // Vẫn tự chạy sau khi người dùng bấm
    //},
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