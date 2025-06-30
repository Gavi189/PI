<?php
include "../verificar-autenticacao.php";

if (!$_POST) {
    $_SESSION["msg"] = "Acesso indevído! Tente novamente.";
    header("Location: ./");
    exit;
}

$postfields = array(
    "id_cliente" => $_POST["id_cliente"],
    "id_produto" => $_POST["id_produto"],
    "quantidade" => $_POST["quantidade"]
);

if ($_POST["cartId"] == "") {
    require("../requests/carrinho/post.php");
} else {
    require("../requests/carrinho/put.php");
}

$_SESSION["msg"] = $response['message'];
header("Location: ./carrinho.php");
exit;
?>