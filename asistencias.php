<?php
	session_start();

	if($_SESSION['Usuario'] == true){

	}else{
	  header("Location: ./entrar.php");
	}

    include 'conexion.php';
	$buscar_asistencia = $cnx->query("SELECT * FROM asistencia");

	if(@$_GET['eliminar']){
		$idAlumno = $_GET['eliminar'];
		$eliminar_alumno = $cnx->query("DELETE FROM alumnos WHERE idAlumno = '$idAlumno'");
		if($eliminar_alumno)
		{
			echo "<center><label class='alert alert-success'>Alumno eliminado</label></center>";
			header("REFRESH:2; URL=./alumnos.php");
		}
		else
		{
			echo "<center>Error al eliminar</center>";
		}
		exit($eliminar_alumno);
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Alumnos - Asistencia</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="estilo.css">
</head>
<body>
	<div class="container">
        <div class="login">
            <a href="./salir.php">Cerrar Sesión</a>
        </div>
		<h2>Alumnos</h2>
		<div class="row">
			<div class="col-md-12">
				<a href="./" target="_blank"  class="btn btn-primary md-12"><b> <i class="material-icons md-12">check</i> Abrir Sistema de Asistencia</b></a>
				<br /><br />
				<a href="./alumnos.php"       class="btn btn-danger md-12"><b>  <i class="material-icons md-12">perm_identity</i> Ver Alumnos</b></a>
				<a href="./asistencias.php"   class="btn btn-primary md-12"><b> <i class="material-icons md-12">timer</i> Ver Asistencia</b></a>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead class="bg-primary text-white text-center">
						<th>ID</th>
						<th>Matrícula</th>
						<th>Nombre</th>
						<!-- <th colspan="2">Acciones</th> -->
					</thead>
					<?php while($listar_asistencia = mysqli_fetch_object($buscar_asistencia)){ ?>
					<tbody style="font-size: 10px;">
						<td><?php echo $listar_asistencia->idAsistencia ?></td>
						<td><?php echo $listar_asistencia->Matricula ?></td>
						<td><?php echo $listar_asistencia->FechaRegistro ?></td>
						<!-- <td class="text-center"><a href="#" class="btn btn-primary"><i class="material-icons md-10" style="color: white;">edit</i></a></td> -->
						<!-- <td class="text-center"><a href="alumnos.php?eliminar=<?php echo $listar_asistencia->idAsistencia ?>" class="btn btn-danger"><i class="material-icons md-10" style="color: white;">delete</i></a></td> -->
					</tbody>
					<?php
						}
					?>
				</table>
			</div>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>