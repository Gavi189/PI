<?php
// Get form data
$postfields = array(
    'id_cliente' => $_POST['id_cliente'] ?? null,
    'id_produto' => $_POST['id_produto'] ?? null,
    'quantidade' => $_POST['quantidade'] ?? null
);

// Initialize cURL session
$curl = curl_init();
// Configure cURL options
curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost:8080/carrinho/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($postfields),
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
));
// Execute cURL request
$response = curl_exec($curl);
// Close cURL session
curl_close($curl);

// Decode response or return empty array if no response
if (empty($response)) {
    $response = array();
} else {
    $response = json_decode($response, true);
}
?>