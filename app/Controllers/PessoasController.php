```php
<?php

class PessoasController
{
    private PDO $pdo;

    public function __construct()
    {
        require __DIR__ . '/../../config/database.php';
        $this->pdo = $pdo;
    }

    public function listar(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $stmt = $this->pdo->query(
            "SELECT * FROM pessoas ORDER BY id DESC"
        );

        echo json_encode(
            $stmt->fetchAll(PDO::FETCH_ASSOC),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
    }

    public function buscarPorId(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $stmt = $this->pdo->prepare(
            "SELECT * FROM pessoas WHERE id = :id"
        );

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(
            $stmt->fetch(PDO::FETCH_ASSOC),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
    }

    public function criar(): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO pessoas
            (nome, cpf, telefone, email, status)
            VALUES
            (:nome, :cpf, :telefone, :email, :status)"
        );

        $stmt->execute([
            ':nome' => $_POST['nome'],
            ':cpf' => $_POST['cpf'],
            ':telefone' => $_POST['telefone'],
            ':email' => $_POST['email'],
            ':status' => $_POST['status'] ?? 'ativo'
        ]);

        echo json_encode([
            'mensagem' => 'Pessoa cadastrada com sucesso.'
        ]);
    }

    public function atualizar(): void
    {
        $stmt = $this->pdo->prepare(
            "UPDATE pessoas
            SET nome=:nome,
                cpf=:cpf,
                telefone=:telefone,
                email=:email,
                status=:status
            WHERE id=:id"
        );

        $stmt->execute([
            ':id' => $_POST['id'],
            ':nome' => $_POST['nome'],
            ':cpf' => $_POST['cpf'],
            ':telefone' => $_POST['telefone'],
            ':email' => $_POST['email'],
            ':status' => $_POST['status']
        ]);

        echo json_encode([
            'mensagem' => 'Pessoa atualizada com sucesso.'
        ]);
    }

    public function excluir(): void
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM pessoas WHERE id=:id"
        );

        $stmt->execute([
            ':id' => $_POST['id']
        ]);

        echo json_encode([
            'mensagem' => 'Pessoa excluída com sucesso.'
        ]);
    }
}
```
