<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Verificación de Asistencia - Asistencia</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="estilo.css">
</head>
<body>
	<?php
		
		
		include 'conexion.php';
		if ($_POST['submit']) {
			
			$matricula = $_POST['matricula'];
			$asistencia = "A";
			$fecha = date('Y-m-d');			

			$buscar_alumno = $cnx->query("SELECT * FROM alumnos WHERE Matricula = '$matricula'");

			$buscar_matricula = mysqli_fetch_array($buscar_alumno);

			$matricula_encontrada = $buscar_matricula['Matricula'];

			if (!$matricula_encontrada) {

				echo "<label class='alert alert-danger'><h2>Matrícula no existe</h2></label>";

			}else{

				//Verificamos si ya existe la asistencia registrada
				$existe_asistencia = "SELECT * FROM asistencia WHERE Matricula = '$matricula_encontrada' AND FechaRegistro = '$fecha'";
				$resultado = $cnx->query($existe_asistencia) or die (mysqli_error());
				if (mysqli_num_rows($resultado)>0){
					echo("<label class='alert alert-info text-center'><h2><img src='https://cdn4.iconfinder.com/data/icons/meBaze-Freebies/512/cancel.png' width='25%'> <br/> Asistencia ya registrada!</h2></label>");
					header("REFRESH:2; URL=./");
				} else {

					//En caso contrario registramos la asistencia del alumno
					$guardar_asistencia = $cnx->query("INSERT INTO asistencia VALUES(NULL,'$matricula_encontrada','$asistencia','$fecha')");

					if(!$guardar_asistencia){
						echo "<label class='alert alert-danger'><h2><img src='https://freeiconshop.com/wp-content/uploads/edd/error-flat.png' width='25%'> <br/> Hubo un problema al registrar la checada</h2></label>";
						header("REFRESH:2; URL=./");
					}else{
						echo "<label class='alert alert-success text-center'><h2><img src='https://cdn4.iconfinder.com/data/icons/meBaze-Freebies/512/ok.png' width='25%'> <br/> Asistencia Registrada!!</h2></label>";
						header("REFRESH:2; URL=./");
					}
				}
			}
		}

	?>
</body>
</html>