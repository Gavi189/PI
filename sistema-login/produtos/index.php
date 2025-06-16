<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "produtos";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/produtos/get.php");
    $key = null;
    if (isset($response["data"]) && !empty($response["data"])) {
        // Se houver dados, pega o primeiro e único fornecedor na posição [0]
        $product = $response["data"][0];
    } else {
        $product = null;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Produtos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <!-- Conteúdo principal -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Produtos Cadastrados</h3>
                        <div>
                            <a href="/produtos/formulario.php" class="btn btn-secondary btn-sm float-left">Novo</a>
                            <a href="/produtos/exportar.php" class="btn btn-success btn-sm float-left">Excel</a>
                            <a href="/produtos/exportar_pdf.php" class="btn btn-danger btn-sm float-left">PDF</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Tabela de produtos cadastrados -->
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Imagem</th>
                                    <th scope="col">Produto</th>
                                    <th scope="col" class="text-center">Marca</th>
                                    <th scope="col" class="text-center">Quantidade</th>
                                    <th scope="col" class="text-center">Preço</th>
                                    <th scope="col" class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="productTableBody">
                                <!-- Os produtos serão carregados aqui via PHP -->
                                <?php
                                // SE HOUVER PRODUTOS NA SESSÃO, EXIBIR
                                require("../requests/produtos/get.php");
                                if(!empty($response)) {
                                    foreach($response["data"] as $key => $product) {
                                        echo '
                                        <tr style="vertical-align:middle">
                                            <th scope="row">'.$product["id_produto"].'</th>
                                            <td>
                                                <img src="/produtos/imagens/'.$product["imagem"].'" alt="Imagem do Produto" class="img-thumbnail" style="max-width: 100px;">
                                            </td>
                                            <td>'.$product["produto"].'</td>
                                            <td class="text-center">'.$product["marca"].'</td>
                                            <td class="text-center">'.$product["quantidade"].'</td>
                                            <td class="text-center">R$ '.number_format($product["preco"],2,',','.').'</td>
                                            <td>
                                                <a href="/produtos/formulario.php?key='.$product["id_produto"].'" class="btn btn-warning">Editar</a>
                                                <a href="/produtos/remover.php?key='.$product["id_produto"].'" class="btn btn-danger">Excluir</a>
                                            </td>
                                        </tr>
                                        ';
                                    }
                                } else {
                                    echo '
                                    <tr>
                                        <td colspan="7">Nenhum produto cadastrado</td>
                                    </tr>
                                    ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables -->
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