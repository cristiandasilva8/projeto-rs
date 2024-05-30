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
    $formAction = isset($vaga) ? url_to('admin.vaga.edit', $vaga->id) : url_to('admin.vaga.add');
    $formMethod = 'POST'; // You can adjust if you have different methods for add or update
?>

<div class="container mt-5">
    <h2><?= isset($vaga) ? 'Editar' : 'Cadastrar'; ?> Vaga de Emprego</h2>
    <form action="<?= $formAction; ?>" method="<?= $formMethod; ?>">
        <?= csrf_field() ?>

        <?php if (session()->get('grupo') == 1) : ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="empresa_id">Empresa:</label>
                    <select class="form-control" id="empresa_id" name="empresa_id">
                        <option value="">Selecionar empresa</option>
                        <?php foreach ($empresas as $empresa) : ?>
                            <option value="<?= $empresa->id ?>" <?= (isset($vaga) && $vaga->empresa_id == $empresa->id) ? 'selected' : '' ?>><?= $empresa->nome ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        <?php else : ?>
            <input type="hidden" name="empresa_id" value="<?= session()->get('id') ?>">
        <?php endif; ?>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nome">Nome da Vaga:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= isset($vaga) ? $vaga->nome : ''; ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="id_categoria">Setor:</label>
                <select class="form-control" id="id_categoria" name="id_categoria">
                    <option value="">Selecionar setor</option>
                    <?php foreach ($categorias as $categoria) : ?>
                        <option value="<?= $categoria->id ?>" <?= (isset($vaga) && $vaga->id_categoria == $categoria->id) ? 'selected' : '' ?>><?= $categoria->nome ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="localizacao">Localização:</label>
                <input type="text" class="form-control" id="localizacao" name="localizacao" value="<?= isset($vaga) ? $vaga->localizacao : ''; ?>" required>
            </div>
            <div class="form-group col-md-2">
                <label for="cep">CEP:</label>
                <input type="text" class="form-control" id="cep" name="cep" value="<?= isset($vaga) ? $vaga->cep : ''; ?>" required>
            </div>
            <div class="form-group col-md-2">
                <label for="cidade">Cidade:</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="<?= isset($vaga) ? $vaga->cidade : ''; ?>" required>
            </div>
            <div class="form-group col-md-2">
                <label for="estado">Estado:</label>
                <input type="text" class="form-control" id="estado" name="estado" value="<?= isset($vaga) ? $vaga->estado : ''; ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="quantidade_limite">Quantidade Limite:</label>
                <input type="number" class="form-control" id="quantidade_limite" name="quantidade_limite" value="<?= isset($vaga) ? $vaga->quantidade_limite : ''; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="salario">Salário:</label>
                <input type="text" class="form-control moeda" id="salario" name="salario" value="<?= isset($vaga) ? $vaga->salario : ''; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="tipo">Tipo de Contratação:</label>
                <select class="form-control" id="tipo" name="tipo">
                    <option value="CLT" <?= (isset($vaga) && $vaga->tipo == "CLT") ? 'selected' : '' ?>>CLT</option>
                    <option value="Temporario" <?= (isset($vaga) && $vaga->tipo == "Temporario") ? 'selected' : '' ?>>Temporário</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="requisitos">Requisitos:</label>
            <textarea class="form-control" id="requisitos" name="requisitos" rows="3"><?= isset($vaga) ? $vaga->requisitos : ''; ?></textarea>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição da Vaga:</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3"><?= isset($vaga) ? $vaga->descricao : ''; ?></textarea>
        </div>

        <div class="form-group">
            <label for="outros_beneficios">Outros Benefícios:</label>
            <textarea class="form-control" id="outros_beneficios" name="outros_beneficios" rows="3"><?= isset($vaga) ? $vaga->outros_beneficios : ''; ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary"><?= isset($vaga) ? 'Atualizar' : 'Cadastrar'; ?> Vaga</button>
    </form>
</div>

<?= $this->endsection(); ?>
