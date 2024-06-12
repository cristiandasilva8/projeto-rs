<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidatura à Vaga de Emprego</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            color: #333333;
        }
        .content h2 {
            color: #4CAF50;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777777;
            border-top: 1px solid #eeeeee;
            border-radius: 0 0 8px 8px;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Nome do site</h1>
        </div>
        <div class="content">
            <h2>Nova Candidatura Recebida</h2>
            <p>Olá,</p>
            <p>Você recebeu uma nova candidatura para a vaga <strong><?= $vaga->nome ?></strong>.</p>
            <p><strong>Detalhes do Candidato:</strong></p>
            <ul>
                <li><strong>Nome:</strong> <?= esc($usuario->usuario->username) ?></li>
                <li><strong>Email:</strong> <?= esc($usuario->authIdentities->secret ) ?></li>
                <li><strong>Telefone:</strong> <?= esc($usuario->informacoesPessoais->telefone) ?></li>
                <li><strong>WhatsApp:</strong> <?= esc($usuario->informacoesPessoais->whatsapp) ?></li>
            </ul>
            <p>Para mais detalhes, acesse o painel de administração.</p>
            <p>Atenciosamente,<br>Equipe Nome do Site</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Nome do Site. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>
