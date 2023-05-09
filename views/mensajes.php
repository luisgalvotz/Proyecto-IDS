<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-IDS/DAO/mensajesDAO.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-IDS/DAO/categoriaDAO.php';

  session_start();
  
  $usuarioActivo = 0;
  if (isset($_SESSION["Id_Usuario"])){
    $usuarioActivo = $_SESSION["Id_Usuario"];
  }

  $otheru = $_GET["id"];
  $mensajeDAO = new MensajeDAO();
  $chats = $mensajeDAO->getChatsUser("CHATS", $_SESSION["Id_Usuario"]);
  $msgs = $mensajeDAO->getMessagesUser("GETMS", $_SESSION["Id_Usuario"], $otheru);

  $categoriaDAO = new CategoriaDAO();
  $categorias = $categoriaDAO->getCategoria("CATEG");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="shortcut icon" type="image/x-icon" href="./Imagenes/Logo.png"><!--Aqui va la imagen del icono de la pagina-->
    <link rel="stylesheet" type="text/css" href="./CSS/style.css">

    <!--Footer-->
    <!-- Font Awesome -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css"
    rel="stylesheet"
    />
    <!--Footer-->


    <style>
      .bg{
          background-image: url(./Imagenes/c.jpg);
          background-position: center;
          background-size: 160%;
          border-radius: 10px 0px 0px 10px;

      }
  </style>
