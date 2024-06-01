<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Job board HTML-5 Template </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('/assets/img/favicon.ico') ?>">

    <!-- CSS here -->
    <link rel="stylesheet" href="<?= base_url('/assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/flaticon.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/price_rangs.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/slicknav.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/animate.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/magnific-popup.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/fontawesome-all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/slick.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/nice-select.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/style.css') ?>">



</head>
<style>
    /* Define o tamanho do mapa */
    /* Define o tamanho do mapa */
    #map {
        display: block;
        height: 300px;
        /* Ajuste a altura conforme necessário */
        width: 100%;
        /* Ajuste a largura conforme necessário */
        margin-bottom: 1em;
    }
</style>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="<?= base_url('/assets/img/logo/logo.png') ?>" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparrent">
            <div class="headder-top header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-2">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="<?= url_to('home.index') ?>"><img src="<?= base_url('/assets/img/logo/logo.png') ?>" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="menu-wrapper">
                                <!-- Main-menu -->
                                <div class="main-menu">
                                    <nav class="d-none d-lg-block">
                                        <ul id="navigation">
                                            <li><a href="<?= url_to('home.index') ?>">Home</a></li>
                                            <li><a href="<?= url_to('procurar.vagas') ?>">Procurar Vagas </a></li>
                                            <li><a href="<?= url_to('imoveis.index') ?>">Procurar Imóveis</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Header-btn -->
                                <div class="header-btn d-none f-right d-lg-block">

                                    <?php if (isset(auth()->user()->username)) : ?>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle head-btn2" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                <?= auth()->user()->username ?>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
                                            </div>
                                        </li>
                                    <?php else : ?>
                                        <a href="<?= base_url('login') ?>" class="btn head-btn2">Login</a>
                                        <a href="<?= base_url('register') ?>" class="btn head-btn1">Cadastrar</a>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>

    <div class="app">
        <?= $this->renderSection('content') ?>
    </div>

    <footer>
        <!-- Footer Start-->
        <!-- footer-bottom area -->
        <div class="footer-bottom-area footer-bg">
            <div class="container">
                <div class="footer-border">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-xl-10 col-lg-10 ">
                            <div class="footer-copy-right">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;<script>
                                        document.write(new Date().getFullYear());
                                    </script> Desenvolvido <i class="fa fa-heart" aria-hidden="true"></i> por <a href="https://colorlib.com" target="_blank">voluntários</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>

    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="<?= base_url('/assets/js/vendor/modernizr-3.5.0.min.js') ?>"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="<?= base_url('/assets/js/vendor/jquery-1.12.4.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/bootstrap.min.js') ?>"></script>
    <!-- Jquery Mobile Menu -->
    <script src="<?= base_url('/assets/js/jquery.slicknav.min.js') ?>"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="<?= base_url('/assets/js/owl.carousel.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/slick.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/price_rangs.js') ?>"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="<?= base_url('/assets/js/wow.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/animated.headline.js') ?>"></script>
    <script src="<?= base_url('/assets/js/jquery.magnific-popup.js') ?>"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="<?= base_url('/assets/js/jquery.scrollUp.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/jquery.nice-select.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/jquery.sticky.js') ?>"></script>

    <!-- contact js -->
    <script src="<?= base_url('/assets/js/contact.js') ?>"></script>
    <script src="<?= base_url('/assets/js/jquery.form.js') ?>"></script>
    <script src="<?= base_url('/assets/js/jquery.validate.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/mail-script.js') ?>"></script>
    <script src="<?= base_url('/assets/js/jquery.ajaxchimp.min.js') ?>"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="<?= base_url('/assets/js/plugins.js') ?>"></script>
    <script src="<?= base_url('/assets/js/main.js') ?>"></script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDL4HdV6ycjjj_Vo2JSe9Daei4J6uQNNM4&callback=initMap&libraries=maps,marker&v=beta"></script>

    <script>
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
            var filtroVagas = document.getElementById('filtro-vagas');
            if (filtroVagas) {
                filtroVagas.addEventListener('submit', function(event) {
                    event.preventDefault(); // Impede o envio do formulário padrão
                    buscarVagas();
                });
            }
        });

        setTimeout(() => {
            buscarVagas();
        }, 1000);
        
        <?php if (isset($detalhes->latitude) && isset($detalhes->longitude) && !empty($detalhes->latitude) && !empty($detalhes->longitude)): ?>
            const latitude = <?= $detalhes->latitude ?>;
            const longitude = <?= $detalhes->longitude ?>;

            // Substitua estas variáveis pelos seus dados de latitude e longitude
            const jobLocation = {
                latitude: latitude,
                longitude: longitude
            };
            const houseLocations = <?php echo json_encode($imoveis); ?>;
            if (latitude && longitude) {
                function initMap() {
                    // Define o centro inicial do mapa
                    const center = {
                        lat: jobLocation.latitude,
                        lng: jobLocation.longitude
                    };

                    // Cria o mapa centrado nas coordenadas fornecidas
                    const map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 16,
                        center: center
                    });

                    // Adiciona o marcador para a vaga de emprego com o ícone padrão
                    new google.maps.Marker({
                        position: {
                            lat: jobLocation.latitude,
                            lng: jobLocation.longitude
                        },
                        map: map,
                        title: jobLocation.title,
                        animation: google.maps.Animation.BOUNCE // Define a animação para pular
                    });

                    // Define o ícone do marcador de casa personalizado
                    const houseIcon = {
                        url: '<?php echo base_url('assets/img/icon/location-pin.png') ?>', // URL da imagem da casa
                        scaledSize: new google.maps.Size(50, 50) // Ajuste o tamanho do ícone
                    };

                    // Itera sobre a matriz de localizações de casas para adicionar os marcadores
                    houseLocations.forEach(location => {
                        new google.maps.Marker({
                            position: {
                                lat: location.latitude,
                                lng: location.longitude
                            },
                            map: map,
                            title: location.title,
                            icon: houseIcon,
                            animation: google.maps.Animation.BOUNCE // Define a animação para pular
                        });
                    });

                    // Função para ajustar o tamanho do mapa
                    function adjustMapSize() {
                        const mapElement = document.getElementById('map');
                        if (window.innerWidth < 600) {
                            mapElement.style.height = '30vh';
                        } else {
                            mapElement.style.height = '50vh';
                        }
                    }

                    // Ajusta o tamanho do mapa na carga inicial
                    adjustMapSize();

                    // Adiciona um listener para ajustar o tamanho do mapa quando a janela é redimensionada
                    window.addEventListener('resize', adjustMapSize);
                }
            }  else {
                document.getElementById('map').innerHTML = '<p>Localização da vaga não disponível.</p>';
            }
        <?php endif; ?>
    </script>

</body>

</html>