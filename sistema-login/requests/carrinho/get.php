<?php
// Define the URL based on whether a specific cart ID is provided
if (isset($key) && is_numeric($key)) {
    $url = 'http://localhost:8080/carrinho?id_carrinho=' . $key;
} else {
    $url = 'http://localhost:8080/carrinho?id_cliente=' . (isset($_GET['id_cliente']) ? $_GET['id_cliente'] : 'all');
}

// Initialize cURL session
$curl = curl_init();
// Configure cURL options
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
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