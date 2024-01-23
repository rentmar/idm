<?php

class Municipio_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Lee todos los muncipios disponibles
	public function leerMuncipios()
	{
		$sql = "SELECT idmunicipio, municipio_nombre "
			."FROM municipio ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	//Leer los municipios y los departamentos a los que pertenece
	public function leerMuncipiosDepartamentos()
	{
		$sql = "SELECT * "
			."FROM municipio "
			."LEFT JOIN departamento ON municipio.rel_iddepartamento = departamento.iddepartamento ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	//Lee un municipio por ID
	public function leerMunicipioPorID($idmunicipio){
		$this->db->where('idmunicipio', $idmunicipio);
		$q= $this->db->get('municipio');
		return $q->row();
	}

	//Lee todos los municipios por id de departamento
	public function leerMunicipiosPorDepartamento($iddepartamento)
	{
		$this->db->where('rel_iddepartamento', $iddepartamento);
		$qry = $this->db->get('municipio');
		return $qry->result();
	}

	//Crear nuevo registro municipio
	public function crearMuncipio($datos_municipio)
	{
		/*
		 *$datos_municio es un objeto
		 * $datos_municio->idmunicipio
		 * $datos_municio->municipio_nombre
		 * $datos_municio->rel_iddepartameno
		 */
		$sql = $this->db->insert('departamento', $datos_municipio);
		if($sql){
			return true;
		}else{
			return false;
		}
	}

	//Actualizar datos de muncipio
	public function updateDepartamento($idmunicipio, $municipio)
	{
		$this->db->where('idmunicipio', $idmunicipio);
		$sql = $this->db->update('municipio', $municipio );
		return $sql;
	}

}
