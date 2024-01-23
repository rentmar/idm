<?php

class SubTema_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function agregarSubTema($dt)
	{
		$this->db->insert('subtema', $dt);
	}
	public function modificarSubTema($dt,$idt)
	{
		$this->db->where('idsubtema',$idt);
		$this->db->update('subtema',$dt);
	}
	public function leerSubTemas()
	{
		$q=$this->db->get('subtema');
		return $q->result();
	}
	public function leerSubTemaPorId($idt)
	{
		$this->db->where('idsubtema',$idt);
		$q=$this->db->get ('subtema');
		return $q->row();
	}
	public function leerTemas()
	{
		$q=$this->db->get('tema');
		return $q->result();
	}
	//Rutina para extraer los subtemas de los tres primero formularios
	public function leerSubtemasForms()
	{
		$sql = "SELECT *  "
			."FROM subtema AS s  "
			."LEFT JOIN tema ON s.rel_idtema = tema.idtema  "
			."WHERE tema.rel_idcuestionario != 4 ";

		$qry = $this->db->query($sql);
		return $qry->result();
	}

	//Extrae Subtemas, temas y cuestionario
	public function leerSubtemaTemaCuestionario()
	{
		$sql = "SELECT *  "
			."FROM subtema AS s   "
			."LEFT JOIN tema ON tema.idtema = s.rel_idtema  "
			."LEFT JOIN cuestionario ON tema.rel_idcuestionario = cuestionario.idcuestionario  "
			."ORDER BY s.idsubtema   "
			."  ";

		$qry = $this->db->query($sql);
		return $qry->result();

	}

	//Rutina para extraer los subtemas del formulario leyes
	public function leerSubtemasLeyes()
	{
		$sql = "SELECT *  "
			."FROM subtema AS s  "
			."LEFT JOIN tema ON s.rel_idtema = tema.idtema  "
			."WHERE tema.rel_idcuestionario = 4 ";

		$qry = $this->db->query($sql);
		return $qry->result();
	}

	//Extraer los subtemas de una noticia
	public function leerSubtemasDeUnaNoticia($idnoticia)
	{
		$sql = "SELECT *  "
			."FROM noticia AS n   "
			."LEFT JOIN noticia_subtema ON noticia_subtema.rel_idnoticia = n.idnoticia  "
			."LEFT JOIN subtema ON noticia_subtema.rel_idsubtema = subtema.idsubtema  "
			."LEFT JOIN tema ON tema.idtema = subtema.rel_idtema  "
			."WHERE n.idnoticia = ?  "
			."  "
			."  "
			." ";

		$qry = $this->db->query($sql, [$idnoticia,]);
		return $qry->result();
	}

	//Leer los otros subtemas de una noticia
	public function  leerOtrossubtemasDeUnaNoticia($idnoticia)
	{
		$sql = "SELECT *  "
			."FROM noticia AS n    "
			."LEFT JOIN noticia_otrosubtema ON n.idnoticia = noticia_otrosubtema.rel_idnoticia   "
			."LEFT JOIN otrosubtema ON otrosubtema.idotrosubtema = noticia_otrosubtema.rel_idotrosubtema  "
			."LEFT JOIN tema ON tema.idtema = otrosubtema.rel_idtema  "
			."WHERE n.idnoticia = ?  "
			."  "
			."  "
			." ";

		$qry = $this->db->query($sql, [$idnoticia,]);
		return $qry->result();
	}

	//Subtema - tema por identificador de subtema
	public function  leerSubtemaPorIDs($idsubtema)
	{
		$sql = "SELECT *  "
			."FROM subtema AS st     "
			."LEFT JOIN tema ON st.rel_idtema = tema.idtema   "
			."WHERE st.idsubtema = ?  "
			."  "
			."  "
			."  "
			."  "
			." ";

		$qry = $this->db->query($sql, [$idsubtema,]);
		return $qry->row();
	}

	public function leerSubtemasdeTemasActivos($idtema){
		$sql = "SELECT * "
			."FROM subtema  "
			."WHERE subtema.rel_idtema = ?  "
			."  "
			."  "
			."  ";
		$qry = $this->db->query($sql, [$idtema, ]);
		return $qry->result();
	}









}
