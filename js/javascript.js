
var swiper = new Swiper(".mySwiper", {
  slidesPerView: 1,
  spaceBetween: 10,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    "@0.00": {
      slidesPerView: 1,
      spaceBetween: 10,
    },
    "@0.75": {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    "@1.00": {
      slidesPerView: 3,
      spaceBetween: 40,
    },
    "@1.50": {
      slidesPerView: 4,
      spaceBetween: 50,
    },
  },
});




var swiper = new Swiper(".mySwiper1", {
  slidesPerView: 1,
  spaceBetween: 30,
  loop: true,
  pagination: {
    el: ".swiper-pagination1",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next1",
    prevEl: ".swiper-button-prev1",
  },
});




var counted = 0;
$(window).scroll(function() {

var oTop = $('.counter1').offset().top - window.innerHeight;
if (counted == 0 && $(window).scrollTop() > oTop) {
    $('.count').each(function() {
    var $this = $(this),
        countTo = $this.attr('data-count');
    $({
        countNum: $this.text()
    }).animate({
        countNum: countTo
        },

        {
        duration: 2500,
        easing: 'swing',
        step: function() {
            $this.text(Math.floor(this.countNum));
        },
        complete: function() {
            $this.text(this.countNum);
        }

        });
    });
    counted = 1;
}
});


