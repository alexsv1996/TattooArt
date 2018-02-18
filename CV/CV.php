<!DOCTYPE html>

<html lang="en-US">
<!-- Comentar coses mola! -->
<meta charset="UTF-8">

<head>
    <title><?php echo $_POST["nombre"] ?> <?php echo $_POST["apellido1"] ?> <?php echo $_POST["apellido2"] ?></title>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>

<body>
    <?php
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["imgInp"]["name"]);
        $uploadOk = 1;
        if (!empty($_FILES["imgInp"]["name"])){
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["imgInp"]["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                //echo "File is called - " . $target_file . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            if (file_exists($target_file)) {
                unlink("uploads/" . basename( $_FILES["imgInp"]["name"]));
                //$uploadOk = 0;
            }

            // Check file size
            if ($_FILES["imgInp"]["size"] > 500000) {
                //echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } 

            else {
                if (move_uploaded_file($_FILES["imgInp"]["tmp_name"], $target_file)) {
                    //echo "The file ". basename( $_FILES["imgInp"]["name"]). " has been uploaded.";
                } 

                else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
        else $uploadOk = 0;
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 text-center" id="leftCol">
                <div class="col-12 photo">
                    <?php
                    if ($uploadOk == 0){
                        echo "<img src=\"https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male2-512.png\" class=\"mx-auto d-block img-responsive\" id=\"userImg\">";
                    }

                    else{
                        echo "<img src=\"uploads/" . basename( $_FILES["imgInp"]["name"]) . "\" class=\"mx-auto d-block rounded-circle img-responsive\" id=\"userImg\">";
                    }
                    ?>
                </div>
                <div class="col-12 fullIntro">
                    <header><h1 class="name"><?php echo $_POST["nombre"] ?> <?php echo $_POST["apellido1"] ?> <?php echo $_POST["apellido2"] ?></h1></header>

                    <?php
                        if (isset($_POST["fecha-nacimiento"]) && !empty($_POST["fecha-nacimiento"])){
                            echo "<p><h6 class=\"dataNaixement\"><strong>Fecha de nacimiento: </strong>" . date('d-m-Y', strtotime($_POST["fecha-nacimiento"])) . "</h6></p>";
                        }
                    ?>

                    <?php
                        if (isset($_POST["ciudad-nacimiento"]) && !empty($_POST["ciudad-nacimiento"])){
                            echo "<p><h6 class=\"infoNaixement\"><strong>Nacido en </strong>" . $_POST["ciudad-nacimiento"] . "</h6></p>";
                        }
                    ?>

                    <?php echo "<p class=\"intro\">" . $_POST["about-me"] . "</p>" ?>
                </div>
                <div class="col-12 text-center">
                    <?php
                        if (!empty($_POST["link-profesional"])){
                            echo "<p><a href=\"" . $_POST["link-profesional"] . "\">&#128279 " . $_POST["link-profesional"] . "</a></p>";
                        }

                        if (!empty($_POST["correo-electronico"])){
                            echo "<p><a href=\"mailto:" . $_POST["correo-electronico"] . "\"><i class=\"far fa-envelope\"></i> " . $_POST["correo-electronico"] . "</a></p>";
                        }

                        if (!empty($_POST["telefono1"])){
                            echo "<p><a href=\"tel:+34" . $_POST["telefono1"] . "\"><i class=\"fas fa-mobile-alt\"></i> " . $_POST["telefono1"] . "</a></p>";
                        }
                    ?>

                    <?php 
                        if (!empty($_POST["telefono2"])){
                            echo "<p><a href=\"tel:+34" . $_POST["telefono2"] . "\"><i class=\"fas fa-mobile-alt\"></i> " . $_POST["telefono2"] . "</a></p>";
                        } 

                        if (!empty($_POST["ciudad"])){
                            echo "<p><i class=\"fas fa-location-arrow\"></i> " . $_POST["ciudad"];

                            if (!empty($_POST["codigo-postal"])){
                                echo ", " . $_POST["codigo-postal"];
                            }

                            echo "</p>";
                        }
                    ?>
                </div>
            </div>

            <div class="col-md-8" id="rightCol">

                <?php
                    if (isset($_POST["hiddenExp"]) && !empty($_POST["puesto1"])){
                        echo "<div class=\"card\">
                                <div class=\"card-header bg-dark text-white\">
                                    <strong><h4>Experiencia</h4></strong>
                                </div>
                                    <ul class=\"list-group list-group-flush\">";

                        for ($i = 1; $i <= $_POST["hiddenExp"]; $i++){
                            if(!empty($_POST["puesto" . $i])){
                                echo "<li class=\"list-group-item\">
                                        <h5>" . $_POST["puesto" . $i] . "</h5>
                                        <p>" . $_POST["empresa" . $i] . "</p>
                                        <p class=\"footer\">" . $_POST["tiempo-trabajado" . $i] . "</p>";

                                if (!empty($_POST["funciones" . $i])) echo "<p>" . $_POST["funciones" . $i] . "</p>";
                                if (!empty($_POST["logros" . $i])) echo "<p>" . $_POST["logros" . $i] . "</p>";

                                echo "</li>";
                            }
                        }

                        echo "</ul></div>";
                    }
                ?>

                <?php
                    if((isset($_POST["hiddenAptitud"]) && !empty($_POST["aptitud1"])) || (isset($_POST["hiddenCategoria"]) && !empty($_POST["categoria1"]))){
                        echo "<div class=\"card\">
                                <div class=\"card-header bg-dark text-white\">
                                    <strong><h4>Habilidades</h4></strong>
                                </div>
                                    <ul class=\"list-group list-group-flush\">";

                        if (isset($_POST["hiddenAptitud"]) && !empty($_POST["aptitud1"])){
                            echo "<li class=\"list-group-item\">
                                    <h5>Aptitudes personales</h5>
                                    <ul>";
                            for ($i = 1; $i <= intval($_POST["hiddenAptitud"]); $i++){
                                if(!empty($_POST["aptitud" . $i])){
                                    echo "<li>" . $_POST["aptitud" . $i] . "</li>";
                                }
                            }
                            echo "</ul></li>";
                        }

                        if (isset($_POST["hiddenCategoria"]) && !empty($_POST["categoria1"])){
                            echo "<li class=\"list-group-item\">";

                            for ($i = 1; $i <= $_POST["hiddenCategoria"]; $i++){
                                if (!empty($_POST["categoria" . $i . "hab1"])){
                                    echo "<h5>" . $_POST["categoria" . $i] . "</h5>
                                            <ul>";

                                    for($x = 1; $x <= $_POST["hiddenCategoria" . $i . "habilitats"]; $x++){
                                        if (!empty($_POST["categoria" . $i . "hab" . $x])){
                                            echo "<li>" . $_POST["categoria" . $i . "hab" . $x];

                                            if (isset($_POST["cat" . $i . "hab" . $x . "perc"])){
                                                echo "<div class=\"progress\">
                                                        <div class=\"progress-bar progress-bar-striped bg-success\" role=\"progressbar\" style=\"width:" . $_POST["cat" . $i . "hab" . $x . "porcentage"] . "%\" aria-valuenow=\"" . $_POST["cat" . $i . "hab" . $x . "porcentage"] . "\" aria-valuemin=\"0\" aria-valuemax=\"100\">" . $_POST["cat" . $i . "hab" . $x . "porcentage"] . "%</div> </div>";
                                            }

                                            echo "</li>";
                                        }
                                    }
                                }
                            }
                        }

                        echo "</ul></div>";
                    }
                ?>

                <?php
                    if (isset($_POST["hiddenEstudio"]) && !empty($_POST["titulo1"])){
                        echo "<div class=\"card\">
                                <div class=\"card-header bg-dark text-white\">
                                    <strong><h4>Estudios</h4></strong>
                                </div>
                                    <ul class=\"list-group list-group-flush\">";

                        for ($i = 1; $i <= $_POST["hiddenEstudio"]; $i++){
                            if(!empty($_POST["titulo" . $i])){
                                echo "<li class=\"list-group-item\">
                                        <h5>" . $_POST["titulo" . $i] . "</h5>
                                        <p>" . $_POST["centro". $i] . "</p>
                                        <p class=\"footer\">" . date('m-Y', strtotime($_POST["fecha-inicio" . $i])) . " - " . date('m-Y', strtotime($_POST["fecha-fin" . $i])) . "</p>";

                                if (!empty($_POST["comentario-educacion" . $i])){
                                    echo "<p>" . $_POST["comentario-educacion" . $i] . "</p>";
                                }

                                echo "</li>";
                            }
                        }

                        echo "</ul></div>";
                    }
                ?>

                <?php
                if (isset($_POST["hiddenIdioma"]) && !empty($_POST["idioma1"])){
                    echo "<div class=\"card\">
                            <div class=\"card-header bg-dark text-white\">
                                <strong><h4>Idiomas</h4></strong>
                            </div>
                            <ul class=\"list-group list-group-flush\">";

                    for($i=1; $i <= $_POST["hiddenIdioma"]; $i++){
                        if(!empty($_POST["idioma" . $i])){
                            echo "<li class=\"list-group-item\">
                                    <h5>" . $_POST["idioma" . $i] . "</h5>
                                    <ul class=\"idioma\">
                                        <li>Escrito: " . $_POST["nivel-escrito" . $i] . "</li>
                                        <li>Leído: " . $_POST["nivel-leido" . $i] . "</li>
                                        <li>Hablado: " . $_POST["nivel-oral" . $i] . "</li>";

                            if(!empty($_POST["certificado" . $i])){
                                echo "<li>Certificado: " . $_POST["certificado" . $i] . "</li>";
                            }

                             if (isset($_POST["info-idiomas" . $i]) && !empty($_POST["info-idiomas" . $i])){
                                echo "<li><footer class=\"footer\">" . $_POST["info-idiomas" . $i] . "</footer></li>";
                            }
                               
                            echo "</ul></li>";
                        }
                    }

                    echo "</ul></div";
                }


                ?>
            </div>
        </div>
    </div>
</body>

</html>