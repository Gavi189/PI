<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

try {
    if(!$_POST){
        throw new Exception("Acesso indevído! Tente novamente.");
    }

    // VERIFICAR SE O ARQUIVO FOI ENVIADO
    if ($_FILES["productImage"]["name"] != "") {
        // PEGAR A EXTENSÃO DO ARQUIVO
        $extensao = pathinfo($_FILES["productImage"]["name"], PATHINFO_EXTENSION);
        // GERAR UM NOVO NOME PARA O ARQUIVO
        $novo_nome = md5(uniqid() . microtime()) . ".$extensao";
        // MOVER O ARQUIVO PARA A PASTA DE IMAGENS
        move_uploaded_file($_FILES["productImage"]["tmp_name"], "imagens/$novo_nome");
        // ADICIONAR O NOME DO ARQUIVO NO POST
        $_POST["productImage"] = $novo_nome;

        // SE JÁ EXISTIR UMA IMAGEM, DELETAR A IMAGEM
        if ($_POST["currentProductImage"] != "") {
            // UNLINK = DELETAR ARQUIVOS
            unlink("imagens/" . $_POST["currentProductImage"]);
        }

    } else {
        // SE NÃO FOI ENVIADO ARQUIVO, PEGAR O NOME DO ARQUIVO ATUAL
        $_POST["productImage"] = $_POST["currentProductImage"];
    }

    $msg = '';
    if ($_POST["productId"] == "") {
        // SE O ID DO FORNECEDOR ESTIVER VAZIO, SIGNIFICA QUE É UM NOVO FORNECEDOR
        $postfields = array (
            "produto" => $_POST["productName"],
            "id_marca" => $_POST["brandId"],
            "descricao" => $_POST["productDescription"],
            "preco" => $_POST["productPrice"],
            "quantidade" => $_POST["productQuantity"],
            "imagem" => $_POST["productImage"]
        );

        require("../requests/produtos/post.php");
    } else {
        // SENÃO, SIGNIFICA QUE É UM PRODUTO JÁ CADASTRADO
        $postfields = array (
            "id_produto" => $_POST["productId"],
            "produto" => $_POST["productName"],
            "id_marca" => $_POST["brandId"],
            "descricao" => $_POST["productDescription"],
            "preco" => $_POST["productPrice"],
            "quantidade" => $_POST["productQuantity"],
            "imagem" => $_POST["productImage"]
        );
        
        require("../requests/produtos/put.php");
    }
    $_SESSION["msg"] = $response['message'];

}catch(Exception $e){
    $_SESSION["msg"] = $e->getMessage();
}finally{
    header("Location: ./");
}