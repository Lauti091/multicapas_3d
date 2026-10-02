<?php
// admin/dashboard.php
session_start();
// Si no inició sesión o si inició pero NO es administrador, lo mandamos afuera
if (!isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] !== 'admin') {
header("Location: ../auth/login.php");
exit;
}
// ... de aquí para abajo va tu código HTML/PHP exclusivo de Administrador ...
echo "Bienvenido al panel de control, " . $_SESSION['usuario_nombre'];