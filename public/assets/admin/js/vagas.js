$(document).ready(function() {
    var baseUrlEdit = $('.divVagas').data('url-edit');
    var baseUrlDelete = $('.divVagas').data('url-delete');

     // Event listener para o botão deletar
     $('#tabelaVagas').on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        deleteVaga(baseUrlDelete, id);
    });

    $('#tabelaVagas').DataTable({
        responsive: true,
        "processing": true,
        "serverSide": true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json"
        },
        "ajax": {
            "url": `${BASE_URL}vagas/listar`, // URL de onde os dados devem ser puxados
            "type": "POST"
        },
        "columns": [
            { "data": "nome" },
            { "data": "cidade" },
            { "data": "setor" },
            { "data": "quantidade_limite" },
            {
                "data": "salario",
                "render": function (data, type, row) {
                  return parseFloat(data).toLocaleString("pt-BR", {
                    style: "currency",
                    currency: "BRL",
                  });
                },
              },
            { "data": "tipo" },
            {
                "data": null,
                "render": function (data, type, row) {
                    return `
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="${baseUrlEdit}/${data.id}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="${data.id}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <button class="btn btn-warning btn-sm" onclick="showCandidates(${row.id})">
                                Candidatos <span class="badge badge-success">${data.num_candidatos}</span>
                            </button>
                        </div>`;
                }
            }
        ]
    });

});


    function showCandidates(vagaId) {
        $.ajax({
            url: `${BASE_URL}/admin/vagas/candidatos/${vagaId}`,
            type: 'GET',
            success: function(response) {
                let htmlContent;
                if (response.length > 0) {
                    // Há candidatos para a vaga
                    htmlContent = '<ul>';
                    response.forEach(function(user) {
                        htmlContent += `<li>${user.username}</li>`;
                    });
                    htmlContent += '</ul>';
                } else {
                    // Não há candidatos para a vaga
                    htmlContent = '<p>Não há candidatos cadastrados para esta vaga.</p>';
                }
                $('#candidatesModal .modal-body').html(htmlContent);
                $('#candidatesModal').modal('show');
            },
            error: function() {
                alert('Não foi possível carregar os candidatos.');
            }
        });
    }
    


function deleteVaga(url, id) {
    Swal.fire({
        title: 'Tem certeza?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, delete isso!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `${url}/${id}`,
                type: 'DELETE',
                success: function(response) {
                    $('#tabelaVagas').DataTable().ajax.reload();
                    Swal.fire(
                        'Deletado!',
                        'A vaga foi deletada.',
                        'success'
                    );
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.fire(
                        'Erro!',
                        'Falha ao deletar a vaga: ' + xhr.responseText,
                        'error'
                    );
                }
            });
        }
    });
}

