<?php

auth/registro.php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multicapas 3D</title>
</head>
<body>

    <div class="contenedor_auth">

    <form action="procesar_registro.php" method="post">

    <label for="nombre">Nombre Completo:</label>
    <input type="text" id="nombre" name="nombre" placeholder="Por ej: Kiki Bustamante" required>

    <label for="email">Mail:</label>
    <input type="email" id="email" name="email" placeholder="Por ej: aragon@gmail.com" required>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>

    <button type="submit">Registrarse</button>
    </form>

    <p>Ya tenes cuenta? <a href="login.php">Inicia sesion</a> </p> 

    </div>

</body>
</html>