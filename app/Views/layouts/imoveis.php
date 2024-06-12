<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Makaan - Real Estate HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('assets/imoveis/lib/animate/animate.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/imoveis/lib/owlcarousel/assets/owl.carousel.min.css'); ?>" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('assets/imoveis/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url('assets/imoveis/css/style.css'); ?>" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">

        <!-- Navbar Start -->
        <div class="container-fluid nav-bar bg-transparent">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
                <a href="<?= url_to('imoveis.index') ?>" class="navbar-brand d-flex align-items-center text-center">
                    <div class="icon p-2 me-2">
                        <img class="img-fluid" src="<?= base_url('assets/imoveis/img/icon-deal.png') ?>" alt="Icon" style="width: 30px; height: 30px;">
                    </div>
                    <h1 class="m-0 text-primary">Makaan</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="<?= url_to('imoveis.index') ?>" class="nav-item nav-link active">Home</a>
                        <a href="<?= url_to('imovel.procurar') ?>" class="nav-item nav-link">Procurar imóvel</a>
                        <a href="<?= url_to('procurar.vagas') ?>" class="nav-item nav-link">Procurar vagas</a>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->

        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn mb-4">Encontre <span class="text-primary">o lugar perfeito</span> para sua família ou empresa prosperar</h1>
                    <p class="animated fadeIn mb-4 pb-2">Encontre o espaço perfeito para sua família ou empresa crescer e prosperar! Explore nossas opções e mude para melhor hoje mesmo!</p>
                    <a href="<?= url_to('imovel.procurar') ?>" class="btn btn-primary py-3 px-5 me-3 animated fadeIn">Localizar</a>
                </div>
                <div class="col-md-6 animated fadeIn">
                    <div class="owl-carousel header-carousel">
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="<?= base_url('assets/imoveis/img/carousel-1.jpg') ?>" alt="">
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="<?= base_url('assets/imoveis/img/carousel-2.jpg') ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->

        <?= $this->renderSection('content') ?>


        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Desenvolvido por <a class="border-bottom" href="#">Voluntários</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="<?= url_to('imoveis.index') ?>">Home</a>
                                <a href="<?= url_to('imovel.procurar') ?>">Procurar imóvel</a>
                                <a href="<?= url_to('procurar.vagas') ?>">Procurar vagas</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/imoveis/lib/wow/wow.min.js'); ?>"></script>
    <script src="<?= base_url('assets/imoveis/lib/easing/easing.min.js'); ?>"></script>
    <script src="<?= base_url('assets/imoveis/lib/waypoints/waypoints.min.js'); ?>"></script>
    <script src="<?= base_url('assets/imoveis/lib/owlcarousel/owl.carousel.min.js'); ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Template Javascript -->
    <script src="<?= base_url('assets/imoveis/js/main.js'); ?>"></script>

    <script>
        $('.moeda').mask('#.##0,00', {
            reverse: true
        });

        var BASE_URL = '<?= base_url() ?>';

        function formatarData(dataStr) {
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const data = new Date(dataStr);
            return data.toLocaleDateString('pt-BR', options);
        }

        document.addEventListener('DOMContentLoaded', function() {
            var filtroImoveis = document.getElementById('filtro-imoveis');

            if (filtroImoveis) {
                filtroImoveis.addEventListener('submit', function(event) {
                    event.preventDefault(); // Impede o envio do formulário padrão

                    buscarImoveis();
                });
            }
        });
    </script>
</body>

</html>