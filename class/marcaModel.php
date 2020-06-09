<?php
require_once('modelo.php');

class marcaModel extends Modelo{
	public function __construct(){
		parent::__construct();
	}

	public function getMarcas(){
		$mar = $this->_db->query("SELECT id, nombre FROM marcas ORDER BY nombre");

		return $mar->fetchall();
	}

	public function getMarcaNombre($nombre){
		$mar = $this->_db->prepare("SELECT id FROM marcas WHERE nombre = ?");
		$mar->bindParam(1, $nombre);
		$mar->execute();

		return $mar->fetch();
	}

	public function setMarca($nombre){
		$mar = $this->_db->prepare("INSERT INTO marcas VALUES(null, ?, now(), now())");
		$mar->bindParam(1, $nombre);
		$mar->execute();

		$row = $mar->rowCount();
		return $row;
	}
}