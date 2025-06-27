<?php
// IMPORTA O ARQUIVO DE CABEÇALHO QUE CONTÉM 
// AS DEFINIÇÕES DE CABEÇALHO E CONFIGURAÇÕES DE ACESSO
require_once '../headers.php';


// VERIFICAR O MÉTODO DA REQUISIÇÃO


try {
    if (method == 'GET') {
        include "get.php";
    } elseif(method == 'POST') {
        include "post.php";
    } elseif(method == 'PUT') {
        include "put.php";
    } elseif(method == 'DELETE') {
        include "delete.php";
    } else {
        throw new Exception('Page not found', 404);
    }
} catch (Exception $e) {
   $code = !empty($e->getCode()) ? $e->getCode() : 500;
    http_response_code($code);
    $result = array(
        'status' => 'error',
        'message' => $e->getMessage(),
    );
    echo json_encode($result);
}

    
    