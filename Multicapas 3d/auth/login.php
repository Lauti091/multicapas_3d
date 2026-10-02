<?php
// auth/login.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Iniciar Sesión - Impresión 3D</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="contenedor-auth">
<h2>Iniciar Sesión</h2>
<?php if (isset($_GET['registro']) && $_GET['registro'] === 'exitoso'): ?>
<p class="alerta-exito" style="color: green;">¡Registro exitoso! Ya
puedes iniciar sesión.</p>
<?php endif; ?>
<?php if (isset($_GET['error']) && $_GET['error'] === 'credenciales'): ?>
<p class="alerta-error" style="color: red;">Correo o contraseña
incorrectos.</p>
<?php endif; ?>
<form action="procesar_login.php" method="POST">
<label for="email">Correo Electrónico:</label>
<input type="email" name="email" id="email" required>
<label for="password">Contraseña:</label>
<input type="password" name="password" id="password" required>
<button type="submit">Ingresar</button>
</form>
<p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
</div>
</body>
</html>