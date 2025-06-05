<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

try {
    if(!$_POST){
        throw new Exception("Acesso indevído! Tente novamente.");
    }

    $msg = '';
    if ($_POST["providerId"] == "") {
        // SE O ID DO FORNECEDOR ESTIVER VAZIO, SIGNIFICA QUE É UM NOVO FORNECEDOR
        $postfields = array (
            "razao_social" => $_POST["providerName"],
            "cnpj" => $_POST["providerCNPJ"],
            "email" => $_POST["providerEmail"],
            "telefone" => $_POST["providerPhone"],
            "imagem" => $_POST["providerImage"],
            "endereco" => array (
                "cep" => $_POST["providerCEP"],
                "logradouro" => $_POST["providerStreet"],
                "numero" => $_POST["providerNumber"],
                "complemento" => $_POST["providerComplement"],
                "bairro" => $_POST["providerNeighborhood"],
                "cidade" => $_POST["providerCity"],
                "estado" => $_POST["providerState"]
            )
        );

        require("../requests/fornecedores/post.php");
    } else {
        // SENÃO, SIGNIFICA QUE É UM PRODUTO JÁ CADASTRADO
        $postfields = array (
            "id_fornecedor" => $_POST["providerId"],
            "razao_social" => $_POST["providerName"],
            "cnpj" => $_POST["providerCNPJ"],
            "email" => $_POST["providerEmail"],
            "telefone" => $_POST["providerPhone"],
            "imagem" => $_POST["providerImage"],
            "endereco" => array (
                "cep" => $_POST["providerCEP"],
                "logradouro" => $_POST["providerStreet"],
                "numero" => $_POST["providerNumber"],
                "complemento" => $_POST["providerComplement"],
                "bairro" => $_POST["providerNeighborhood"],
                "cidade" => $_POST["providerCity"],
                "estado" => $_POST["providerState"]
            )
        );
        require("../requests/fornecedores/put.php");
    }
    $_SESSION["msg"] = $response['message'];

}catch(Exception $e){
    $_SESSION["msg"] = $e->getMessage();
}finally{
    header("Location: ./");
}
