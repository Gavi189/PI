<?php
include "../verificar-autenticacao.php";

// Define the URL with id_cliente and id_produto
$url = 'http://localhost:8080/carrinho?id_cliente=' . ($_GET['id_cliente'] ?? '') . '&id_produto=' . ($_GET['id_produto'] ?? '');

// Initialize cURL session
$curl = curl_init();
// Configure cURL options
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'DELETE',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . ($_SESSION['token'] ?? '')
    ),
));
// Execute cURL request
$response = curl_exec($curl);
// Close cURL session
curl_close($curl);

// Decode response
if (empty($response)) {
    $response = array();
} else {
    $response = json_decode($response, true);
}
?>