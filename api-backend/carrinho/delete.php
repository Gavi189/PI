<?php
$id_cliente = $_GET['id_cliente'] ?? null;
$id_produto = $_GET['id_produto'] ?? null;

if (empty($id_cliente) || empty($id_produto)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

$sql = "
    DELETE FROM carrinho
    WHERE id_cliente = :id_cliente AND id_produto = :id_produto
";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
$stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
$stmt->execute();

$result = [
    'status' => 'success',
    'message' => 'Item removed from cart'
];
echo json_encode($result);
$conn = null;
?>