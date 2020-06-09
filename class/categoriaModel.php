<?php
require_once('modelo.php');

class categoriaModel extends Modelo{
	public function __construct(){
		parent::__construct();
	}

	public function getCategorias(){
		$cat = $this->_db->query("SELECT id, nombre FROM categorias ORDER BY nombre");

		return $cat->fetchall();
	}

	public function getCategoriaNombre($nombre){
		$cat = $this->_db->prepare("SELECT id FROM categorias WHERE nombre = ?");
		$cat->bindParam(1, $nombre);
		$cat->execute();

		return $cat->fetch();
	}

	public function setCategoria($nombre){
		$cat = $this->_db->prepare("INSERT INTO categorias VALUES(null, ?, now(), now())");
		$cat->bindParam(1, $nombre);
		$cat->execute();

		$row = $cat->rowCount();
		return $row;
	}
}