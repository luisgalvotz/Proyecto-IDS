<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/DAO/usuarioDAO.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/DAO/categoriaDAO.php';

  session_start();
  
  $usuarioActivo = 0;
  if (isset($_SESSION["Id_Usuario"])){
    $usuarioActivo = $_SESSION["Id_Usuario"];
  }

  $usuarioDAO = new UsuarioDAO();
  $us = new UsuarioModel();
  $us->addUserID($_SESSION["Id_Usuario"]);
  $usuario = $usuarioDAO->getUser("VERPF", $us)[0];

  $categoriaDAO = new CategoriaDAO();
  $categorias = $categoriaDAO->getCategoria("CATEG");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>

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
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style=" width: 100%; top:0px;" >
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
            <div class="container">
                <br>
                <h3>Editar Perfil</h3>
                <div class="row">
                    <div class="col-12">
                      
                    <form id="editar-perfil" action="/Proyecto-BDMM-PCI/php/controllers/cEditarPerfil.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input name="Id_Usuario" type="hidden" value="<?php echo $usuario->Id_Usuario?>">
                    <div class=" ">
                             
                    <div class="mb-4 text-start text-white"style="width: 50%; position: center;">
                            <label for="image" class="form-label text-white">Foto de perfil:</label>
                            <div class="container">
                              
                                <div class="wrapper active">
                                  
                                  <div id="imagen" class="image">
                                  <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($usuario->Foto).'" alt="">' ?>
                                    <!--img src="" alt=""-->
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
                                <input id="default-btn" name="fotoPerfil" class="" type="file" hidden>
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

                            <div class="mb-4 text-start ">
                                <div class="form-group">
                                    <label for="text" class="form-label  ">Nombre:</label>
                                    <input type="text" class="form-control " name="name" placeholder="Coloca tu nombre" value=<?php echo $usuario->Nombre?> required>
          
                                </div>
                              </div>
                
                              <div class="mb-4 text-start ">
                                <div class="form-group">
                                    <label for="text" class="form-label  ">Apellido Paterno:</label>
                                    <input type="text" class="form-control " name="fname" placeholder="Coloca tu apellido paterno" value=<?php echo $usuario->Apellido_P?> required>
          
                                </div>
                              </div>
                
                              <div class="mb-4 text-start ">
                                <div class="form-group">
                                    <label for="text" class="form-label  ">Apellido Materno:</label>
                                    <input type="text" class="form-control " name="lname" placeholder="Coloca tu apellido materno" value=<?php echo $usuario->Apellido_M?> required>
          
                                </div>
                              </div>

                              <div class="mb-4 text-start ">
                                <div class="form-group">
                                    <label for="email" class="form-label  ">Correo electronico:</label>
                                    <input type="email" class="form-control " name="email" placeholder="Coloca tu correo electronico" value=<?php echo $usuario->Email?> required>
                                </div>
                              </div>



                              <div class="mb-4 text-start ">
                                <div class="form-group">
                                    <label for="password" class="form-label  ">Contraseña:</label>
                                    <input type="password" class="form-control " name="contra" placeholder="Coloca tu nueva contraseña" value=<?php echo $usuario->Contrasena?> required>
                                </div>

                              </div>
        
                              <div class="mb-4 text-start ">
                                <div class="form-group">
                                    <label for="genero" class="form-label ">Genero:</label>
                                    <select name="genero" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                      <?php if ($usuario->Genero == "Hombre"): ?>
                                        <option value="Hombre" selected>Hombre</option>
                                        <option value="Mujer">Mujer</option>
                                        <option value="Otro">Otro</option>
                                      <?php elseif ($usuario->Genero == "Mujer"): ?>
                                        <option value="Hombre">Hombre</option>
                                        <option value="Mujer" selected>Mujer</option>
                                        <option value="Otro">Otro</option>
                                      <?php else: ?>
                                        <option value="Hombre">Hombre</option>
                                        <option value="Mujer">Mujer</option>
                                        <option value="Otro" selected>Otro</option>
                                      <?php endif ?>
                                    </select>
                                </div>
                              </div>
        
                              <div class="mb-4 text-start ">
                                <div class="form-group">
                                    <label for="date" class="form-label ">Fecha de nacimiento:</label>
                                    <input id="date" type="date" class="form-control " name="birthday" value=<?php echo $usuario->Fecha_Nac?> required>
          
                                </div>
                              </div>
                              <div class="d-grid gap-2 col-6 mx-auto">
                                <button type="submit" id="edit" class="btn btn-primary btn-sm">Editar</button>
                            </div>
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

            $('#edit').click(function () {
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
    <script src="./JScript/validation-edit.js"></script>

</body>
</html>