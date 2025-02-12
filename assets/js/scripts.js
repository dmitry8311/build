/** Burger menu open/close */

(function ($) {

    document.addEventListener("DOMContentLoaded", function (event) {

        // Toggle to show and hide navbar menu
        const navbarMenu = document.getElementById("menu");
        const burgerMenu = document.getElementById("burger");

        burgerMenu.addEventListener("click", () => {
            navbarMenu.classList.toggle("is-active");
            burgerMenu.classList.toggle("is-active");
        });

        $('[data-slick]').slick();

    });

    // Lightbox
    $(document).ready(function() {
        const $lightbox = $('#block_gallery__gallery-lightbox');
        const $lightboxImage = $('#block_gallery__gallery-lightbox-image');
        const $closeButton = $('#block_gallery__gallery-lightbox-close');
        const $prevButton = $('#block_gallery__gallery-lightbox-prev');
        const $nextButton = $('#block_gallery__gallery-lightbox-next');
        const $thumbnails = $('.thumbnail');
        let currentIndex = 0;

        function showImage(index) {
            const imageSrc = $thumbnails.eq(index).attr('href');
            $lightboxImage.attr('src', imageSrc);
            $lightbox.css('display', 'flex');
            currentIndex = index;
        }

        // Add event listener to each thumbnail
        $thumbnails.on('click', function(event) {
            event.preventDefault();
            const index = $(this).data('index');
            showImage(index);
        });

        // Close lightbox when close button is clicked
        $closeButton.on('click', function() {
            $lightbox.css('display', 'none');
        });

        // Close lightbox when clicking outside the image
        $lightbox.on('click', function(event) {
            if (event.target === this) {
                $lightbox.css('display', 'none');
            }
        });

        // Show previous image
        $prevButton.on('click', function(event) {
            event.stopPropagation();
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : $thumbnails.length - 1;
            showImage(currentIndex);
        });

        // Show next image
        $nextButton.on('click', function(event) {
            event.stopPropagation();
            currentIndex = (currentIndex < $thumbnails.length - 1) ? currentIndex + 1 : 0;
            showImage(currentIndex);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        if (window.innerWidth <= 744) {  // Initialize only for mobile screens
            const gallery = document.querySelector('.block_gallery__gallery');
            if(!gallery.length) {
                return;
            }
            const dots = document.querySelectorAll('.slider-dots .dot');
            let currentSlide = 0;

            function updateDots(index) {
                dots.forEach(dot => dot.classList.remove('active'));
                dots[index].classList.add('active');
            }

            function getClosestSlide() {
                const scrollLeft = gallery.scrollLeft;
                const slideWidth = gallery.querySelector('a').offsetWidth;
                return Math.round(scrollLeft / slideWidth);
            }

            // Event listener for scrolling
            gallery.addEventListener('scroll', () => {
                const newSlideIndex = getClosestSlide();
                if (newSlideIndex !== currentSlide) {
                    currentSlide = newSlideIndex;
                    updateDots(currentSlide);
                }
            });

            // Event listener for dots click
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    gallery.scrollTo({
                        left: index * gallery.querySelector('a').offsetWidth,
                        behavior: 'smooth'
                    });
                    currentSlide = index;  // Update currentSlide to the clicked dot
                    updateDots(currentSlide);  // Manually update dots after the scroll
                });
            });

            updateDots(0);  // Initialize the first slide
        }
    });

})(jQuery)
