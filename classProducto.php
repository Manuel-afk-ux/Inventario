<?php

require_once 'conexion2.php';

class datosProductos
{
    const TABLA = 'inventario';

    public function __construct(
        private $codproducto = null,
        private $nom_producto = "",
        private $costoproducto = 0.00,
        private $porc_ventapro = 0,
        private $precio_ventapro = 0.00,
        private $imagenpro = "",
        private $stockpro = 0,
        private $fechapro = null
    ) {}

    // GETTERS
    public function get_codproducto() {
        return $this->codproducto;
    }

    public function get_nom_producto() {
        return $this->nom_producto;
    }

    public function get_costoproducto() {
        return $this->costoproducto;
    }

    public function get_porc_ventapro() {
        return $this->porc_ventapro;
    }

    public function get_precio_ventapro() {
        return $this->precio_ventapro;
    }

    public function get_imagenpro() {
        return $this->imagenpro;
    }

    public function get_stockpro() {
        return $this->stockpro;
    }

    public function get_fechapro() {
        return $this->fechapro;
    }

    // SETTERS
    public function set_codproducto($codproducto) {
        $this->codproducto = $codproducto;
    }

    public function set_nom_producto($nom_producto) {
        $this->nom_producto = $nom_producto;
    }

    public function set_costoproducto($costoproducto) {
        $this->costoproducto = $costoproducto;
    }

    public function set_porc_ventapro($porc_ventapro) {
        $this->porc_ventapro = $porc_ventapro;
    }

    public function set_precio_ventapro($precio_ventapro) {
        $this->precio_ventapro = $precio_ventapro;
    }

    public function set_imagenpro($imagenpro) {
        $this->imagenpro = $imagenpro;
    }

    public function set_stockpro($stockpro) {
        $this->stockpro = $stockpro;
    }

    public function set_fechapro($fechapro) {
        $this->fechapro = $fechapro;
    }

    // METODO PARA GUARDAR PRODUCTO
    public function guardarProducto()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA . ' 
        (nom_producto, costo, porc_venta, precio_venta, Imagen, stock, Fecha) 
        VALUES(:producto, :pcosto, :pporc_venta, :precio_venta, :pImagen, :pStock, :pFecha)');

        $consulta->bindParam(':producto', $this->nom_producto);
        $consulta->bindParam(':pcosto', $this->costoproducto);
        $consulta->bindParam(':pporc_venta', $this->porc_ventapro);
        $consulta->bindParam(':precio_venta', $this->precio_ventapro);
        $consulta->bindParam(':pImagen', $this->imagenpro);
        $consulta->bindParam(':pStock', $this->stockpro);
        $consulta->bindParam(':pFecha', $this->fechapro);
        $consulta->execute();
        $conexion = null;
    }

    // ACTUALIZAR PRODUCTO
    public function actualizarProducto()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare("UPDATE " . self::TABLA . " SET 
        nom_producto = :producto, 
        costo = :pcosto, 
        porc_venta = :pporc_venta, 
        precio_venta = :precio_venta, 
        Imagen = :pImagen,
        stock = :pStock,
        Fecha = :pFecha 
        WHERE codigo = :codpro");

        $consulta->bindParam(':producto' , $this->nom_producto);
        $consulta->bindParam(':pcosto' , $this->costoproducto);
        $consulta->bindParam(':pporc_venta' , $this->porc_ventapro);
        $consulta->bindParam(':precio_venta', $this->precio_ventapro);
        $consulta->bindParam(':pImagen' , $this->imagenpro);
        $consulta->bindParam(':pStock' , $this->stockpro);
        $consulta->bindParam(':pFecha' , $this->fechapro);
        $consulta->bindParam(':codpro' , $this->codproducto);
        $consulta->execute();
        $conexion = null;
    }

    // ACTUALIZAR STOCK
    public static function actualizarStock($v_idpro, $canstock, $nuevacant)
    {
        $nuevo_stock = 0;
        if (isset($v_idpro, $canstock, $nuevacant)) {
            $nuevo_stock = $nuevacant ? $nuevacant : ($canstock + $nuevacant);
        } else {
            exit;
        }

        $conexion = new Conexion();
        $consulta = $conexion->prepare('UPDATE ' . self::TABLA . ' SET stock = :p_stock 
        WHERE codigo = :codpro');

        $consulta->bindParam(':p_stock', $nuevo_stock);
        $consulta->bindParam(':codpro', $v_idpro);
        $consulta->execute();
        $conexion = null;
        return $consulta;
    }

    // CONTAR TODOS LOS PRODUCTOS
    public static function todosProductos()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT COUNT(*) FROM ' . self::TABLA);
        $consulta->execute();
        return $consulta->fetchColumn();
    }

    // LISTAR TODOS LOS PRODUCTOS
    public static function listarProductos()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA . ' ORDER BY codigo DESC');
        $consulta->execute();
        $registros = $consulta->fetchAll(PDO::FETCH_OBJ);
        $conexion = null;
        return $registros;
    }

    // CONSULTAR PRODUCTO POR CODIGO
    public static function consultarProductoCod($codproducto)
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA . ' WHERE codigo = :codpro');
        $consulta->bindParam(':codpro', $codproducto);
        $consulta->execute();
        $registros = $consulta->fetchAll(PDO::FETCH_OBJ);
        $conexion = null;
        return $registros;
    }

    // ELIMINAR PRODUCTO
    public function eliminarProducto()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('DELETE FROM ' . self::TABLA . ' WHERE codigo = :codpro');
        $consulta->bindParam(':codpro', $this->codproducto);
        $consulta->execute();
        $conexion = null;
    }
}
