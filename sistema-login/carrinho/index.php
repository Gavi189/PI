<?php
include "../verificar-autenticacao.php";
$pagina = "carrinho";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Carrinho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Carrinhos Cadastrados</h3>
                        <a href="/carrinho/formulario.php" class="btn btn-secondary btn-sm">Novo</a>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID Carrinho</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Preço Total</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require("../requests/carrinho/get.php");
                                var_dump($response);exit;
                                if (!empty($response['data']['items'])) {
                                    foreach ($response['data']['items'] as $item) {
                                        echo '
                                        <tr>
                                            <td>' . htmlspecialchars($item['id_carrinho'] ?? '') . '</td>
                                            <td>' . htmlspecialchars($item['cliente_nome'] ?? 'Desconhecido') . '</td>
                                            <td>' . htmlspecialchars($item['produto'] ?? '') . '</td>
                                            <td>' . htmlspecialchars($item['quantidade'] ?? 0) . '</td>
                                            <td>R$ ' . number_format($item['preco_total'] ?? 0, 2, ',', '.') . '</td>
                                            <td>
                                                <a href="/carrinho/formulario.php?key=' . htmlspecialchars($item['id_carrinho'] ?? '') . '" class="btn btn-warning">Editar</a>
                                                <a href="/carrinho/remover.php?id_cliente=' . htmlspecialchars($item['id_cliente'] ?? '') . '&id_produto=' . htmlspecialchars($item['id_produto'] ?? '') . '" class="btn btn-danger">Excluir</a>
                                            </td>
                                        </tr>
                                        ';
                                    }
                                } else {
                                    echo '<tr><td colspan="6">Nenhum item no carrinho</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
    let table = new DataTable('#myTable', {
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.3.2/i18n/pt-BR.json'
        },
        columns: [{
                data: 'id_carrinho'
            },
            {
                data: 'cliente_nome',
                defaultContent: 'Desconhecido'
            },
            {
                data: 'produto'
            },
            {
                data: 'quantidade'
            },
            {
                data: 'preco_total',
                render: function(data) {
                    return 'R$ ' + (parseFloat(data) || 0).toFixed(2).replace('.', ',');
                }
            },
            {
                data: null,
                orderable: false,
                searchable: false
            }
        ],
        data: <?php echo json_encode($response['data']['items'] ?? []); ?>
    });
    </script>
</body>

</html>