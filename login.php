<?php
  session_start();
  
  $usuarioActivo = 0;
  if (isset($_SESSION["Id_Usuario"])){
    $usuarioActivo = $_SESSION["Id_Usuario"];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_login.css">
    <title>Login</title>
</head>
<body>
  <div class="container">
    <h1>Lic. Rubicelia Barrientos</h1>
    <h2>¡Bienvenida!</h2>
    <div class="divider"></div>
  <div class="login-page">
    <div class="form">
        <form class="login-form" action="/Proyecto-IDS/controllers/cLogin.php" method="post">
          <span class="avatar">
            <img src="img/cerebro.jpg" alt="Avatar">
        </span>
            <input type="text" placeholder="Usuario" name="username" required>
            <input type="password" placeholder="Contraseña" name="password" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</div>
</body>
</html>