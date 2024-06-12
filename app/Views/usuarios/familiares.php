<?= $this->extend('layouts/app.php'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5" style="margin-bottom: 10em;">
    <h2>Gerenciar Familiares</h2>
    <form id="addFamiliarForm">
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="nomeFamiliar" class="form-label">Nome do Familiar</label>
                <input type="text" class="form-control" id="nomeFamiliar" name="nome" required>
            </div>
            <div class="col-md-12 mb-3">
                <select class="form-control" id="parentescoFamiliar" name="parentesco" required>
                    <option value="" disabled selected>Selecione o parentesco</option>
                    <option value="Cônjuge">Cônjuge(Esposa/Marido)</option>
                    <option value="Pai">Pai</option>
                    <option value="Mãe">Mãe</option>
                    <option value="Irmão">Irmão</option>
                    <option value="Irmã">Irmã</option>
                    <option value="Tio">Tio</option>
                    <option value="Tia">Tia</option>
                    <option value="Primo">Primo</option>
                    <option value="Prima">Prima</option>
                    <option value="Avô">Avô</option>
                    <option value="Avó">Avó</option>
                    <option value="Sobrinho">Sobrinho</option>
                    <option value="Sobrinha">Sobrinha</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <button type="submit" class="btn btn-nano">Adicionar Familiar</button>
            </div>
        </div>
    </form>

    <h3 class="mt-5">Familiares</h3>
    <table class="table table-bordered" id="familiaresTable">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Parentesco</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Conteúdo da tabela será preenchido dinamicamente -->
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Função para buscar e atualizar a tabela de familiares
        function fetchFamiliares() {
            $.ajax({
                url: '<?= base_url('usuario/get_familiares') ?>',
                type: 'GET',
                success: function(response) {
                    let html = '';
                    response.forEach(function(familiar) {
                        html += `
                            <tr>
                                <td>${familiar.nome}</td>
                                <td>${familiar.parentesco}</td>
                                <td>
                                    <button class="btn btn-nano btn-sm delete-familiar" data-id="${familiar.id}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#familiaresTable tbody').html(html);
                },
                error: function() {
                    alert('Não foi possível carregar os familiares.');
                }
            });
        }

        // Buscar e atualizar a tabela ao carregar a página
        fetchFamiliares();

        // Adicionar familiar
        $('#addFamiliarForm').submit(function(event) {
            event.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: '<?= base_url('usuario/add_familiar') ?>',
                type: 'POST',
                data: formData,
                success: function(response) {
                    fetchFamiliares(); // Atualizar a tabela
                    $('#addFamiliarForm')[0].reset(); // Resetar o formulário
                },
                error: function() {
                    alert('Não foi possível adicionar o familiar.');
                }
            });
        });

        // Deletar familiar
        $(document).on('click', '.delete-familiar', function() {
            const familiarId = $(this).data('id');

            Swal.fire({
                title: "Tem certeza?",
                text: "Você não poderá reverter isso!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, delete isso!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `<?= base_url('usuario/delete_familiar') ?>/${familiarId}`,
                        type: 'DELETE',
                        success: function(response) {
                            fetchFamiliares(); // Atualizar a tabela
                        },
                        error: function() {
                            alert('Não foi possível excluir o familiar.');
                        }
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>