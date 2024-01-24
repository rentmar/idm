<?php

class Formulario_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Todos los formularios Base
	public function getFormularios(){
		$sql = "SELECT *      "
			."FROM uiformulario   "
			."   "
			."   "
			."  "
			."   "
			."   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	//formulario por ID
	public function getFormularioPorID($idformulario){
		$sql = "SELECT formulario_respuesta.idformresp, formulario_respuesta.nombre_lugar AS nombre, ciudad.nombre_ciudad, zona.nombre_zona, lugar.nombre_lugar, uiformulario.form_nombre, uiencuesta.uinombre_encuesta      "
			."FROM formulario_respuesta   "
			."LEFT JOIN ciudad ON ciudad.idciudad = formulario_respuesta.rel_idciudad   "
			."LEFT JOIN zona ON zona.idzona = formulario_respuesta.rel_idzona   "
			."LEFT JOIN lugar ON lugar.idlugar = formulario_respuesta.rel_idlugar   "
			."LEFT JOIN uiformulario ON uiformulario.idformulario = formulario_respuesta.rel_iduiformulario   "
			."LEFT JOIN uiencuesta ON uiencuesta.iduiencuesta = uiformulario.rel_iduiencuesta  "
			."WHERE formulario_respuesta.idformresp = ?   "
			."   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idformulario,  ]);
		return $qry->row();
	}

	//formulario por ID
	public function getCiudad(){
		$sql = "SELECT *      "
			."FROM  ciudad "
			."   "
			."   "
			."  "
			."   "
			."   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	public function getZona(){
		$sql = "SELECT *      "
			."FROM  zona "
			."   "
			."   "
			."  "
			."   "
			."   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	public function getLugar(){
		$sql = "SELECT *      "
			."FROM  lugar "
			."   "
			."   "
			."  "
			."   "
			."   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	public function getFormRespPorIdusuario($idusuario){
		$sql = "SELECT *      "
			."FROM  formulario_respuesta "
			."WHERE formulario_respuesta.rel_idusuario = ?   "
			."   "
			."  "
			."   "
			."   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idusuario, ]);
		return $qry->result();
	}

	public function leerZonaPorIdciudad($idciudad) {
		$sql = "SELECT * "
			."FROM zona "
			."WHERE zona.rel_idciudad = ? ";
		$qry = $this->db->query($sql, [$idciudad,  ]);
		return $qry->result_array();

	}

	public function crearFormulario($form){
		$formulario = $form;
		$this->db->trans_begin();

		$data = array(
			'nombre_lugar' => $formulario->nombre_lugar,
			'fecha_fc' => $formulario->fecha_fc,
			'latitud_fc' => $formulario->latitud_fc,
			'longitud_fc' => $formulario->longitud_fc,
			'rel_idciudad' => $formulario->rel_idciudad,
			'rel_idzona' => $formulario->rel_idzona,
			'rel_idlugar' => $formulario->rel_idlugar,
			'rel_idusuario' => $formulario->rel_idusuario,
			'rel_iduiformulario' => $formulario->rel_iduiformulario,
		);

		$this->db->insert('formulario_respuesta', $data);
		$id = $this->db->insert_id();

		$data2 = array(
			'form_resp' => '{}',
			'rel_idformresp' => $id,
		);
		$this->db->insert('formulario_respuesta_cmp', $data2);


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return $id;
		}
	}

	public function buscarComplementoFormulario($idformulario){
		$sql = "SELECT *      "
			."FROM formulario_respuesta_cmp "
			."WHERE formulario_respuesta_cmp.rel_idformresp = ?   "
			."   "
			."  "
			."   "
			."   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idformulario, ]);
		return $qry->result();
	}


	//Familias de los productost
	public function getFamilias()
	{
		$sql = "SELECT *      "
			."FROM familia "
			."ORDER BY familia.ordinal_familia ASC  "
			."   "
			."  "
			."   "
			."   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	//Familias con subfamilias
	public function getFamiliaSubfamilia()
	{
		$sql = "SELECT *      "
			."FROM familia "
			."LEFT JOIN subfamilia ON subfamilia.rel_idflia = familia.idflia  "
			."ORDER BY familia.ordinal_familia ASC, subfamilia.ordinal_subfamilia ASC   "
			."  "
			."   "
			."   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	public function getItemPorSubfamilia($idsubflia){
		$sql = "SELECT *      "
			."FROM item_sub "
			."LEFT JOIN item ON item.iditem = item_sub.rel_iditem  "
			."LEFT JOIN subfamilia ON subfamilia.idsubflia = item_sub.rel_idsubflia   "
			."WHERE subfamilia.idsubflia = ?  "
			."ORDER BY item.ordinal_item ASC   "
			."   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idsubflia,]);
		return $qry->result();
	}

	public function getItemPorFamilia($idfamilia){
		$sql = "SELECT *      "
			."FROM item_fam "
			."LEFT JOIN item ON item.iditem = item_fam.rel_iditem  "
			."LEFT JOIN familia ON familia.idflia = item_fam.rel_idfamilia   "
			."WHERE familia.idflia = ?  "
			."ORDER BY item.ordinal_item ASC   "
			."   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idfamilia,]);
		return $qry->result();
	}

	public function getFamiliaId($idfamilia)
	{
		$sql = "SELECT *      "
			."FROM familia   "
			."WHERE familia.idflia = ?   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idfamilia,  ]);
		return $qry->row();
	}
	public function getSubfamiliaId($idfamilia)
	{
		$sql = "SELECT *      "
			."FROM subfamilia   "
			."WHERE subfamilia.idsubflia = ?  "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idfamilia,  ]);
		return $qry->row();
	}



















}
