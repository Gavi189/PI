<?php

include_once('../conexao.php');

// LISTAGEM DE REGISTROS
// if ($postjson['requisicao'] == 'imprimir') {
$id = $_GET['id'];
$tipo_documento = $_GET['tipo_documento'];

if ($tipo_documento == 'pgr') {
    $table = 'pgr';
    $field = 'id_pgr';
    $filename = 'PGR [{{nr_documento}}] - {{razao_social}}';
} elseif ($tipo_documento == 'pcmso') {
    $table = 'pcmso';
    $field = 'id_pcmso';
    $filename = 'PCMSO [{{nr_documento}}] - {{razao_social}}';
} elseif ($tipo_documento == 'ltcat') {
    $table = 'ltcat';
    $field = 'id_ltcat';
    $filename = 'LTCAT [{{nr_documento}}] - {{razao_social}}';
}

$sql = "
    SELECT nr_" . $table . " nr_documento, corpo_documento,
    empresas.razao_social
    FROM $table
    JOIN empresas ON " . $table . ".id_empresa = empresas.id_empresa
    WHERE $field = $id
    ";

// echo $sql;exit;
$query = mysqli_query($conecta, $sql);
if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_object($query);

    $filename = str_replace(
        [
            '{{nr_documento}}',
            '{{razao_social}}'
        ],
        [
            $row->nr_documento,
            $row->razao_social
        ],
        $filename
    );

    include_once('./vendor/autoload.php');

    $mpdf = new \Mpdf\Mpdf();

    $stylesheet = "
    body {
        font-family: 'Calibri';
        font-size: small;
    }
    .text-tiny {
        font-size: xx-small;
    }
    .text-small {
        font-size: small;
    }
    table {
        width: 100%;
    }
    th {
        background: #eee;
        font-weight: bold
    }
    table, td, th, tr {
        border: 1px solid #666;
        border-collapse: collapse
    }
    page-break {
        page-break-before: always;
    }
    
    ";

    // echo $row->corpo_documento;exit;

    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($row->corpo_documento, \Mpdf\HTMLParserMode::HTML_BODY);
    $mpdf->Output();
} else {
    echo json_encode(array(
        'success' => false,
        'result' => 'Documento não encontrado.'
    ));
    exit;
}
// }
