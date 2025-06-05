<?php

try {
    // Recuperar informações de formulário vindo do Frontend
    $postfields = json_decode(file_get_contents('php://input'), true);

    // Verificar se existe informações de formulário
    if(!empty($postfields)) {
        $id = $postfields['id_fornecedor'];
        $razao_social = $postfields['razao_social'] ?? null;
        $cnpj = $postfields['cnpj'] ?? null;
        $email = $postfields['email'] ?? null;
        $telefone = $postfields['telefone'] ?? null;
        $logradouro = $postfields['endereco']['logradouro'] ?? null;
        $numero = $postfields['endereco']['numero'] ?? null;
        $complemento = $postfields['endereco']['complemento'] ?? null;
        $bairro = $postfields['endereco']['bairro'] ?? null;
        $cidade = $postfields['endereco']['cidade'] ?? null;
        $estado = $postfields['endereco']['estado'] ?? null;
        $cep = $postfields['endereco']['cep'] ?? null;

        // Verifica campos obrigatórios
        if(empty($id)) {
            http_response_code(400);
            throw new Exception('ID do fornecedor é obrigatório');
        }
        if (empty($razao_social) || empty($postfields['endereco'])) {
            http_response_code(400);
            throw new Exception('Razão Social e Endereço são obrigatórios');
        }

        $sql = "
        UPDATE fornecedores SET 
            razao_social = :razao_social, 
            cnpj = :cnpj, 
            email = :email,
            telefone = :telefone,
            logradouro = :logradouro, 
            numero = :numero, 
            complemento = :complemento, 
            bairro = :bairro, 
            cidade = :cidade,
            estado = :estado,
            cep = :cep
        WHERE id_fornecedor = :id
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':razao_social', $razao_social, PDO::PARAM_STR);
        $stmt->bindParam(':cnpj', $cnpj, is_null($cnpj) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, is_null($email) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $telefone, is_null($telefone) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':logradouro', $logradouro);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':complemento', $complemento, is_null($complemento) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':cep', $cep);

        $stmt->execute();

        $result = array(
            'status' => 'success',
            'message' => 'Fornecedor alterado com sucesso!'
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
