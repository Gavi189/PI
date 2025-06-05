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
</head>
<body>
    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <!-- Conteúdo principal -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <!-- Formulário de cadastro de produtos -->
                <h2>
                    Cadastrar Produtos
                    <a href="./" class="btn btn-primary btn-sm">Novo Produto</a>
                </h2>
                <form id="productForm" action="/produtos/cadastrar.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productId" class="form-label">Código do Produto</label>
                        <input type="text" class="form-control" id="productId" name="productId" readonly value="<?php echo isset($product) ? $product["id_produto"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Produto</label>
                        <input type="text" class="form-control" id="productName" name="productName" required value="<?php echo isset($product) ? $product["produto"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="brandId" class="form-label">Marca</label>
                        <select class="form-select" id="brandId" name="brandId" required>
                            <option value="">Selecione uma marca</option>
                            <?php
                            // Carrega as marcas do banco de dados
                            require("../requests/marcas/get.php");
                            if(!empty($response)) {
                                foreach($response["data"] as $marcas) {
                                    $selected = (isset($product) && $product["id_marca"] == $marcas["id_marca"]) ? "selected" : "";
                                    echo '<option value="'.$marcas["id_marca"].'" '.$selected.'>'.$marcas["marca"].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productQuantity" class="form-label">Quantidade</label>
                        <input type="number" min="0" class="form-control" id="productQuantity" name="productQuantity" required value="<?php echo isset($product) ? $product["quantidade"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Preço</label>
                        <input type="number" class="form-control" id="productPrice" name="productPrice" required value="<?php echo isset($product) ? $product["preco"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Imagem do Produto</label>
                        <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*">
                    </div>
                    <?php
                    // SE HOUVER IMAGEM NO PRODUTO, EXIBIR MINIATURA
                    if (isset($product["imagem"])) {
                        echo '
                        <div class="mb-3">
                            <input type="hidden" name="currentProductImage" value="' . $product["imagem"] . '">
                            <img width="100" src="imagens/' . $product["imagem"] . '">
                        </div>
                        ';
                    }
                    ?>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Descrição</label>
                        <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required><?php echo isset($product) ? $product["descricao"] : ""; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
            <div class="col-md-6">
                <!-- Tabela de produtos cadastrados -->
                <h2>
                    Produtos Cadastrados
                    <a href="/produtos/exportar.php" class="btn btn-success btn-sm float-left">Excel</a>
                    <a href="/produtos/exportar_pdf.php" class="btn btn-danger btn-sm float-left">PDF</a>
                </h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Imagem</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Ações</th>
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
                                <tr>
                                    <th scope="row">'.$product["id_produto"].'</th>
                                    <td>
                                        <img src="/produtos/imagens/'.$product["imagem"].'" alt="Imagem do Produto" class="img-thumbnail" style="max-width: 100px;">
                                    </td>
                                    <td>'.$product["produto"].'</td>
                                    <td>'.$product["marca"].'</td>
                                    <td>'.$product["quantidade"].'</td>
                                    <td>'.number_format($product["preco"],2,',','.').'</td>
                                    <td>
                                        <a href="/produtos/?key='.$product["id_produto"].'" class="btn btn-warning">Editar</a>
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

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

</body>
</html>