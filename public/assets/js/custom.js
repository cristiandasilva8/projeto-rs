
    document.getElementById('filtro-vagas').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio do formulário padrão

        const termo = document.getElementById('termo').value;
        const salarioMin = document.getElementById('salario_min').value;
        const salarioMax = document.getElementById('salario_max').value;

        fetch('<?= base_url('vagas/procurar') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'termo': termo,
                'salario_min': salarioMin,
                'salario_max': salarioMax
            })
        })
        .then(response => response.json())
        .then(data => {
            const resultadosDiv = document.getElementById('resultados-vagas');
            const jobCountSpan = document.getElementById('job-count');
            resultadosDiv.innerHTML = ''; // Limpa os resultados anteriores

            if (data.length > 0) {
                jobCountSpan.textContent = `${data.length} Jobs found`;

                data.forEach(vaga => {
                    const vagaDiv = document.createElement('div');
                    vagaDiv.classList.add('single-job-items', 'mb-30');
                    vagaDiv.innerHTML = `
                        <div class="job-items">
                            <div class="company-img">
                                <a href="#"><img src="assets/img/icon/job-list1.png" alt=""></a>
                            </div>
                            <div class="job-tittle job-tittle2">
                                <a href="#">
                                    <h4>${vaga.nome}</h4>
                                </a>
                                <ul>
                                    <li>${vaga.empresa}</li>
                                    <li><i class="fas fa-map-marker-alt"></i>${vaga.localizacao}</li>
                                    <li>${vaga.salario}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="items-link items-link2 f-right">
                            <a href="#">${vaga.tipo}</a>
                            <span>${vaga.data}</span>
                        </div>
                    `;
                    resultadosDiv.appendChild(vagaDiv);
                });
            } else {
                jobCountSpan.textContent = '0 Jobs found';
                resultadosDiv.innerHTML = '<p>Nenhuma vaga encontrada.</p>';
            }
        });
    });

