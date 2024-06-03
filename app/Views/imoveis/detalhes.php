<?= $this->extend('layouts/imoveis.php'); ?>
<?= $this->section('content'); ?>
<hr />
<div class="container-xxl py-5">
    <div class="container">
        <div class="row">
            <h1><?= $detalhes->descricao ?></h1>
            <div class="col-md-8 mt-4">
                <div id="propertyCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <?php
                        $count = 0;
                        $active = '';
                        foreach ($detalhes->imagens as $imagem) :
                            if ($count == 0) {
                                $active = 'active';
                            } else {
                                $active = '';
                            }
                            $count++;
                        ?>

                            <div class="carousel-item <?= $active ?>">
                                <a href="<?= base_url($imagem['caminho_imagem']) ?>" data-lightbox="property-images"><img src="<?= base_url($imagem['caminho_imagem']) ?>" class="d-block w-100 carousel-image" alt="<?= base_url($imagem['caminho_imagem']) ?>"></a>
                            </div>

                        <?php endforeach; ?>

                        <!-- Adicione mais imagens conforme necessário -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                </div>
                <div class="carousel-thumbnails">
                    <?php
                    $count2 = 0;
                    $active = '';
                    foreach ($detalhes->imagens as $imagem) :

                        if ($count2 == 0) {
                            $active = 'active';
                        } else {
                            $active = '';
                        }
                        $count2++;
                    ?>

                        <img src="<?= base_url($imagem['caminho_imagem']) ?>" data-bs-target="#propertyCarousel" data-bs-slide-to="<?= $count2 ?>" class="thumbnail <?= $active ?>">
                    <?php endforeach; ?>
                    <!-- Adicione mais miniaturas conforme necessário -->
                </div>
            </div>
            <div class="col-md-4 property-details">
                <div class="container mb-5 text-center">
                    <button class="btn btn-success btn-sm whatsapp-button" data-mensagem="Olá, me interessei nesse imóvel, <?= $detalhes->descricao ?>, gostaria de mais informações" data-whatsapp="<?= $detalhes->empresa_telefone ?>"><i class="fa-brands fa-whatsapp"></i> Entrar em contato com a imobiliária</button>
                </div>
                <h1 class="text-primary">Detalhes do Imóvel</h1>
                <hr />
                <div class="mt-2">
                    <b><h2>Preço: <span class="text-primary">R$ <?= moeda($detalhes->preco) ?></span></h2></b>
                </div>
                <div class="total mt-2">
                    <h2>Tipo: <?= strtolower($detalhes->tipo) ?><h2>
                </div>
                <hr />
                <div class="details mt-3">
                    <h3 class="text-primary">Detalhes</h3>
                    <div class="detail-item"><i class="fa-solid text-primary fa-city"></i> Código: <?= $detalhes->id ?></div>
                    <div class="detail-item"><i class="fa-solid text-primary fa-city"></i> Categoria: <?= $detalhes->nome_tipo_propriedade ?></div>
                    <div class="detail-item"><i class="fa-solid text-primary fa-road"></i> Endereço: <?= $detalhes->logradouro ?></div>
                    <div class="detail-item"><i class="fa-solid text-primary fa-people-roof"></i> Bairro: <?= $detalhes->bairro ?>, N°<?= $detalhes->numero ?></div>
                    <div class="detail-item"><i class="fa-solid text-primary fa-city"></i> Cidade: <?= $detalhes->cidade ?> - <?= $detalhes->uf ?></div>
                </div>
                <div class="description">
                    <h3 class="text-primary">Descrição</h3>
                    <?= $detalhes->caracteristicas ?>
                </div>
                <div class="features">
                    <h3 class="text-primary">Características Adicionais</h3>
                    <div class="feature-item"><i class="fa-solid text-primary fa-bed"></i> Dormitório(s): <?= $detalhes->qtd_quartos ?></div>
                    <div class="feature-item"><i class="fa-solid text-primary fa-ruler-combined"></i> Área total contruída: <?= $detalhes->area_construida ?> m²</div>
                    <div class="feature-item"><i class="fa-solid text-primary fa-ruler-combined"></i> Área total terreno: <?= $detalhes->area_terreno ?> m²</div>
                    <div class="feature-item"><i class="fa-solid text-primary fa-shower"></i> Banheiro(s): <?= $detalhes->qtd_banheiros ?></div>
                    <div class="feature-item"><i class="fa-solid text-primary fa-bath"></i> Suite(s): <?= $detalhes->qtd_suites ?></div>
                    <div class="feature-item"><i class="fa-solid text-primary fa-warehouse"></i> Vaga de garagem: <?= $detalhes->qtd_vagas_garagem ?></div>
                    <hr />
                    <div class="feature-item"><b><i class="fa-solid text-primary fa-building"></i> Imobiliária: <?= $detalhes->empresa_nome ?></b></div>
                    <div class="feature-item"><b><i class="fa-solid text-primary fa-user-tie"></i> Responsável: <?= $detalhes->empresa_nome_responsavel ?></b></div>
                    <div class="feature-item"><b><i class="fa-solid text-primary fa-envelope"></i> E-mail: <?= $detalhes->empresa_email ?></b></div>
                    <div class="feature-item"><b><i class="fa-solid text-primary fa-phone-volume"></i> Contato: <?= $detalhes->empresa_telefone ?></b></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Visualizar Imagem -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <img id="modalImage" src="" class="img-fluid" alt="Imagem Ampliada">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>