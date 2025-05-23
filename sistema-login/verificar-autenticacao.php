<?php
session_start();
// !ISSET = VERIFICA SE A VARIÁVEL "NÃO" EXISTE
// VERIFICA SE A VARIÁVEL EXISTE, MAS É FALSE
if(
    !isset($_SESSION["autenticado"]) ||  // OU
    $_SESSION["autenticado"] == false
) {
    header('Location: ./tela-login.php');
    exit;
} 
// VERIFICAR SE EXPIROU O TEMPO LIMITE DE INATIVIDADE
else {
    $tempo_login = $_SESSION["tempo_login"];
    $tempo_agora = time();
    $tempo_limite = 3000; // segundos
    $tempo_expirado = $tempo_login + $tempo_limite;

    if ($tempo_agora <= $tempo_expirado) {
        // SIGNIFICA QUE PODE CONTINUAR USANDO O SISTEMA
        $_SESSION["tempo_login"] = time();
    } else {
        $_SESSION["msg"] = "Tempo excedido! Realize o login novamente.";
        unset($_SESSION["autenticado"]);
        header('Location: '.$_SESSION['url'].'/tela-login.php');
    }
}
?>