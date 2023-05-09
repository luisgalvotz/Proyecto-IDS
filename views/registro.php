<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/DAO/categoriaDAO.php';

  session_start();
  
  $usuarioActivo = 0;
  if (isset($_SESSION["Id_Usuario"])){
    $usuarioActivo = $_SESSION["Id_Usuario"];
  }

  $categoriaDAO = new CategoriaDAO();
  $categorias = $categoriaDAO->getCategoria("CATEG");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="shortcut icon" type="image/x-icon" href="./Imagenes/Logo.png"><!--Aqui va la imagen del icono de la pagina-->
    <link rel="stylesheet" type="text/css" href="./CSS/registro.css">

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

        <!--Cuerpo-->
        <div class="container bg-dark w-75 mt-5 rounded shadow  ">
            <div class="row align-items-stretch">
              <div class="col">
                <div class="text-end">
                  <p></p>
                  <img src="./Imagenes/Logo.png" width="70px" alt="Error de carga">
                  <h2 class="fw-bold text-center text-white">Bienvenido</h2>
                  <h4 class="fw-bold text-center py-5 text-white">Registra tu cuenta aquí</h4>
                  <form action="/Proyecto-BDMM-PCI/php/controllers/cRegistro.php" method="POST" class="was-validated" id="register-form" enctype="multipart/form-data">
                    <div class="mb-4 text-start text-white">
                      <div class="form-group">
                          <label for="text" class="form-label text-white ">Nombre:</label>
                          <input type="text" class="form-control " name="name" placeholder="Coloca tu nombre" required>

                      </div>
                    </div>
      
                    <div class="mb-4 text-start text-white">
                      <div class="form-group">
                          <label for="text" class="form-label text-white ">Apellido Paterno:</label>
                          <input type="text" class="form-control " name="fname" placeholder="Coloca tu apellido paterno" required>

                      </div>
                    </div>
      
                    <div class="mb-4 text-start text-white">
                      <div class="form-group">
                          <label for="text" class="form-label text-white ">Apellido Materno:</label>
                          <input type="text" class="form-control " name="lname" placeholder="Coloca tu apellido materno" required>

                      </div>
                    </div>

                    <div class="mb-4 text-start text-white ">
                        <div class="form-group">
                            <label for="password" class="form-label text-white">Genero:</label>
                            <select name="genero" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                              <option value="Hombre">Hombre</option>
                              <option value="Mujer">Mujer</option>
                              <option value="Otro">Otro</option>
                            </select>
                        </div>
                        
                      </div>
      
                    <div class="mb-4 text-start text-white">
                      <div class="form-group">
                          <label for="date" class="form-label text-white ">Fecha de nacimiento:</label>
                          <input type="date" class="form-control " name="birthday" required>

                      </div>
                    </div>
      
                    <div class="mb-4 text-start text-white">
                      <div class="form-group">
                          <label for="email" class="form-label text-white ">Correo electronico:</label>
                          <input type="email" class="form-control " name="email" placeholder="Coloca tu correo electronico" required>
                      </div>
                  </div>
           
                    <div class="mb-4 text-start text-white ">
                      <div class="form-group">
                          <label for="password" class="form-label text-white">Contraseña:</label>
                          <input type="password" class="form-control" name="password"  placeholder="Contraseña" required>

                      </div>
                      
                    </div>

                    <div class="mb-4 text-start text-white ">
                      <div class="form-group form-check-inline">
                          <label for="password" class="form-label text-white">Rol:</label>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="A">
                            <label class="form-check-label" for="flexRadioDefault1">
                              Alumno
                            </label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="E" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                              Escuela
                            </label>
                          </div>
                      </div>
                      
                    </div>
                    
                    <br>
      
                    <div class="mb-4 text-start text-white"style="width: 50%; position: center;">
                      <label for="image" class="form-label text-white">Foto de perfil:</label>
                      <div class="container">
                        
                          <div class="wrapper">
                            
                            <div id="imagen" class="image">
                              <img src="" alt="">
                            </div>
                                <div class="content">
                                          <div class="icon">
                                <i class="fas fa-cloud-upload-alt"></i></div>
                                <div class="text">
                                Ningun archivo seleccionado todavia</div>
                                </div>
                                <div id="cancel-btn">
                                  <i class="fas fa-times"></i></div>
                                <div class="file-name">
                                Nombre Archivo</div>
                              </div>
                            <button type="button" onclick="defaultBtnActive()" id="custom-btn" style="max-height: 40px;">Escoge un archivo</button>
                          <input id="default-btn" name="fotoPerfil" type="file" hidden>
                      </div>
                    </div>
                    <script>
                      const wrapper = document.querySelector(".wrapper");
                      const fileName = document.querySelector(".file-name");
                      const defaultBtn = document.querySelector("#default-btn");
                      const customBtn = document.querySelector("#custom-btn");
                      const cancelBtn = document.querySelector("#cancel-btn i");
                      const img = document.querySelector("#imagen img");
                      let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
                      function defaultBtnActive(){
                        defaultBtn.click();
                      }
                      defaultBtn.addEventListener("change", function(){
                        const file = this.files[0];
                        if(file){
                          const reader = new FileReader();
                          reader.onload = function(){
                            const result = reader.result;
                            img.src = result;
                            wrapper.classList.add("active");
                          }
                          cancelBtn.addEventListener("click", function(){
                            img.src = "";
                            wrapper.classList.remove("active");
                          })
                          reader.readAsDataURL(file);
                        }
                        if(this.value){
                          let valueStore = this.value.match(regExp);
                          fileName.textContent = valueStore;
                        }
                      });
                    </script>
      
                    <div class="mb-4"></div>
                    <br>
                    
                    <div class="d-grid">
                      <button type="submit" id="insert" class="btn btn-primary"> Registrarte </button>
                    </div>
      
      
                    <br>
      
                  </form>
      
                </div>
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




        <script>
          $(document).ready(function(){

            $('#insert').click(function () {
                var image_name = $('#default-btn').val();
                if(image_name==""){
                  alert("Seleccione una Imagen");
                  return false;
                }
                else{
                  var extension = $('#default-btn').val().split('.').pop().toLowerCase();
                  if(jQuery.inArray(extension,['png','jpg','jpeg']) == -1){
                    alert('Tipo de archivo invalido para la foto')
                    $('#default-btn').val('');
                    return false;
                  }
                }
              });
          });
        </script>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>

    <!--JQUERY VALIDATION-->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="./JScript/aditionalMethods.min.js"></script>
    <script src="./JScript/validation.js"></script>
</body>
</html>