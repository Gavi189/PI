<?php
$postfields = json_decode(file_get_contents('php://input'), true);
$id_cliente = $postfields['id_cliente'] ?? null;
$id_produto = $postfields['id_produto'] ?? null;
$quantidade = $postfields['quantidade'] ?? null;

if (empty($id_cliente) || empty($id_produto) || empty($quantidade)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

$sql = "
    UPDATE carrinho
    SET quantidade = :quantidade
    WHERE id_cliente = :id_cliente AND id_produto = :id_produto
";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
$stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
$stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
$stmt->execute();

$result = [
    'status' => 'success',
    'message' => 'Cart updated'
];
echo json_encode($result);
$conn = null;
?>