<?php

class Instanciaseguimiento_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Leer todas las instancias de seguimiento
	public function leerInstancias()
	{
		$qry = $this->db->get("instancia_seguimiento");
		return $qry->result();
	}

	//Leer una instancia de seguimiento
	public function leerInstancia($idinstancia)
	{
		$this->db->where("idinsseg", $idinstancia);
		$q=$this->db->get("instancia_seguimiento");
		return $q->row();
	}
}
