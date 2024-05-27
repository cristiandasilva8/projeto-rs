<?= $this->extend('layouts/app.php'); ?>
<?= $this->section('content'); ?>

<main>

    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="<?= base_url('assets/img/hero/about.jpg') ?>">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->
    <!-- job post company Start -->
    <div class="job-post-company pt-120 pb-120">
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                Parabéns, você de candidatou a vaga!
            </div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-warning" role="alert">
                você já está candidatado a essa vaga
            </div>
        <?php endif; ?>
        <div class="container">
            <div class="row justify-content-between">
                <!-- Left Content -->
                <div class="col-xl-7 col-lg-8">
                    <!-- job single -->
                    <div class="single-job-items mb-50">
                        <div class="job-items">
                            <div class="company-img company-img-details">
                                <a href="#"><img src="<?= base_url('/assets/img/icon/job-list1.png') ?>" alt=""></a>
                            </div>
                            <div class="job-tittle">
                                <a href="#">
                                    <h4><?= $detalhes->nome ?></h4>
                                </a>
                                <ul>
                                    <li><?= $detalhes->requisitos ?></li>
                                    <li><i class="fas fa-map-marker-alt"></i><?= $detalhes->cidade ." - ". $detalhes->estado ?></li>
                                    <li>R$ <?= $detalhes->salario ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- job single End -->

                    <div class="job-post-details">
                        <div class="post-details1 mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Descrição da vaga</h4>
                            </div>
                            <p><?= $detalhes->descricao ?></p>
                        </div>
                        <div class="post-details2  mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Outros Benefícios</h4>
                            </div>
                            <?= $detalhes->outros_beneficios ?>
                        </div>
                    </div>

                </div>
                <!-- Right Content -->
                <div class="col-xl-4 col-lg-4">
                    <div class="post-details3  mb-50">
                        <!-- Small Section Tittle -->
                        <div class="small-section-tittle">
                            <h4>Detalhes</h4>
                        </div>
                        <ul>
                            <li>Posted date : <span><?= (new DateTime($detalhes->created_at))->format('d M Y') ?></span></li>
                            <li>Location : <span><?= $detalhes->cidade?></span></li>
                            <li>Quantidade de vagas : <span><?= $detalhes->quantidade_limite ?></span></li>
                            <li>Tipo : <span><?= strtoupper($detalhes->tipo) ?></span></li>
                            <li>Salário : <span><?= 'R$ ' . $detalhes->salario ?></span></li>
                        </ul>
                        <div class="apply-btn2">
                            <?php if (isset(auth()->user()->username)) : ?>
                                <form method="POST" action="<?= url_to('vaga.candidatar', $detalhes->id) ?>">
                                    <button type="submit" class="btn">Candidatar-se</button>
                                </form>
                            <?php else: ?>
                                <a href="<?= base_url('login') ?>" class="btn head-btn2">Login</a>
                                <a href="<?= base_url('register') ?>" class="btn head-btn1">Cadastrar</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- job post company End -->

</main>

<?= $this->endsection(); ?>