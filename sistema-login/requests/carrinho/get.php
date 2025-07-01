<?php
if (!session_id()) {
    session_start();
}
// Caminho absoluto temporário - ajuste conforme necessário
include "C:/Next/PI/sistema-login/verificar-autenticacao.php";

$url = 'http://localhost:8080/carrinho/get.php?id_cliente=all';

// Inicializa a sessão cURL
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . ($_SESSION['token'] ?? '')
    ),
));
$response = curl_exec($curl);

if ($response === false) {
    $error = curl_error($curl);
    $response = [
        'status' => 'error',
        'message' => 'Erro na requisição cURL: ' . $error,
        'data' => []
    ];
} else {
    $response = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        $response = [
            'status' => 'error',
            'message' => 'Erro ao decodificar JSON: ' . json_last_error_msg(),
            'data' => []
        ];
    } else {
        error_log("Resposta da API: " . var_export($response, true)); // Log para depuração
    }
}
curl_close($curl);
?>