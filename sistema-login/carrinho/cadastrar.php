<?php
include "../verificar-autenticacao.php";

if (!$_POST) {
    $_SESSION["msg"] = "Acesso indevido! Tente novamente.";
    header("Location: ./index.php");
    exit;
}

$postfields = [
    "id_cliente" => $_POST["id_cliente"],
    "id_produto" => $_POST["id_produto"],
    "quantidade" => $_POST["quantidade"]
];

if (empty($_POST["cartId"])) {
    require("../requests/carrinho/post.php");
} else {
    require("../requests/carrinho/put.php");
}

$_SESSION["msg"] = $response['message'];
header("Location: ./index.php");
exit;
?>