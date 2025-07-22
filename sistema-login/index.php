<?php
if (!session_id()) {
    session_start();
}
include "../sistema-login/verificar-autenticacao.php";
$pagina = "home";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <?php include "../sistema-login/mensagens.php"; ?>
    <?php include "../sistema-login/navbar.php"; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="bi bi-people" style="font-size: 2rem;"></i>
                                <h5 class="card-title mt-2">Clientes
                                    <?php require("requests/clientes/get.php"); ?>
                                    (<?php echo isset($response['data']) ? count($response['data']) : 0; ?>)</h5>
                            </div>
                            <div class="card-footer text-center">
                                <a href="<?php echo $_SESSION["url"]; ?>/clientes" class="btn btn-primary">Acessar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="bi bi-buildings" style="font-size: 2rem;"></i>
                                <h5 class="card-title mt-2">Fornecedores
                                    <?php require("requests/fornecedores/get.php"); ?>
                                    (<?php echo isset($response['data']) ? count($response['data']) : 0; ?>)</h5>
                            </div>
                            <div class="card-footer text-center">
                                <a href="<?php echo $_SESSION["url"]; ?>/fornecedores"
                                    class="btn btn-primary">Acessar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="bi bi-gift" style="font-size: 2rem;"></i>
                                <h5 class="card-title mt-2">Produtos
                                    <?php require("requests/produtos/get.php"); ?>
                                    (<?php echo isset($response['data']) ? count($response['data']) : 0; ?>)</h5>
                            </div>
                            <div class="card-footer text-center">
                                <a href="<?php echo $_SESSION["url"]; ?>/produtos" class="btn btn-primary">Acessar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="bi bi-cart" style="font-size: 2rem;"></i>
                                <h5 class="card-title mt-2">Carrinho
                                    <?php require("requests/carrinho/get.php"); ?>
                                    (<?php echo isset($response['data']['items']) ? count($response['data']['items']) : 0; ?>)
                                </h5>
                            </div>
                            <div class="card-footer text-center">
                                <a href="<?php echo $_SESSION["url"]; ?>/carrinho" class="btn btn-primary">Acessar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>