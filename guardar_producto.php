<?php
require_once 'classProducto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $producto = new datosProductos();
    $producto->set_nom_producto(trim($_POST['nom_producto'] ?? ''));
    $producto->set_costoproducto((float) ($_POST['costoproducto'] ?? 0));
    $producto->set_porc_ventapro((float) ($_POST['porc_ventapro'] ?? 0));
    $producto->set_precio_ventapro((float) ($_POST['precio_ventapro'] ?? 0));
    $producto->set_imagenpro(trim($_POST['imagenpro'] ?? ''));
    $producto->set_stockpro((int) ($_POST['stockpro'] ?? 0));
    $producto->set_fechapro($_POST['fechapro'] ?? date('Y-m-d'));

    if (!empty($_POST['codproducto'])) {
        // Modo edición
        $producto->set_codproducto((int) $_POST['codproducto']);
        $producto->actualizarProducto();
    } else {
        // Modo creación
        $producto->guardarProducto();
    }
}

header("Location: frmproducto.php");
exit;
