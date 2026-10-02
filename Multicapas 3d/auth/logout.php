<?php
// auth/logout.php
session_start();
session_unset(); // Libera todas las variables de sesión
session_destroy(); // Destruye la sesión por completo
// Redirige a la tienda principal
header("Location: ../index.php");
exit;
