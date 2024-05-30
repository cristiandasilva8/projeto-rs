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
<div class="divVagas mt-5" data-url-edit="/admin/vagas/edit" data-url-delete="/admin/vagas/delete">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Listagem de Vagas de Emprego</h2>
        <a href="<?= url_to('admin.vaga.add'); ?>" class="btn bg-purple color-palette"><i class="nav-icon fas fa-briefcase"></i> Cadastrar Nova Vaga</a>
    </div>
    <table id="tabelaVagas" class="table table-bordered table-hover display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Localização</th>
                <th>Setor</th>
                <th>Quantidade</th>
                <th>Salário</th>
                <th>Descrição</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Os dados serão inseridos aqui via JavaScript -->
        </tbody>
    </table>
</div>

<!-- Modal para Candidatos -->
<div class="modal fade" id="candidatesModal" tabindex="-1" role="dialog" aria-labelledby="candidatesModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="candidatesModalLabel">Candidatos da Vaga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Conteúdo do modal será inserido aqui -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<?= $this->endsection(); ?>