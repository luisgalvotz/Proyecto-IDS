<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_cita.css">
    <title>Citas</title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="img/cerebro.jpg" alt="Logo">
            <h1>Lic. Rubicelia Barrientos</h1>
        </div>

        <div class="right">
            <a href="index.php " class="inicio">Inicio</a>
            <a href="perfil.php" class="psi">Psicóloga</a>
            <a href="AgendarCita.php" class="cit">Citas</a>
            <a href="login.php" class="button-link">¿Eres psicólogo?</a>

        </div>
    </header>
    <div class="content">
        <div class="frase-del-dia">
            <p class="frase" style="font-size: 30px;">¡Agenda tu cita aquí!</p>
        </div>

        <div class="cita2">
            <div class="contenedor">
                <form action="/Proyecto-IDS/controllers/cCita.php" method="post">
                    <h2>Datos de Consulta</h2>
                    
                    <div class="input-container">
                      <label for=" nombre">Nombre completo</label>
                      <input type="text" id=" nombre"  name=" nombre" required>
                    </div>

                    <div class="input-container">
                      <label for="email">Correo</label>
                      <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="input-container">
                      <label for="telefono">Télefono</label>
                      <input type="tel" id="telefono" name="telefono" required>
                    </div>
                    
                    <div class="input-container">
                      <label for="motivo">Motivo de la consulta</label>
                      <textarea id="motivo" name="motivo" rows="5" required></textarea>
                    </div>

                    <div class="input-container">
                        <label for="fecha">Fecha</label>
                        <input type="date" id="fecha" name="fecha" required>
                      </div>

                      <div class="input-container">
                        <label for="hora">Hora</label>
                        <input type="time" id="hora" name="hora" required>
                      </div>
                    
                    <button type="submit">Enviar</button>
                  </form>
        </div>



    </div>
    <footer>
        <div class="col first">
            <h3>Servicios</h3>
            <ul>
                <li>Terapia individual</li>
                <li>Terapia de pareja</li>
                <li>Psicoanálisis</li>
            </ul>
        </div>
        <div class="col center-col">
            <h3>Contacto</h3>
            <ul>
                <li>Teléfono: 811-667-9802</li>
                <li>Correo electrónico: psi.rubibarrientos@gmail.com</li>
            </ul>
        </div>
        <div class="col right-col">
            <h3>Dirección</h3>
            <ul>
                <li>Rosas 3413, Alta Vista Invernadero</li>
                <li>Monterrey, Nuevo León</li>
                <li>Código Postal 64770</li>
            </ul>
        </div>
    </footer>
</body>

</html>