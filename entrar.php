<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Asistencia</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <form action="" method="post" class="form-signin">
      	<h1 class="h3 mb-3 font-weight-normal">Ingrese datos de acceso</h1>
        <label for="">Usuario:</label>
        <input type="text" name="usuario" id="usuario" class="form-control" autofocus required>
        <br />
        <label for="">Contraseña:</label>
        <input type="password" name="contra" id="contra" class="form-control" required>
        <br />
        <input type="submit" name="acceder" value="Acceder" class="btn btn-lg btn-primary btn-block">
        <br />
        <?php
            session_start();
            include 'conexion.php';

            if(@$_POST['acceder']){
                $txt_usuario = $_POST['usuario'];
                $txt_contra  = $_POST['contra'];

                $buscar_datos = $cnx->query("SELECT * FROM usuarios WHERE usuario = '$txt_usuario' ") or die (mysqli_error());
                
                if($validacion = mysqli_fetch_array($buscar_datos)){
                    $validacion['contra'] == $txt_contra;
                    $_SESSION['Usuario'] = $txt_usuario;
                    header("Location: ./alumnos.php");
                }else{
                    header("Location: ./entrar.php?denegadologin=datos no validos");
                    exit();
                }
            }
            if (isset($_GET['denegadologin'])) { echo '<div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>  <strong>Datos incorrectos!</strong></div>'; }
        ?>
    </form>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>