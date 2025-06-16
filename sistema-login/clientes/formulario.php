<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "clientes";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/clientes/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
        // Se houver dados, pega o primeiro e único cliente na posição [0]
        $client = $response["data"][0];
    } else {
        $client = null;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Clientes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <!-- Conteúdo principal -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3>Cadastrar Cliente</h3>
                    </div>
                    <div class="card-body">
                        <!-- Formulário de cadastro de clientes -->
                        <form id="myForm" action="/clientes/cadastrar.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="clientId" class="form-label">Código do Cliente</label>
                                        <input type="text" class="form-control" id="clientId" name="clientId" readonly
                                            value="<?php echo isset($client) ? $client["id_cliente"] : ""; ?>">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <label for="clientName" class="form-label">Nome do Cliente</label>
                                        <input type="text" class="form-control" id="clientName" name="clientName"
                                            required value="<?php echo isset($client) ? $client["nome"] : ""; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="clientCPF" class="form-label">CPF</label>
                                        <input data-mask="000.000.000-00" type="text" class="form-control"
                                            id="clientCPF" name="clientCPF" required
                                            value="<?php echo isset($client) ? $client["cpf"] : ""; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="clientEmail" class="form-label">E-mail</label>
                                        <input type="email" class="form-control" id="clientEmail" name="clientEmail"
                                            required value="<?php echo isset($client) ? $client["email"] : ""; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="clientWhatsapp" class="form-label">Whatsapp</label>
                                        <input data-mask="(00) 0 0000-0000" type="text" class="form-control"
                                            id="clientWhatsapp" name="clientWhatsapp" required
                                            value="<?php echo isset($client) ? $client["whatsapp"] : ""; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="clientImage" class="form-label">Imagem</label>
                                        <input type="file" class="form-control" id="clientImage" name="clientImage"
                                            accept="image/*"
                                            value="<?php echo isset($client) ? $client["imagem"] : ""; ?>">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <?php
                                    // SE HOUVER IMAGEM NO CLIENTE, EXIBIR MINIATURA
                                    if (isset($client["imagem"])) {
                                        echo '
                                        <div class="mb-3">
                                            <input type="hidden" name="currentClientImage" value="' . $client["imagem"] . '">
                                            <img width="100" src="imagens/' . $client["imagem"] . '">
                                        </div>
                                        ';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="clientCEP" class="form-label">CEP</label>
                                        <input data-mask="00000-000" type="text" class="form-control" id="clientCEP"
                                            name="clientCEP" required
                                            value="<?php echo isset($client) ? $client["endereco"]["cep"] : ""; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="clientStreet" class="form-label">Logradouro</label>
                                        <input type="text" class="form-control" id="clientStreet" name="clientStreet"
                                            required
                                            value="<?php echo isset($client) ? $client["endereco"]["logradouro"] : ""; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm">
                                    <div class="mb-3">
                                        <label for="clientNumber" class="form-label">Número</label>
                                        <input type="text" class="form-control" id="clientNumber" name="clientNumber"
                                            required
                                            value="<?php echo isset($client) ? $client["endereco"]["numero"] : ""; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="clientComplement" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" id="clientComplement"
                                            name="clientComplement"
                                            value="<?php echo isset($client) ? $client["endereco"]["complemento"] : ""; ?>">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="clientNeighborhood" class="form-label">Bairro</label>
                                        <input type="text" class="form-control" id="clientNeighborhood"
                                            name="clientNeighborhood" required
                                            value="<?php echo isset($client) ? $client["endereco"]["bairro"] : ""; ?>">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="clientCity" class="form-label">Cidade</label>
                                        <input readonly type="text" class="form-control" id="clientCity"
                                            name="clientCity" required
                                            value="<?php echo isset($client) ? $client["endereco"]["cidade"] : ""; ?>">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="mb-3">
                                        <label for="clientState" class="form-label">Estado</label>
                                        <input readonly type="text" maxlength="2" class="form-control" id="clientState"
                                            name="clientState" required
                                            value="<?php echo isset($client) ? $client["endereco"]["estado"] : ""; ?>">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <a href="/clientes" class="btn btn-outline-danger">Voltar</a>
                        <button form="myForm" type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
    $('#clientCEP').on('blur', function() {
        var cep = $(this).val().replace(/\D/g, '');
        // Verifica se o CEP tem 8 dígitos
        if (cep.length === 8) {
            // Faz a requisição para a API ViaCEP
            $.getJSON('https://viacep.com.br/ws/' + cep + '/json/?callback=?', function(data) {
                if (!data.erro) {
                    $('#clientStreet').val(data.logradouro);
                    $('#clientNeighborhood').val(data.bairro);
                    $('#clientCity').val(data.localidade);
                    $('#clientState').val(data.uf);
                } else {
                    alert('CEP não encontrado.');
                    $("#clientCEP").val("");
                    $("#clientStreet").val("");
                    $("#clientNeighborhood").val("");
                    $("#clientCity").val("");
                    $("#clientState").val("");
                }
            });
        } else {
            alert('Formato de CEP inválido.');
            // Limpa os campos de endereço
            $("#clientCEP").val("");
            $("#clientStreet").val("");
            $("#clientNeighborhood").val("");
            $("#clientCity").val("");
            $("#clientState").val("");
        }
    });
    </script>

</body>

</html>