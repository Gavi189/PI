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
    <link href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include "C:/Next/PI/sistema-login/mensagens.php";
    include "C:/Next/PI/sistema-login/navbar.php";
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Carrinhos Cadastrados</h3>
                        <div>
                            <a href="/carrinho/formulario.php" class="btn btn-secondary btn-sm float-left">Novo</a>
                            <a href="/carrinho/exportar.php" class="btn btn-success btn-sm float-left">Excel</a>
                            <a href="/carrinho/exportar_pdf.php" class="btn btn-danger btn-sm float-left">PDF</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Produtos</th>
                                    <th scope="col" class="text-center">Quantidade Total</th>
                                    <th scope="col" class="text-center">Preço Total</th>
                                    <th scope="col" class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require "C:/Next/PI/sistema-login/requests/carrinho/get.php";
                                if ($response['status'] === 'success' && !empty($response['data']['items'])) {
                                    foreach ($response['data']['items'] as $key => $item) {
                                        $quantidade_total = array_sum(array_column($item['produtos'], 'quantidade'));
                                        $produtos_lista = [];
                                        foreach ($item['produtos'] as $produto) {
                                            $produtos_lista[] = htmlspecialchars($produto['produto']) . ' (x' . $produto['quantidade'] . ')';
                                        }
                                        echo '
                                        <tr style="vertical-align: middle">
                                            <th scope="row">' . htmlspecialchars($item['id_carrinho']) . '</th>
                                            <td>' . htmlspecialchars($item['cliente_nome']) . '</td>
                                            <td>' . htmlspecialchars($item['data']) . '</td>
                                            <td>' . implode(', ', $produtos_lista) . '</td>
                                            <td class="text-center">' . htmlspecialchars($quantidade_total) . '</td>
                                            <td class="text-center">R$ ' . number_format($item['preco_total'] ?? 0, 2, ',', '.') . '</td>
                                            <td class="text-center">
                                                <a href="/carrinho/editar.php?id=' . htmlspecialchars($item['id_carrinho']) . '" class="btn btn-warning btn-sm">Editar</a>
                                                <a href="/carrinho/remover.php?id=' . htmlspecialchars($item['id_carrinho']) . '" class="btn btn-sm btn-danger">Excluir</a>
                                            </td>
                                        </tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="7">Nenhum carrinho encontrado ou erro: ' . htmlspecialchars($response['message'] ?? 'Sem dados') . '</td></tr>';
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
            url: 'https://cdn.datatables.net/plug-ins/2.3.2/i18n/pt-BR.json',
        },
    });
    </script>
</body>

</html>