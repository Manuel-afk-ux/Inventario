<?php
require_once 'classProducto.php';

$productos = datosProductos::listarProductos();

$editar = null;
if (isset($_GET['editar'])) {
    $encontrados = datosProductos::consultarProductoCod((int) $_GET['editar']);
    $editar = $encontrados[0] ?? null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <div class="navbar">
        <h1>Inventario</h1>
    </div>

    <div class="contenedor">

        <!-- ===== Panel: Formulario ===== -->
        <div class="panel-formulario">
            <div class="titulo"><?= $editar ? 'Editar producto' : 'Nuevo producto' ?></div>
            <form action="guardar_producto.php" method="POST">
                <input type="hidden" name="codproducto" value="<?= $editar->codigo ?? '' ?>">

                <div class="campo">
                    <label>Nombre del producto</label>
                    <input type="text" name="nom_producto" placeholder="Nombre del producto"
                           value="<?= htmlspecialchars($editar->nom_producto ?? '') ?>" required>
                </div>

                <div class="fila-doble">
                    <div class="campo">
                        <label>Costo</label>
                        <input type="number" step="0.01" name="costoproducto" placeholder="0.00"
                               value="<?= htmlspecialchars($editar->costo ?? '0.00') ?>" required>
                    </div>
                    <div class="campo">
                        <label>% de venta</label>
                        <input type="number" step="0.01" name="porc_ventapro" placeholder="0"
                               value="<?= htmlspecialchars($editar->porc_venta ?? '0') ?>" required>
                    </div>
                </div>

                <div class="fila-doble">
                    <div class="campo">
                        <label>Precio de venta</label>
                        <input type="number" step="0.01" name="precio_ventapro" placeholder="0.00"
                               value="<?= htmlspecialchars($editar->precio_venta ?? '0.00') ?>" required>
                    </div>
                    <div class="campo">
                        <label>Stock</label>
                        <input type="number" name="stockpro" placeholder="0"
                               value="<?= htmlspecialchars($editar->stock ?? '0') ?>" required>
                    </div>
                </div>

                <div class="campo">
                    <label>Imagen (URL o nombre de archivo)</label>
                    <input type="text" name="imagenpro" placeholder="imagen.jpg"
                           value="<?= htmlspecialchars($editar->Imagen ?? '') ?>">
                </div>

                <div class="campo">
                    <label>Fecha</label>
                    <input type="date" name="fechapro"
                           value="<?= htmlspecialchars($editar->Fecha ?? date('Y-m-d')) ?>" required>
                </div>

                <button type="submit" class="btn-guardar"><?= $editar ? 'Actualizar' : 'Guardar' ?></button>
                <?php if ($editar): ?>
                    <a href="frmproducto.php" class="btn-guardar" style="background:#777; text-decoration:none; display:inline-block; margin-left:8px;">Cancelar</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- ===== Panel: Tabla ===== -->
        <div class="panel-tabla">
            <div class="titulo">Lista de productos</div>

            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Costo</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (count($productos) > 0): ?>
                    <?php foreach ($productos as $p): ?>
                        <tr>
                            <td><?= $p->codigo ?></td>
                            <td><?= htmlspecialchars($p->nom_producto) ?></td>
                            <td><?= number_format((float) $p->costo, 2) ?></td>
                            <td><?= number_format((float) $p->precio_venta, 2) ?></td>
                            <td><?= (int) $p->stock ?></td>
                            <td>
                                <div class="acciones">
                                    <a class="btn-accion btn-editar"
                                       href="frmproducto.php?editar=<?= $p->codigo ?>"
                                       title="Editar">&#9998;</a>
                                    <a class="btn-accion btn-eliminar"
                                       href="eliminar_producto.php?id=<?= $p->codigo ?>"
                                       title="Eliminar"
                                       onclick="return confirm('¿Desea eliminar este producto?');">&#128465;</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="sin-registros">No hay productos registrados.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
