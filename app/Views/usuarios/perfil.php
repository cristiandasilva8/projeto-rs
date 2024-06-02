<?= $this->extend('layouts/app.php'); ?>
<?= $this->section('content'); ?>

<div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="<?= base_url('assets/img/hero/about.jpg'); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Atualizar seus dados de perfil e </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="container mt-5" style="margin-bottom: 10em;">
    <div id="wizard" class="card">
        <div class="card-body">
            <h2>Editar Perfil</h2>
            <ul class="nav nav-tabs" id="wizardTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-dark" id="tab-step-1" data-toggle="tab" href="#step-1" role="tab" aria-controls="step-1" aria-selected="true">Informações Pessoais</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" id="tab-step-2" data-toggle="tab" href="#step-2" role="tab" aria-controls="step-2" aria-selected="false">Objetivo Profissional</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" id="tab-step-3" data-toggle="tab" href="#step-3" role="tab" aria-controls="step-3" aria-selected="false">Educação</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" id="tab-step-4" data-toggle="tab" href="#step-4" role="tab" aria-controls="step-4" aria-selected="false">Experiência Profissional</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" id="tab-step-5" data-toggle="tab" href="#step-5" role="tab" aria-controls="step-5" aria-selected="false">Habilidades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" id="tab-step-6" data-toggle="tab" href="#step-6" role="tab" aria-controls="step-6" aria-selected="false">Certificações</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" id="tab-step-7" data-toggle="tab" href="#step-7" role="tab" aria-controls="step-7" aria-selected="false">Idiomas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" id="tab-step-8" data-toggle="tab" href="#step-8" role="tab" aria-controls="step-8" aria-selected="false">Projetos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" id="tab-step-9" data-toggle="tab" href="#step-9" role="tab" aria-controls="step-9" aria-selected="false">Atividades Extracurriculares</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" id="tab-step-10" data-toggle="tab" href="#step-10" role="tab" aria-controls="step-10" aria-selected="false">Publicações</a>
                </li>
            </ul>

            <div class="tab-content" id="wizardTabContent">
                <!-- Step 1: Informações Pessoais -->
                <div class="tab-pane fade show active wizard-step" id="step-1" role="tabpanel" aria-labelledby="tab-step-1">
                    <h3>Informações Pessoais</h3>
                    <div class="form-group text-center">
                        <?php if (!empty($informacoesPessoais->foto_perfil)) : ?>
                            <img id="foto_perfil_display" src="<?= base_url($informacoesPessoais->foto_perfil) ?>" class="rounded-circle mb-3" width="150" height="150" alt="Foto de Perfil">
                        <?php else : ?>
                            <img id="foto_perfil_display" src="<?= base_url('path/to/default/image.png') ?>" class="rounded-circle mb-3" width="150" height="150" alt="Foto de Perfil">
                        <?php endif; ?>
                        <input type="file" class="form-control-file" id="foto_perfil" name="foto_perfil" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= !empty($usuario->username) ? $usuario->username : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= !empty($authIdentities->secret) ? $authIdentities->secret : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" value="<?= !empty($informacoesPessoais->telefone) ? $informacoesPessoais->telefone : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="whatsapp">Telefone</label>
                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?= !empty($informacoesPessoais->whatsapp) ? $informacoesPessoais->whatsapp : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" value="<?= !empty($informacoesPessoais->endereco) ? $informacoesPessoais->endereco : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="linkedin">LinkedIn</label>
                        <input type="url" class="form-control" id="linkedin" name="linkedin" value="<?= !empty($informacoesPessoais->linkedin) ? $informacoesPessoais->linkedin : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input type="url" class="form-control" id="instagram" name="instagram" value="<?= !empty($informacoesPessoais->instagram) ? $informacoesPessoais->instagram : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="url" class="form-control" id="facebook" name="facebook" value="<?= !empty($informacoesPessoais->facebook) ? $informacoesPessoais->facebook : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha">
                    </div>
                    <div class="form-group">
                        <label for="confirmar_senha">Confirmar Senha</label>
                        <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha">
                    </div>
                    <button type="button" class="btn btn-primary save-personal-info">Salvar</button>
                    <button type="button" class="btn btn-primary next-step" data-next="step-2">Próximo</button>
                </div>

                <!-- Step 2: Objetivo Profissional -->
                <div class="tab-pane fade wizard-step" id="step-2" role="tabpanel" aria-labelledby="tab-step-2">
                    <h3>Objetivo Profissional</h3>
                    <div class="form-group">
                        <label for="objetivo">Objetivo</label>
                        <textarea class="form-control" id="objetivo" name="objetivo" rows="4" required><?= !empty($objetivoProfissional->objetivo) ? $objetivoProfissional->objetivo : '' ?></textarea>
                    </div>
                    <button type="button" class="btn btn-primary save-objetivo">Salvar</button>
                    <button type="button" class="btn btn-secondary previous-step" data-prev="step-1">Anterior</button>
                    <button type="button" class="btn btn-primary next-step" data-next="step-3">Próximo</button>
                </div>
                <!-- Step 3: Educação -->
                <div class="tab-pane fade wizard-step" id="step-3" role="tabpanel" aria-labelledby="tab-step-3">
                    <h3>Educação</h3>
                    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalForm" data-form="educacao" data-acao="educacao">Adicionar</button>
                    <div id="educacao-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Instituição</th>
                                    <th>Curso</th>
                                    <th>Data de Início</th>
                                    <th>Data de Fim</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($educacoes as $index => $educacao) : ?>
                                    <tr  data-id="<?= $educacao->id ?>">
                                        <td><?= $educacao->instituicao ?></td>
                                        <td><?= $educacao->curso ?></td>
                                        <td><?= bd2br($educacao->data_inicio) ?></td>
                                        <td><?= bd2br($educacao->data_fim) ?></td>
                                        <td>
                                            <button type="button" data-action="educacao" class="btn btn-danger btn-sm delete-educacao"><i class="fa fa-trash"></i></button>
                                        </td>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-secondary previous-step" data-prev="step-2">Anterior</button>
                    <button type="button" class="btn btn-primary next-step" data-next="step-4">Próximo</button>
                </div>

                <!-- Step 4: Experiência Profissional -->
                <div class="tab-pane fade wizard-step" id="step-4" role="tabpanel" aria-labelledby="tab-step-4">
                    <h3>Experiência Profissional</h3>
                    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalForm" data-form="experiencia" data-acao="experiencia">Adicionar</button>
                    <div id="experiencia-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Empresa</th>
                                    <th>Cargo</th>
                                    <th>Data de Início</th>
                                    <th>Data de Fim</th>
                                    <th>Responsabilidades</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($experienciasProfissionais as $index => $experiencia) : ?>
                                    <tr  data-id="<?= $experiencia->id ?>">
                                        <td><?= $experiencia->empresa ?></td>
                                        <td><?= $experiencia->cargo ?></td>
                                        <td><?= bd2br($experiencia->data_inicio) ?></td>
                                        <td><?= bd2br($experiencia->data_fim) ?></td>
                                        <td><?= $experiencia->responsabilidades ?></td>
                                        <td><button type="button" data-action="experiencia" class="btn btn-danger btn-sm delete-experiencia"><i class="fa fa-trash"></i></button></td>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-secondary previous-step" data-prev="step-3">Anterior</button>
                    <button type="button" class="btn btn-primary next-step" data-next="step-5">Próximo</button>
                </div>

                <!-- Step 5: Habilidades -->
                <div class="tab-pane fade wizard-step" id="step-5" role="tabpanel" aria-labelledby="tab-step-5">
                    <h3>Habilidades</h3>
                    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalForm" data-form="habilidade" data-acao="habilidade">Adicionar</button>
                    <div id="habilidade-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Habilidade</th>
                                    <th>Tipo</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($habilidades as $index => $habilidade) : ?>
                                    <tr data-id="<?= $habilidade->id ?>">
                                        <td><?= $habilidade->habilidade ?></td>
                                        <td><?= $habilidade->tipo ?></td>
                                        <td><button type="button" data-action="habilidade" class="btn btn-danger btn-sm delete-habilidade"><i class="fa fa-trash"></i></button></td>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-secondary previous-step" data-prev="step-4">Anterior</button>
                    <button type="button" class="btn btn-primary next-step" data-next="step-6">Próximo</button>
                </div>

                <!-- Step 6: Certificações -->
                <div class="tab-pane fade wizard-step" id="step-6" role="tabpanel" aria-labelledby="tab-step-6">
                    <h3>Certificações</h3>
                    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalForm" data-form="certificacao" data-acao="certificacao">Adicionar</button>
                    <div id="certificacao-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Certificação</th>
                                    <th>Instituição</th>
                                    <th>Data de Emissão</th>
                                    <th>Data de Validade</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($certificacoes as $index => $certificacao) : ?>
                                    <tr data-id="<?= $certificacao->id ?>">
                                        <td><?= $certificacao->certificacao ?></td>
                                        <td><?= $certificacao->instituicao ?></td>
                                        <td><?= bd2br($certificacao->data_emissao) ?></td>
                                        <td><?= bd2br($certificacao->data_validade) ?></td>
                                        <td><button type="button" data-action="certificacao" class="btn btn-danger btn-sm delete-certificacao"><i class="fa fa-trash"></i></button></td>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-secondary previous-step" data-prev="step-5">Anterior</button>
                    <button type="button" class="btn btn-primary next-step" data-next="step-7">Próximo</button>
                </div>

                <!-- Step 7: Idiomas -->
                <div class="tab-pane fade wizard-step" id="step-7" role="tabpanel" aria-labelledby="tab-step-7">
                    <h3>Idiomas</h3>
                    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalForm" data-form="idioma" data-acao="idioma">Adicionar</button>
                    <div id="idioma-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Idioma</th>
                                    <th>Nível</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($idiomas as $index => $idioma) : ?>
                                    <tr data-id="<?= $idioma->id ?>">
                                        <td><?= $idioma->idioma ?></td>
                                        <td><?= $idioma->nivel ?></td>
                                        <td><button type="button" data-action="idioma" class="btn btn-danger btn-sm delete-idioma"><i class="fa fa-trash"></i></button></td>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-secondary previous-step" data-prev="step-6">Anterior</button>
                    <button type="button" class="btn btn-primary next-step" data-next="step-8">Próximo</button>
                </div>

                <!-- Step 8: Projetos -->
                <div class="tab-pane fade wizard-step" id="step-8" role="tabpanel" aria-labelledby="tab-step-8">
                    <h3>Projetos</h3>
                    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalForm" data-form="projeto" data-acao="projeto">Adicionar</button>
                    <div id="projeto-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Projeto</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($projetos as $index => $projeto) : ?>
                                    <tr data-id="<?= $projeto->id ?>">
                                        <td><?= $projeto->projeto ?></td>
                                        <td><?= $projeto->descricao ?></td>
                                        <td><button type="button" data-action="projeto" class="btn btn-danger btn-sm delete-projeto"><i class="fa fa-trash"></i></button></td>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-secondary previous-step" data-prev="step-7">Anterior</button>
                    <button type="button" class="btn btn-primary next-step" data-next="step-9">Próximo</button>
                </div>

                <!-- Step 9: Atividades Extracurriculares -->
                <div class="tab-pane fade wizard-step" id="step-9" role="tabpanel" aria-labelledby="tab-step-9">
                    <h3>Atividades Extracurriculares</h3>
                    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalForm" data-form="atividade" data-acao="atividade">Adicionar</button>
                    <div id="atividade-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Atividade</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($atividadesExtracurriculares as $index => $atividade) : ?>
                                    <tr data-id="<?= $atividade->id ?>">
                                        <td><?= $atividade->atividade ?></td>
                                        <td><?= $atividade->descricao ?></td>
                                        <td><button type="button" data-action="atividade" class="btn btn-danger btn-sm delete-atividade"><i class="fa fa-trash"></i></button></td>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-secondary previous-step" data-prev="step-8">Anterior</button>
                    <button type="button" class="btn btn-primary next-step" data-next="step-10">Próximo</button>
                </div>

                <!-- Step 10: Publicações -->
                <div class="tab-pane fade wizard-step" id="step-10" role="tabpanel" aria-labelledby="tab-step-10">
                    <h3>Publicações</h3>
                    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalForm" data-form="publicacao" data-acao="publicacao">Adicionar</button>
                    <div id="publicacao-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Descrição</th>
                                    <th>Data de Publicação</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($publicacoes as $index => $publicacao) : ?>
                                    <tr data-id="<?= $publicacao->id ?>">
                                        <td><?= $publicacao->titulo ?></td>
                                        <td><?= $publicacao->descricao ?></td>
                                        <td><?= bd2br($publicacao->data_publicacao) ?></td>
                                        <td><button type="button"  data-action="publicacao" class="btn btn-danger btn-sm delete-publicacao"><i class="fa fa-trash"></i></button></td>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-secondary previous-step" data-prev="step-9">Anterior</button>
                    <button type="button" class="btn btn-primary next-step" data-next="step-11">Próximo</button>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal Dinâmico -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormLabel">Adicionar Informação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="dynamicForm">
                <div class="modal-body">
                    <!-- Form Dinâmico -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ativar navegação por abas
        $('#wizardTabs a').on('click', function(e) {
            e.preventDefault();
            $(this).tab('show');
        });

        // Manter a aba ativa após a navegação
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });

        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('#wizardTabs a[href="' + activeTab + '"]').tab('show');
        }

        // Função para navegação entre etapas
        $('.next-step').click(function() {
            var nextStep = $(this).data('next');
            $('#wizardTabs a[href="#' + nextStep + '"]').tab('show');
        });

        $('.previous-step').click(function() {
            var prevStep = $(this).data('prev');
            $('#wizardTabs a[href="#' + prevStep + '"]').tab('show');
        });

        // Modal Dinâmico
        $('#modalForm').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var formType = button.data('form');
            var acao = button.data('acao');
            var modal = $(this);
            var formHtml = '';

            switch (formType) {
                case 'educacao':
                    formHtml = `
                        <div class="form-group">
                            <label for="instituicao">Instituição</label>
                            <input type="text" class="form-control" id="instituicao" name="instituicao" required>
                        </div>
                        <div class="form-group">
                            <label for="curso">Curso</label>
                            <input type="text" class="form-control" id="curso" name="curso" required>
                        </div>
                        <div class="form-group">
                            <label for="data_inicio">Data de Início</label>
                            <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
                        </div>
                        <div class="form-group">
                            <label for="data_fim">Data de Fim</label>
                            <input type="date" class="form-control" id="data_fim" name="data_fim">
                        </div>`;
                    break;
                case 'experiencia':
                    formHtml = `
                        <div class="form-group">
                            <label for="empresa">Empresa</label>
                            <input type="text" class="form-control" id="empresa" name="empresa" required>
                        </div>
                        <div class="form-group">
                            <label for="cargo">Cargo</label>
                            <input type="text" class="form-control" id="cargo" name="cargo" required>
                        </div>
                        <div class="form-group">
                            <label for="data_inicio">Data de Início</label>
                            <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
                        </div>
                        <div class="form-group">
                            <label for="data_fim">Data de Fim</label>
                            <input type="date" class="form-control" id="data_fim" name="data_fim">
                        </div>
                        <div class="form-group">
                            <label for="responsabilidades">Responsabilidades</label>
                            <textarea class="form-control" id="responsabilidades" name="responsabilidades" rows="3"></textarea>
                        </div>`;
                    break;
                case 'habilidade':
                    formHtml = `
                        <div class="form-group">
                            <label for="habilidade">Habilidade</label>
                            <input type="text" class="form-control" id="habilidade" name="habilidade" required>
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <input type="text" class="form-control" id="tipo" name="tipo" required>
                        </div>`;
                    break;
                case 'certificacao':
                    formHtml = `
                        <div class="form-group">
                            <label for="certificacao">Certificação</label>
                            <input type="text" class="form-control" id="certificacao" name="certificacao" required>
                        </div>
                        <div class="form-group">
                            <label for="instituicao">Instituição</label>
                            <input type="text" class="form-control" id="instituicao" name="instituicao" required>
                        </div>
                        <div class="form-group">
                            <label for="data_emissao">Data de Emissão</label>
                            <input type="date" class="form-control" id="data_emissao" name="data_emissao" required>
                        </div>
                        <div class="form-group">
                            <label for="data_validade">Data de Validade</label>
                            <input type="date" class="form-control" id="data_validade" name="data_validade">
                        </div>`;
                    break;
                case 'idioma':
                    formHtml = `
                        <div class="form-group">
                            <label for="idioma">Idioma</label>
                            <input type="text" class="form-control" id="idioma" name="idioma" required>
                        </div>
                        <div class="form-group">
                            <label for="nivel">Nível</label>
                            <input type="text" class="form-control" id="nivel" name="nivel" required>
                        </div>`;
                    break;
                case 'projeto':
                    formHtml = `
                        <div class="form-group">
                            <label for="projeto">Projeto</label>
                            <input type="text" class="form-control" id="projeto" name="projeto" required>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                        </div>`;
                    break;
                case 'atividade':
                    formHtml = `
                        <div class="form-group">
                            <label for="atividade">Atividade</label>
                            <input type="text" class="form-control" id="atividade" name="atividade" required>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                        </div>`;
                    break;
                case 'publicacao':
                    formHtml = `
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="data_publicacao">Data de Publicação</label>
                            <input type="date" class="form-control" id="data_publicacao" name="data_publicacao">
                        </div>`;
                    break;
            }

            modal.find('.modal-body').html(formHtml);
            modal.find('form').attr('data-acao', acao);
        });

        $('#dynamicForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var formType = $(this).attr('data-acao');

            $.ajax({
                type: 'POST',
                url: '<?= base_url('usuario/adicionar_informacao') ?>/' + formType,
                data: formData,
                success: function(response) {
                    if (response.data) {
                        var newRow = '';
                        switch (formType) {
                            case 'educacao':
                                newRow = `<tr data-id="${response.data.id}">
                                    <td>${response.data.instituicao}</td>
                                    <td>${response.data.curso}</td>
                                    <td>${formatDate(response.data.data_inicio)}</td>
                                    <td>${formatDate(response.data.data_fim)}</td>
                                    <td><button type="button" data-action="educacao" class="btn btn-danger btn-sm delete-educacao"><i class="fa fa-trash"></i></button></td>
                                </tr>`;
                                $('#educacao-container tbody').append(newRow);
                                break;
                            case 'experiencia':
                                newRow = `<tr data-id="${response.data.id}">
                                    <td>${response.data.empresa}</td>
                                    <td>${response.data.cargo}</td>
                                    <td>${formatDate(response.data.data_inicio)}</td>
                                    <td>${formatDate(response.data.data_fim)}</td>
                                    <td>${response.data.responsabilidades}</td>
                                    <td><button type="button" data-action="experiencia" class="btn btn-danger btn-sm delete-experiencia"><i class="fa fa-trash"></i></button></td>
                                </tr>`;
                                $('#experiencia-container tbody').append(newRow);
                                break;
                            case 'habilidade':
                                newRow = `<tr data-id="${response.data.id}">
                                    <td>${response.data.habilidade}</td>
                                    <td>${response.data.tipo}</td>
                                    <td><button type="button" data-action="habilidade" class="btn btn-danger btn-sm delete-habilidade"><i class="fa fa-trash"></i></button></td>
                                </tr>`;
                                $('#habilidade-container tbody').append(newRow);
                                break;
                            case 'certificacao':
                                newRow = `<tr data-id="${response.data.id}">
                                    <td>${response.data.certificacao}</td>
                                    <td>${response.data.instituicao}</td>
                                    <td>${formatDate(response.data.data_emissao)}</td>
                                    <td>${formatDate(response.data.data_validade)}</td>
                                    <td><button type="button" data-action="certificacao" class="btn btn-danger btn-sm delete-certificacao"><i class="fa fa-trash"></i></button></td>
                                </tr>`;
                                $('#certificacao-container tbody').append(newRow);
                                break;
                            case 'idioma':
                                newRow = `<tr data-id="${response.data.id}">
                                    <td>${response.data.idioma}</td>
                                    <td>${response.data.nivel}</td>
                                    <td><button type="button" data-action="idioma" class="btn btn-danger btn-sm delete-idioma"><i class="fa fa-trash"></i></button></td>
                                </tr>`;
                                $('#idioma-container tbody').append(newRow);
                                break;
                            case 'projeto':
                                newRow = `<tr data-id="${response.data.id}">
                                    <td>${response.data.projeto}</td>
                                    <td>${response.data.descricao}</td>
                                    <td><button type="button" data-action="projeto" class="btn btn-danger btn-sm delete-projeto"><i class="fa fa-trash"></i></button></td>
                                </tr>`;
                                $('#projeto-container tbody').append(newRow);
                                break;
                            case 'atividade':
                                newRow = `<tr data-id="${response.data.id}">
                                    <td>${response.data.atividade}</td>
                                    <td>${response.data.descricao}</td>
                                    <td><button type="button" data-action="atividade" class="btn btn-danger btn-sm delete-atividade"><i class="fa fa-trash"></i></button></td>
                                </tr>`;
                                $('#atividade-container tbody').append(newRow);
                                break;
                            case 'publicacao':
                                newRow = `<tr data-id="${response.data.id}">
                                    <td>${response.data.titulo}</td>
                                    <td>${response.data.descricao}</td>
                                    <td>${formatDate(response.data.data_publicacao)}</td>
                                    <td><button type="button" data-action="publicacao" class="btn btn-danger btn-sm delete-publicacao"><i class="fa fa-trash"></i></button></td>
                                </tr>`;
                                $('#publicacao-container tbody').append(newRow);
                                break;
                        }
                        $('#modalForm').modal('hide');
                    }
                },
                error: function(error) {
                    console.error('Erro ao adicionar informação:', error);
                }
            });
        });

        // Salvar Informações Pessoais
        $('.save-personal-info').click(function() {
            var formData = new FormData();
            formData.append('nome', $('#nome').val());
            formData.append('email', $('#email').val());
            formData.append('telefone', $('#telefone').val());
            formData.append('endereco', $('#endereco').val());
            formData.append('linkedin', $('#linkedin').val());
            formData.append('facebook', $('#facebook').val());
            formData.append('instagram', $('#instagram').val());
            formData.append('confirmar_senha', $('#confirmar_senha').val());
            formData.append('senha', $('#senha').val());
            if ($('#foto_perfil')[0].files[0]) {
                formData.append('foto_perfil', $('#foto_perfil')[0].files[0]);
            }

            $.ajax({
                type: 'POST',
                url: '<?= base_url('usuario/salvar_informacoes_pessoais') ?>',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: response.message,
                    });
                    if (response.foto_perfil) {
                        $('#foto_perfil_display').attr('src', '<?= base_url() ?>/' + response.foto_perfil);
                        $('#foto_perfil').val('');
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'Erro ao salvar informações pessoais. Por favor, tente novamente.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: errorMessage,
                    });
                    console.error('Erro ao salvar informações pessoais:', xhr);
                }
            });
        });

        // Salvar Objetivo Profissional
        $('.save-objetivo').click(function() {
            console.log('teste')
            var formData = {
                'objetivo': $('#objetivo').val()
            };

            $.ajax({
                type: 'POST',
                url: '<?= base_url('usuario/salvar_objetivo_profissional') ?>',
                data: formData,
                success: function(response) {
                    alert('Objetivo profissional salvo com sucesso!');
                },
                error: function(error) {
                    console.error('Erro ao salvar objetivo profissional:', error);
                }
            });
        });

        // Excluir informação
        $(document).on('click', '.delete-educacao, .delete-experiencia, .delete-habilidade, .delete-certificacao, .delete-idioma, .delete-projeto, .delete-atividade, .delete-publicacao', function() {
            var row = $(this).closest('tr');
            var id = row.data('id');
            var formType = $(this).data('action');

            $.ajax({
                type: 'POST',
                url: '<?= base_url('usuario/excluir_informacao') ?>/' + formType + '/' + id,
                success: function(response) {
                    row.remove();
                    alert('Informação excluída com sucesso!');
                },
                error: function(error) {
                    console.error('Erro ao excluir informação:', error);
                }
            });
        });
    });

    function formatDate(dateString) {
        const dateParts = dateString.split('-');
        return `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`;
    }

</script>

<?= $this->endSection(); ?>