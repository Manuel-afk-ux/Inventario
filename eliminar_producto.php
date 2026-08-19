<?php
require_once 'classProducto.php';

if (isset($_GET['id'])) {
    $producto = new datosProductos();
    $producto->set_codproducto((int) $_GET['id']);
    $producto->eliminarProducto();
}

header("Location: frmproducto.php");
exit;
