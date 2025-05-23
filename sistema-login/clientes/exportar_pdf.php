<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// CARREGAR BIBLIOTECA MPDF
require_once '../mpdf/vendor/autoload.php';

$lista = "";
if(!empty($_SESSION["clientes"])) {
    foreach($_SESSION["clientes"] as $key => $client) {
        // .= ADICIONA ITENS NA VARIÁVEL $lista
        $lista .= '
        <tr>
            <th style="border:1px solid black" scope="row">'.($key + 1).'</th>
            <td style="border:1px solid black"><img src="imagens/'.$client["clientImage"].'" width="100"></td>
            <td style="border:1px solid black">'.$client["clientName"].'</td>
            <td style="border:1px solid black">'.$client["clientCPF"].'</td>
            <td style="border:1px solid black">'.$client["clientEmail"].'</td>
            <td style="border:1px solid black">'.$client["clientWhatsapp"].'</td>
        </tr>
        ';
    }
} else {
    echo '
    <tr>
        <td colspan="4">Nenhum cliente cadastrado</td>
    </tr>
    ';
}

$html = '
<html>
<head>
    <meta charset="utf-8">
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border: 1px solid black;
    }
    </style>
</head>
<body>
    <h1 style="text-align:center">Lista de Clientes</h1>
    <p style="text-align:center">Data: '.date('d/m/Y').'</p>
    <p style="text-align:center">Total de Clientes: '.count($_SESSION["clientes"]).'</p>
    <table>
        <thead>
            <tr>
                <th style="background:gray;font-weight:bold" scope="col">#</th>
                <th style="background:gray;font-weight:bold;" scope="col">Imagem</th>
                <th style="background:gray;font-weight:bold;width:300px" scope="col">Nome</th>
                <th style="background:gray;font-weight:bold;width:100px" scope="col">CPF</th>
                <th style="background:gray;font-weight:bold;width:250px" scope="col">E-mail</th>
                <th style="background:gray;font-weight:bold;width:120px" scope="col">Whatsapp</th>
            </tr>
        </thead>
        <tbody id="clientTableBody">
            '.$lista.'
        </tbody>
    </table>
</body>
</html>
';

// Cria uma instância do MPDF
$mpdf = new \Mpdf\Mpdf();

// Escreve o conteúdo HTML no PDF
$mpdf->WriteHTML($html);

// Define o nome do arquivo PDF para download
$nomeArquivo = 'clientes_'.date('YmdHis').'.pdf';
// Define as dimensões do PDF
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetMargins(10, 10, 10);
$mpdf->SetDefaultBodyCSS('background', '#FFF');
// Gera o PDF e força o download
$mpdf->Output($nomeArquivo, \Mpdf\Output\Destination::DOWNLOAD);