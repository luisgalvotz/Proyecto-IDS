<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/DAO/categoriaDAO.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/DAO/cursoDAO.php';

    session_start();
  
    $usuarioActivo = 0;
    if (isset($_SESSION["Id_Usuario"])){
      $usuarioActivo = $_SESSION["Id_Usuario"];
    }

    $categoriaDAO = new CategoriaDAO();
    $categorias = $categoriaDAO->getCategoria("CATEG");

    $cursoDAO = new CursoDAO();
    $cursosVendidos = $cursoDAO->getCursosMain("+VEND");
    $cursosCalificados = $cursoDAO->getCursosMain("+CALI");
    $cursosRecientes = $cursoDAO->getCursosMain("+RECI");
    $cursos = $cursoDAO->getCursosMain("TODOS");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>

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
    <!--OWL CARROUSEL-->
    <link rel="stylesheet" href="./Plugins/OwlCarousel2-2.3.4/dist/assets/owl.carousel.css">
    <link rel="stylesheet" href="./Plugins/OwlCarousel2-2.3.4/dist/assets/owlcarousel/owl.theme.default.min.css">




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
        <!--Cuerpo-->

          <?php if (isset($_SESSION["Id_Usuario"])): ?>
            <?php if ($_SESSION["Tipo"] == "E"): ?>
                <form action="./creacioncurso.php">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-lg btn-primary" >Publicar un curso</button>
                    </div>
                    <br>
                    <hr>
                </form>
            <?php endif ?>
          <?php endif ?>

          <div class="row p-4">
            <h4>Cursos más vendidos</h4>
                <div class="col-12">
                    <div class="owl-carousel owl-theme">
                        <?php foreach($cursosVendidos as $curV){ ?>
                            <div class="item"><div class="card shadow-lg" style="width: 15rem;">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($curV->Imagen).'" class="card-img-top" alt="...">' ?>
                                <div class="card-body">
                                <h5 class="card-title"><?php echo $curV->Titulo ?></h5>
                                <p class="card-text"><?php echo $curV->Descripcion ?></p>
                                <?php echo '<a href="./curso.php?Id_Curso='.$curV->Id_Curso.'" class="btn btn-primary">Ir al curso</a>'; ?>
                                </div>
                            </div></div>
                        <?php } ?>
                    </div>
                </div>
          </div>
          <hr>
          <div class="row p-4">
            <h4>Cursos mejor calificados</h4>
                <div class="col-12">
                    <div class="owl-carousel owl-theme">
                        <?php foreach($cursosCalificados as $curC){ ?>
                            <div class="item"><div class="card shadow-lg" style="width: 15rem;">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($curC->Imagen).'" class="card-img-top" alt="...">' ?>
                                <div class="card-body">
                                <h5 class="card-title"><?php echo $curC->Titulo ?></h5>
                                <p class="card-text"><?php echo $curC->Descripcion ?></p>
                                <?php echo '<a href="./curso.php?Id_Curso='.$curC->Id_Curso.'" class="btn btn-primary">Ir al curso</a>'; ?>
                                </div>
                            </div></div>
                        <?php } ?>
                    </div>
                </div>
          </div>
          <hr>
          <div class="row p-4">
            <h4>Cursos más recientes</h4>
                <div class="col-12">
                    <div class="owl-carousel owl-theme">
                        <?php foreach($cursosRecientes as $curR){ ?>
                            <div class="item"><div class="card shadow-lg" style="width: 15rem;">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($curR->Imagen).'" class="card-img-top" alt="...">' ?>
                                <div class="card-body">
                                <h5 class="card-title"><?php echo $curR->Titulo ?></h5>
                                <p class="card-text"><?php echo $curR->Descripcion ?></p>
                                <?php echo '<a href="./curso.php?Id_Curso='.$curR->Id_Curso.'" class="btn btn-primary">Ir al curso</a>' ?>
                                </div>
                            </div></div>
                        <?php } ?>
                    </div>
                </div>
          </div>
          <hr>
          <div class="row p-4">
            <h4>Todos los cursos</h4>
                <div class="col-12">
                    <div class="owl-carousel owl-theme">
                        <?php foreach($cursos as $cur){ ?>
                            <div class="item"><div class="card shadow-lg" style="width: 15rem;">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($cur->Imagen).'" class="card-img-top" alt="...">' ?>
                                <div class="card-body">
                                <h5 class="card-title"><?php echo $cur->Titulo ?></h5>
                                <p class="card-text"><?php echo $cur->Descripcion ?></p>
                                <?php echo '<a href="./curso.php?Id_Curso='.$cur->Id_Curso.'" class="btn btn-primary">Ir al curso</a>'; ?>
                                </div>
                            </div></div>
                        <?php } ?>
                    </div>
                </div>
          </div>
        <!--Cuerpo-->
        <hr>
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

    <!--OWL CARROUSEL-->
    <script src="./Plugins/OwlCarousel2-2.3.4/dist/owl.carousel.js"></script>
    <script>
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop:false,
                margin:10,
                nav:true,
                nav:false,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:5
                    }
                }
            })
        });
    </script>
</body>
</html>