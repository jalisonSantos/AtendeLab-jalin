<?php

require_once __DIR__ . '/../Middleware/auth.php';

class AuthController
{
    public function exibirLogin(): void
    {
        $mensagem = $_SESSION['mensagem'] ?? null;

        unset($_SESSION['mensagem']);

        require __DIR__ . '/../Views/auth/login.php';
    }

    public function entrar(): void
    {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        if (
            $email === 'admin@atendelab.com' &&
            $senha === '123456'
        ) {
            $_SESSION['usuario'] = [
                'id' => 1,
                'nome' => 'Administrador',
                'email' => 'admin@atendelab.com',
                'perfil' => 'admin'
            ];

            header('Location: ?controller=auth&action=dashboard');
            exit;
        }

        $_SESSION['mensagem'] = 'Usuário ou senha inválidos.';

        header('Location: ?controller=auth&action=login');
        exit;
    }

    public function dashboard(): void
    {
        exigirAutenticacao();

        $usuario = usuarioAtual();

        require __DIR__ . '/../Views/dashboard/index.php';
    }

    public function logout(): void
    {
        $_SESSION = [];

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }

        header('Location: ?controller=auth&action=login');
        exit;
    }
}

