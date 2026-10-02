<?php
// auth/procesar_login.php
// Iniciamos la sesión para poder guardar variables persistentes
session_start();
require_once '../config/conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$email = trim($_POST['email']);
$password = trim($_POST['password']);
if (empty($email) || empty($password)) {
header("Location: login.php?error=vacio");
exit;
}
// Buscar al usuario por correo
$stmt = $pdo->prepare("SELECT id, nombre, password, rol FROM usuarios WHERE
email = ?");
$stmt->execute([$email]);
$usuario = $stmt->fetch();
// Verificar si el usuario existe y comprobar la contraseña hash
if ($usuario && password_verify($password, $usuario['password'])) {
// ¡Login exitoso! Guardamos la información en la sesión
$_SESSION['usuario_id'] = $usuario['id'];
$_SESSION['usuario_nombre'] = $usuario['nombre'];
$_SESSION['usuario_rol'] = $usuario['rol']; // 'cliente' o 'admin'
// Redirección inteligente según el rol
if ($usuario['rol'] === 'admin') {
header("Location: ../admin/dashboard.php");
} else {
header("Location: ../index.php");
}
exit;
} else {
// Credenciales incorrectas
header("Location: login.php?error=credenciales");
exit;
}
} else {
header("Location: login.php");
exit;
}