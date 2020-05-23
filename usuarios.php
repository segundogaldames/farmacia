<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require('class/usuarioModel.php');
//creamos una instancia de la clase rolModel
$usuarios = new usuarioModel;
$res = $usuarios->getUsuarios();
//print_r($res);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Usuarios</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<?php include('header.php'); ?>
		<div class="row">
			<div class="col-md-8 mt-3">
				<h3>Usuarios</h3>
				<!--Valida o notifica que el registro se ha realizado-->
				<?php if(isset($_GET['m'])): ?>
					<p class="alert alert-success">El usuario se ha registrado correctamente</p>
				<?php endif; ?>

				<?php if(isset($_GET['e'])): ?>
					<p class="alert alert-success">El usuario no se ha registrado correctamente</p>
				<?php endif; ?>

				<a href="addUsuarios.php" class="btn btn-primary">Nuevo Usuario</a>
				<?php if(isset($res) && count($res)): ?>
					<table class="table table-hover">
						<tr>
							<th>Nombre</th>
							<th>Rol</th>
							<th>Activo</th>
						</tr>
						<?php foreach($res as $r): ?>
							<tr>
								<td>
									<a href="verUsuario.php?id=<?php echo $r['id']; ?>"><?php echo $r['usuario']; ?></a>
								</td>
								<td><?php echo $r['rol'] ?></td>
								<td>
									<?php if($r['active'] == 1): ?>
										Si
									<?php else: ?>
										No
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</table>
				<?php else: ?>
					<p class="text-info mt-3">No hay usuarios registrados</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</body>
</html>