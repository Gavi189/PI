<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "home";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Clientes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <?php
    include "mensagens.php";
    include "navbar.php";
    ?>

    <!-- Conteúdo principal -->
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
                                    (<?php echo isset($response['data']) ? count($response['data']) : 0;?>)</h5>
                            </div>
                            <div class="card-footer text-center">
                                <a href="<?php echo $_SESSION["url"];?>/clientes" class="btn btn-primary">Acessar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="bi bi-buildings" style="font-size: 2rem;"></i>
                                <h5 class="card-title mt-2">Fornecedores
                                    <?php require("requests/fornecedores/get.php"); ?>
                                    (<?php echo isset($response['data']) ? count($response['data']) : 0;?>)</h5>
                            </div>
                            <div class="card-footer text-center">
                                <a href="<?php echo $_SESSION["url"];?>/fornecedores" class="btn btn-primary">Acessar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="bi bi-gift" style="font-size: 2rem;"></i>
                                <h5 class="card-title mt-2">Produtos
                                    <?php require("requests/produtos/get.php"); ?>
                                    (<?php echo isset($response['data']) ? count($response['data']) : 0;?>)</h5>
                            </div>
                            <div class="card-footer text-center">
                                <a href="<?php echo $_SESSION["url"];?>/produtos" class="btn btn-primary">Acessar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>