<?= $this->extend('layouts/app.php'); ?>
<?= $this->section('content'); ?>
<main>
    <!-- Hero Area Start -->
    <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/about.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Get your job</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->
    <!-- Job List Area Start -->
    <div class="job-listing-area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <!-- Left content -->
                <div class="col-xl-3 col-lg-3 col-md-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="small-section-tittle2 mb-45">
                                <div class="ion">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="12px">
                                        <path fill-rule="evenodd" fill="rgb(27, 207, 107)" d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z" />
                                    </svg>
                                </div>
                                <h4>Filter Jobs</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Job Category Listing start -->
                    <div class="job-category-listing mb-50">
                        <!-- Formulário de Filtros -->
                        <form id="filtro-vagas" action="javascript:void(0);">
                            
                        <div class="single-listing mb-4">
                                <div class="small-section-tittle2">
                                    <h4>Buscar Vaga</h4>
                                </div>
                                <input type="text" id="termo" name="termo" class="form-control" placeholder="Nome da vaga">
                            </div>

                            <div class="single-listing mb-4">
                                <div class="small-section-tittle2">
                                    <h4>Salário</h4>
                                </div>
                                <input type="number" id="salario_min" name="salario_min" class="form-control mb-2" placeholder="Salário Mínimo">
                                <input type="number" id="salario_max" name="salario_max" class="form-control" placeholder="Salário Máximo">
                            </div>

                            <div class="single-listing mb-4">
                                <div class="small-section-tittle2">
                                    <h4>Tipo de Vaga</h4>
                                </div>
                                <!-- Select job items start -->
                                <div class="select-job-items2">
                                    <select id="tipo_vaga" name="tipo_vaga" class="form-control">
                                        <option value="">Todos os Tipos</option>
                                        <option value="clt">CLT</option>
                                        <option value="temporario">Temporário</option>
                                    </select>
                                </div>
                                <!--  Select job items End-->
                            </div>

                            <!-- single one -->
                            <div class="single-listing mb-4">
                                <div class="small-section-tittle2">
                                    <h4>Categoria vaga</h4>
                                </div>
                                <!-- Select job items start -->
                                <div class="select-job-items2">
                                    <select id="id_categoria" name="id_categoria" class="form-control">
                                        <option value="">Todos as categorias</option>
                                        <?php foreach ($categorias as $categoria) : ?>
                                            <option value="<?= $categoria->id ?>"><?= $categoria->nome ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <!--  Select job items End-->
                            </div>

                            <button type="submit" class="btn btn-primary mt-4">Buscar</button>
                        </form>
                        <!-- Keeping existing categories and styling -->
                        <!-- single one -->

                    </div>
                    <!-- Job Category Listing End -->
                </div>
                <!-- Right content -->
                <div class="col-xl-9 col-lg-9 col-md-8">
                    <!-- Área para exibir os resultados -->
                    <section class="featured-job-area">
                        <div class="container">
                            <!-- Count of Job list Start -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="count-job mb-35">
                                        <span id="job-count">0 Jobs found</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Count of Job list End -->
                            <!-- Resultados das Vagas -->
                            <div id="resultados-vagas" class="job-listing-area pt-120 pb-120"></div>
                        </div>
                    </section>
                    <!-- Featured_job_end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Job List Area End -->
</main>
<?= $this->endSection(); ?>