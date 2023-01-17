<?php
	session_start();

	if($_SESSION['Usuario'] == true){

	}else{
	  header("Location: ./entrar.php");
	}

	include 'conexion.php';
	$buscar_alumnos = $cnx->query("SELECT * FROM alumnos");

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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
		<div class="row col-md-12">
			<div class="col-md-6">
				<form action="" method="POST" class="form-horizontal form-signin">
					<h2 class="h3 mb-3 font-weight-normal">Nuevo Alumno</h2>
					<div class="form-group col-md-12">
						<!-- <label for="">Matrícula</label> -->
						<input type="text" name="matricula" placeholder="Matrícula" class="form-control" autofocus required onkeyup="javascript:this.value=this.value.toUpperCase();">
					</div>
					<div class="form-group col-md-12">
						<!-- <label for="">Nombre</label> -->
						<input type="text" name="nombre" placeholder="Nombre" class="form-control" required onkeyup="javascript:this.value=this.value.toUpperCase();">
					</div>
					<div class="form-group col-md-12 text-center">
						<input type="submit" name="submit" value="Guardar Alumno" class="btn btn-success btn-sm">
					</div>
					<?php
						if (@$_POST['submit']) {
			
							$matricula = $_POST['matricula'];
							$nombre = $_POST['nombre'];
					
							$existe_asistencia = "SELECT * FROM alumnos WHERE Matricula = '$matricula'";
							$resultado = $cnx->query($existe_asistencia) or die (mysqli_error());
							if (mysqli_num_rows($resultado)>0){
					
								echo "<label class='alert alert-warning text-center'><img src='https://cdn4.iconfinder.com/data/icons/meBaze-Freebies/512/cancel.png' width='10%'> <br/> <strong>Mensaje: </strong> Matrícula Duplicada!</label>";
								header("REFRESH:2; URL=./alumnos.php");
					
							}else{
					
								$guardar_alumno = $cnx->query("INSERT INTO alumnos VALUES(NULL, '$matricula', '$nombre')");
					
								if ($guardar_alumno == false) {
									echo "<label class='alert alert-danger text-center'><img src='https://cdn4.iconfinder.com/data/icons/meBaze-Freebies/512/cancel.png' width='10%'> <br/> <strong>Mensaje: </strong> Ocurrio un error al guardar</label>";
									header("REFRESH:2; URL=./alumnos.php");
								}else{
									echo "<label class='alert alert-success text-center'><img src='https://cdn4.iconfinder.com/data/icons/meBaze-Freebies/512/ok.png' width='10%'> <br/> <strong>Mensaje: </strong> Alumno Registrado!</label>";
									header("REFRESH:2; URL=./alumnos.php");
								}
					
							}
					
						}
					?>
				</form>
			</div>
			<div class="col-md-6">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead class="bg-primary text-white text-center">
							<th>ID</th>
							<th>Matrícula</th>
							<th>Nombre</th>
							<th colspan="2">Acciones</th>
						</thead>
						<?php while($listar_alumnos = mysqli_fetch_object($buscar_alumnos)){ ?>
						<tbody style="font-size: 10px;">
							<td><?php echo $listar_alumnos->idAlumno ?></td>
							<td><?php echo $listar_alumnos->Matricula ?></td>
							<td><?php echo $listar_alumnos->Nombre ?></td>
							<td class="text-center"><a href="#" class="btn btn-primary"><i class="material-icons md-10" style="color: white;">edit</i></a></td>
							<td class="text-center"><a href="alumnos.php?eliminar=<?php echo $listar_alumnos->idAlumno ?>" class="btn btn-danger"><i class="material-icons md-10" style="color: white;">delete</i></a></td>
						</tbody>
						<?php
							}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>