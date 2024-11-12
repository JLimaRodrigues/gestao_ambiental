<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: /inicio/inicio.php");
    exit;
} else {
    header("Location: /login/login.php");
    exit;
}
?>
