var currentVagaId;
$(document).ready(function () {

$(document).on('click', '.whatsapp-button', function() {
    var whatsappNumber = $(this).data('whatsapp');
    // Remove espaços, traços e parênteses do número
    whatsappNumber = whatsappNumber.replace(/\s+/g, '').replace(/[-()]/g, '');
    var whatsappLink = 'https://wa.me/' + whatsappNumber;
    window.open(whatsappLink, '_blank');
});

  var baseUrlEdit = $(".divVagas").data("url-edit");
  var baseUrlDelete = $(".divVagas").data("url-delete");

  // Event listener para o botão deletar
  $("#tabelaVagas").on("click", ".delete-btn", function () {
    var id = $(this).data("id");
    deleteVaga(baseUrlDelete, id);
  });

  $("#tabelaVagas").DataTable({
    responsive: true,
    "processing": true,
    "serverSide": true,
    "language": {
      "url":
        "https://cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json",
    },
    "ajax": {
      "url": `${BASE_URL}vagas/listar`, // URL de onde os dados devem ser puxados
      "type": "POST",
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
                    <button class="btn btn-warning btn-sm" onclick="showCandidatos(${row.id})">
                        Candidatos <span class="badge badge-success">${data.num_candidatos}</span>
                    </button>
                </div>`;
        },
      },
    ],
  });
});

function showCandidatos(vagaId) {
  currentVagaId = vagaId;
  $.ajax({
    url: `${BASE_URL}/admin/vagas/candidatos/${vagaId}`,
    type: "GET",
    success: function (response) {
      let htmlContent;
      if (response.length > 0) {
        // Há candidatos para a vaga
        htmlContent = "<ul class='list-group'>";
        response.forEach(function (user) {
          const isSelected = user.selecionado == 1;

          htmlContent += `
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start ${
            isSelected ? "bg-success text-white" : ""
          }">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">${user.username}</h5>
                    <small>${user.email}</small>
                  </div>
                  <p class="mb-1">${user.telefone}</p>
                  <div class="d-flex justify-content-between">
                    <div>
                      <input type="checkbox" class="select-candidate" data-id="${user.id}" ${
            isSelected ? "checked" : ""
          }>
                      <label>Selecionar</label>
                    </div>
                    ${isSelected ? `
                        <button class="btn btn-success btn-sm whatsapp-button" data-whatsapp="${user.whatsapp}"><i class="fa-brands fa-whatsapp"></i></button>
                    ` : ''}
                        <button class="btn btn-primary btn-sm view-curriculo" data-id="${user.id}"><i class="fa-solid fa-address-card"></i></button>
                  </div>
                </a>`;
        });
        htmlContent += "</ul>";
      } else {
        // Não há candidatos para a vaga
        htmlContent = "<p>Não há candidatos cadastrados para esta vaga.</p>";
      }
      $("#candidatesList").html(htmlContent);
      $("#candidatesModal").modal("show");
    },
    error: function () {
      alert("Não foi possível carregar os candidatos.");
    },
  });
}

// Event listener para abrir o modal do currículo
$(document).on("click", ".view-curriculo", function () {
  const userId = $(this).data("id");
  showCurriculo(userId);
});

// Função para abrir o modal do currículo
function showCurriculo(userId) {
  $.ajax({
    url: `${BASE_URL}/admin/vagas/curriculo/${userId}`,
    type: "GET",
    success: function (response) {
      let htmlContent = `
          <div class="text-center mb-4">
            ${
        response.informacoesPessoais.foto_perfil
          ? `<img src="${BASE_URL}/${response.informacoesPessoais.foto_perfil}" class="img-fluid rounded-circle mb-3" alt="Foto de Perfil" width="150" height="150">`
          : ""
      }
            <h3>${response.usuario.username}</h3>
          </div>
          <div class="text-left">
            <p><strong>Email:</strong> ${response.authIdentities.secret}</p>
            <p><strong>Telefone:</strong> ${response.informacoesPessoais.telefone}</p>
            <p><strong>Endereço:</strong> ${response.informacoesPessoais.endereco}</p>
            <p><strong>LinkedIn:</strong> <a href="${response.informacoesPessoais.linkedin}" target="_blank">${response.informacoesPessoais.linkedin}</a></p>
            <hr>
            <h4>Objetivo Profissional</h4>
            <p>${response.objetivoProfissional.objetivo}</p>
            <hr>
            <h4>Educação</h4>
            <ul class="list-unstyled">`;
      response.educacoes.forEach(function (educacao) {
        htmlContent +=
          `<li><strong>${educacao.instituicao}</strong> - ${educacao.curso} (${educacao.data_inicio} - ${educacao.data_fim})</li>`;
      });
      htmlContent += `</ul>
            <hr>
            <h4>Experiência Profissional</h4>
            <ul class="list-unstyled">`;
      response.experienciasProfissionais.forEach(function (experiencia) {
        htmlContent +=
          `<li><strong>${experiencia.empresa}</strong> - ${experiencia.cargo} (${experiencia.data_inicio} - ${experiencia.data_fim})</li>`;
      });
      htmlContent += `</ul>
            <hr>
            <h4>Habilidades</h4>
            <ul class="list-unstyled">`;
      response.habilidades.forEach(function (habilidade) {
        htmlContent += `<li>${habilidade.habilidade} (${habilidade.tipo})</li>`;
      });
      htmlContent += `</ul>
            <hr>
            <h4>Certificações</h4>
            <ul class="list-unstyled">`;
      response.certificacoes.forEach(function (certificacao) {
        htmlContent +=
          `<li>${certificacao.certificacao} - ${certificacao.instituicao} (${certificacao.data_emissao} - ${certificacao.data_validade})</li>`;
      });
      htmlContent += `</ul>
            <hr>
            <h4>Idiomas</h4>
            <ul class="list-unstyled">`;
      response.idiomas.forEach(function (idioma) {
        htmlContent += `<li>${idioma.idioma} (${idioma.nivel})</li>`;
      });
      htmlContent += `</ul>
            <hr>
            <h4>Projetos</h4>
            <ul class="list-unstyled">`;
      response.projetos.forEach(function (projeto) {
        htmlContent += `<li>${projeto.projeto} - ${projeto.descricao}</li>`;
      });
      htmlContent += `</ul>
            <hr>
            <h4>Atividades Extracurriculares</h4>
            <ul class="list-unstyled">`;
      response.atividadesExtracurriculares.forEach(function (atividade) {
        htmlContent +=
          `<li>${atividade.atividade} - ${atividade.descricao}</li>`;
      });
      htmlContent += `</ul>
            <hr>
            <h4>Publicações</h4>
            <ul class="list-unstyled">`;
      response.publicacoes.forEach(function (publicacao) {
        htmlContent +=
          `<li>${publicacao.titulo} - ${publicacao.descricao} (${publicacao.data_publicacao})</li>`;
      });
      htmlContent += `</ul>
          </div>`;

      $("#curriculoModal .modal-body").html(htmlContent);
      $("#curriculoModal").modal("show");
    },
    error: function () {
      alert("Não foi possível carregar o currículo.");
    },
  });
}

// Event listener para enviar email aos candidatos selecionados
$(document).on("click", ".send-email", function () {
  const selectedCandidates = [];
  $(".select-candidate:checked").each(function () {
    selectedCandidates.push($(this).data("id"));
  });

  if (selectedCandidates.length === 0) {
    alert("Por favor, selecione pelo menos um candidato.");
    return;
  }

  $.ajax({
    url: `${BASE_URL}/admin/vagas/enviar_email`,
    type: "POST",
    data: {
      candidatos: selectedCandidates,
      vaga_id: currentVagaId, // Usando a variável armazenada para a vaga
    },
    success: function (response) {
      alert("Email enviado com sucesso!");
      showCandidatos(currentVagaId);
    },
    error: function () {
      alert("Não foi possível enviar o email.");
    },
  });
});





function deleteVaga(url, id) {
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
        url: `${url}/${id}`,
        type: "DELETE",
        success: function (response) {
          $("#tabelaVagas").DataTable().ajax.reload();
          Swal.fire(
            "Deletado!",
            "A vaga foi deletada.",
            "success",
          );
        },
        error: function (xhr, ajaxOptions, thrownError) {
          Swal.fire(
            "Erro!",
            "Falha ao deletar a vaga: " + xhr.responseText,
            "error",
          );
        },
      });
    }
  });
}
