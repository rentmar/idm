<?php

class TPlenaria_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Leer el tipo de plenaria segun la instancia de seguimiento
	public function leerTPlenariaPorISeguimiento($idinstanciaseguimiento)
	{
		$sql = "SELECT *    "
			."FROM tipoplenaria      "
			."LEFT JOIN tipo_plenaria_informacion ON tipoplenaria.rel_idtpinf = tipo_plenaria_informacion.idtpinf    "
			."WHERE tipoplenaria.rel_idinsseg = ?  "
			." "
			."  "
			." "
			."  ";
		$qry = $this->db->query($sql, [$idinstanciaseguimiento, ]);
		return $qry->result();
	}

	//Leer el tipo de plenaria seleccionada
	public function leerTPlenariaPorID($idtipoplenaria)
	{
		$sql = "SELECT *    "
			."FROM tipoplenaria      "
			."LEFT JOIN tipo_plenaria_informacion ON tipoplenaria.rel_idtpinf = tipo_plenaria_informacion.idtpinf    "
			."WHERE tipoplenaria.idtpl = ?  "
			." "
			."  "
			." "
			."  ";
		$qry = $this->db->query($sql, [$idtipoplenaria, ]);
		return $qry->row();
	}




}
