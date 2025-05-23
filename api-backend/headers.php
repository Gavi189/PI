<?php
// Conecta-se ao banco de dados
require_once 'conn.php';

// Define as configurações de cabeçalho para permitir o acesso à API
header('Access-Control-Allow-Origin: *'); // Permite acesso de qualquer origem
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE'); // Permite métodos HTTP específicos
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Permite cabeçalhos específicos
header('Access-Control-Allow-Credentials: true'); // Permite o envio de cookies e credenciais
header('Content-Type: application/json; charset=utf-8'); // Define o tipo de conteúdo como JSON

// Define uma constante com o método HTTP da requisição
define('method', $_SERVER['REQUEST_METHOD']);