<!DOCTYPE html>
<html>
<head>
    <title>Nova Candidatura</title>
</head>
<body>
    <h1>Novo candidato para a vaga: <?= esc($vaga->titulo) ?></h1>
    <p><strong>Nome:</strong> <?= esc($user->username) ?></p>
    <p><strong>Email:</strong> <?= esc($user->email) ?></p>
    <p><strong>Telefone:</strong> <?= esc($user->phone) ?></p>
    <p>Por favor, entre em contato com o candidato para mais informações.</p>
</body>
</html>
