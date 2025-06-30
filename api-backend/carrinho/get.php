<?php
// Assumes $conn is defined in headers.php or a similar file
$sql = "
    SELECT c.id_carrinho, c.id_cliente, c.id_produto, c.quantidade, 
           p.produto, p.descricao, p.id_marca, p.imagem, p.preco, m.marca
    FROM carrinho c
    JOIN produtos p ON c.id_produto = p.id_produto
    JOIN marcas m ON p.id_marca = m.id_marca
    WHERE c.id_cliente = :id_cliente
";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_cliente', $_GET['id_cliente'], PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_OBJ);

$total = 0;
foreach ($data as $item) {
    $total += $item->preco * $item->quantidade;
}

$result = [
    'status' => 'success',
    'message' => 'Cart data found',
    'data' => [
        'items' => $data,
        'total' => $total
    ]
];
echo json_encode($result);
$conn = null;
?>