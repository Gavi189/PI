<?php

try {
    // Recuperar informações de formulário vindo do Frontend
    $postfields = json_decode(file_get_contents('php://input'), true);

    // Verificar se existe informações de formulário
    if(!empty($postfields)) {
        $id = $postfields['id_usuario'] ?? null;
        $nome = $postfields['nome'] ?? null;
        $email = $postfields['email'] ?? null;
        $senha = sha1($postfields['senha']) ?? null;

        // Verifica campos obrigatórios
        if(empty($id)) {
            http_response_code(400);
            throw new Exception('ID do usuário é obrigatório');
        }
        if (empty($nome) || empty($email) || empty($senha)) {
            http_response_code(400);
            throw new Exception('Nome, E-mail e Senha são obrigatórios');
        }

        $sql = "
        UPDATE usuarios SET 
            nome = :nome, 
            email = :email, 
            senha = :senha 
        WHERE id_usuario = :id
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);

        $stmt->execute();

        $result = array(
            'status' => 'success',
            'message' => 'Usuário alterado com sucesso!'
        );


    } else {
        http_response_code(400);
        // Se não existir dados, retornar erro
        throw new Exception('Nenhum dado foi enviado!');
    }

} catch (Exception $e) {
    // Se houver erro, retorna o erro
    $result = array(
        'status' => 'error',
        'message' => $e->getMessage(),
    );
} finally {
    // Retorna os dados em formato JSON
    echo json_encode($result);
    // Fecha a conexão com o banco de dados
    $conn = null;
}
