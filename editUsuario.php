<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require('class/rolModel.php');
require('class/usuarioModel.php');

//creamos una instancia de la clase rolModel y usuarioModel
$roles = new rolModel;
$usuarios = new usuarioModel;

if (isset($_GET['id'])) {
	$id = (int) $_GET['id'];

	//consultamos por el usuario segun el id seleccionado
	$usu = $usuarios->getUsuarioId($id);
	$res = $roles->getRoles();

	if (!$usu) {
		$mensaje = 'El usuario no existe';
	}else{

	}

	//print_r($res);
	if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {
		$nombre = trim(strip_tags($_POST['nombre']));
		$email = trim(strip_tags($_POST['email']));
		$rol = (int) $_POST['rol'];
		$password = trim(strip_tags($_POST['password']));
		$repassword = trim(strip_tags($_POST['repassword']));

		if (!$nombre) {
			$mensaje = 'Ingrese el nombre del usuario';
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$mensaje = 'Ingrese el email del usuario';
		}elseif (!$rol) {
			$mensaje = 'Seleccione el rol del usuario';
		}elseif (!$password || strlen($password) < 8) {
			$mensaje = 'El password del usuario debe tener al menos 8 caracteres';
		}elseif ($password != $repassword) {
			$mensaje = 'El password no coincide';
		}else{
			//verificar que el usuario no se haya registrado previamente
			$res = $usuarios->getUsuarioEmail($email);

			if ($res) {
				$mensaje = 'El usuario ingresado ya existe';
			}else{
				//enviar los datos a la base de datos
				$sql = $usuarios->setUsuario($nombre, $email, $password, $rol);

				if ($sql) {
					$msg = 'ok';
					header('Location: usuarios.php?m=' . $msg);
				}else{
					$msg = 'error';
					header('Location: usuarios.php?e=' . $msg);
				}
			}
		}
	}
}



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nuevo Usuario</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<?php include('header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Editar Usuario</h3>
				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>
				<form action="" method="post">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="nombre" value="<?php echo $usu['nombre']; ?>" placeholder="Nombre del usuario" class="form-control">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" value="<?php echo $usu['email']; ?>" placeholder="Email del usuario" class="form-control">
					</div>
					<div class="form-group">
						<label>Rol</label>
						<select name="rol" class="form-control">
							<option value="<?php echo $usu['usuario_id'] ?>"><?php echo $usu['rol']; ?></option>
							<?php foreach($res as $r):?>
								<option value="<?php echo $r['id']; ?>"><?php echo $r['nombre']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label>Estado</label>
						<select name="rol" class="form-control">
							<option value="<?php echo $usu['active'] ?>">
								<?php if($usu['active']==1): ?>Activo <?php else: ?> Inactivo <?php endif; ?>
							</option>
							<option value="1">Activar</option>
							<option value="2">Desactivar</option>
						</select>
					</div>
					<div class="form-group">
						<input type="hidden" name="enviar" value="si">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="usuarios.php" class="btn btn-link">Volver</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>