// SWIPER & PHOTOSWIPE INITIALIZATION
import Swiper from "swiper";
import { Navigation, Pagination, Autoplay } from "swiper/modules";
import PhotoSwipe from "photoswipe";
import PhotoSwipeLightbox from "photoswipe/lightbox";

// Variables to store swiper instances
let mainSwiper = null;
let testimonialSwiper = null;
let photoSwipeLightbox = null;

export function initializeSwipers() {
    initializeMainSwiper();
    initializeTestimonialSwiper();
    initializePhotoSwipe();
}

export function destroySwipers() {
    if (mainSwiper) {
        mainSwiper.destroy(true, true);
        mainSwiper = null;
    }
    
    if (testimonialSwiper) {
        testimonialSwiper.destroy(true, true);
        testimonialSwiper = null;
    }
    
    if (photoSwipeLightbox) {
        photoSwipeLightbox.destroy();
        photoSwipeLightbox = null;
    }
}

// Function khusus untuk update testimonial swiper tanpa destroy
export function refreshTestimonialSwiper() {
    if (testimonialSwiper) {
        // Simpan posisi slide saat ini
        const currentSlide = testimonialSwiper.activeIndex;
        
        // Update swiper
        testimonialSwiper.update();
        
        // Kembali ke slide yang sama (jika masih ada)
        if (currentSlide < testimonialSwiper.slides.length) {
            testimonialSwiper.slideTo(currentSlide);
        }
    }
}

function initializeMainSwiper() {
    const swiperElement = document.querySelector(".mySwiper");
    if (swiperElement && !mainSwiper) {
        mainSwiper = new Swiper(".mySwiper", {
            modules: [Navigation, Pagination, Autoplay],
            loop: true,
            slidesPerView: 3,
            spaceBetween: 20,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            breakpoints: {
                0: { slidesPerView: 1 },
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
            },
        });
    }
}

function initializeTestimonialSwiper() {
    const testimonialSwiperElement = document.querySelector(".testimonialSwiper");
    if (testimonialSwiperElement && !testimonialSwiper) {
        testimonialSwiper = new Swiper(".testimonialSwiper", {
            modules: [Navigation, Pagination, Autoplay],
            loop: true,
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
                nextEl: ".testimonial-button-next",
                prevEl: ".testimonial-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            // Observer untuk auto-detect changes
            observer: true,
            observeParents: true,
            observeSlideChildren: true,
        });
    }
}

function initializePhotoSwipe() {
    const galleryElements = document.querySelectorAll(".layout-wrapper");
    if (galleryElements.length > 0 && !photoSwipeLightbox) {
        photoSwipeLightbox = new PhotoSwipeLightbox({
            gallery: ".ps-gallery",
            children: "a",
            pswpModule: PhotoSwipe,
            showHideAnimationType: "zoom",
            bgOpacity: 0.9,
            padding: { top: 20, bottom: 20, left: 20, right: 20 },
        });

        photoSwipeLightbox.on("uiRegister", function () {
            photoSwipeLightbox.pswp.ui.registerElement({
                name: "custom-caption",
                order: 9,
                isButton: false,
                appendTo: "root",
                html: "Caption teks",
                onInit: (el, pswp) => {
                    photoSwipeLightbox.pswp.on("change", () => {
                        const currSlideElement = photoSwipeLightbox.pswp.currSlide.data;
                        el.innerHTML = currSlideElement.caption || "";
                    });
                },
            });
        });

        photoSwipeLightbox.init();
    }
}