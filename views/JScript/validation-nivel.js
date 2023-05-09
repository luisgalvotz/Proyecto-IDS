$(document).ready(function(){

    
    $(function(){

        $("#creacion-nivel").validate({
            rules:{
                videoNivel:{

                    required:true,
                    extension: "mp4"
                },
                descripcion:{
                    required:true
                }
    
            },
            messages:{
                videoNivel:{
                    required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa un video para el nivel"
                },
                descripcion:{
                    required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa descripcion para el nivel"
                }
            }
        });
    
       
    });
    });
    
    