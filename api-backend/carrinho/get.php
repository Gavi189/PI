<?php
require_once '../headers.php';

if(isset($_GET['id_cliente']) && is_numeric($_GET['id_cliente'])) {
    $sql = "
        SELECT c.id_carrinho, c.id_cliente, c.id_produto, c.quantidade, 
               p.produto, p.descricao, p.id_marca, p.imagem, p.preco, m.marca,
               cl.nome AS cliente_nome
        FROM carrinho c
        JOIN produtos p ON c.id_produto = p.id_produto
        JOIN marcas m ON p.id_marca = m.id_marca
        LEFT JOIN clientes cl ON c.id_cliente = cl.id_cliente
        WHERE c.id_cliente = :id_cliente
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_cliente', $_GET['id_cliente'], PDO::PARAM_INT);
} else {
    $sql = "
        SELECT c.*, cli.*, rl.qtde, p.id_produto, p.produto, p.preco
        FROM carrinhos AS c
        JOIN clientes AS cli ON c.id_cliente = cli.id_cliente
        JOIN rl_carrinho_produto AS rl ON rl.id_carrinho = c.id_carrinho
        JOIN produtos AS p ON p.id_produto = rl.id_produto
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Agrupar produtos por carrinho
    $carrinhos = [];
    foreach ($rows as $row) {
        $id_carrinho = $row->id_carrinho;
        if (!isset($carrinhos[$id_carrinho])) {
            $carrinhos[$id_carrinho] = [
                'id_carrinho' => $row->id_carrinho,
                'id_cliente' => $row->id_cliente,
                'cliente_nome' => $row->nome ?? '',
                'produtos' => [],
            ];
        }
        $carrinhos[$id_carrinho]['produtos'][] = [
            'id_produto' => $row->id_produto,
            'produto' => $row->produto,
            'quantidade' => $row->qtde,
            'preco' => $row->preco
        ];
    }

    $data = array_values($carrinhos);

    $total = 0;
    foreach ($data as $key => $item) {
        foreach ($item['produtos'] as $produto) {
            $total += $produto['preco'] * $produto['quantidade'];
        }
    }
}
// $stmt->execute();
// $data = $stmt->fetchAll(PDO::FETCH_OBJ);

$total = 0;
// foreach ($data as $item) {
//     $item->preco_total = $item->preco * $item->quantidade;
//     $total += $item->preco_total;
// }

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