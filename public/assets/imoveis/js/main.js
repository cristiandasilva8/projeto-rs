(function ($) {
  "use strict";

  // Spinner
  var spinner = function () {
    setTimeout(function () {
      if ($("#spinner").length > 0) {
        $("#spinner").removeClass("show");
      }
    }, 1);
  };
  spinner();

  // Initiate the wowjs
  new WOW().init();

  // Sticky Navbar
  $(window).scroll(function () {
    if ($(this).scrollTop() > 45) {
      $(".nav-bar").addClass("sticky-top");
    } else {
      $(".nav-bar").removeClass("sticky-top");
    }
  });

  // Back to top button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
      $(".back-to-top").fadeIn("slow");
    } else {
      $(".back-to-top").fadeOut("slow");
    }
  });
  $(".back-to-top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
    return false;
  });

  // Header carousel
  $(".header-carousel").owlCarousel({
    autoplay: true,
    smartSpeed: 1500,
    items: 1,
    dots: true,
    loop: true,
    nav: true,
    navText: [
      '<i class="bi bi-chevron-left"></i>',
      '<i class="bi bi-chevron-right"></i>',
    ],
  });

  // Testimonials carousel
  $(".testimonial-carousel").owlCarousel({
    autoplay: true,
    smartSpeed: 1000,
    margin: 24,
    dots: false,
    loop: true,
    nav: true,
    navText: [
      '<i class="bi bi-arrow-left"></i>',
      '<i class="bi bi-arrow-right"></i>',
    ],
    responsive: {
      0: {
        items: 1,
      },
      992: {
        items: 2,
      },
    },
  });
})(jQuery);

$(document).ready(function () {
  $(".carousel-image").on("click", function (e) {
    e.preventDefault();
    var src = $(this).attr("src");
    $("#modalImage").attr("src", src);
    $("#imageModal").modal("show");
  });

  $(".thumbnail").on("click", function () {
    $(".thumbnail").removeClass("active");
    $(this).addClass("active");
  });

  $("#propertyCarousel").on("slide.bs.carousel", function (event) {
    var index = $(event.relatedTarget).index();
    $(".thumbnail").removeClass("active");
    $(".thumbnail").eq(index).addClass("active");
  });

  $("#filtroVagas").on("submit", function (event) {
    event.preventDefault(); // Impede o envio do formulário padrão
    buscarImoveis();
  });
});

function formatarData(dataStr) {
  const options = {
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  const data = new Date(dataStr);
  return data.toLocaleDateString("pt-BR", options);
}

function buscarImoveis() {
  const termo = $("#termo").val();
  const cidade = $("#cidade").val();
  const tipo_propriedade = $("#tipo_propriedade").val();
  const preco = $("#preco").val();
  const imobiliaria = $("#imobiliaria").val();

  // Mostrar o loader
  $("#loader").show();

  $.ajax({
    url: `${BASE_URL}imoveis/procurar-imoveis`,
    method: "POST",
    data: {
      "termo": termo,
      "cidade": cidade,
      "tipo_propriedade": tipo_propriedade,
      "preco": preco,
      "imobiliaria": imobiliaria,
    },
    dataType: "json",
    success: function (data) {
      const aluguelContent = $("#aluguel-content");
      const compraContent = $("#compra-content");
      aluguelContent.empty(); // Limpa os resultados anteriores
      compraContent.empty(); // Limpa os resultados anteriores

      if (data.length > 0) {
        data.forEach(function (imovel) {
            console.log(imovel)
          const imovelDiv = $("<div>").addClass("col-lg-4 col-md-6").html(`
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href="${BASE_URL}imoveis/detalhes/${imovel.id}"><img class="img-fluid" src="${BASE_URL}${imovel.foto_destaque}" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">${
            imovel.tipo === "aluguel" ? "Aluguel" : "Compra"
          }</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">${imovel.nome_tipo_propriedade}</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">${
            parseFloat(imovel.preco).toLocaleString("pt-BR", {
              style: "currency",
              currency: "BRL",
            })
          }</h5>
                                        <a class="d-block h5 mb-2" href="${BASE_URL}imoveis/detalhes/${imovel.id}">${
            imovel.descricao.substring(0, 30)
          }</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>${imovel.cidade}</p>
                                        <div class="d-flex align-items-center mt-2">
                                            <img src="${imovel.logo_imobiliaria}" alt="Logo Imobiliária" class="imobiliaria-logo me-2">
                                            <span>${imovel.nome_imobiliaria}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>${
            parseFloat(imovel.area_construida)
          } m²</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>${imovel.qtd_quartos}</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-shower text-primary me-2"></i>${imovel.qtd_banheiros}</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-bath text-primary me-2"></i>${imovel.qtd_suites}</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-warehouse text-primary me-2"></i>${imovel.qtd_vagas_garagem}</small>
                                    </div>
                                </div>
                            `);
          if (imovel.tipo === "aluguel") {
            aluguelContent.append(imovelDiv);
          } else if (imovel.tipo === "compra") {
            compraContent.append(imovelDiv);
          }
        });
      } else {
        aluguelContent.html("<p>Nenhum imóvel encontrado.</p>");
        compraContent.html("<p>Nenhum imóvel encontrado.</p>");
      }

      // Esconder o loader
      $("#loader").hide();
    },
    error: function (xhr, status, error) {
      console.error("Erro na requisição:", status, error);

      // Esconder o loader mesmo em caso de erro
      $("#loader").hide();
    },
  });
}

setTimeout(() => {
  buscarImoveis();
}, 1000);
