<?php

try {
    // Recuperar informações de formulário vindo do Frontend
    $postfields = json_decode(file_get_contents('php://input'), true);

    // Verificar se existe informações de formulário
    if(!empty($postfields)) {
        $produto = $postfields['produto'] ?? null;
        $id_marca = $postfields['id_marca'] ?? null;
        $descricao = $postfields['descricao'] ?? null;
        $quantidade = $postfields['quantidade'] ?? null;
        $preco = $postfields['preco'] ?? null;
        $imagem = $postfields['imagem'] ?? null;

        // Verifica campos obrigatórios
        if (empty($produto) || empty($id_marca)) {
            http_response_code(400);
            throw new Exception('Produto e Marca são obrigatórios');
        }

        $sql = "
        INSERT INTO produtos (produto, id_marca, descricao, imagem, quantidade, preco) VALUES 
        (
            :produto, 
            :id_marca, 
            :descricao, 
            :imagem, 
            :quantidade, 
            :preco
        )";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':produto', $produto, PDO::PARAM_STR);
        $stmt->bindParam(':id_marca', $id_marca, PDO::PARAM_INT);
        $stmt->bindParam(':descricao', $descricao, is_null($descricao) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':imagem', $imagem, is_null($imagem) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':quantidade', $quantidade, is_null($quantidade) ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindParam(':preco', $preco, is_null($preco) ? PDO::PARAM_NULL : PDO::PARAM_STR);

        $stmt->execute();

        $result = array(
            'status' => 'success',
            'message' => 'Produto cadastrado com sucesso!'
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
