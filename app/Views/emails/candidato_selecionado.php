<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Você foi Selecionado!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 10px 0;
            border-bottom: 1px solid #eeeeee;
        }
        .header h1 {
            margin: 0;
            color: #4CAF50;
        }
        .content {
            padding: 20px;
            text-align: left;
        }
        .content h2 {
            color: #333333;
        }
        .content p {
            line-height: 1.6;
            margin: 10px 0;
        }
        .company-info {
            margin: 20px 0;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #eeeeee;
            border-radius: 8px;
        }
        .company-info p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            border-top: 1px solid #eeeeee;
            color: #888888;
            font-size: 12px;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Parabéns, Você foi Selecionado!</h1>
        </div>
        <div class="content">
            <h2>Olá, <?= $nomeCandidato ?></h2>
            <p>Temos o prazer de informar que você foi selecionado para uma entrevista na nossa empresa. Estamos muito interessados no seu perfil e gostaríamos de conhecê-lo melhor.</p>
            <div class="company-info">
                <h3>Informações da Empresa</h3>
                <p><strong>Nome da Empresa:</strong> <?= $empresaNome ?></p>
                <p><strong>Endereço:</strong> <?= $empresaEndereco ?></p>
                <p><strong>Email para Contato:</strong> <?= $empresaEmail ?></p>
                <p><strong>Telefone:</strong> <?= $empresaTelefone ?></p>
            </div>
            <p>Por favor, entre em contato conosco o mais breve possível para agendarmos a sua entrevista.</p>
            <p>Estamos ansiosos para conhecê-lo!</p>
            <p>Atenciosamente,</p>
            <p><strong><?= $empresaNome ?></strong></p>
        </div>
        <div class="footer">
            <p>Este é um email automático, por favor, não responda.</p>
            <p>Se você tiver alguma dúvida, entre em contato conosco através do <a href="mailto:<?= $emailSuporte ?>"><?= $emailSuporte ?></a>.</p>
        </div>
    </div>
</body>
</html>
