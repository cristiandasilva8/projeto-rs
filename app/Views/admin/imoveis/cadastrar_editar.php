<?= $this->extend('layouts/admin.php'); ?>
<?= $this->section('content'); ?>

<?php if (session()->has('error')) : ?>
    <div class="alert alert-danger">
        <?= session('error'); ?>
    </div>
<?php endif; ?>

<?php if (session()->has('success')) : ?>
    <div class="alert alert-success">
        <?= session('success'); ?>
    </div>
<?php endif; ?>

<?php
$formAction = isset($imovel) ? url_to('admin.imovel.edit', $imovel->id) : url_to('admin.imovel.add');
$formMethod = 'POST'; // You can adjust if you have different methods for add or update
$uploadUrl = isset($uploadUrl) ? $uploadUrl : '';
$deleteUploadUrl = isset($deleteUploadUrl) ? $deleteUploadUrl : '';
$imagens = isset($imagens) ? $imagens : [];
?>

<div class="mt-5">
    <h2><?= isset($imovel) ? 'Editar' : 'Cadastrar'; ?> Imóvel</h2>
    <form action="<?= $formAction; ?>" method="<?= $formMethod; ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <?php if (session()->get('grupo') == 1) : ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="empresa_id">Empresa:</label>
                    <select class="form-control" id="id_empresa" name="id_empresa">
                        <option value="">Selecionar empresa</option>
                        <?php foreach ($empresas as $empresa) : ?>
                            <option value="<?= $empresa->id ?>" <?= (isset($imovel) && $imovel->id_empresa == $empresa->id) ? 'selected' : '' ?>><?= $empresa->nome ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        <?php else : ?>
            <input type="hidden" name="id_empresa" value="<?= session()->get('id') ?>">
        <?php endif; ?>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="foto_destaque">Foto Destaque</label>
                <?php if (isset($imovel) && !empty($imovel->foto_destaque)) : ?>
                    <div>
                        <img src="<?= base_url($imovel->foto_destaque) ?>" alt="Foto Destaque" style="max-width: 150px; max-height: 150px;">
                    </div>
                <?php endif; ?>
                <input type="file" class="form-control" id="foto_destaque" name="foto_destaque">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" value="<?= isset($imovel) ? $imovel->descricao : ''; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <label for="preco">Preço</label>
                <input type="text" class="form-control moeda" id="preco" name="preco" value="<?= isset($imovel) ? $imovel->preco : ''; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <label for="logradouro">Logradouro</label>
                <input type="text" class="form-control" id="logradouro" name="logradouro" value="<?= isset($imovel) ? $imovel->logradouro : ''; ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="cep">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" value="<?= isset($imovel) ? $imovel->cep : ''; ?>" required>
            </div>
            <div class="form-group col-md-2">
                <label for="numero">Número</label>
                <input type="text" class="form-control" id="numero" name="numero" value="<?= isset($imovel) ? $imovel->numero : ''; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <label for="bairro">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro" value="<?= isset($imovel) ? $imovel->bairro : ''; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="<?= isset($imovel) ? $imovel->cidade : ''; ?>" required>
            </div>
            <div class="form-group col-md-2">
                <label for="uf">UF</label>
                <input type="text" class="form-control" id="estado" name="uf" value="<?= isset($imovel) ? $imovel->uf : ''; ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="latitude">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="latitude" value="<?= isset($imovel) ? $imovel->latitude : ''; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <label for="longitude">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="longitude" value="<?= isset($imovel) ? $imovel->longitude : ''; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <label for="tipo">Tipo</label>
                <select class="form-control" id="tipo" name="tipo" required>
                    <option value="aluguel" <?= isset($imovel) && $imovel->tipo == 'aluguel' ? 'selected' : '' ?>>Aluguel</option>
                    <option value="compra" <?= isset($imovel) && $imovel->tipo == 'compra' ? 'selected' : '' ?>>Compra</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="0" <?= isset($imovel) && $imovel->status == '0' ? 'selected' : '' ?>>Desativado</option>
                    <option value="1" <?= isset($imovel) && $imovel->status == '1' ? 'selected' : '' ?>>Ativo</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="caracteristicas">Características</label>
                <textarea class="form-control" id="summernote" name="caracteristicas" rows="3" required><?= isset($imovel) ? $imovel->caracteristicas : ''; ?></textarea>
            </div>
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary"><?= isset($imovel) ? 'Atualizar' : 'Cadastrar'; ?></button>
            </div>

            <div class="form-group col-md-12 mt-6" id="imagens-dropzone" data-upload-url="<?= $uploadUrl ?>" data-delete-upload-url=<?= $deleteUploadUrl ?> data-imagens='<?= json_encode($imagens) ?>'></div>
            <?php if (isset($imovel)) : ?>
                <div class="card-body">
                    <div id="actions" class="row">
                        <div class="col-lg-6">
                            <div class="btn-group w-100">
                                <span class="btn btn-success col fileinput-button">
                                    <i class="fas fa-plus"></i>
                                    <span>Add Imagens</span>
                                </span>
                                <button type="button" class="btn btn-primary col start">
                                    <i class="fas fa-upload"></i>
                                    <span>Carregar imagens</span>
                                </button>
                                <button type="reset" class="btn btn-warning col cancel">
                                    <i class="fas fa-times-circle"></i>
                                    <span>Cancelar</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center">
                            <div class="fileupload-process w-100">
                                <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table table-striped files" id="previews">
                        <div id="template" class="row mt-2">
                            <div class="col-auto">
                                <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                            </div>
                            <div class="col d-flex align-items-center">
                                <p class="mb-0">
                                    <span class="lead" data-dz-name></span>
                                    (<span data-dz-size></span>)
                                </p>
                                <strong class="error text-danger" data-dz-errormessage></strong>
                            </div>
                            <div class="col-4 d-flex align-items-center">
                                <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                </div>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <div class="btn-group">
                                    <button class="btn btn-primary start">
                                        <i class="fas fa-upload"></i>
                                        <span>Carregar</span>
                                    </button>
                                    <button data-dz-remove class="btn btn-danger delete">
                                        <i class="fas fa-trash"></i>
                                        <span>Excluir</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </form>
</div>

<?= $this->endsection(); ?>