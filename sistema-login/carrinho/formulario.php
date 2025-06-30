<?php
include "../verificar-autenticacao.php";
$pagina = "carrinho";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/carrinho/get.php");
    $key = null;
    if (isset($response["data"]["items"]) && !empty($response["data"]["items"])) {
        $cart_item = $response["data"]["items"][0];
    } else {
        $cart_item = null;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Item no Carrinho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <div class="card-header">
                        <h3><?php echo isset($cart_item) ? 'Editar Item no Carrinho' : 'Adicionar Item ao Carrinho'; ?>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form id="myForm" action="/carrinho/cadastrar.php" method="POST">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="cartId" class="form-label">Código do Carrinho</label>
                                        <input type="text" class="form-control" id="cartId" name="cartId" readonly
                                            value="<?php echo isset($cart_item) ? $cart_item['id_carrinho'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="id_cliente" class="form-label">Cliente</label>
                                        <select class="form-select" id="id_cliente" name="id_cliente" required>
                                            <option value="">Selecione um cliente</option>
                                            <?php
                                            $cliente_sql = "SELECT id_cliente, nome FROM clientes ORDER BY nome";
                                            $cliente_stmt = $conn->prepare($cliente_sql);
                                            $cliente_stmt->execute();
                                            $clientes = $cliente_stmt->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($clientes as $cliente) {
                                                $selected = (isset($cart_item) && $cart_item['id_cliente'] == $cliente->id_cliente) ? 'selected' : '';
                                                echo '<option value="' . $cliente->id_cliente . '" ' . $selected . '>' . $cliente->nome . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="id_produto" class="form-label">Produto</label>
                                        <select class="form-select" id="id_produto" name="id_produto" required>
                                            <option value="">Selecione um produto</option>
                                            <?php
                                            require("../requests/carrinho/get.php");
                                            if (!empty($response['data'])) {
                                                foreach ($response['data'] as $produto) {
                                                    $selected = (isset($cart_item) && $cart_item['id_produto'] == $produto['id_produto']) ? 'selected' : '';
                                                    echo '<option value="' . $produto['id_produto'] . '" ' . $selected . '>' . $produto['produto'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="quantidade" class="form-label">Quantidade</label>
                                        <input type="number" min="1" class="form-control" id="quantidade"
                                            name="quantidade" required
                                            value="<?php echo isset($cart_item) ? $cart_item['quantidade'] : ''; ?>">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <a href="/carrinho/index.php" class="btn btn-outline-danger">Voltar</a>
                        <button form="myForm" type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>