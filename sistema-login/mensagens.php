<?php

// SE HOUVER MENSAGEM DE ERRO, EXIBIR TEXTO
if(isset($_SESSION["msg"])) {
    echo '
    <div class="alert alert-warning" role="alert">
        '.$_SESSION["msg"].'
    </div>
    ';
    // APÓS EXIBIR A MENSAGEM, REMOVER ELA DA SESSÃO
    unset($_SESSION["msg"]);
}