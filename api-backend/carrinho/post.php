<?php
require_once '../headers.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$postfields = json_decode(file_get_contents('php://input'), true);
$id_cliente = $postfields['id_cliente'] ?? null;
$id_produto = $postfields['id_produto'] ?? null;
$quantidade = $postfields['quantidade'] ?? null;

if (empty($id_cliente) || empty($id_produto) || empty($quantidade) || !is_numeric($id_cliente) || !is_numeric($id_produto) || !is_numeric($quantidade)) {
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

$sql_get_qty = "SELECT COALESCE(SUM(qtde), 0) as total_quantidade FROM rl_carrinho_produto WHERE id_carrinho = :id_carrinho AND id_produto = :id_produto";
$stmt_get_qty = $conn->prepare($sql_get_qty);
$stmt_get_qty->bindParam(':id_carrinho', $id_carrinho, PDO::PARAM_INT);
$stmt_get_qty->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
$stmt_get_qty->execute();
$total_atual = $stmt_get_qty->fetchColumn();

$nova_quantidade = $total_atual + $quantidade;

$sql_update = "UPDATE rl_carrinho_produto SET qtde = :quantidade WHERE id_carrinho = :id_carrinho AND id_produto = :id_produto";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bindParam(':id_carrinho', $id_carrinho, PDO::PARAM_INT);
$stmt_update->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
$stmt_update->bindParam(':quantidade', $nova_quantidade, PDO::PARAM_INT);

if ($stmt_update->execute() && $stmt_update->rowCount() > 0) {
    $result = ['status' => 'success', 'message' => 'Item updated in cart'];
} else {
    $sql_insert = "INSERT INTO rl_carrinho_produto (id_carrinho, id_produto, qtde, valor) SELECT :id_carrinho, :id_produto, :quantidade, preco FROM produtos WHERE id_produto = :id_produto";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bindParam(':id_carrinho', $id_carrinho, PDO::PARAM_INT);
    $stmt_insert->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmt_insert->bindParam(':quantidade', $nova_quantidade, PDO::PARAM_INT);
    $stmt_insert->execute();
    $result = ['status' => 'success', 'message' => 'Item added to cart'];
}

echo json_encode($result);
$conn = null;
?>