<?php

class Cuestionario_model extends CI_Model
{
	private $_tipomedioID;
	private $_temaID;
	private $_departamentoID;
	private $_cuestionarioID;
	private $_usuarioID;
	private $_temaIDs = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Colocar el id del tipo de medio

	/**
	 * @param mixed $tipomedioID
	 * Colocar el id del tipo de medio
	 */
	public function setTipomedioID($tipomedioID)
	{
		$this->_tipomedioID = $tipomedioID;
	}

	//Colocar el id del tema
	public function setTemaID($temaID)
	{
		$this->_temaID = $temaID;
	}

	//Colocar el id del departamento
	public function setDepartamentoID($depID)
	{
		$this->_departamentoID = $depID;
	}

	public function setCuestionarioID($cuestID)
	{
		$this->_cuestionarioID = $cuestID;
	}

	public function setTemaIDs($temas)
	{
		$this->_temaIDs = $temas;
	}

	public function setUsuarioID($usuarioID)
	{
		$this->_usuarioID = $usuarioID;
	}

	//Leer todos los tipos de medios
	public function leerTodosTiposMedio()
	{
		$this->db->select(array('c.idtipomedio as tipo_id', 'c.nombre_tipo as tipo_nombre'));
		$this->db->from('tipo_medio as c');
		$this->db->order_by('tipo_nombre', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function leerMedios() {
		$sql = "SELECT medio_comunicacion.idmedio AS medio_id, medio_comunicacion.rel_idtipomedio, medio_comunicacion.nombre_medio AS medio_name "
			."FROM departamento "
			."RIGHT JOIN medio_departamento ON medio_departamento.rel_iddepartamento = departamento.iddepartamento "
			."RIGHT JOIN medio_comunicacion ON medio_comunicacion.idmedio = medio_departamento.rel_idmedio  "
			."RIGHT JOIN tipo_medio ON tipo_medio.idtipomedio = medio_comunicacion.rel_idtipomedio "
			."WHERE tipo_medio.idtipomedio = ? AND departamento.iddepartamento = ? ";
		$qry = $this->db->query($sql, [$this->_tipomedioID, $this->_departamentoID, ]);
		return $qry->result_array();

		/*$this->db->select(array('s.idmedio as medio_id', 's.rel_idtipomedio', 's.nombre_medio as medio_name'));
		$this->db->from('medio_comunicacion as s');
		$this->db->where('s.rel_idtipomedio', $this->_tipomedioID);
		$query = $this->db->get();
		return $query->result_array();*/
	}

	public function leerActor()
	{
		$query = $this->db->get('actor');
		return $query->result_array();
	}

	public function leerTema()
	{
		$sql = "SELECT tema.idtema, tema.nombre_tema "
			."FROM tema "
			."WHERE tema.rel_idcuestionario = ?  "
			."AND tema.activo = 1  ";
		/*$sql = "SELECT tema.idtema, tema.nombre_tema "
			."FROM groups AS g "
			."LEFT JOIN users_groups ON users_groups.group_id = g.id  "
			."LEFT JOIN users ON users.id = users_groups.user_id "
			."LEFT JOIN tema ON tema.rel_idusuario = users.id "
			."WHERE g.id = 1 AND tema.rel_idcuestionario = ?  ";*/
		$qry = $this->db->query($sql, [$this->_cuestionarioID,  ]);
		return $qry->result_array();

		/*$sql = "SELECT tema.idtema, tema.nombre_tema "
			."FROM tema "
			."WHERE tema.rel_idcuestionario = ?  ";
		$qry = $this->db->query($sql, [$this->_cuestionarioID,  ]);
		return $qry->result_array();*/
	}
	public function leerGrupoPorIdTema($idt)
	{
		$sql = "SELECT users_groups.group_id "
			."FROM tema "
			."LEFT JOIN users_groups ON tema.rel_idusuario = users_groups.user_id  "
			."WHERE tema.idtema =".$idt;
		$qry = $this->db->query($sql);
		return $qry->row();
	}
	public function leerGrupoPorSubTema($idt)
	{
		$sql = "SELECT users_groups.group_id "
			."FROM tema "
			."LEFT JOIN users_groups ON tema.rel_idusuario = user_groups.user_id  "
			."WHERE tema.idtema =".$idt;
		$qry = $this->db->query($sql);
		return $qry;
	}
	public function leerSubtema()
	{
		$sql = "SELECT s.idsubtema AS stema_id, s.nombre_subtema AS stema_name "
			."FROM subtema as s "
			."WHERE s.rel_idtema = ?  ";

		$qry = $this->db->query($sql, [$this->_temaID,  ]);
		return $qry->result_array();
		/*$this->db->select(array('s.idsubtema as stema_id', 's.rel_idtema', 's.nombre_subtema as stema_name'));
		$this->db->from('subtema as s');
		$this->db->where('s.rel_idtema', $this->_temaID);
		$query = $this->db->get();
		return $query->result_array();*/
	}

	public function leerDepartamento($iddep)
	{
		$sql = "SELECT d.iddepartamento, d.nombre_departamento "
			."FROM departamento AS d  "
			."WHERE d.iddepartamento = ?  ";
		$qry = $this->db->query($sql, [$iddep,  ]);
		return $qry->row();
	}

	public function leerTipoMedio($iddep)
	{
		$sql = "SELECT * "
			."FROM tipo_medio AS t   "
			."WHERE t.idtipomedio = ?  ";
		$qry = $this->db->query($sql, [$iddep,  ]);
		return $qry->row();
	}



	public function leerCuestionario($idcuestionario)
	{
		$qry = $this->db->get_where('cuestionario', [ 'idcuestionario' => $idcuestionario ]);
		return $qry->row();
	}

	public function leerTemaPorId($idt)
	{
		$this->db->where('idtema',$idt);
		$q= $this->db->get('tema');
		return $q->row();
	}
	public function leerSubTemaPorId($id)
	{
		$this->db->where('idsubtema',$id);
		$q= $this->db->get('subtema');
		return $q->row();
	}
	public function leerActorPorId($id)
	{
		$this->db->where('idactor',$id);
		$q= $this->db->get('actor');
		return $q->row();
	}
	public function leerMedioPorId($id)
	{
		$this->db->where('idmedio',$id);
		$q= $this->db->get('medio_comunicacion');
		return $q->row();
	}
	public function leerTipoMedioPorId($id)
	{
		$this->db->where('idtipomedio',$id);
		$q= $this->db->get('tipo_medio');
		return $q->row();
	}

	public function leerSubtemasPorIDs()
	{
		$sql = "SELECT * "
		."FROM tema as t  "
		."LEFT JOIN subtema ON subtema.rel_idtema = t.idtema  "
		."WHERE t.idtema = ?  ";
		$tema_subtema = array();


		foreach ($this->_temaIDs as $i=>$id)
		{
			if($id != 0)
			{
				$qry = $this->db->query($sql, [$id,  ]);
				$registro = $qry->result_array();

				$tema_subtema = array_merge($tema_subtema, $registro);
			}
		}
		return $tema_subtema;
	}

	public function leerTemasPorIDs()
	{
		$sql = "SELECT * "
			."FROM tema as t  "
			."WHERE t.idtema = ?  ";
		$tema_subtema = array();


		foreach ($this->_temaIDs as $i=>$id)
		{
			if($id != 0)
			{
				$qry = $this->db->query($sql, [$id,  ]);
				$registro = $qry->result_array();

				$tema_subtema = array_merge($tema_subtema, $registro);
			}
		}
		return $tema_subtema;
	}

	public function leerActoresPorIDs($actores)
	{
		$sql = "SELECT * "
			."FROM actor as ac  "
			."WHERE ac.idactor = ?  ";
		$tema_subtema = array();


		foreach ($actores as $i=>$id)
		{
			if($id != 0)
			{
				$qry = $this->db->query($sql, [$id,  ]);
				$registro = $qry->result_array();

				$tema_subtema = array_merge($tema_subtema, $registro);
			}
		}
		return $tema_subtema;
	}

	//Leer los estados de ley definidos
	public function leerEstadosDeLey()
	{
		$sql = "SELECT * "
			."FROM estadoley "
			."ORDER BY estadoley.porcentaje_estadoley ASC ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	//Leer por estado de ley definidos por id
	public function leerEstadosDeLeyID($id)
	{
		$sql = "SELECT * "
			."FROM estadoley "
			."WHERE estadoley.idestadoley = ? ";
		$qry = $this->db->query($sql, [$id, ]);
		return $qry->row();
	}

	//Leer las fuentes de la ley
	public function leerFuentesDeLey()
	{
		$sql = "SELECT * "
			."FROM fuente ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}
	public function leerLeyesIdUsuario($idu)
	{
		$sql="SELECT leyes.idleyes,leyes.fecha_registro,leyes.resumen,fuente.nombre_fuente FROM "
			."leyes_fuente "
			."LEFT JOIN leyes ON leyes_fuente.rel_idleyes=leyes.idleyes "
			."LEFT JOIN fuente ON leyes_fuente.rel_idfuente=fuente.idfuente "
			."WHERE leyes.rel_idusuario = ".$idu;
		$q=$this->db->query($sql);
        return $q->result();
	}

	public function leerLeyesEstadoIdUsuario()
	{
		$sql = "SELECT * "
			."FROM leyes AS l "
			."LEFT JOIN leyes_estadoley ON leyes_estadoley.rel_idleyes = l.idleyes "
			."LEFT JOIN estadoley ON estadoley.idestadoley = leyes_estadoley.rel_idestadoley "
			."WHERE l.rel_idusuario = ? "
			."ORDER BY estadoley.porcentaje_estadoley ASC";
		$qry = $this->db->query($sql);
		return $qry->result();
	}






}
