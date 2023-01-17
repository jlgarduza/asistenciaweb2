<?php

    $server = "localhost";
	$dbuser = "root";
	$dbpwd = "";
	$dbname = "asistencia";

	$cnx = new mysqli($server,$dbuser,$dbpwd,$dbname);

	if (!$cnx) {
		echo "Error en la conexion";
	}

?>