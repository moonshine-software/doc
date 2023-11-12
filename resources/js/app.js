/* Import Swiper */
import Swiper from "swiper"
import { Navigation } from "swiper/modules"

import("../../node_modules/swiper/swiper.css")

/* Import Alpine.js */
import Alpine from "alpinejs"
import persist from "@alpinejs/persist"
import mask from "@alpinejs/mask"

import.meta.glob(["../images/**", "../fonts/**"])

window.Alpine = Alpine

/* Alpine.js */
document.addEventListener("alpine:init", () => {
	Alpine.data("featureSlider", () => ({
        testimonialsSwiper: null,
		sliderValue: 0,

        init() {
            this.testimonialsSwiper = new Swiper(this.$el, {
                modules: [Navigation],
                slidesPerView: 1,
                spaceBetween: 20,
                navigation: {
                    prevEl: ".testimonials-navigation .swiper-button-prev",
                    nextEl: ".testimonials-navigation .swiper-button-next",
                },
                watchSlidesProgress: true,
                grabCursor: true,
                breakpoints: {
                    375: {
                        slidesPerView: 1.1,
                        spaceBetween: 20,
                    },
                    720: {
                        slidesPerView: 1.25,
                        spaceBetween: 30,
                    },
                    960: {
                        slidesPerView: 2.25,
                        spaceBetween: 30,
                    },
                    1140: {
                        slidesPerView: 2.5,
                        spaceBetween: 40,
                    },
                    1550: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                },
            })
        },
	}))
})

Alpine.plugin(persist)
Alpine.plugin(mask)
Alpine.start()
