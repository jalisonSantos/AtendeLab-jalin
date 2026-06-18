<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>Dashboard</title>

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-body">

            <h2>
                Dashboard
            </h2>

            <hr>

            <p>

                <strong>Nome:</strong>

                <?= htmlspecialchars($usuario['nome']) ?>

            </p>

            <p>

                <strong>E-mail:</strong>

                <?= htmlspecialchars($usuario['email']) ?>

            </p>

            <p>

                <strong>Perfil:</strong>

                <?= htmlspecialchars($usuario['perfil']) ?>

            </p>

            <a
                href="?controller=usuarios&action=listar"
                class="btn btn-success">

                Testar rota protegida
            </a>

            <a
                href="?controller=auth&action=logout"
                class="btn btn-danger">

                Sair
            </a>

        </div>

    </div>

</div>

</body>
</html>