<?= $this->extend('layouts/imoveis.php'); ?>
<?= $this->section('content'); ?>


<!-- Property List Start -->
<div class="container-xxl py-5" style="background-color: #F6F6F6">
  <div class="container">
    <div class="row g-0 gx-5 align-items-end">
      <div class="col-lg-6">
        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
          <h1 class="mb-3">Encontre o Lar dos Seus Sonhos</h1>
          <p>Descubra imóveis incríveis e dê o primeiro passo para uma vida nova!</p>
        </div>
      </div>
      <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
        <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">

          <li class="nav-item me-2">
            <a class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-recentes">Recentes</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="tab-content">
      <div id="tab-recentes" class="tab-pane fade show p-0 active">
        <div class="row g-4">
          <?php
          foreach ($imoveis as $imovel) : ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
              <div class="property-item rounded overflow-hidden">
                <div class="position-relative overflow-hidden">
                  <a href="<?= url_to('imovel.detalhes', $imovel->id) ?>"><img class="img-fluid" src="<?= base_url($imovel->foto_destaque) ?>" alt=""></a>
                  <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3"><?= strtoupper($imovel->tipo) ?></div>
                  <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3"><?= $imovel->nome_tipo_propriedade ?></div>
                </div>
                <div class="p-4 pb-0">
                  <h5 class="text-primary mb-3">R$ <?= moeda($imovel->preco) ?></h5>
                  <a class="d-block h5 mb-2" href="<?= url_to('imovel.detalhes', $imovel->id) ?>"><?= substr($imovel->descricao, 0, 30) . ''  ?></a>
                  <p><i class="fa fa-map-marker-alt text-primary me-2"></i><?= $imovel->cidade ?></p>
                </div>
                <div class="d-flex border-top">

                  <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i><?= moeda($imovel->area_construida) ?> m²</small>
                  <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i><?= $imovel->qtd_quartos ?></small>
                  <small class="flex-fill text-center border-end py-2"><i class="fa fa-shower text-primary me-2"></i><?= $imovel->qtd_banheiros ?></small>
                  <small class="flex-fill text-center border-end py-2"><i class="fa fa-bath text-primary me-2"></i><?= $imovel->qtd_suites ?></small>
                  <small class="flex-fill text-center border-end py-2"><i class="fa fa-warehouse text-primary me-2"></i><?= $imovel->qtd_vagas_garagem ?></small>

                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container mt-5">
  <h2 class="text-center mb-4">Imobiliárias Parceiras</h2>
  <div id="imobiliariasCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <?php
      $chunks = array_chunk($imobiliarias, 4);
      foreach ($chunks as $index => $chunk) {
        $active = $index === 0 ? 'active' : '';
        echo "<div class='carousel-item $active'>";
        echo "<div class='row'>";
        foreach ($chunk as $imobiliaria) {
          echo "<div class='col-md-3 col-sm-6'>";
          echo "<img src='{$imobiliaria->imagem}' class='d-block logo-img' alt='Logo {$imobiliaria->nome}'>";
          echo "</div>";
        }
        echo "</div>";
        echo "</div>";
      }
      ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#imobiliariasCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#imobiliariasCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>
<!-- Property List End -->
<?= $this->endsection(); ?>


