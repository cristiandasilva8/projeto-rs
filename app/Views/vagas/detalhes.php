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
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success" role="alert">
                Parabéns, você de candidatou a vaga!
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
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
                                <img src="<?= ($detalhes->empresa_imagem != null) ? base_url($detalhes->empresa_imagem) : base_url('assets/img/icon/job-list1.png') ?>" alt="" width="85" height="85">
                            </div>
                            <div class="job-tittle">
                                <a href="#">
                                    <h4><?= $detalhes->nome ?></h4>
                                </a>
                                <ul>
                                    <li><i class="fas fa-map-marker-alt"></i><?= $detalhes->cidade . " - " . $detalhes->estado ?></li>
                                    <li>R$ <?= moeda($detalhes->salario) ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- job single End -->

                    <div class="job-post-details">
                        <div class="post-details2 mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Descrição da vaga</h4>
                            </div>
                            <?= $detalhes->descricao ?>
                        </div>
                        <div class="post-details2 mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Requistos da vaga</h4>
                            </div>
                            <?= $detalhes->requisitos ?>
                        </div>
                        <div class="post-details2  mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Outros Benefícios</h4>
                            </div>
                            <?= $detalhes->outros_beneficios ?>
                        </div>

                        <h1>Localização Geográfica</h1>
                        <div id="map"></div>
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
                            <li>Criação da Vaga : <span><?= (new DateTime($detalhes->created_at))->format('d/m/Y') ?></span></li>
                            <li>Localização : <span><?= $detalhes->cidade ?></span></li>
                            <li>Quantidade de vagas : <span><?= $detalhes->quantidade_limite ?></span></li>
                            <li>Tipo do contrato : <span><?= strtoupper($detalhes->tipo) ?></span></li>
                            <li>Salário : <span><?= 'R$ ' . $detalhes->salario ?></span></li>
                        </ul>
                        <div class="apply-btn2">
                            <?php if (isset(auth()->user()->username)) : ?>
                                <form method="POST" action="<?= url_to('vaga.candidatar', $detalhes->id) ?>">
                                    <button type="submit" class="btn">Candidatar-se</button>
                                </form>
                            <?php else : ?>
                                <a href="<?= base_url('login') ?>" class="btn head-btn2">Login</a>
                                <a href="<?= base_url('register') ?>" class="btn head-btn1">Cadastrar</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="post-details4  mb-50">
                    <!-- Small Section Tittle -->
                    <div class="small-section-tittle">
                        <h4>Detalhes da empresa</h4>
                    </div>
                    <span><?= $detalhes->empresa_nome ?></span>
                    <p><?= $detalhes->empresa_descricao ?></p>
                    <ul>
                        <li>Responsável: <span><?= $detalhes->empresa_nome_responsavel ?></span></li>
                        <li>Tel. : <span><?= $detalhes->empresa_telefone ?></span></li>
                        <li>Email: <span><?= $detalhes->empresa_email ?></span></li>
                    </ul>
                </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- job post company End -->

</main>

<?= $this->endsection(); ?>