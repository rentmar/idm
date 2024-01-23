<?php

class Universidad_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function leerUniversidades()
	{
		$qry = $this->db->get('universidad');
		return $qry->result();
	}

	public function leerUniversidadId($idu)
	{
		$this->db->where('iduniversidad',$idu);
		$qry = $this->db->get('universidad');
		return $qry->row();
	}
	public function leerDepartamentos()
	{
		$qry = $this->db->get('departamento');
		return $qry->result();
	}
	public function leerDepartamentoUniversidad($idu)
	{
		$this->db->where('rel_iduniversidad',$idu);
		$qry = $this->db->get('universidad_departamento');
		return $qry->result();
	}
	public function agregarUniversidad($dt,$dtchkbox)
	{
		$this->db->trans_start();
			$this->db->insert('universidad', $dt);
			$idu=$this->db->insert_id();
			foreach ($dtchkbox as $iddpto)
			{
				$dtu=array('rel_iduniversidad'=>$idu,
						'rel_iddepartamento'=>$iddpto
						);
				$this->db->insert('universidad_departamento', $dtu);
			}
		$this->db->trans_complete();
	}
	public function modificarUniversidad($dt,$dtchkbox,$idu)
	{
		$this->db->trans_start();
			$this->db->where('iduniversidad',$idu);
			$this->db->update('universidad',$dt);
			$this->db->where('rel_iduniversidad',$idu);
			$this->db->delete('universidad_departamento');
			foreach ($dtchkbox as $iddpto)
			{
				$dtu=array('rel_iduniversidad'=>$idu,
						'rel_iddepartamento'=>$iddpto
						);
				$this->db->insert('universidad_departamento', $dtu);
			}
		$this->db->trans_complete();
	}

	/*public function leerUniverdiadID($id)
	{
		$this->db->where('iduniversidad',$id);
		$q=$this->db->get('universidad');
		return $q->row();

	}*/
	
	

}
