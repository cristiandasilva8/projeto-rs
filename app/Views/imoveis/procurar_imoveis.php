<?= $this->extend('layouts/imoveis.php'); ?>
<?= $this->section('content'); ?>
<!-- Search Start -->
<div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
  <div class="container">

    <div class="row g-2">
      <form id="filtro-imoveis" action="javascript:void(0);">
        <div class="col-md-12">
          <div class="row g-2">
            <div class="col-md-2">
              <input type="text" id="termo" name="termo" class="form-control border-0 py-2" placeholder="Palavra chave">
            </div>
            <div class="col-md-2">
              <select class="form-select border-0 py-2" name="tipo_propriedade" id="tipo_propriedade">
                <option value="">Tipo da propriedade</option>
                <?php foreach ($tipoPropriedades as $tipoPropriedade) : ?>
                  <option value="<?= $tipoPropriedade->id ?>"><?= $tipoPropriedade->nome ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-2">
              <select class="form-select border-0 py-2" id="cidade" name="cidade">
                <option value="">Cidade</option>
                <?php foreach ($cidades as $cidade) : ?>
                  <option value="<?= $cidade->cidade ?>"><?= $cidade->cidade ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-2">
              <select class="form-select border-0 py-2" id="imobiliaria" name="imobiliaria">
                <option value="">Imobiliaria</option>
                <?php foreach ($imobiliarias as $imobiliaria) : ?>
                  <option value="<?= $imobiliaria->id ?>"><?= $imobiliaria->nome ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-2">
              <input type="text" id="preco" name="preco" class="form-control border-0 py-2 moeda" placeholder="Preço máximo">
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-dark border-0 w-100 py-2">Procurar</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Search End -->
<!-- Property List Start -->
<div class="container-xxl py-5">
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
            <a class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-aluguel">Aluguel</a>
          </li>

          <li class="nav-item me-2">
            <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-compra">Compra</a>
          </li>

        </ul>
      </div>
    </div>
    <div class="tab-content">
      <div id="loader" class=" justify-content-center align-items-center" style="display: none; height: 100px;">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Carregando...</span>
        </div>
      </div>
      <div id="tab-aluguel" class="tab-pane fade show p-0 active">
        <div class="row g-4" id="aluguel-content">
          <!-- Imóveis de aluguel serão inseridos aqui -->
        </div>
      </div>

      <div id="tab-compra" class="tab-pane fade show p-0">
        <div class="row g-4" id="compra-content">
          <!-- Imóveis de compra serão inseridos aqui -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Property List End -->
<?= $this->endsection(); ?>