<?= $this->extend('layouts/app.php'); ?>
<?= $this->section('content'); ?>

<main>

    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="slider-active">
            <div class="single-slider slider-height d-flex align-items-center" data-background="assets/img/hero/h1_hero.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-9 col-md-10">
                            <div class="hero__caption">
                                <h2>impulsione sua carreira no mercado de trabalho ou reiniciar sua trajetória profissional.</h2>
                            </div>
                        </div>
                    </div>
                    <!-- Search Box -->
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="section-tittle mt-4">
                                <a class="btn" href="<?= url_to('procurar.vagas') ?>">Procurar uma vaga agora!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <!-- Featured_job_start -->
    <section class="featured-job-area feature-padding">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center">
                    <span>Vagas Recentes</span>
                    <h2>Vagas em Destaque</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <!-- single-job-content -->
                    <?php foreach ($todasVagas as $vaga):?>
                    <div class="single-job-items mb-30">
                        <div class="job-items">
                            <div class="company-img">
                                <a href="<?= url_to('vaga.detalhes', $vaga->id) ?>">
                                    <img src="<?= ($vaga->empresa_imagem != null) ? base_url($vaga->empresa_imagem) : base_url('assets/img/icon/job-list1.png') ?>" alt="" width="85" height="85">
                                </a>
                            </div>
                            <div class="job-tittle">
                                <a href="<?= url_to('vaga.detalhes', $vaga->id)?>">
                                    <h4><?= $vaga->nome ?></h4>
                                </a>
                                <ul>
                                    <li><i class="fas fa-map-marker-alt"></i><?= $vaga->cidade ." - ". $vaga->estado?></li>
                                    <li>R$<?= moeda($vaga->salario) ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="items-link f-right">
                            <a href="<?= url_to('vaga.detalhes', $vaga->id)?>">Detalhes</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured_job_end -->
    <!-- How  Apply Process Start-->
    <div class="apply-process-area apply-bg " data-background="assets/img/gallery/how-applybg.png">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle white-text text-center">
                        <span></span>
                        <h2> Como funciona</h2>
                    </div>
                </div>
            </div>
            <!-- Apply Process Caption -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-process text-center mb-30">
                        <div class="process-ion">
                            <span class="flaticon-search"></span>
                        </div>
                        <div class="process-cap">
                            <h5>1. Procure uma vaga</h5>
                            <p>Explore oportunidades de emprego que impulsionem sua carreira.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-process text-center mb-30">
                        <div class="process-ion">
                            <span class="flaticon-curriculum-vitae"></span>
                        </div>
                        <div class="process-cap">
                            <h5>2. Condidate-se</h5>
                            <p>Condidate-se para a vaga e demonstre seu potencia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-process text-center mb-30">
                        <div class="process-ion">
                            <span class="flaticon-tour"></span>
                        </div>
                        <div class="process-cap">
                            <h5>3. Prepare-se</h5>
                            <p>Prepare-se para a entrevista e garanta seu novo emprego.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- How  Apply Process End-->
    <!-- Support Company Start-->
    <div class="support-company-area support-padding fix">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="right-caption">
                        <!-- Section Tittle -->
                        <div class="section-tittle section-tittle2">
                            <span>O que está esperando?</span>
                            <h2>Conecte-se com Talentos e Impulsione Sua Empresa</h2>
                        </div>
                        <div class="support-caption">
                            <p class="pera-top">Cadastre suas vagas de emprego no nosso sistema e encontre os melhores profissionais para sua empresa.</p>
                            <p>Facilite o processo de recrutamento com nossa plataforma intuitiva, onde você pode divulgar oportunidades, receber candidaturas e selecionar os talentos que farão a diferença no seu negócio. Junte-se a nós e descubra como é simples atrair candidatos qualificados e elevar sua equipe ao próximo nível.</p>
                            <a href="about.html" class="btn post-btn">Cadastrar vagas</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="support-location-img">
                        <img src="assets/img/service/support-img.jpg" alt="">
                        <div class="support-img-cap text-center">
                            <p>Comece</p>
                            <span>Agora!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Support Company End-->


</main>

<?= $this->endsection(); ?>