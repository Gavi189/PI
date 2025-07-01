<?php
require_once '../headers.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$id_cliente = $_GET['id_cliente'] ?? null;
$id_produto = $_GET['id_produto'] ?? null;

if (empty($id_cliente) || empty($id_produto) || !is_numeric($id_cliente) || !is_numeric($id_produto)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Missing or invalid required fields']);
    exit;
}

$sql_check = "SELECT id_carrinho FROM carrinhos WHERE id_cliente = :id_cliente";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
$stmt_check->execute();
$carrinho = $stmt_check->fetch(PDO::FETCH_OBJ);

if (!$carrinho) {
    http_response_code(404);
    echo json_encode(['status' => 'error', 'message' => 'Cart not found for this client']);
    exit;
}

$id_carrinho = $carrinho->id_carrinho;

$sql = "DELETE FROM rl_carrinho_produto WHERE id_carrinho = :id_carrinho AND id_produto = :id_produto";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_carrinho', $id_carrinho, PDO::PARAM_INT);
$stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
$stmt->execute();

$result = [
    'status' => 'success',
    'message' => 'Item removed from cart'
];
echo json_encode($result);
$conn = null;
?>