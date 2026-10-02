<?php
require_once '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Limpiamos espacios en blanco
$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
// Validaciones básicas
if (empty($nombre) || empty($email) || empty($password)) {
die("Por favor, completa todos los campos.");
}
// 1. Validar si el email ya existe
$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
die("Este correo electrónico ya está registrado.");
}
// 2. Encriptar la contraseña (Regla de oro para tu portafolio)
$password_encriptada = password_hash($password, PASSWORD_BCRYPT);
// 3. Insertar el usuario en la base de datos (por defecto es rol 'cliente')
try {
$stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password,
rol) VALUES (?, ?, ?, 'cliente')");
$stmt->execute([$nombre, $email, $password_encriptada]);
// Redirigir al login tras un registro exitoso
header("Location: login.php?registro=exitoso");
exit;
} catch (PDOException $e) {
die("Error al registrar el usuario: " . $e->getMessage());
}
} else {
header("Location: registro.php");
exit;
}