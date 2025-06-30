<?php

$id_cliente = $_GET['id_cliente'] ?? 'all';
$url = 'http://localhost:8080/carrinho/get.php?id_cliente=' . $id_cliente;

// Inicializa a sessão cURL
$curl = curl_init();
// Configura as opções do cURL
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . ($_SESSION['token'] ?? '') // Adiciona token se necessário
    ),
));
// Executa a requisição cURL
$response = curl_exec($curl);

// Verifica erros
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
    } elseif (isset($response['data']['items']) && !empty($response['data']['items'])) {
        foreach ($response['data']['items'] as &$item) {
            $item['preco_total'] = $item['preco'] * $item['quantidade'];
        }
        $response['data']['total'] = array_sum(array_map(function($item) {
            return $item['preco'] * $item['quantidade'];
        }, $response['data']['items']));
    }
}
// Encerra a sessão cURL
curl_close($curl);
?>