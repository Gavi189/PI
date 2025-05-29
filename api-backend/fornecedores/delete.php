<?php

try {
    // Verificar se está vindo ID na URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        
        $sql = "
        DELETE FROM fornecedores 
        WHERE id_fornecedor = :id
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
    } else {
        throw new Exception('ID inválido ou não fornecido.');
    }
    
    $result = array(
        'status' => 'success',
        'message' => 'Fornecedor excluído com sucesso.'
    );

} catch (Exception $e) {
    http_response_code(400);
    $result = array(
        'status' => 'error',
        'message' => $e->getMessage()
    );
} finally {
    // Retorna os dados em formato JSON
    echo json_encode($result);
    // Fecha a conexão com o banco de dados
    $conn = null;
}