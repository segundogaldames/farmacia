<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require('class/rolModel.php');
require('class/usuarioModel.php');
//creamos una instancia de la clase rolModel
$roles = new rolModel;
$usuarios = new usuarioModel;

//print_r($_GET);

if (isset($_GET['id'])) {
	//recuperamos y sanitizamos el dato que viene por cabecera
	$id = (int) $_GET['id'];

	$res = $usuarios->getUsuarioId($id);

	if (!$res) {
		$mensaje = 'El dato no es valido';
	}
}

//print_r($res);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Usuario</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<?php include('header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Usuario</h3>
				<!--Valida o notifica que el registro se ha realizado-->
				<?php if(isset($_GET['m'])): ?>
					<p class="alert alert-success">El rol se ha modificado correctamente</p>
				<?php endif; ?>

				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<table class="table table-hover">
					<tr>
						<th>Nombre:</th>
						<td><?php echo $res['usuario']; ?></td>
					</tr>
					<tr>
						<th>Email:</th>
						<td><?php echo $res['email']; ?></td>
					</tr>
					<tr>
						<th>Rol:</th>
						<td><?php echo $res['rol']; ?></td>
					</tr>
					<tr>
						<th>Activo:</th>
						<td>
							<?php
								if($res['active'] == 1): ?>
									Si
								<?php else: ?>
									No
								<?php endif; ?>
						</td>
					</tr>
					<tr>
						<th>Fecha de creación:</th>
						<td>
							<?php
								$fecha_reg = new DateTime($res['created_at']);
								echo $fecha_reg->format('d-m-Y H:i:s');
							?>
						</td>
					</tr>
					<tr>
						<th>Fecha de modificación:</th>
						<td>
							<?php
								$fecha_mod = new DateTime($res['updated_at']);
								echo $fecha_mod->format('d-m-Y H:i:s');
							?>
						</td>
					</tr>
				</table>
				<p>
					<a href="editUsuario.php?id=<?php echo $res['id']; ?>" class="btn btn-link">Editar</a>
					<a href="usuarios.php" class="btn btn-link">Volver</a>
					<a href="#" class="btn btn-danger">Eliminar</a>
				</p>
			</div>
		</div>
	</div>
</body>
</html>