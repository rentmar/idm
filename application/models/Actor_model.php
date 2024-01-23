<?php

class Actor_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function agregarActor($dt)
	{
		$this->db->insert('actor', $dt);
	}
	public function modificarActor($dt,$ida)
	{
		$this->db->where('idactor',$ida);
		$this->db->update('actor',$dt);
	}

	public function leerActorID($idactor)
	{
		$sql = "SELECT * "
			."FROM actor AS a  "
			."WHERE a.idactor = ?  ";
		$qry = $this->db->query($sql, [$idactor,  ]);
		return $qry->row();
	}
	public function leerActorPorId($ida)
	{
		$this->db->where('idactor',$ida);
		$q=$this->db->get('actor');
		return $q->row();
	}
	public function leerActores()
	{
		$q=$this->db->get('actor');
		return $q->result();
	}

	public function leerActoresNoticia($idnoticia)
	{
		$sql = "SELECT *  "
			."FROM noticia AS n   "
			."LEFT JOIN noticia_actor ON noticia_actor.rel_idnoticia = n.idnoticia   "
			."LEFT JOIN actor ON actor.idactor = noticia_actor.rel_idactor  "
			."WHERE n.idnoticia = ?  "
			."  "
			."  "
			."  ";
		$qry = $this->db->query($sql, [$idnoticia,  ]);
		return $qry->result();
	}
	
}
