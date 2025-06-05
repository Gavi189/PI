<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// DEFINE TIMEZONE PARA BRASIL
date_default_timezone_set('America/Sao_Paulo');
$filename = "fornecedores_".date('YmdHis').".xls";

// CABEÇALHO PARA EXPORTAR O ARQUIVO EM EXCEL
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");

?>
<head>
    <meta charset="utf-8">
</head>
<table>
    <thead>
        <tr>
            <th style="background:gray;font-weight:bold" scope="col">#</th>
            <th style="background:gray;font-weight:bold;width:100px" scope="col">Imagem</th>
            <th style="background:gray;font-weight:bold;width:280px" scope="col">Produto</th>
            <th style="background:gray;font-weight:bold;width:120px" scope="col">Marca</th>
            <th style="background:gray;font-weight:bold;width:250px" scope="col">Quantidade</th>
            <th style="background:gray;font-weight:bold;width:120px" scope="col">Preço</th>
        </tr>
    </thead>
    <tbody id="clientTableBody">
        <!-- Os clientes serão carregados aqui via PHP -->
        <?php
        // SE HOUVER CLIENTES NA SESSÃO, EXIBIR
        require("../requests/fornecedores/get.php");
        if(!empty($response)) {
            foreach($response["data"] as $key => $provider) {
                echo '
                <tr>
                    <th style="border:1px solid black" scope="row">'.$product["id_produto"].'</th>
                    <td style="border:1px solid black"><img src="http://localhost:8081/produtos/imagens/'.$product["imagem"].'" width="100"></td>
                    <td style="border:1px solid black">'.$product["produto"].'</td>
                    <td style="border:1px solid black">'.$product["marca"].'</td>
                    <td style="border:1px solid black">'.$product["quantidade"].'</td>
                    <td style="border:1px solid black">'.$product["preco"].'</td>
                </tr>
                ';
            }
        } else {
            echo '
            <tr>
                <td colspan="6">Nenhum produto cadastrado</td>
            </tr>
            ';
        }
        ?>
    </tbody>
</table>