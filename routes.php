<?php

// Carrega o controller responsável pelos endpoints de usuários.
// Observação: o arquivo no projeto está no singular (UsuarioController.php).

require_once __DIR__ . '/app/Controllers/AuthController.php';
require_once __DIR__ . '/app/Controllers/UsuarioController.php';
require_once __DIR__ . '/app/Controllers/PessoasController.php';
require_once __DIR__ . '/app/Controllers/TiposAtendimentosController.php';
require_once __DIR__ . '/app/Controllers/AtendimentosController.php';

require_once __DIR__ . '/app/Middleware/auth.php';

// Define controller e action por query string.
// Exemplo: ?controller=usuarios&action=listar
$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

// Este roteador é simples: só reconhece o controller "auth".
if ($controller === 'auth') {

    $auth = new AuthController();

    switch ($action) {

        case 'login':
            $auth->exibirLogin();
            break;

        case 'entrar':
            $auth->entrar();
            break;

        case 'dashboard':
            $auth->dashboard();
            break;

        case 'logout':
            $auth->logout();
            break;

        default:
            $auth->exibirLogin();
            break;
    }

    return;
}

// Este roteador é simples: só reconhece o controller "usuarios".
if ($controller === 'usuarios') {

    exigirAutenticacao();

    $usuariosController = new UsuariosController();

    // Escolhe qual método do controller executar.
    switch ($action) {
        case 'listar':
            $usuariosController->listar();
            break;

        case 'buscar':
            $usuariosController->buscarPorId();
            break;

        case 'criar':
            $usuariosController->criar();
            break;

        case 'atualizar':
            $usuariosController->atualizar();
            break;

        case 'excluir':
            $usuariosController->excluir();
            break;

        default:
            // Retorno padrão para action inválida.
            echo 'Ação de usuários não encontrada.';
            break;
    }
/*
|--------------------------------------------------------------------------
| PESSOAS
|--------------------------------------------------------------------------
*/
} elseif ($controller === 'pessoas') {

    $obj = new PessoasController();

    switch ($action) {
        case 'listar':
            $obj->listar();
            break;

        case 'buscar':
        case 'buscarPorId':
            $obj->buscarPorId();
            break;

        case 'criar':
            $obj->criar();
            break;

        case 'atualizar':
            $obj->atualizar();
            break;

        case 'excluir':
            $obj->excluir();
            break;

        default:
            echo 'Ação de pessoas não encontrada.';
            break;
    }

/*
|--------------------------------------------------------------------------
| TIPOS DE ATENDIMENTO
|--------------------------------------------------------------------------
*/
} elseif ($controller === 'tiposatendimentos') {

    $obj = new TiposAtendimentosController();

    switch ($action) {
        case 'listar':
            $obj->listar();
            break;

        case 'buscar':
        case 'buscarPorId':
            $obj->buscarPorId();
            break;

        case 'criar':
            $obj->criar();
            break;

        case 'atualizar':
            $obj->atualizar();
            break;

        case 'excluir':
            $obj->excluir();
            break;

        default:
            echo 'Ação de tipos de atendimento não encontrada.';
            break;
    }

/*
|--------------------------------------------------------------------------
| ATENDIMENTOS
|--------------------------------------------------------------------------
*/
} elseif ($controller === 'atendimentos') {

    $obj = new AtendimentosController();

    switch ($action) {
        case 'listar':
            $obj->listar();
            break;

        case 'buscar':
        case 'buscarPorId':
            $obj->buscarPorId();
            break;

        case 'criar':
            $obj->criar();
            break;

        case 'atualizar':
            $obj->atualizar();
            break;

        case 'excluir':
            $obj->excluir();
            break;

        default:
            echo 'Ação de atendimentos não encontrada.';
            break;
    }

} else {

    echo '<h1>AtendeLab</h1>';
    echo '<p>Projeto em execução.</p>';

}
?>