<?php
// IMPORTA O ARQUIVO DE CABEÇALHO QUE CONTÉM 
// AS DEFINIÇÕES DE CABEÇALHO E CONFIGURAÇÕES DE ACESSO
require_once '../headers.php';


// VERIFICAR O MÉTODO DA REQUISIÇÃO
if (method == 'GET') {
    include "get.php";
} elseif(method == 'POST') {
    include "post.php";
} elseif(method == 'PUT') {
    include "put.php";
} elseif(method == 'DELETE') {
    include "delete.php";
} else {

}