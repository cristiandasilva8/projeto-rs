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
<div class="divImoveis mt-5" data-url-edit="/admin/imovel/edit" data-url-delete="/admin/imovel/delete">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Listagem de Imóveis de Emprego</h2>
        <a href="<?= url_to('admin.imovel.add'); ?>" class="btn bg-purple color-palette"><i class="nav-icon fas fa-briefcase"></i> Cadastrar Novo Imóveis</a>
    </div>
    <table id="tabelaImoveis" class="table table-bordered table-hover display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descricao</th>
                <th>Preço</th>
                <th>Tipo</th>
                <th>Empresa</th>
                <th>status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Os dados serão inseridos aqui via JavaScript -->
        </tbody>
    </table>
</div>

<?= $this->endsection(); ?>