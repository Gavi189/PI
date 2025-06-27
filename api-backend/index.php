<?php
// IMPORTA O ARQUIVO DE CABEÇALHO QUE CONTÉM 
// AS DEFINIÇÕES DE CABEÇALHO E CONFIGURAÇÕES DE ACESSO
require_once './headers.php';

$recursos = ["clientes", "fornecedores", "marcas", "produtos", "usuarios"];
$url = explode("/",$_SERVER['REQUEST_URI'])[1];

try {
    
    if(method == 'GET'){ 

        $existe_recurso = false;
        foreach($recursos as $recurso){
            // $existe_recurso = $recurso==$url ? true : false;
            if($recurso==$url){
                $existe_recurso= true;
                break;
            }
        }

        if(!$existe_recurso AND strlen($url)>0 ){
            throw new Exception('Page not found', 404);;
        }

        $result = array(
            'status' => 'OK',
            'message' => "API funcionando",
            );
        echo json_encode($result);
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