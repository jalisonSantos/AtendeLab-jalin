<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>AtendeLab - Login</title>

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-4">

            <div class="card mt-5 shadow">

                <div class="card-body">

                    <h3 class="text-center mb-4">
                        AtendeLab
                    </h3>

                    <?php if (!empty($mensagem)): ?>

                        <div class="alert alert-danger">

                            <?= htmlspecialchars($mensagem) ?>

                        </div>

                    <?php endif; ?>

                    <form
                        method="POST"
                        action="?controller=auth&action=entrar">

                        <div class="mb-3">

                            <label class="form-label">

                                E-mail

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Senha

                            </label>

                            <input
                                type="password"
                                name="senha"
                                class="form-control"
                                required>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            Entrar

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>