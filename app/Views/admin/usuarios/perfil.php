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

<div class="mt-4">
    <h2>Alterar Perfil</h2>
    <form action="<?= url_to('admin.usuario.perfil') ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            
            <!-- Campo para Upload de Imagem -->
            <div class="form-group col-md-4">
                <label for="imagem">Imagem do Perfil:</label>
                <input type="file" class="form-control-file" id="imagem" name="imagem">
                <!-- Mostrar a imagem se já existir -->
                <img src="<?= base_url($userData->imagem) ?>" alt="Profile Image" class="img-thumbnail mt-2" style="width: 100px;">
            </div>
            <!-- Nome -->
            <div class="form-group col-md-4">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome" value="<?= $userData->nome ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="name">Nome responsável:</label>
                <input type="text" class="form-control" id="nome_responsavel" name="nome_responsavel" placeholder="Digite o nome do responsavel" value="<?= $userData->nome_responsavel ?>" required>
            </div>
        </div>

        <div class="row">
            <!-- Email -->
            <div class="form-group col-md-4">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" value="<?= $userData->email ?>" required>
            </div>

            <!-- Senha (opcional) -->
            <div class="form-group col-md-4">
                <label for="password">Nova Senha:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua nova senha">
                <small class="form-text text-muted">Deixe em branco para manter a senha atual.</small>
            </div>

            <!-- Telefone -->
            <div class="form-group col-md-4">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite seu telefone"  value="<?= $userData->telefone ?>">
            </div>
        </div>

        <div class="row">
            <!-- Endereço Completo -->
            <div class="form-group col-md-6">
                <label for="endereco_completo">Endereço Completo:</label>
                <input type="text" class="form-control" id="endereco_completo" name="endereco_completo" placeholder="Digite seu endereço completo" required  value="<?= $userData->endereco_completo ?>">
            </div>

            <!-- Celular -->
            <div class="form-group col-md-6">
                <label for="celular">Celular:</label>
                <input type="text" class="form-control" id="celular" name="celular" placeholder="Digite seu celular" value="<?= $userData->celular ?>">
            </div>
        </div>

        <div class="row">
            <!-- CPF/CNPJ -->
            <div class="form-group col-md-4">
                <label for="cpf_cnpj">CPF/CNPJ:</label>
                <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" placeholder="Digite seu CPF ou CNPJ"  value="<?= $userData->cpf_cnpj ?>">
            </div>

            <?php if(session()->get('grupo') == 3): ?>
            <!-- CRECI -->
            <div class="form-group col-md-4">
                <label for="creci">CRECI:</label>
                <input type="text" class="form-control" id="creci" name="creci" placeholder="Digite seu CRECI" value="<?= $userData->creci ?>">
            </div>
            <?php endif ?>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="descricao">Conte sua história</label>
                <textarea class="form-control summernote"name="descricao" rows="3" required><?= isset($userData) ? $userData->descricao : ''; ?></textarea>
            </div>
        </div>

        <!-- Botão de Submissão -->
        <button type="submit" class="btn btn-primary">Atualizar Perfil</button>
    </form>
</div>


<?= $this->endsection(); ?>
