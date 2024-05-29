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
            <div class="form-group col-md-12">
                <label for="foto_destaque">Foto Destaque</label>
                <input type="file" class="form-control" id="foto_destaque" name="foto_destaque" multiple>
            </div>

            <div class="form-group col-md-6">
                <label for="preco">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" value="<?= isset($imovel) ? $imovel->descricao : ''; ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="preco">Preço</label>
                <input type="text" class="form-control" id="preco" name="preco" value="<?= isset($imovel) ? $imovel->preco : ''; ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="logradouro">Logradouro</label>
                <input type="text" class="form-control" id="logradouro" name="logradouro" value="<?= isset($imovel) ? $imovel->logradouro : ''; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <label for="numero">Número</label>
                <input type="text" class="form-control" id="numero" name="numero" value="<?= isset($imovel) ? $imovel->numero : ''; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <label for="bairro">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro" value="<?= isset($imovel) ? $imovel->bairro : ''; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="<?= isset($imovel) ? $imovel->cidade : ''; ?>" required>
            </div>
            <div class="form-group col-md-2">
                <label for="uf">UF</label>
                <input type="text" class="form-control" id="uf" name="uf" value="<?= isset($imovel) ? $imovel->uf : ''; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="cep">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" value="<?= isset($imovel) ? $imovel->cep : ''; ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="latitude">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="latitude" value="<?= isset($imovel) ? $imovel->latitude : ''; ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="longitude">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="longitude" value="<?= isset($imovel) ? $imovel->longitude : ''; ?>" required>
            </div>
            <div class="form-group col-md-12">
                <label for="caracteristicas">Características</label>
                <input type="text" class="form-control" id="caracteristicas" name="caracteristicas" value="<?= isset($imovel) ? $imovel->caracteristicas : ''; ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= isset($imovel) ? $imovel->status : ''; ?>" required>
            </div>
            <div class="form-group col-md-12" id="imagens-dropzone" data-upload-url="<?= $uploadUrl ?>" data-delete-upload-url=<?= $deleteUploadUrl ?> data-imagens='<?= json_encode($imagens) ?>'></div>
            <?php if (isset($imovel)) : ?>
            <div class="card-body">
                <div id="actions" class="row">
                    <div class="col-lg-6">
                        <div class="btn-group w-100">
                            <span class="btn btn-success col fileinput-button">
                                <i class="fas fa-plus"></i>
                                <span>Add files</span>
                            </span>
                            <button type="submit" class="btn btn-primary col start">
                                <i class="fas fa-upload"></i>
                                <span>Start upload</span>
                            </button>
                            <button type="reset" class="btn btn-warning col cancel">
                                <i class="fas fa-times-circle"></i>
                                <span>Cancel upload</span>
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
                                    <span>Start</span>
                                </button>
                                <button data-dz-remove class="btn btn-warning cancel">
                                    <i class="fas fa-times-circle"></i>
                                    <span>Cancel</span>
                                </button>
                                <button data-dz-remove class="btn btn-danger delete">
                                    <i class="fas fa-trash"></i>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>


        </div>
        <button type="submit" class="btn btn-primary"><?= isset($imovel) ? 'Atualizar' : 'Cadastrar'; ?></button>
    </form>
</div>



<?= $this->endsection(); ?>