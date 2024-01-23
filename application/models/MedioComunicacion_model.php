<?php

class MedioComunicacion_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function agregarMedioComunicacion($dt,$dtchkbox)
	{
		$this->db->trans_start();
			$this->db->insert('medio_comunicacion', $dt);
			$idmc=$this->db->insert_id();
			foreach ($dtchkbox as $iddpto)
			{
				$dtm=array('rel_idmedio'=>$idmc,
						'rel_iddepartamento'=>$iddpto
						);
				$this->db->insert('medio_departamento', $dtm);
			}
		$this->db->trans_complete();
	}
	public function modificarMedioComunicacion($dt,$dtchkbox,$idm)
	{
		$this->db->trans_start();
			$this->db->where('idmedio',$idm);
			$this->db->update('medio_comunicacion',$dt);
			$this->db->where('rel_idmedio',$idm);
			$this->db->delete('medio_departamento');
			foreach ($dtchkbox as $iddpto)
			{
				$dtm=array('rel_idmedio'=>$idm,
						'rel_iddepartamento'=>$iddpto
						);
				$this->db->insert('medio_departamento', $dtm);
			}
		$this->db->trans_complete();
	}
	public function leerDepartamento()
	{
		$q = $this->db->get('departamento');
		return $q->result();	
	}
	public function leerTipoMedio()
	{
		$q = $this->db->get('tipo_medio');
		return $q->result();	
	}
	public function leerMedioPorId($idm)
	{
		$this->db->where('idmedio',$idm);
		$q = $this->db->get('medio_comunicacion');
		return $q->row();
	}
	public function leerDepartamentoMedioId($idm)
	{
		$this->db->select('rel_iddepartamento');
		$this->db->where('rel_idmedio',$idm);
		$q = $this->db->get('medio_departamento');
		return $q->result();
	}
	public function leerMedioComunicacion()
	{
		$sql="SELECT idmedio,nombre_medio,nombre_tipo FROM medio_comunicacion "
		."LEFT JOIN tipo_medio ON medio_comunicacion.rel_idtipomedio=tipo_medio.idtipomedio ";
		$q = $this->db->query($sql);
		return $q->result();
	}
	public function agregarTipoMedio($dt)
	{
		$this->db->insert('tipo_medio', $dt);
	}
	public function modificarTipoMedio($dt,$idtm)
	{
		$this->db->where('idtipomedio',$idtm);
		$this->db->update('tipo_medio',$dt);
	}
	public function leerTipoMedioPorId($idtm)
	{
		$this->db->where('idtipomedio',$idtm);
		$q=$this->db->get('tipo_medio');
		return $q->row();
	}
}
