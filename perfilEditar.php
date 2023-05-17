<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-IDS/DAO/resenaDAO.php';

  session_start();
  
  $usuarioActivo = 0;
  if (isset($_SESSION["Id_Usuario"])){
    $usuarioActivo = $_SESSION["Id_Usuario"];
  }

  $resenaDAO = new ResenaDAO();
  $resenas = $resenaDAO->getResenas("GET");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="style_perfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-dGqTKGWUc0LvG9jPqKxzi8SBv7J/KQfg9yQ6qQOQSZoXBPb5lNQY5tgNV7UJtGsm6Mk+5vRkq++jRdp/fZqTyw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header>

        <div class="logo">
            <img src="img/cerebro.jpg" alt="Logo">
            <h1>Lic. Rubicelia Barrientos</h1>
        </div>

        <div class="right">
            <a href="psicologaInicio.php" class="inicio">Inicio</a>
            <a href="perfilEditar.php" class="psi">Perfil</a>
            <a href="Citas.php" class="cit">Citas</a>
            <a href="index.php" class="button-link">Salir</a>

        </div>
    </header>
    <div class="content">

        <div class="izq">
            <div class="espacio2"></div>
            <div class="psicologa-container">
                <div class="psicologa">

                    <div class="right2">
                        <form action="">
                            <img src="img/psicologa2.jpg" alt="Descripción de la imagen">
                            <a href="perfil.php" class="nombre">Rubicelia Barrientos Hooding</a>
                            <input class="email" type="text" value="" placeholder="Email">
                            <input class="frase" type="text" value="" placeholder="Teléfono">
                            <input class="frase" type="text"
                                value="" placeholder="Consultorio">
                            <div class="boton-container">
                                <input type="submit" value="Guardar" class="guardar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="experiencia">
                <h3>Experiencia</h3>
                <hr class="linea-gris">
                <h3>Especialidades</h3>
                <ul>
                    <li>Ansiedad</li>
                    <li>Depresión</li>
                    <li>Estrés</li>
                </ul>
                <h3>Formación Académica</h3>
                <ul>
                    <li>Doctorado en Psicología - Universidad Nacional Autónoma de México</li>
                    <li>Maestría en Psicología Clínica - Universidad de Buenos Aires</li>
                    <li>Licenciatura en Psicología - Universidad Complutense de Madrid</li>
                </ul>
            </div>

        </div>
        <div class="der">
            <div class="comentarios-container">

                <div>

                    <div class="titulo-comentarios">
                        Reseñas

                    </div>

                    <?php foreach($resenas as $res){ ?>
                        <div class="recuadro-comentarios">
                            <img src="img/cerebro.jpg" alt="descripción de la imagen" class="imagen-comentarios">
                            <div class="contenedor-texto">
                                <span class="fecha-comentario"><i class="far fa-clock"></i> Publicado: <?php echo $res->Fecha ?></span>
                                <p><?php echo $res->Contenido ?></p>
                            </div>
                        </div>
                    <?php } ?>

                </div>

            </div>

        </div>




    </div>


    <footer>
        <div class="col first">
            <h3>Servicios</h3>
            <ul>
                <li>Terapia individual</li>
                <li>Terapia de pareja</li>
                <li>Psicoanálisis</li>
                <li>Medicación</li>
            </ul>
        </div>
        <div class="col center-col">
            <h3>Contacto</h3>
            <ul>
                <li>Teléfono: 123-456-7890</li>
                <li>Correo electrónico: info@miempresa.com</li>
            </ul>
        </div>
        <div class="col right-col">
            <h3>Dirección</h3>
            <ul>
                <li>Calle Hemmings 123</li>
                <li>Monterrey, Nuevo León</li>
                <li>Código Postal 12345</li>
            </ul>
        </div>
    </footer>

</body>

</html>