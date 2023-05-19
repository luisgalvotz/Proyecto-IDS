<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-IDS/DAO/citaDAO.php';

  session_start();
  
  $usuarioActivo = 0;
  if (isset($_SESSION["Id_Usuario"])){
    $usuarioActivo = $_SESSION["Id_Usuario"];
  }

  $citaDAO = new CitaDAO();
  $citas = $citaDAO->getCitas("GET");
?>

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
            <a href="psicologaInicio.php" class="inicio">Inicio</a>
            <a href="perfilEditar.php" class="psi">Perfil</a>
            <a href="Citas.php" class="cit">Citas</a>
            <a href="index.php" class="button-link">Salir</a>

        </div>
    </header>
    <div class="content">
        <div class="frase-del-dia">
            <p class="frase" style="font-size: 30px;">Agenda de citas</p>
        </div>

        <div class="cita2">
            <div class="contenedor">
                <button id="btnHistorial" onclick="mostrarDiv1()" class="hist">Historial de citas</button>
                <button id="btnPendientes" onclick="mostrarDiv2()">Citas pendientes</button>

                <div id="div1">
                    <?php foreach($citas as $ct){ ?>

                        <div class="historial">
                            <img src="img/cita.png" alt="descripción de la imagen" class="imagen-cita">
                            <div class="contenedor-texto">
                                <p><b>Estado:</b> <?php echo $ct->Aprobada; ?></p>
                                <p><b>Fecha:</b> <?php echo date('d/m/Y', strtotime($ct->Fecha)) . ', ' . date('h:i a', strtotime($ct->Hora)); ?></p>
                                <p><b>Nombre del paciente:</b> <?php echo $ct->Nombre_Paciente; ?></p>
                                <p><b>Motivo de consulta:</b> <?php echo $ct->Motivo; ?></p>
                                <p><b>Teléfono:</b> <?php echo $ct->Telefono; ?></p>
                                <div style="
                                margin-bottom: 10px;">
                                    <p><b>Correo: </b><?php echo $ct->Email; ?></p>
                                </div>
                            </div>

                        </div>
                    <?php } ?>

                </div>

                <div id="div2">
                    
                    <?php foreach($citas as $ct){ 
                        if($ct->Aprobada == 'Pendiente'){?>

                        <div class="historial">
                            <img src="img/cita.png" alt="descripción de la imagen" class="imagen-cita">
                            <div class="contenedor-texto">
                                <p><b>Estado:</b> <?php echo $ct->Aprobada; ?></p>
                                <p><b>Fecha:</b> <?php echo date('d/m/Y', strtotime($ct->Fecha)) . ', ' . date('h:i a', strtotime($ct->Hora)); ?></p>
                                <p><b>Nombre del paciente:</b> <?php echo $ct->Nombre_Paciente; ?></p>
                                <p><b>Motivo de consulta:</b> <?php echo $ct->Motivo; ?></p>
                                <p><b>Teléfono:</b> <?php echo $ct->Telefono; ?></p>
                                <div style="
                                margin-bottom: 10px;">
                                    <p><b>Correo: </b><?php echo $ct->Email; ?></p>
                                </div>
                            </div>
                            <div class="botones">
                                <form action="/Proyecto-IDS/controllers/cCita.php" method="post">
                                    <input type="text" name="id" id="id" value="<?php echo $ct->Id_Cita; ?>" hidden>
                                    <button type="submit" class="boton-aprobar" name="aprobada" value="1">Aprobar</button>
                                    <button type="submit" class="boton-rechazar" name="aprobada" value="0">Rechazar</button>
                                </form>
                            </div>

                        </div>
                        <?php }
                    } ?>
                </div>


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
    <script>
        function mostrarDiv1() {
            document.getElementById("div1").style.display = "block";
            document.getElementById("div2").style.display = "none";

            document.getElementById("btnHistorial").style.background = "white";
            document.getElementById("btnHistorial").style.color = "#4f818e";
            document.getElementById("btnHistorial").style.border = "solid #4f818e";

            document.getElementById("btnPendientes").style.background = "#57CA5B";
            document.getElementById("btnPendientes").style.color = "white";
            document.getElementById("btnPendientes").style.border = "none";
        }

        function mostrarDiv2() {
            document.getElementById("div2").style.display = "block";
            document.getElementById("div1").style.display = "none";

            document.getElementById("btnHistorial").style.background = "#4f818e";
            document.getElementById("btnHistorial").style.color = "white";
            document.getElementById("btnHistorial").style.border = "none";

            document.getElementById("btnPendientes").style.background = "white";
            document.getElementById("btnPendientes").style.color = "#57CA5B";
            document.getElementById("btnPendientes").style.border = "solid #57CA5B";
        }

        mostrarDiv1();
    </script>
</body>

</html>