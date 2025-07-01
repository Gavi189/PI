<?php
require_once '../headers.php';

if (isset($_GET['id_cliente']) && is_numeric($_GET['id_cliente'])) {
    $id_cliente = $_GET['id_cliente'];
    $sql = "SELECT c.id_carrinho, c.data, c.id_cliente, cli.nome AS cliente_nome, 
            rl.id_rl, rl.id_produto, rl.qtde, p.preco,
            p.produto, p.descricao, p.id_marca, p.imagem, m.marca
            FROM carrinhos AS c
            JOIN clientes AS cli ON c.id_cliente = cli.id_cliente
            JOIN rl_carrinho_produto AS rl ON rl.id_carrinho = c.id_carrinho
            JOIN produtos AS p ON p.id_produto = rl.id_produto
            JOIN marcas AS m ON m.id_marca = p.id_marca
            WHERE c.id_cliente = :id_cliente";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Agrupar produtos por carrinho
    $carrinhos = [];
    foreach ($rows as $row) {
        $id_carrinho = $row->id_carrinho;
        if (!isset($carrinhos[$id_carrinho])) {
            $carrinhos[$id_carrinho] = [
                'id_carrinho' => $row->id_carrinho,
                'data' => $row->data,
                'id_cliente' => $row->id_cliente,
                'cliente_nome' => $row->cliente_nome,
                'produtos' => [],
                'preco_total' => 0,
            ];
        }
        $carrinhos[$id_carrinho]['produtos'][] = [
            'id_rl' => $row->id_rl,
            'id_produto' => $row->id_produto,
            'produto' => $row->produto,
            'quantidade' => $row->qtde,
            'preco' => $row->preco,
            'descricao' => $row->descricao,
            'id_marca' => $row->id_marca,
            'imagem' => $row->imagem,
            'marca' => $row->marca,
        ];
        $carrinhos[$id_carrinho]['preco_total'] += $row->preco * $row->qtde; // Atualiza preco_total
    }

    $data = array_values($carrinhos);
    $total = array_sum(array_map(fn($item) => $item['preco_total'], $data));
} else {
    $data = [];
    $total = 0;
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