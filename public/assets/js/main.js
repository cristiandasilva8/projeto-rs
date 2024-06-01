(function ($) {
  "use strict";

  /* 1. Proloder */
  $(window).on("load", function () {
    $("#preloader-active").delay(450).fadeOut("slow");
    $("body").delay(450).css({
      "overflow": "visible",
    });
  });

  /* 2. slick Nav */
  // mobile_menu
  var menu = $("ul#navigation");
  if (menu.length) {
    menu.slicknav({
      prependTo: ".mobile_menu",
      closedSymbol: "+",
      openedSymbol: "-",
    });
  }

  /* 3. MainSlider-1 */
  function mainSlider() {
    var BasicSlider = $(".slider-active");
    BasicSlider.on("init", function (e, slick) {
      var $firstAnimatingElements = $(".single-slider:first-child").find(
        "[data-animation]",
      );
      doAnimations($firstAnimatingElements);
    });
    BasicSlider.on(
      "beforeChange",
      function (e, slick, currentSlide, nextSlide) {
        var $animatingElements = $(
          '.single-slider[data-slick-index="' + nextSlide + '"]',
        ).find("[data-animation]");
        doAnimations($animatingElements);
      },
    );
    BasicSlider.slick({
      autoplay: false,
      autoplaySpeed: 10000,
      dots: false,
      fade: true,
      arrows: false,
      prevArrow:
        '<button type="button" class="slick-prev"><i class="ti-shift-left"></i></button>',
      nextArrow:
        '<button type="button" class="slick-next"><i class="ti-shift-right"></i></button>',
      responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
        },
      }, {
        breakpoint: 991,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
        },
      }, {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
        },
      }],
    });

    function doAnimations(elements) {
      var animationEndEvents =
        "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";
      elements.each(function () {
        var $this = $(this);
        var $animationDelay = $this.data("delay");
        var $animationType = "animated " + $this.data("animation");
        $this.css({
          "animation-delay": $animationDelay,
          "-webkit-animation-delay": $animationDelay,
        });
        $this.addClass($animationType).one(animationEndEvents, function () {
          $this.removeClass($animationType);
        });
      });
    }
  }
  mainSlider();

  /* 4. Testimonial Active*/
  var testimonial = $(".h1-testimonial-active");
  if (testimonial.length) {
    testimonial.slick({
      dots: true,
      infinite: true,
      speed: 500,
      autoplay: true,
      arrows: false,
      prevArrow:
        '<button type="button" class="slick-prev"><i class="ti-angle-left"></i></button>',
      nextArrow:
        '<button type="button" class="slick-next"><i class="ti-angle-right"></i></button>',
      slidesToShow: 1,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrow: false,
          },
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
          },
        },
      ],
    });
  }

  /* 5. Gallery Active */
  var client_list = $(".completed-active");
  if (client_list.length) {
    client_list.owlCarousel({
      slidesToShow: 2,
      slidesToScroll: 1,
      loop: true,
      autoplay: true,
      speed: 3000,
      smartSpeed: 2000,
      nav: false,
      dots: false,
      margin: 15,

      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1,
        },
        768: {
          items: 2,
        },
        992: {
          items: 2,
        },
        1200: {
          items: 3,
        },
      },
    });
  }

  /* 6. Nice Selectorp  */
  var nice_Select = $("select");
  if (nice_Select.length) {
    nice_Select.niceSelect();
  }

  /* 7.  Custom Sticky Menu  */
  $(window).on("scroll", function () {
    var scroll = $(window).scrollTop();
    if (scroll < 245) {
      $(".header-sticky").removeClass("sticky-bar");
    } else {
      $(".header-sticky").addClass("sticky-bar");
    }
  });

  $(window).on("scroll", function () {
    var scroll = $(window).scrollTop();
    if (scroll < 245) {
      $(".header-sticky").removeClass("sticky");
    } else {
      $(".header-sticky").addClass("sticky");
    }
  });

  /* 8. sildeBar scroll */
  $.scrollUp({
    scrollName: "scrollUp", // Element ID
    topDistance: "300", // Distance from top before showing element (px)
    topSpeed: 300, // Speed back to top (ms)
    animation: "fade", // Fade, slide, none
    animationInSpeed: 200, // Animation in speed (ms)
    animationOutSpeed: 200, // Animation out speed (ms)
    scrollText: '<i class="ti-arrow-up"></i>', // Text for element
    activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
  });

  /* 9. data-background */
  $("[data-background]").each(function () {
    $(this).css(
      "background-image",
      "url(" + $(this).attr("data-background") + ")",
    );
  });

  /* 10. WOW active */
  new WOW().init();

  /* 11. Datepicker */

  // 11. ---- Mailchimp js --------//
  function mailChimp() {
    $("#mc_embed_signup").find("form").ajaxChimp();
  }
  mailChimp();

  // 12 Pop Up Img
  var popUp = $(".single_gallery_part, .img-pop-up");
  if (popUp.length) {
    popUp.magnificPopup({
      type: "image",
      gallery: {
        enabled: true,
      },
    });
  }
})(jQuery);

function buscarVagas() {
  const termo = $("#termo").val();
  const salarioMin = $("#salario_min").val();
  const salarioMax = $("#salario_max").val();
  const categoriaId = $("#id_categoria").val();
  const tipoVaga = $("#tipo_vaga").val();

  $.ajax({
    url: `${BASE_URL}vagas/procurar-vagas`,
    type: "POST",
    data: {
      "termo": termo,
      "salario_min": salarioMin,
      "salario_max": salarioMax,
      "id_categoria": categoriaId,
      "tipo_vaga": tipoVaga,
    },
    headers: {
      "X-Requested-With": "XMLHttpRequest", // Garante que a requisição seja tratada como AJAX
    },
    success: function (data) {
      const resultadosDiv = $("#resultados-vagas");
      const jobCountSpan = $("#job-count");
      resultadosDiv.empty(); // Limpa os resultados anteriores

      if (data.length > 0) {
        jobCountSpan.text(`${data.length} Vagas encontradas`);

        data.forEach(function (vaga) {
          const vagaDiv = $(`
            <div class="single-job-items mb-30">
                <div class="job-items">
                    <div class="company-img">
                        <a href="${BASE_URL}vagas/detalhes/${vaga.id}"><img src="${BASE_URL}${vaga.empresa_imagem}" alt="${vaga.nome}" style="width: 5em;"></a>
                    </div>
                    <div class="job-tittle job-tittle2">
                        <a href="${BASE_URL}vagas/detalhes/${vaga.id}">
                            <h4>${vaga.nome}</h4>
                        </a>
                        <ul>
                            <li>${vaga.empresa_nome}</li>
                            <li><i class="fas fa-map-marker-alt"></i>${vaga.cidade}</li>
                            <li>${vaga.salario}</li>
                        </ul>
                    </div>
                </div>
                <div class="items-link items-link2 f-right">
                    <a href="${BASE_URL}vagas/detalhes/${vaga.id}">${vaga.tipo}</a>
                    <span>${formatarData(vaga.created_at)}</span>
                </div>
            </div>
          `);
          resultadosDiv.append(vagaDiv);
        });
      } else {
        jobCountSpan.text("0 Vagas encontradas");
        resultadosDiv.html("<p>Nenhuma vaga encontrada.</p>");
      }
    },
    error: function (xhr, status, error) {
      console.error("Erro na requisição AJAX:", status, error);
    },
  });
}
