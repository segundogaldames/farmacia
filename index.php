<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

require('class/productoModel.php');
require('class/imagenModel.php');
require('class/config.php');

$imagenes = new imagenModel;

$img = $imagenes->getImagenes();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Bienvenida</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<?php include('partials/header.php'); ?>
		<div class="row">
			<div class="col-md-12 mt-3">
				<?php include('partials/mensajes.php'); ?>
				<?php foreach($img as $img): ?>
					<a href="<?php echo BASE_URL . 'productos/verOferta.php?id=' . $img['id']; ?>">
						<div class="col-md-3">
							<h5><?php echo $img['producto']; ?></h5>
							<img src="<?php echo BASE_IMG . 'productos/' . $img['imagen']; ?>" class="img-responsive" >
							<h5 class="text-info">$ <?php echo number_format($img['precio'],0,',','.'); ?></h5>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</body>
</html>


