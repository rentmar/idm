<?php

class Tema_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function agregarTema($dt)
	{
		$this->db->insert('tema', $dt);
	}
	public function leerCustionarios()
	{
		$q=$this->db->get('cuestionario');
		return $q->result();
	}
	public function modificarTema($dt,$idt)
	{
		$this->db->where('idtema',$idt);
		$this->db->update('tema',$dt);
	}
	public function leerTemas()
	{
		$q=$this->db->get('tema');
		return $q->result();
	}
	public function leerTemaPorId($idt)
	{
		$this->db->where('idtema',$idt);
		$q=$this->db->get ('tema');
		return $q->row();
	}
	//Rutina para extraer los temas de los tres primeros formularios
	public function leerTemasForms()
	{
		$sql = "SELECT *  "
			."FROM tema as t  "
			."WHERE t.rel_idcuestionario != 4  "
			."ORDER by t.idtema ";

		$qry = $this->db->query($sql);
		return $qry->result();
	}

	public function leerTemaFormulario()
	{
		$sql = "SELECT *  "
			."FROM tema AS t  "
			."LEFT JOIN cuestionario ON t.rel_idcuestionario = cuestionario.idcuestionario  "
			."ORDER BY t.idtema  ";

		$qry = $this->db->query($sql);
		return $qry->result();

	}

	//Rutina para extraer los temas del formulario leyes
	public function leerTemasLeyes()
	{
		$sql = "SELECT *  "
			."FROM tema as t  "
			."WHERE t.rel_idcuestionario = 4  "
			."ORDER by t.idtema ";

		$qry = $this->db->query($sql);
		return $qry->result();
	}


	//Leer temas por identificador de formulario
	public function leerTemasPorFormulario($identificador)
	{
		$sql = "SELECT *  "
			."FROM tema as t  "
			."WHERE t.rel_idcuestionario = ?  "
			."ORDER by t.idtema ";

		$qry = $this->db->query($sql, [$identificador, ]);
		return $qry->result();
	}


	//Lee todos los temas de una noticia
	public function leerTemasDeUnaNoticia($idnoticia)
	{
		$sql = "SELECT tema.idtema, tema.nombre_tema  "
			."FROM noticia AS n   "
			."LEFT JOIN noticia_subtema ON noticia_subtema.rel_idnoticia = n.idnoticia  "
			."LEFT JOIN subtema ON noticia_subtema.rel_idsubtema = subtema.idsubtema  "
			."LEFT JOIN tema ON tema.idtema = subtema.rel_idtema  "
			."WHERE n.idnoticia = ?  "
			."GROUP BY tema.idtema  "
			."  ";

		$qry = $this->db->query($sql, [$idnoticia,]);
		return $qry->result();
	}

	//Lee otro tema de una noticia
	public function leerOtrotemaDeUnaNoticia($idnoticia)
	{
		$sql = "SELECT *   "
			."FROM noticia AS n    "
			."LEFT JOIN noticia_otrotema ON noticia_otrotema.rel_idnoticia = n.idnoticia   "
			."LEFT JOIN otrotema ON otrotema.idotrotema = noticia_otrotema.rel_idotrotema  "
			."WHERE n.idnoticia = ?  "
			."  "
			." "
			."  ";

		$qry = $this->db->query($sql, [$idnoticia,]);
		return $qry->row();
	}














}
