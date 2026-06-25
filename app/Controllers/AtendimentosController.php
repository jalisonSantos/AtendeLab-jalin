<?php

class AtendimentosController
{
    private PDO $pdo;

    public function __construct()
    {
        require __DIR__ . '/../../config/database.php';
        $this->pdo = $pdo;
    }

public function listar()
{
    header('Content-Type: application/json; charset=utf-8');

    $sql = "
        SELECT
            a.id,
            p.nome AS pessoa,
            t.nome AS tipo_atendimento,
            a.data_atendimento,
            a.hora_atendimento,
            a.descricao,
            a.observacao,
            a.observacao_final,
            a.status
        FROM atendimentos a
        INNER JOIN pessoas p
            ON p.id = a.pessoa_id
        INNER JOIN tipos_atendimentos t
            ON t.id = a.tipo_atendimento
        ORDER BY a.id DESC
    ";

    $stmt = $this->pdo->query($sql);

    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(
        $dados,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );
}

    public function buscarPorId()
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM atendimentos WHERE id=:id"
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
            "INSERT INTO atendimentos
            (pessoa_id, tipo_atendimento_id, descricao, status)
            VALUES
            (:pessoa_id, :tipo_id, :descricao, :status)"
        );

        $stmt->execute([
            ':pessoa_id' => $_POST['pessoa_id'],
            ':tipo_id' => $_POST['tipo_atendimento_id'],
            ':descricao' => $_POST['descricao'],
            ':status' => $_POST['status']
        ]);

        echo json_encode([
            'mensagem' => 'Atendimento cadastrado.'
        ]);
    }

    public function atualizar()
    {
        $stmt = $this->pdo->prepare(
            "UPDATE atendimentos
            SET pessoa_id=:pessoa_id,
                tipo_atendimento_id=:tipo_id,
                descricao=:descricao,
                status=:status
            WHERE id=:id"
        );

        $stmt->execute([
            ':id' => $_POST['id'],
            ':pessoa_id' => $_POST['pessoa_id'],
            ':tipo_id' => $_POST['tipo_atendimento_id'],
            ':descricao' => $_POST['descricao'],
            ':status' => $_POST['status']
        ]);

        echo json_encode([
            'mensagem' => 'Atendimento atualizado.'
        ]);
    }

    public function excluir()
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM atendimentos WHERE id=:id"
        );

        $stmt->execute([
            ':id' => $_POST['id']
        ]);

        echo json_encode([
            'mensagem' => 'Atendimento excluído.'
        ]);
    }
}