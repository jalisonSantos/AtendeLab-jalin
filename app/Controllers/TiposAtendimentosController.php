<?php

class TiposAtendimentosController
{
    private PDO $pdo;

    public function __construct()
    {
        require __DIR__ . '/../../config/database.php';
        $this->pdo = $pdo;
    }

    public function listar()
    {
        echo json_encode(
            $this->pdo
                ->query("SELECT * FROM tipos_atendimentos ORDER BY id DESC")
                ->fetchAll(PDO::FETCH_ASSOC)
        );
    }

    public function buscarPorId()
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM tipos_atendimentos WHERE id=:id"
        );

        $stmt->execute([
            ':id' => $_GET['id']
        ]);

        echo json_encode(
            $stmt->fetch(PDO::FETCH_ASSOC)
        );
    }

    public function criar()
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO tipos_atendimentos
            (nome, descricao, status)
            VALUES
            (:nome, :descricao, :status)"
        );

        $stmt->execute([
            ':nome' => $_POST['nome'],
            ':descricao' => $_POST['descricao'],
            ':status' => $_POST['status']
        ]);

        echo json_encode([
            'mensagem' => 'Tipo de atendimento cadastrado.'
        ]);
    }

    public function atualizar()
    {
        $stmt = $this->pdo->prepare(
            "UPDATE tipos_atendimentos
            SET nome=:nome,
                descricao=:descricao,
                status=:status
            WHERE id=:id"
        );

        $stmt->execute([
            ':id' => $_POST['id'],
            ':nome' => $_POST['nome'],
            ':descricao' => $_POST['descricao'],
            ':status' => $_POST['status']
        ]);

        echo json_encode([
            'mensagem' => 'Tipo atualizado.'
        ]);
    }

    public function excluir()
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM tipos_atendimentos WHERE id=:id"
        );

        $stmt->execute([
            ':id' => $_POST['id']
        ]);

        echo json_encode([
            'mensagem' => 'Tipo removido.'
        ]);
    }
}
