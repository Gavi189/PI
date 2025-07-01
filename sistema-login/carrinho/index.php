<?php
if (!session_id()) {
    session_start();
}
include "C:/Next/PI/sistema-login/verificar-autenticacao.php";
$pagina = "carrinho";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Carrinhos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include "C:/Next/PI/sistema-login/navbar.php"; ?>

    <div class="container mt-4">
        <h2 class="mb-3">Todos os Carrinhos</h2>
        <?php
        require "C:/Next/PI/sistema-login/requests/carrinho/get.php";
        if ($response['status'] === 'success' && !empty($response['data']['items'])) {
            echo '<ul class="list-group">';
            foreach ($response['data']['items'] as $item) {
                $quantidade_total = array_sum(array_column($item['produtos'], 'quantidade'));
                echo '<li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Carrinho #' . htmlspecialchars($item['id_carrinho']) . ' - ' . htmlspecialchars($item['cliente_nome']) . '</h5>
                        <small>' . htmlspecialchars($item['data']) . '</small>
                    </div>
                    <p class="mb-1">Produtos: ';
                $produtos = [];
                foreach ($item['produtos'] as $produto) {
                    $produtos[] = htmlspecialchars($produto['produto']) . ' (x' . $produto['quantidade'] . ')';
                }
                echo implode(', ', $produtos) . '</p>
                    <p>Quantidade Total: ' . htmlspecialchars($quantidade_total) . '</p>
                    <p>Preço Total: R$ ' . number_format($item['preco_total'] ?? 0, 2, ',', '.') . '</p>
                    <div>
                        <a href="/carrinho/editar.php?id=' . htmlspecialchars($item['id_carrinho']) . '" class="btn btn-sm btn-warning">Editar</a>
                        <a href="/carrinho/remover.php?id=' . htmlspecialchars($item['id_carrinho']) . '" class="btn btn-sm btn-danger">Excluir</a>
                    </div>
                </li>';
            }
            echo '</ul>';
            echo '<p class="mt-3">Total Geral: R$ ' . number_format($response['data']['total'] ?? 0, 2, ',', '.') . '</p>';
        } else {
            echo '<p class="text-danger">Nenhum carrinho encontrado ou erro: ' . htmlspecialchars($response['message'] ?? 'Sem dados') . '</p>';
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>