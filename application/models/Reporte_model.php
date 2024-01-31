<?php

class Reporte_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function formulariosReportesGeneral()
	{
		$sql = "SELECT formulario_respuesta.idformresp, formulario_respuesta.nombre_lugar AS nombre_del_lugar, formulario_respuesta.esta_abierto, formulario_respuesta.es_valido, ciudad.idciudad, ciudad.nombre_ciudad, zona.idzona, zona.nombre_zona, lugar.idlugar, lugar.nombre_lugar, formulario_respuesta.rel_idusuario, formulario_respuesta.rel_iduiformulario, formulario_respuesta.fecha_fc, formulario_respuesta.rel_iduiformulario, formulario_respuesta.masvendidos, users.id, users.username               "
			."FROM  formulario_respuesta  "
			."LEFT JOIN users ON users.id = formulario_respuesta.rel_idusuario   "
			."LEFT JOIN ciudad ON ciudad.idciudad = formulario_respuesta.rel_idciudad      "
			."LEFT JOIN zona ON zona.idzona = formulario_respuesta.rel_idzona     "
			."LEFT JOIN lugar ON lugar.idlugar = formulario_respuesta.rel_idlugar      "
			."WHERE formulario_respuesta.rel_iduiformulario = 1   "
			."AND formulario_respuesta.es_valido = 1   "
			."   "
			."   ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	public function formulariosReportesDepartameto($idciudad)
	{
		$sql = "SELECT formulario_respuesta.idformresp, formulario_respuesta.nombre_lugar AS nombre_del_lugar, formulario_respuesta.esta_abierto, formulario_respuesta.es_valido, ciudad.idciudad, ciudad.nombre_ciudad, zona.idzona, zona.nombre_zona, lugar.idlugar, lugar.nombre_lugar, formulario_respuesta.rel_idusuario, formulario_respuesta.rel_iduiformulario, formulario_respuesta.fecha_fc, formulario_respuesta.rel_iduiformulario, formulario_respuesta.masvendidos, users.id, users.username               "
			."FROM  formulario_respuesta  "
			."LEFT JOIN users ON users.id = formulario_respuesta.rel_idusuario   "
			."LEFT JOIN ciudad ON ciudad.idciudad = formulario_respuesta.rel_idciudad      "
			."LEFT JOIN zona ON zona.idzona = formulario_respuesta.rel_idzona     "
			."LEFT JOIN lugar ON lugar.idlugar = formulario_respuesta.rel_idlugar      "
			."WHERE formulario_respuesta.rel_iduiformulario = 1   "
			."AND formulario_respuesta.es_valido = 1   "
			."AND ciudad.idciudad = ?  "
			."   ";
		$qry = $this->db->query($sql, [$idciudad,]);
		return $qry->result();
	}



}
