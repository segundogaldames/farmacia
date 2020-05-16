<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require('class/rolModel.php');
//creamos una instancia de la clase rolModel
$roles = new rolModel;

//print_r($_GET);

if (isset($_GET['id'])) {
	//recuperamos y sanitizamos el dato que viene por cabecera
	$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
	//$id = (int) $id;

	$res = $roles->getRolId($id);

	if (!$res) {
		$msg = 'error';
		header('Location: roles.php?e=' . $msg);
	}

	if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {
		//sanitizamos el dato
		//print_r($_POST);exit;
		$nombre = trim(strip_tags($_POST['nombre']));

		if (!$nombre) {
			$mensaje = 'Ingrese el nombre del rol';
		}else{
			//print_r($id);exit;
			//actualizamos el rol
			$sql = $roles->editRoles($id, $nombre);
			//print_r($res);exit;
			if ($sql) {
				$msg = 'ok';
				header('Location: verRol.php?m=' . $msg . '&id=' . $id);
			}
		}
	}
}

//print_r($res);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Rol</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<?php include('header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Rol</h3>
				<!--Valida o notifica que el registro se ha realizado-->
				<?php if(isset($_GET['m'])): ?>
					<p class="alert alert-success">El rol se ha modificado correctamente</p>
				<?php endif; ?>

				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<form action="" method="post">
					<div class="form-group">
						<label>Nombre del rol</label>
						<input type="text" name="nombre" value="<?php echo $res['nombre']; ?>" placeholder="Nombre del rol" class="form-control">
					</div>
					<div class="form-group">
						<input type="hidden" name="enviar" value="si">
						<button type="submit" class="btn btn-success">Modificar</button>
						<a href="roles.php" class="btn btn-link">Volver</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>