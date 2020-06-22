<?php
require_once('modelo.php');

class imagenModel extends Modelo
{

	public function __construct(){
		parent::__construct();
	}

	public function getImagenNombre($nombre){
		$id = (int) $id;

		$prod = $this->_db->prepare("SELECT id FROM imagenes WHERE id = ?");
		$prod->bindParam(1, $nombre);
		$prod->execute();

		return $prod->fetch();
	}

	public function getImagenProducto($producto){
		$producto = (int) $producto;

		$prod = $this->_db->prepare("SELECT id, titulo, descripcion, nombre FROM imagenes WHERE producto_id = ?");
		$prod->bindParam(1, $producto);
		$prod->execute();

		return $prod->fetchall();
	}

	public function setImagen($titulo, $descripcion, $imagen, $producto, $portada){
		$producto = (int) $producto;
		$portada = (int) $portada;

		$img = $this->_db->prepare("INSERT INTO imagenes VALUES(null, ?, ?, ?, ?, ?, now(), now())");
		$img->bindParam(1, $titulo);
		$img->bindParam(2, $descripcion);
		$img->bindParam(3, $imagen);
		$img->bindParam(4, $producto);
		$img->bindParam(5, $portada);
		$img->execute();

		$row = $img->rowCount();
		return $row;
	}
}