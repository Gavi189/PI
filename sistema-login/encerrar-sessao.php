<?php
session_start();
session_destroy();
unset($_SESSION["autenticado"]);
header("Location: ". $_SESSION["url"] . "/tela-login.php");
exit;