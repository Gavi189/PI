<?php
try {

    // Verifica se há um ID na URL para consulta específica
    if(isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $id = $_GET["id"];

        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT * 
            FROM usuarios
            WHERE id_usuario = :id
        ";

        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);
        // Vincular o parâmetro :id com o valor da variável $id
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    }
    // Verifica se há um EMAIL e SENHA na URL para consulta
    elseif (
        isset($_GET["email"]) && is_string($_GET["email"]) &&
        isset($_GET["senha"]) && is_string($_GET["senha"])
    ) {
        $email = trim($_GET["email"]);
        $senha = sha1(trim($_GET["senha"]));

        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT * 
            FROM usuarios
            WHERE email LIKE :email
            AND senha LIKE :senha
        ";

        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);
        // Vincular o parâmetro :email com o valor da variável $email
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        // Vincular o parâmetro :senha com o valor da variável $senha
        $stmt->bindValue(':senha', $senha, PDO::PARAM_STR);

    }
    else {
        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT * 
            FROM usuarios
            ORDER BY nome
        ";
        
        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);
    }

    // Executar a sintaxe SQL
    $stmt->execute();
    // Obter os dados do banco de dados como objeto
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Verifica se o resultado da pesquisa é vazio
    if (empty($data)) {
        // Se o resultado for vazio, retorna um erro
        http_response_code(204);
    } else {
        // Se o resultado não for vazio, retorna os dados
        $result = array(
            'status' => 'success',
            'message' => 'Data found',
            'data' => $data
        );
    }
} catch (Exception $e) {
    // Se houver erro, retorna o erro
    $result = array(
        'status' => 'error',
        'message' => 'Error: ' . $e->getMessage()
    );
} finally {
    // Retorna os dados em formato JSON
    echo json_encode($result);
    // Fecha a conexão com o banco de dados
    $conn = null;
}
exit;


// VERIFICAR SE O ID FOI PASSADO NA URL E SE É UM NÚMERO
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];
    // BUSCAR O CLIENTE COM O ID PASSADO NA URL
    $found = false;
    foreach ($data as $cliente) {
        if ($cliente->id == $id) {
            $data = $cliente;
            $found = true;
            break;
        }
    }
    // SE O CLIENTE NÃO FOI ENCONTRADO, RETORNAR UM ERRO
    // $data = $found ? $data : null;
    if(!$found) {
        http_response_code(204);
    }
} elseif (isset($_GET["name"]) && is_string($_GET["name"])) {
    $name = $_GET["name"];
    $result = array();
    // BUSCAR O CLIENTE COM O ID PASSADO NA URL
    $found = false;
    foreach ($data as $cliente) {
        if (stripos($cliente->name, $name) !== false) {
            $result[] = $cliente;
            $found = true;
        }
    }
    // SE O CLIENTE NÃO FOI ENCONTRADO, RETORNAR UM ERRO
    // $data = $found ? $data : null;
    if(!$found) {
        http_response_code(204);
    } else {
        $data = $result;
    }
}

echo json_encode(
    array(
        'status' => 'success',
        'message' => 'GET method called',
        'data' => $data
    )
);