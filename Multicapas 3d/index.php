<?php
// Ubicar este archivo en la raíz del proyecto, junto a las carpetas auth y config.
session_start();
require_once __DIR__ . '/config/conexion.php';

// Consultamos los productos registrados, empezando por los más recientes.
$productos = [];
$errorCatalogo = false;
try {
    $consulta = $pdo->query('SELECT id, nombre, descripcion, precio, stock, imagen, material, color FROM productos ORDER BY fecha_creacion DESC, id DESC');
    $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log('Error al cargar el catálogo: ' . $e->getMessage());
    $errorCatalogo = true;
}

// Escapamos los datos antes de mostrarlos en el HTML.
function escapar($valor) {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

// Aceptamos imágenes locales dentro de uploads, guardadas como nombre o ruta.
function rutaImagen($valor) {
    $ruta = str_replace('\\', '/', trim((string) $valor));
    if ($ruta === '') {
        return '';
    }
    if (strpos($ruta, 'uploads/') !== 0) {
        $ruta = 'uploads/' . $ruta;
    }
    if (strpos($ruta, '..') !== false || !preg_match('~\Auploads/[a-zA-Z0-9_ ./-]+\.(?:jpe?g|png|webp|gif)\z~i', $ruta)) {
        return '';
    }
    if (!is_file(__DIR__ . '/' . $ruta)) {
        return '';
    }
    return implode('/', array_map('rawurlencode', explode('/', $ruta)));
}

$sesionIniciada = isset($_SESSION['usuario_id']);
$esAdministrador = $sesionIniciada && ($_SESSION['usuario_rol'] ?? '') === 'admin';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multicapas 3D MyS | Inicio</title>
    
</head>
<body>
    <header class="cabecera">
        <div class="contenedor barra">
            <a class="marca" href="index.php">Multicapas <span>3D MyS</span></a>
            <nav aria-label="Navegación principal">
                <a href="#catalogo">Productos</a>
                <?php if ($sesionIniciada): ?>
                    <span class="saludo">Hola, <?= escapar($_SESSION['usuario_nombre'] ?? '') ?></span>