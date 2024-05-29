


$(document).ready(function () {
  $(document).click(function (event) {
    var clickover = $(event.target);
    var _opened = $(".navbar-collapse").hasClass("show");
    var isNavbar = clickover.closest('.navbar').length;
    if (_opened === true && !isNavbar) {
      $(".navbar-toggler").click();
    }
  });

  /**
   * File input
   */
  var inputs = document.querySelectorAll('.file-input')
  for (var i = 0, len = inputs.length; i < len; i++) {
    customInput(inputs[i])
  }
  function customInput(el) {
    const fileInput = el.querySelector('[type="file"]')
    const label = el.querySelector('[data-js-label]')
    fileInput.onchange = fileInput.onmouseout = function () {
      if (!fileInput.value) return
      var value = fileInput.value.replace(/^.*[\\\/]/, '')
      el.className += ' -chosen'
      label.innerText = value
    }
  }

  if (typeof Swiper != "undefined") {
    var swiper = new Swiper(".mySwiper2", {
      pagination: {
        el: ".swiper-pagination",
      },
      loop: true,
      slidesPerView: 3,
      spaceBetween: 15,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 15,
        },
      },
    });

    var swiper = new Swiper('.mySwiper', {
      slidesPerView: 1,
      spaceBetween: 10,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 30,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 40,
        },
        1200: {
          slidesPerView: 4,
          spaceBetween: 40,
        },
      }
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


  }
  

});

if($('.counter1').length > 0) {
  var counted = 0;
  $(window).scroll(function () {
  
    var oTop = $('.counter1').offset().top - window.innerHeight;
    if (counted == 0 && $(window).scrollTop() > oTop) {
      $('.count').each(function () {
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
            step: function () {
              $this.text(Math.floor(this.countNum));
            },
            complete: function () {
              $this.text(this.countNum);
            }
  
          });
      });
      counted = 1;
    }
  });
}