</head>
<body>
        <!--Header-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark"style=" width: 100%; top:0px;" >
          <div class="container-fluid" >
            <a class="navbar-brand" href="./main.php"><img src="./Imagenes/Logo.png" width="50" alt="Error de carga"></a>
            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon bg-dark"></span>
              <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="./main.php">Inicio</a>
  
                </li>
                <?php if (isset($_SESSION["Id_Usuario"])): ?>
                        <?php if ($_SESSION["Tipo"] == "E"): ?>
                            <li class="nav-item">
                                <?php echo '<a class="nav-link active" href="./perfilM.php?Id_Usuario='.$_SESSION["Id_Usuario"].'">Perfil</a>' ?>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <?php echo '<a class="nav-link active" href="./perfilA.php?Id_Usuario='.$_SESSION["Id_Usuario"].'">Perfil</a>' ?>
                            </li>
                        <?php endif ?>
                <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="./login.php">Perfil</a>
                        </li>
                <?php endif ?>
                <li class="nav-item">
                        <a class="nav-link active" href="./busquedaavanzada.php">Busqueda Avanzada</a>
                    </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Categorias
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php foreach($categorias as $cat){ ?>
                        <li><a class="dropdown-item" href="./busqueda.php?Id_Categoria=<?php echo $cat->Id_Categoria?>"><?php echo $cat->Descripcion?></a></li>
                    <?php } ?>
                  </ul>
                </li>
              </ul>
              <form action="./busqueda.php" class="d-flex" method="POST" autocomplete="off">
                  <input class="form-control me-2" type="search" placeholder="Escribe para buscar"
                      name="aBuscar" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Buscar</button>
              </form>
            </div>
          </div>
        </nav>
        <!--Header-->
          <br>
          <br>
        <!--Cuerpo-->
        <div class="container">
          <div class="row">
            <hr>

            <div class="col-3" style="min-height: 500px; max-height: 500px; overflow-y: scroll;">
            <?php foreach($chats as $chat){ ?>
              <?php if ($_SESSION["Id_Usuario"] != $chat->Id_Usuario): ?>
                <p style="font-size: 100%;"> <img src="data:image/jpeg;base64,<?php echo base64_encode($chat->Foto) ?>" alt="" style="width: 20%; border-radius:50px;"><a href="./mensajes.php?id=<?php echo $chat->Id_Usuario;?>" style="padding-left: 5px;"><?php echo $chat->Nombre_Usuario?></a>
                <hr>
              <?php endif ?>
            <?php } ?>
              <div class="container" style="height: 800px;"></div>
            </div>

            <div class="col-9">

              <div class="row  " style="min-height: 440px; max-height: 440px; overflow-y: scroll;">
                <?php foreach($msgs as $msg){ 
                  if($msg->Id_Usuario_Envia == $_SESSION["Id_Usuario"]){
                    ?>
                    <div class="card text-end">
                      <div class="card-header" style="font-size: 80%; color: gray;"> <?php echo $msg->Nombre_Usuario_Envia ?> </div>
                      <div class="card-body">
                        <p style="font-size: 80%; color: gray;">Enviado: <?php echo date("d-M-Y H:i:s", strtotime($msg->Fecha_Hora)) ?></p>
                      </div>
                      <div class="card-text" style="padding-right: 2%;">
                        <?php echo $msg->Contenido ?>
                      </div>
                    </div>
                    <hr>
                   
                <?php }
                  else{
                    ?>
                     <div class="card">
                      <div class="card-header" style="font-size: 80%; color: gray;"> <?php echo $msg->Nombre_Usuario_Envia ?> </div>
                      <div class="card-body">
                        <p style="font-size: 80%; color: gray;">Enviado: <?php echo date("d-M-Y H:i:s", strtotime($msg->Fecha_Hora)) ?></p>
                        
                      </div>
                      <div class="card-text" style="padding-left: 2%;">
                        <?php echo $msg->Contenido ?>
                      </div>
                      </div>
                      <hr>
                    
                    <?php
                  }
                 }
                ?>
                 
                <div class="container" style="height: 500px;"></div>

              </div>
              <br>

              <form action="/Proyecto-BDMM-PCI/php/controllers/cMensajes.php" method="POST">
                <div class="mb-3 d-md-flex">
                  <input id="id" name="id" value="<?php echo $otheru ?>" style="width: 80%;" class="form-control" type="text" aria-label="default input example" hidden>
                  <input id="contenido" name="contenido" style="width: 80%;" class="form-control" type="text" aria-label="default input example" autocomplete="off">
                  <button type="submit" style=" text-align: center; width:20%;" class=" btn btn-success btn-sm">Enviar</button>
                </div>
              </form>

            </div>

          </div>
        </div>
        <!--Cuerpo-->
        <br>
        <br>
        <!--Footer-->
        <footer class="page-footer bg-dark">
            <div style="background-color:#0F84BA">
                <div class="container">
                    <div class="row py-4 d-flex align-items-center">
                        <div class="col-md-12 text-center">
                            <a href="#"><i class="fab fa-facebook-square text-white mr-3" style="font-size: 30px;"></i></a>
                            <a href="#"><i class="fab fa-twitter-square text-white mr-3" style="font-size: 30px;"></i></a>
                            <a href="#"><i class="fab fa-instagram-square text-white" style="font-size: 30px;"></i></a>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="container text-center  text-light text-md-left mt-5">
                <div class="row">
                    <div class="col-md-3 mx-auto mb-4">
                        <h6 class="text-uppercase font-weight-bold">Desarrolladores:</h6>
                        <hr class="bg-success mb-4 mt-0 d-inline-block mx-auto" style="width: 125px; height: 2px;">
                        <p class="mt-1">Fernando Moncayo Marquez</p>
                        <a class="mt-1 text-white" href="#" >fermoncam506@gmail.com</a>
                        <br>
                        <p class="mt-1">Luis Alejandro Galvan Ortiz</p>
                        <a class="mt-1 text-white" href="#">luisg.12@outlook.com</a>
                    </div>
    
                    <div class="col-md-2 mx-auto mb-4">
                        <h6 class="text-uppercase font-weight-bold">Categorias:</h6>
                        <hr class="bg-success mb-4 mt-0 d-inline-block mx-auto" style="width: 85px; height: 2px;">
                        <ul class="list-unstyled ">
                            <?php $i = 0;
                            foreach($categorias as $cat){ ?>
                                <li class="mt-1" ><a href="./busqueda.php?Id_Categoria=<?php echo $cat->Id_Categoria?>" class="text-white"><?php echo $cat->Descripcion?></a></li>
                            <?php if (++$i == 4) break;
                            } ?>
                        </ul>
                    </div>
    
                    <div class="col-md-2 mx-auto mb-4">
                        <h6 class="text-uppercase font-weight-bold">Repositorio:</h6>
                        <hr class="bg-success mb-4 mt-0 d-inline-block mx-auto" style="width: 110px; height: 2px; ">
                        <p></p>
                        <a class="mt-0 text-white" href="https://github.com/FerchoSMT/Proyecto-BDMM-PCI.git" target="_blank" >Repositorio del proyecto</a>
                    </div>
    
                    <div class="col-md-2 mx-auto mb-4">
                        <h6 class="text-uppercase font-weight-bold">We Learn:</h6>
                        <hr class="bg-success mb-4 mt-0 d-inline-block mx-auto" style="width: 85px; height: 2px;">
                        <ul class="list-unstyled ">
                            <li class="my-2" ><i class="fas fa-home mr-3"> Monterrey, Nuevo Leon</i></li>
                            <li class="my-2" ><i class="fas fa-envelope mr-3"> WeLearn@gmail.com</i></li>
                            <li class="my-2" ><i class="fas fa-phone  mr-3"> 8112298194</i></li>
                        </ul>
                    </div>
                </div>
            </div>
    
            <div class="footer-copyright text-center py-3 text-white bg-black">
                <p>&copy; Copyright
                    <a href="#" class="text-white">WeLearn.com</a>
                    <p >Diseñado por We Learn</p>
                </p>
            </div>
        </footer>
        <!--Footer-->








    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>
</body>
</html>