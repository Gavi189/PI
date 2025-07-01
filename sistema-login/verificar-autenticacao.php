<?php
if (!session_id()) {
    session_start();
}
error_log("Verificando autenticação - autenticado: " . ($_SESSION["autenticado"] ?? 'não definido') . ", role: " . ($_SESSION["role"] ?? 'não definido'));

if (!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] == false) {
    header('Location: ./tela-login.php');
    exit;
} else {
    $tempo_login = $_SESSION["tempo_login"] ?? time();
    $tempo_agora = time();
    $tempo_limite = 3000; // 50 minutos
    $tempo_expirado = $tempo_login + $tempo_limite;

    if ($tempo_agora > $tempo_expirado) {
        $_SESSION["msg"] = "Tempo excedido! Realize o login novamente.";
        unset($_SESSION["autenticado"]);
        header('Location: ' . ($_SESSION['url'] ?? './') . '/tela-login.php');
        exit;
    }
    $_SESSION["tempo_login"] = time();
}
?>