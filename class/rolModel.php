<?php
require('modelo.php');

class rolModel extends Modelo
{
	public function __construct(){
		//disponemos de lo declarado en el constructor de la clase modelo
		parent::__construct();
	}

	//traemos todos los roles de la tabla roles
	public function getRoles(){
		//consulta a la tabla roles usando el objeto db de la clase modelo
		$roles = $this->_db->query("SELECT id, nombre FROM roles");

		//retornamos lo que haya en la tabla roles
		return $roles->fetchall();
	}

	public function setRoles($nombre){
		$rol = $this->_db->prepare("INSERT INTO roles VALUES(null, ?)");
		$rol->bindParam(1, $nombre); //definimos el valor de cada ?
		$rol->execute();//ejecutamos la consulta

		$row = $rol->rowCount(); //devuelve la cantidad de registros insertados
		return $row;
	}
}
