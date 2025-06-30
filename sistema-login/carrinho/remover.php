<?php
include "../verificar-autenticacao.php";

if (isset($_GET['id_cliente']) && isset($_GET['id_produto'])) {
    require("../requests/carrinho/delete.php");
    $_SESSION["msg"] = $response["message"];
}
header("Location: ./");
exit;
?>