<?php
class Ley_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function leerLeyes()
    {
        $qry=$this->db->query("SELECT nombre_ley, nombre_estadoley, codigo_ley "
                . "FROM nombreley A "
                . "LEFT JOIN estadoley B "
                . "ON A.rel_idestadoley = B.idestadoley "
                . "LEFT JOIN codigoley C "
                . "ON C.rel_idestadoley = B.idestadoley "
                . "GROUP BY idnombreley");
        return $qry->result();
    }
    public function leerEstadoDeLeyes00()
    {
        $qry=$this->db->query("SELECT * "
                . "FROM estadoley "
                . "GROUP BY idestadoley");
        return $qry->result();
    }
    public function insertarEstadoDeLey($dtestado,$dttitulo,$dtcodigo,$dturl)
	{
		$this->db->trans_start();
		$this->db->insert('leyes_estadoley',$dtestado);
		$this->db->insert('nombreley',$dttitulo);
		$this->db->insert('codigoley',$dtcodigo);
		$this->db->insert('urlley',$dturl);
		$this->db->trans_complete();
	} 
	
	public function leerLeyPorId($idley)
	{
		$this->db->where('idleyes',$idley);
		$q=$this->db->get('leyes');
        return $q->row();
	}
	public function leerFuentes()
	{
		$q=$this->db->get('fuente');
		return $q->result();
	}
	public function leerFuenteLey($idl)
	{
		$this->db->where('rel_idleyes',$idl);
		$q=$this->db->get('leyes_fuente');
		return $q->row();
	}
	public function leerEstadosDeLey($idl)
	{
		$sql="SELECT leyes_estadoley.rel_idleyes,leyes_estadoley.rel_idestadoley,estadoley.nombre_estadoley,leyes_estadoley.fecha_estadoley FROM "
			."leyes_estadoley "
			."LEFT JOIN estadoley ON leyes_estadoley.rel_idestadoley=estadoley.idestadoley "
			."WHERE rel_idleyes =  ".$idl;
		$q=$this->db->query($sql);
        return $q->result();
	}
	public function leerEstadoLey($idl,$ide)
	{
		$this->db->where('rel_idleyes',$idl);
		$this->db->where('rel_idestadoley',$ide);
		$q=$this->db->get('leyes_estadoley');
		return $q->result();
	}
	public function leerEstadosEnLey($idl)
	{
		$this->db->where('rel_idleyes',$idl);
		$q=$this->db->get('leyes_estadoley');
		return $q->result();
	}
	public function leerNombreLeyIdEstado($idl,$ids)
	{
		$this->db->where('rel_idley',$idl);
		$this->db->where('rel_idestadoley',$ids);
		$q=$this->db->get('nombreley');
		return $q->row();
	}
	public function leerCodigoLeyIdEstado($idl,$ids)
	{
		$this->db->where('rel_idley',$idl);
		$this->db->where('rel_idestadoley',$ids);
		$q=$this->db->get('codigoley');
		return $q->row();
	}
	public function leerUrlLeyIdEstado($idl,$ids)
	{
		$this->db->where('rel_idley',$idl);
		$this->db->where('rel_idestadoley',$ids);
		$q=$this->db->get('urlley');
		return $q->row();
	}
	public function leerTemasCuestionario($idc)
	{
		$this->db->where('rel_idcuestionario',$idc);
		$q= $this->db->get('tema');
		return $q->result();
	}
	public function leerTemasLey($idl)
	{
		$sql = "SELECT DISTINCT tema.idtema,tema.nombre_tema "
			."FROM ley_subtema "
			."LEFT JOIN subtema ON ley_subtema.rel_idsubtema=subtema.idsubtema "
			."LEFT JOIN tema ON subtema.rel_idtema=tema.idtema "
			."WHERE ley_subtema.rel_idleyes = ".$idl;
		$qry = $this->db->query($sql);
		return $qry->result();
	}
	public function leerSubtemasLey($idl)
	{
		$sql = "SELECT subtema.idsubtema,subtema.nombre_subtema "
			."FROM ley_subtema "
			."LEFT JOIN subtema ON ley_subtema.rel_idsubtema=subtema.idsubtema "
			."WHERE ley_subtema.rel_idleyes = ".$idl;
		$qry = $this->db->query($sql);
		return $qry->result();
	}
	public function leerSubtemasPorTema($idt)
	{
		$this->db->where('rel_idtema',$idt);
		$q= $this->db->get('subtema');
		return $q->result();
	}
	public function leerOtroTemaLey($idley)
	{
		$sql = "SELECT otrotema.idotrotema,otrotema.nombre_otrotema,otrotema.rel_idcuestionario "
			."FROM ley_otrotema "
			."LEFT JOIN otrotema ON ley_otrotema.rel_idotrotema=otrotema.idotrotema "
			."WHERE ley_otrotema.rel_idleyes = ".$idley;
		$qry = $this->db->query($sql);
		return $qry->row();
	}
	public function leerOtroSubTemaLey($idley)
	{
		$sql = "SELECT otrosubtema.idotrosubtema,otrosubtema.nombre_otrosubtema,otrosubtema.rel_idtema "
			."FROM ley_otrosubtema "
			."LEFT JOIN otrosubtema ON ley_otrosubtema.rel_idotrosubtema=otrosubtema.idotrosubtema "
			."WHERE ley_otrosubtema.rel_idleyes = ".$idley;
		$qry = $this->db->query($sql);
		return $qry->row();
	}
	public function modificarFechaLey($idl,$f)
	{
		/*$this->db->set('fecha_ley',$f);
		$this->db->where('idleyes', $idl);
		$this->db->update('leyes');*/
	}
	public function modificarFuenteLey($idl,$idf)
	{
		$this->db->set('rel_idfuente',$idf);
		$this->db->where('rel_idleyes', $idl);
		$this->db->update('leyes_fuente');
	}

	public function leerAllLeyes()
	{
		$sql = "SELECT *"
			."FROM leyes AS l "
			."LEFT JOIN leyes_estadoley ON leyes_estadoley.rel_idleyes = l.idleyes "
			."LEFT JOIN estadoley ON estadoley.idestadoley = leyes_estadoley.rel_idestadoley ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	//Metodo para leer el estado de una ley
	public function leerEstadoDeLey($idley, $idestado)
	{
		$sql = "SELECT *     "
			."FROM leyes AS l    "
			."LEFT JOIN leyes_estadoley ON l.idleyes = leyes_estadoley.rel_idleyes   "
			."LEFT JOIN estadoley ON estadoley.idestadoley = leyes_estadoley.rel_idestadoley   "
			."LEFT JOIN codigoley ON codigoley.rel_idestadoley = estadoley.idestadoley AND codigoley.rel_idley = l.idleyes   "
			."WHERE l.idleyes = ? AND estadoley.idestadoley = ?   ";
		$qry = $this->db->query($sql, [$idley, $idestado, ]);
		return $qry->row();
	}

	public function leerUltimaDescripcion($idley, $idestado)
	{
		$this->db->where('rel_idley',$idley);
		$this->db->where('rel_idestadoley',$idestado);
		$qry=$this->db->get('nombreley');
		return $qry->row();
	}

	//Array ley y estados
	private function leyArray()
	{
		/** @noinspection PhpLanguageLevelInspection */
		$ley = [
			'idley' => ' ',
			'resumen' => ' ',
			'rel_idcuestionario' => ' ',
			'rel_idusuario' => ' ',
			'esta_activa ' => ' ',
			'tratamiento' => [],
			'sancionado' => [],
			'aprobado' => [],
			'modificacion' => [],
			'promulgada' => [],
		];
		return $ley;
	}


	public function leerLeyesEstado($idusuario)
	{
		$leyes_resultado = [];
		$ley = $this->leyArray();
		//Extraer las leyes definidas por el usuario
		$leyes_usuario = $this->Ley_model->leerLeyesIdUsuario($idusuario);

		foreach ($leyes_usuario as $lu)
		{
			$ley['idley'] = $lu->idleyes;
			$ley['resumen'] = $lu->resumen;
			$ley['descripcion'] = '';

			//$idley, $idestado
			$ley['tratamiento']  = $this->Ley_model->leerEstadoDeLey($ley['idley'], 1);
			$t = $this->Ley_model->leerUltimaDescripcion($ley['idley'], 1);
			$ley['sancionado']   = $this->Ley_model->leerEstadoDeLey($ley['idley'], 2);
			$s = $this->Ley_model->leerUltimaDescripcion($ley['idley'], 2);
			$ley['aprobado']     = $this->Ley_model->leerEstadoDeLey($ley['idley'], 3);
			$a = $this->Ley_model->leerUltimaDescripcion($ley['idley'], 3);
			$ley['modificacion'] = $this->Ley_model->leerEstadoDeLey($ley['idley'], 4);
			$m = $this->Ley_model->leerUltimaDescripcion($ley['idley'], 4);
			$ley['promulgada']    = $this->Ley_model->leerEstadoDeLey($ley['idley'], 5);
			$p = $this->Ley_model->leerUltimaDescripcion($ley['idley'], 5);

			if(isset($t))
			{
				$ley['descripcion'] = $t->nombre_ley;
			}
			if(isset($s))
			{
				$ley['descripcion'] = $s->nombre_ley;
			}
			if(isset($a))
			{
				$ley['descripcion'] = $a->nombre_ley;
			}
			if(isset($m))
			{
				$ley['descripcion'] = $m->nombre_ley;
			}
			if(isset($p))
			{
				$ley['descripcion'] = $p->nombre_ley;
			}

			$leyes_resultado[] = $ley;
		}
		return $leyes_resultado;
	}
	public function leerTodasLeyesEstado()
	{
		$leyes_resultado = [];
		$ley = $this->leyArray();
		//Extraer las leyes definidas por el usuario
		$leyes = $this->Ley_model->leerLeyesIdUsuario($idusuario);

		foreach ($leyes_usuario as $lu)
		{
			$ley['idley'] = $lu->idleyes;
			$ley['resumen'] = $lu->resumen;
			$ley['descripcion'] = '';

			//$idley, $idestado
			$ley['tratamiento']  = $this->Ley_model->leerEstadoDeLey($ley['idley'], 1);
			$t = $this->Ley_model->leerEstadoDeLey($ley['idley'], 1);
			$ley['sancionado']   = $this->Ley_model->leerEstadoDeLey($ley['idley'], 2);
			$s = $this->Ley_model->leerEstadoDeLey($ley['idley'], 2);
			$ley['aprobado']     = $this->Ley_model->leerEstadoDeLey($ley['idley'], 3);
			$a = $this->Ley_model->leerEstadoDeLey($ley['idley'], 3);
			$ley['modificacion'] = $this->Ley_model->leerEstadoDeLey($ley['idley'], 4);
			$m = $this->Ley_model->leerEstadoDeLey($ley['idley'], 4);
			$ley['promulgada']    = $this->Ley_model->leerEstadoDeLey($ley['idley'], 5);
			$p = $this->Ley_model->leerEstadoDeLey($ley['idley'], 5);

			if(isset($t))
			{
				$ley['descripcion'] = $t->nombre_estadoley;
			}
			if(isset($s))
			{
				$ley['descripcion'] = $s->nombre_estadoley;
			}
			if(isset($a))
			{
				$ley['descripcion'] = $a->nombre_estadoley;
			}
			if(isset($m))
			{
				$ley['descripcion'] = $m->nombre_estadoley;
			}
			if(isset($p))
			{
				$ley['descripcion'] = $p->nombre_estadoley;
			}

			$leyes_resultado[] = $ley;
		}
		return $leyes_resultado;
	}
	public function leerLeyeId($id)
	{
		$sql="SELECT leyes.idleyes,leyes.fecha_registro,leyes.resumen,fuente.nombre_fuente FROM "
			."leyes_fuente "
			."LEFT JOIN leyes ON leyes_fuente.rel_idleyes=leyes.idleyes "
			."LEFT JOIN fuente ON leyes_fuente.rel_idfuente=fuente.idfuente "
			."WHERE leyes.idleyes = ".$id;
		$q=$this->db->query($sql);
		return $q->result();
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
	public function leerTemaPorId($idt)
	{
		$this->db->where('idtema',$idt);
		$q= $this->db->get('tema');
		return $q->row();
	}

	//Leer todas las leyes y estado
	public function leerTodasLasLeyesEstado()
	{
		$leyes_resultado = [];
		$ley = $this->leyArray();
		//Extraer las leyes definidas por el usuario
		$leyes = $this->leerTodasLeyes();
		foreach ($leyes as $l)
		{
			$ley['idley'] = $l->idleyes;
			$ley['resumen'] = $l->resumen;
			$ley['esta_activa'] = $l->esta_activa;
			$ley['descripcion'] = '';

			//$idley, $idestado
			$ley['tratamiento']  = $this->Ley_model->leerEstadoDeLey($ley['idley'], 1);
			$t = $this->Ley_model->leerUltimaDescripcion($ley['idley'], 1);
			$ley['sancionado']   = $this->Ley_model->leerEstadoDeLey($ley['idley'], 2);
			$s = $this->Ley_model->leerUltimaDescripcion($ley['idley'], 2);
			$ley['aprobado']     = $this->Ley_model->leerEstadoDeLey($ley['idley'], 3);
			$a = $this->Ley_model->leerUltimaDescripcion($ley['idley'], 3);
			$ley['modificacion'] = $this->Ley_model->leerEstadoDeLey($ley['idley'], 4);
			$m = $this->Ley_model->leerUltimaDescripcion($ley['idley'], 4);
			$ley['promulgada']    = $this->Ley_model->leerEstadoDeLey($ley['idley'], 5);
			$p = $this->Ley_model->leerUltimaDescripcion($ley['idley'], 5);

			if(isset($t))
			{
				$ley['descripcion'] = $t->nombre_ley;
			}
			if(isset($s))
			{
				$ley['descripcion'] = $s->nombre_ley;
			}
			if(isset($a))
			{
				$ley['descripcion'] = $a->nombre_ley;
			}
			if(isset($m))
			{
				$ley['descripcion'] = $m->nombre_ley;
			}
			if(isset($p))
			{
				$ley['descripcion'] = $p->nombre_ley;
			}





			$leyes_resultado[] = $ley;
		}
		return $leyes_resultado;
	}

	public function leerTodasLeyes()
	{
		$sql="SELECT *   "
			."FROM leyes AS l   "
			."   "
			."   "
			."   ";
		$q=$this->db->query($sql);
		return $q->result();
	}

        	public function leerCuestionario($idcuestionario)
	{
		$qry = $this->db->get_where('cuestionario', [ 'idcuestionario' => $idcuestionario ]);
		return $qry->row();
	}



	public function leerInfoLeyPorId($identificador)
	{
		$idleyes = $identificador;
		$sql="SELECT *   "
			."FROM leyes   "
			."LEFT JOIN users ON leyes.rel_idusuario = users.id   "
			."LEFT JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento   "
			."LEFT JOIN universidad ON users.rel_iduniversidad = universidad.iduniversidad   "
			."WHERE leyes.idleyes = ?   ";
		$qry=$this->db->query($sql, [$idleyes, ]);
		return $qry->row();
	}

	public function leerFuentePorIdLey($identificador){
		$idleyes = $identificador;
		$sql="SELECT l.idleyes, fuente.idfuente, fuente.nombre_fuente   "
			."FROM leyes AS l    "
			."LEFT JOIN leyes_fuente ON l.idleyes = leyes_fuente.rel_idleyes   "
			."LEFT JOIN fuente ON leyes_fuente.rel_idfuente = fuente.idfuente   "
			."WHERE l.idleyes = ?   "
			."   ";
		$qry=$this->db->query($sql, [$idleyes, ]);
		return $qry->row();
	}

	public function leerEstadoPorcentajePorIdLey($identificador){
		$idleyes = $identificador;
		$sql="SELECT MAX(estadoley.porcentaje_estadoley) AS porcentaje  "
			."FROM leyes as l     "
			."LEFT JOIN leyes_estadoley ON l.idleyes = leyes_estadoley.rel_idleyes   "
			."LEFT JOIN estadoley ON estadoley.idestadoley = leyes_estadoley.rel_idestadoley   "
			."WHERE l.idleyes = ?   "
			."   ";
		$qry=$this->db->query($sql, [$idleyes, ]);
		return $qry->row();
	}

	public function leerEstadosPorLeyID($identificador)
	{
		$idley = $identificador;
		$ley = $this->leyArray();

		//Extraer las leyes definidas por el usuario
		$li = $this->leerInfoLeyPorId($idley);
		$ley['idley'] = $li->idleyes;
		$ley['resumen'] = $li->resumen;

		//$idley, $idestado
		$ley['tratamiento']  = $this->Ley_model->leerEstadoDeLey($ley['idley'], 1);
		$ley['sancionado']   = $this->Ley_model->leerEstadoDeLey($ley['idley'], 2);
		$ley['aprobado']     = $this->Ley_model->leerEstadoDeLey($ley['idley'], 3);
		$ley['modificacion'] = $this->Ley_model->leerEstadoDeLey($ley['idley'], 4);
		$ley['promulgada']    = $this->Ley_model->leerEstadoDeLey($ley['idley'], 5);

		return $ley;
	}

	//Metodo para leer el estado de una ley
	public function leerEstadoDeLeyURL($idley, $idestado)
	{
		$sql = "SELECT *      "
			."FROM leyes AS l       "
			."LEFT JOIN leyes_estadoley ON l.idleyes = leyes_estadoley.rel_idleyes      "
			."LEFT JOIN estadoley ON estadoley.idestadoley = leyes_estadoley.rel_idestadoley   "
			."LEFT JOIN urlley ON urlley.rel_idestadoley = estadoley.idestadoley AND urlley.rel_idley = l.idleyes   "
			."WHERE l.idleyes = ? AND estadoley.idestadoley = ?   ";
		$qry = $this->db->query($sql, [$idley, $idestado, ]);
		return $qry->row();
	}

	public function leerTemasDeLeyPorID($idley)
	{
		$sql = "SELECT l.idleyes, tema.idtema, tema.nombre_tema     "
			."FROM leyes AS l     "
			."LEFT JOIN ley_subtema ON l.idleyes = ley_subtema.rel_idleyes   "
			."LEFT JOIN subtema ON subtema.idsubtema = ley_subtema.rel_idsubtema   "
			."LEFT JOIN tema ON tema.idtema = subtema.rel_idtema   "
			."WHERE l.idleyes = ?   "
			."GROUP BY tema.idtema ";
		$qry = $this->db->query($sql, [$idley, ]);
		return $qry->result();

	}

	public function leerSubtemasDeLeyPorID($idley)
	{
		$sql = "SELECT *    "
			."FROM leyes AS l     "
			."LEFT JOIN ley_subtema ON l.idleyes = ley_subtema.rel_idleyes   "
			."LEFT JOIN subtema ON subtema.idsubtema = ley_subtema.rel_idsubtema   "
			."LEFT JOIN tema ON tema.idtema = subtema.rel_idtema   "
			."WHERE l.idleyes = ?   "
			."ORDER BY subtema.idsubtema ";
		$qry = $this->db->query($sql, [$idley, ]);
		return $qry->result();
	}

	public function leerOtrosTemasDeLeyPorID($idley)
	{
		$sql = "SELECT *    "
			."FROM leyes AS l      "
			."LEFT JOIN ley_otrotema ON ley_otrotema.rel_idleyes = l.idleyes   "
			."LEFT JOIN otrotema ON otrotema.idotrotema = ley_otrotema.rel_idotrotema   "
			."WHERE l.idleyes = ?   "
			."   "
			." ";
		$qry = $this->db->query($sql, [$idley, ]);
		return $qry->result();
	}

	public function leerOtrosSubTemasDeLeyPorID($idley)
	{
		$sql = "SELECT otrosubtema.idotrosubtema, otrosubtema.nombre_otrosubtema, tema.nombre_tema    "
			."FROM leyes AS l     "
			."LEFT JOIN ley_otrosubtema ON ley_otrosubtema.rel_idleyes = l.idleyes   "
			."LEFT JOIN otrosubtema ON otrosubtema.idotrosubtema = ley_otrosubtema.rel_idotrosubtema   "
			."LEFT JOIN tema ON tema.idtema = otrosubtema.rel_idtema   "
			."WHERE l.idleyes = ?   "
			."   ";
		$qry = $this->db->query($sql, [$idley, ]);
		return $qry->result();
	}
	public function modificarResumenLey($idleyes,$res)
	{
		$dt=array('resumen'=>$res);
		$this->db->where('idleyes', $idleyes);
		$this->db->update('leyes', $dt);
	}
	public function modificarDatosLey($dte,$dtf,$dtt,$dtc,$dtu)
	{	$idley=$dte['rel_idleyes'];
		$idestadoley=$dte['rel_idestadoley'];
		$this->db->trans_start();
		$this->db->where('rel_idleyes',$idley);
		$this->db->where('rel_idestadoley', $idestadoley);
		$this->db->update('leyes_estadoley', $dtf);
		$this->db->where('rel_idley',$idley);
		$this->db->where('rel_idestadoley', $idestadoley);
		$this->db->update('nombreley', $dtt);
		$this->db->where('rel_idley',$idley);
		$this->db->where('rel_idestadoley', $idestadoley);
		$this->db->update('codigoley', $dtc);
		$this->db->where('rel_idley',$idley);
		$this->db->where('rel_idestadoley', $idestadoley);
		$this->db->update('urlley', $dtu);
		$this->db->trans_complete();
	}
	public function leerTodoSubTemas()
	{
		$q= $this->db->get('subtema');
		return $q->result();
	}
	public function leerTodoTemas()
	{
		$q= $this->db->get('tema');
		return $q->result();
	}
	public function modificarSubTemasLey($idn,$dtchkboxst,$dtsotrotema,$dtotrosubtemas)
	{
		$this->db->trans_start();
			if (count($dtsotrotema)!=0)
			{
				$this->db->where('rel_idleyes',$idn);
				$not=count($this->db->get('ley_otrotema')->result());
				if ($not==0)
				{
					//echo "inserta otro tema";
					//echo "<br><br>";
					$this->db->insert('otrotema',$dtsotrotema);
					$idotrotema=$this->db->insert_id();
					$dtot=array('rel_idleyes'=>$idn,
							'rel_idotrotema'=>$idotrotema
							);
					$this->db->insert('ley_otrotema',$dtot);
				}
				else
				{
					//echo "edita otro tema";
					//echo "<br><br>";
					$this->db->where('rel_idleyes',$idn);
					$ot=$this->db->get('ley_otrotema')->row();
					$this->db->set('nombre_otrotema',$dtsotrotema['nombre_otrotema']);
					$this->db->where('idotrotema',$ot->rel_idotrotema);
					$this->db->update('otrotema');
				}
			}
			else
			{
				$this->db->where('rel_idleyes',$idn);
				$not=count($this->db->get('ley_otrotema')->result());
				if ($not!=0)
				{
					//echo "borra otro tema";
					//echo "<br><br>";
					$this->db->where('rel_idleyes',$idn);
					$ot=$this->db->get('ley_otrotema')->row();
					$idot=$ot->rel_idotrotema;
					$this->db->where('rel_idleyes',$idn);
					$this->db->delete('ley_otrotema');
					$this->db->where('idotrotema',$idot);
					$this->db->delete('otrotema');					
				}
				else
				{
					//echo "sin accion en otro tema";
					//echo "<br><br>";
				}
			}
		
			if (count($dtchkboxst)!=0)
			{
				//echo "remplaza subtemas";
				//echo "<br><br>";
				$this->db->where('rel_idleyes',$idn);
				$this->db->delete('ley_subtema');
				foreach ($dtchkboxst as $idst)
				{
					$dtst=array('rel_idleyes'=>$idn,
							'rel_idsubtema'=>$idst
							);
					$this->db->insert('ley_subtema',$dtst);
				}
			}
			else 
			{
				//echo "borra subtemas";
				//echo "<br><br>";
				$this->db->where('rel_idleyes',$idn);
				$nst=count($this->db->get('ley_subtema')->result());
				if ($nst!=0)
				{
					$this->db->where('rel_idleyes',$idn);
					$this->db->delete('ley_subtema');
				}
			}
			if (count($dtotrosubtemas)!=0)
			{
				$this->db->where('rel_idleyes',$idn);
				$nost=count($this->db->get('ley_otrosubtema')->result());
				if ($nost!=0)
				{
					//echo "replaza otro subtemas";
					//echo "<br><br>";
					$this->db->where('rel_idleyes',$idn);
					$otrost=$this->db->get('ley_otrosubtema')->result();
					foreach ($otrost as $ost)
					{
						$idost=$ost->rel_idotrosubtema;
						$this->db->where('rel_idotrosubtema',$idost);
						$this->db->delete('ley_otrosubtema');	
						$this->db->where('idotrosubtema',$idost);
						$this->db->delete('otrosubtema');
					}
					foreach ($dtotrosubtemas as $dtost)
					{
						$this->db->insert('otrosubtema',$dtost);
						$idotrosubtema=$this->db->insert_id();
						$dtnost=array('rel_idleyes'=>$idn,
										'rel_idotrosubtema'=>$idotrosubtema);
						$this->db->insert('ley_otrosubtema',$dtnost);
					}
				}
				else
				{
					//echo "inserta otro subtemas";
					//echo "<br><br>";
					foreach ($dtotrosubtemas as $dtost)
					{
						$this->db->insert('otrosubtema',$dtost);
						$idotrosubtema=$this->db->insert_id();
						$dtnost=array('rel_idleyes'=>$idn,
										'rel_idotrosubtema'=>$idotrosubtema);
						$this->db->insert('ley_otrosubtema',$dtnost);
					}
				}
			}
			else 
			{
				$this->db->where('rel_idleyes',$idn);
				$nost=count($this->db->get('ley_otrosubtema')->result());
				if ($nost!=0)
				{
					//echo "borra otro subtemas";
					//echo "<br><br>";
					$this->db->where('rel_idleyes',$idn);
					$otrost=$this->db->get('ley_otrosubtema')->result();
					foreach ($otrost as $ost)
					{
						$idost=$ost->rel_idotrosubtema;
						$this->db->where('rel_idotrosubtema',$idost);
						$this->db->delete('ley_otrosubtema');	
						$this->db->where('idotrosubtema',$idost);
						$this->db->delete('otrosubtema');
					}
				}
				else
				{
					//echo "sin accion subtemas";
					//echo "<br><br>";
				}
			}
		$this->db->trans_complete();
	}

	//Leer todas las leyes y estado
	public function leerTodasLasLeyesEstadoReporte()
	{
		$leyes_resultado = [];
		$ley = $this->leyArray();
		//Extraer las leyes definidas por el usuario
		$leyes = $this->leerTodasLeyes();
		foreach ($leyes as $l)
		{
			$ley['idley'] = $l->idleyes;
			$ley['resumen'] = $l->resumen;
			$ley['descripcion'] = '';

			//$idley, $idestado
			$ley['tratamiento']  = $this->Ley_model->leerEstadoDeLey($ley['idley'], 1);
			$t = $this->Ley_model->leerUltimaDescripcion($ley['idley'], 1);
			$ley['sancionado']   = $this->Ley_model->leerEstadoDeLey($ley['idley'], 2);
			$s = $this->Ley_model->leerUltimaDescripcion($ley['idley'], 2);
			$ley['aprobado']     = $this->Ley_model->leerEstadoDeLey($ley['idley'], 3);
			$a = $this->Ley_model->leerUltimaDescripcion($ley['idley'], 3);
			$ley['modificacion'] = $this->Ley_model->leerEstadoDeLey($ley['idley'], 4);
			$m = $this->Ley_model->leerUltimaDescripcion($ley['idley'], 4);
			$ley['promulgada']    = $this->Ley_model->leerEstadoDeLey($ley['idley'], 5);
			$p = $this->Ley_model->leerUltimaDescripcion($ley['idley'], 5);

			if(isset($t))
			{
				$ley['descripcion'] = $t->nombre_ley;
			}
			if(isset($s))
			{
				$ley['descripcion'] = $s->nombre_ley;
			}
			if(isset($a))
			{
				$ley['descripcion'] = $a->nombre_ley;
			}
			if(isset($m))
			{
				$ley['descripcion'] = $m->nombre_ley;
			}
			if(isset($p))
			{
				$ley['descripcion'] = $p->nombre_ley;
			}
			$leyes_resultado[] = $ley;
		}
		return $leyes_resultado;
	}

	public function leerLeyesReporte($parametros)
	{
		//Solo la fecha de la noticia
		$consulta = $parametros;
		//Array de placeholders
		$placeholder = [];

		$sql = "SELECT *  "
			."FROM leyes as l  "
			."LEFT JOIN leyes_estadoley ON leyes_estadoley.rel_idleyes = l.idleyes  "
			."LEFT JOIN estadoley ON estadoley.idestadoley = leyes_estadoley.rel_idestadoley  "
			."LEFT JOIN nombreley ON nombreley.rel_idestadoley = estadoley.idestadoley AND nombreley.rel_idley = l.idleyes  "
			."LEFT JOIN codigoley ON codigoley.rel_idley = l.idleyes AND codigoley.rel_idestadoley = estadoley.idestadoley  "
			."LEFT JOIN urlley ON urlley.rel_idestadoley = estadoley.idestadoley AND urlley.rel_idley = l.idleyes  "
			."LEFT JOIN users ON l.rel_idusuario = users.id  "
			."LEFT JOIN universidad ON users.rel_iduniversidad = universidad.iduniversidad  "
			."LEFT JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento  "
			."LEFT JOIN ley_subtema ON ley_subtema.rel_idleyes = l.idleyes  "
			."LEFT JOIN subtema ON subtema.idsubtema = ley_subtema.rel_idsubtema  "
			."LEFT JOIN tema ON subtema.rel_idtema = tema.idtema  "
			."LEFT JOIN leyes_fuente ON leyes_fuente.rel_idleyes = l.idleyes "
			."LEFT JOIN fuente ON fuente.idfuente = leyes_fuente.rel_idfuente "
			."WHERE l.fecha_registro BETWEEN ? AND ?  "
			."AND l.esta_activa = 1  " ;

		/** @noinspection PhpLanguageLevelInspection */

		//Añadir el intervalo de fechas al placeholder
		array_push($placeholder, $consulta->fecha_inicio);
		array_push($placeholder, $consulta->fecha_fin);

		//Añadir el resto de los discriminantes
		if($consulta->idestadoley !=0)
		{
			$sql .= "AND  estadoley.idestadoley = ?  ";
			array_push($placeholder, $consulta->idestadoley);
		}
		if($consulta->iduniversidad !=0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND universidad.iduniversidad = ?  ";
			array_push($placeholder, $consulta->iduniversidad );
		}
		if ($consulta->idtema != 0 )
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND tema.idtema = ?   ";
			array_push($placeholder, $consulta->idtema);
		}
		if ($consulta->idsubtema !=0 )
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND subtema.idsubtema = ?  ";
			array_push($placeholder, $consulta->idsubtema);
		}
		$sql .= 'ORDER BY l.idleyes ASC  ';
		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}

	public function leerLeyesReporteOtrosTemas($parametros)
	{
		//Solo la fecha de la noticia
		$consulta = $parametros;
		//Array de placeholders
		$placeholder = [];

		$sql = "SELECT *  "
			."FROM leyes as l  "
			."LEFT JOIN leyes_estadoley ON leyes_estadoley.rel_idleyes = l.idleyes  "
			."LEFT JOIN estadoley ON estadoley.idestadoley = leyes_estadoley.rel_idestadoley  "
			."LEFT JOIN nombreley ON nombreley.rel_idestadoley = estadoley.idestadoley AND nombreley.rel_idley = l.idleyes  "
			."LEFT JOIN codigoley ON codigoley.rel_idley = l.idleyes AND codigoley.rel_idestadoley = estadoley.idestadoley  "
			."LEFT JOIN urlley ON urlley.rel_idestadoley = estadoley.idestadoley AND urlley.rel_idley = l.idleyes  "
			."LEFT JOIN users ON l.rel_idusuario = users.id  "
			."LEFT JOIN universidad ON users.rel_iduniversidad = universidad.iduniversidad  "
			."LEFT JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento  "
			."LEFT JOIN ley_otrotema ON ley_otrotema.rel_idleyes = l.idleyes  "
			."LEFT JOIN otrotema ON otrotema.idotrotema = ley_otrotema.rel_idotrotema  "
			."WHERE l.fecha_registro BETWEEN ? AND ?  "
			."AND l.esta_activa = 1 ";

		/** @noinspection PhpLanguageLevelInspection */

		//Añadir el intervalo de fechas al placeholder
		array_push($placeholder, $consulta->fecha_inicio);
		array_push($placeholder, $consulta->fecha_fin);

		//Añadir el resto de los discriminantes
		if($consulta->idestadoley !=0)
		{
			$sql .= "AND  estadoley.idestadoley = ?  ";
			array_push($placeholder, $consulta->idestadoley);
		}
		if($consulta->iduniversidad !=0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND universidad.iduniversidad = ?  ";
			array_push($placeholder, $consulta->iduniversidad );
		}

		$sql .= 'ORDER BY l.idleyes ASC  ';
		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}

	public function leerLeyesReporteOtrosSubtemas($parametros)
	{
		//Solo la fecha de la noticia
		$consulta = $parametros;
		//Array de placeholders
		$placeholder = [];

		$sql = "SELECT *  "
			."FROM leyes as l  "
			."LEFT JOIN leyes_estadoley ON leyes_estadoley.rel_idleyes = l.idleyes  "
			."LEFT JOIN estadoley ON estadoley.idestadoley = leyes_estadoley.rel_idestadoley  "
			."LEFT JOIN nombreley ON nombreley.rel_idestadoley = estadoley.idestadoley AND nombreley.rel_idley = l.idleyes  "
			."LEFT JOIN codigoley ON codigoley.rel_idley = l.idleyes AND codigoley.rel_idestadoley = estadoley.idestadoley  "
			."LEFT JOIN urlley ON urlley.rel_idestadoley = estadoley.idestadoley AND urlley.rel_idley = l.idleyes  "
			."LEFT JOIN users ON l.rel_idusuario = users.id  "
			."LEFT JOIN universidad ON users.rel_iduniversidad = universidad.iduniversidad  "
			."LEFT JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento  "
			."LEFT JOIN ley_otrosubtema ON ley_otrosubtema.rel_idleyes = l.idleyes  "
			."LEFT JOIN otrosubtema ON otrosubtema.idotrosubtema = ley_otrosubtema.rel_idotrosubtema  "
			."LEFT JOIN tema ON otrosubtema.rel_idtema = tema.idtema  "
			."WHERE l.fecha_registro BETWEEN ? AND ?  "
			."AND l.esta_activa = 1  ";

		/** @noinspection PhpLanguageLevelInspection */

		//Añadir el intervalo de fechas al placeholder
		array_push($placeholder, $consulta->fecha_inicio);
		array_push($placeholder, $consulta->fecha_fin);

		//Añadir el resto de los discriminantes
		if($consulta->idestadoley !=0)
		{
			$sql .= "AND  estadoley.idestadoley = ?  ";
			array_push($placeholder, $consulta->idestadoley);
		}
		if($consulta->iduniversidad !=0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND universidad.iduniversidad = ?  ";
			array_push($placeholder, $consulta->iduniversidad );
		}
		if ($consulta->idtema != 0 )
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND tema.idtema = ?   ";
			array_push($placeholder, $consulta->idtema);
		}
		$sql .= 'ORDER BY l.idleyes ASC  ';
		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}


	//Funcion para la creacion de nuevos registros de ley
	public function crearLey($ley){
		/*
		 *
		 * INICIAR LA TRANSACCION
		 */
		$this->db->trans_start();
		//Insertar el registro en tabla leyes
		/** @noinspection PhpLanguageLevelInspection */
		$tabla_leyes = [
			'fecha_registro' => $ley->fecha_registro ,
			'resumen' => $ley->resumen,
			'rel_idcuestionario' => $ley->rel_idcuestionario,
			'rel_idusuario' => $ley->rel_idusuario,
		];
		$this->db->insert('leyes', $tabla_leyes);
		$ley_id = $this->db->insert_id();

		//insertar el codigo de la ley
		/** @noinspection PhpLanguageLevelInspection */
		$tabla_codigo_ley = [
			'codigo_ley' => $ley->codigo,
			'rel_idley' => $ley_id,
			'rel_idestadoley' => $ley->estado,
		];
		$this->db->insert('codigoley', $tabla_codigo_ley);
		$codigo_id = $this->db->insert_id();

		//Insertar el nombre de la ley
		/** @noinspection PhpLanguageLevelInspection */
		$tabla_nombre_ley = [
			'nombre_ley' => $ley->titulo,
			'rel_idestadoley' => $ley->estado,
			'rel_idley' => $ley_id,
		];
		$this->db->insert('nombreley', $tabla_nombre_ley);
		$nombre_ley_id = $this->db->insert_id();


		//insertar el estado en q se encuentra la ley
		/** @noinspection PhpLanguageLevelInspection */
		$tabla_leyes_estadoley = [
			'rel_idleyes' => $ley_id,
			'rel_idestadoley' => $ley->estado,
			'fecha_estadoley ' => $ley->fecha_ley,
		];
		$this->db->insert('leyes_estadoley', $tabla_leyes_estadoley);

		//Insertar la fuente de la ley
		/** @noinspection PhpLanguageLevelInspection */
		$tabla_leyes_fuente = [
			'rel_idleyes' => $ley_id,
			'rel_idfuente' => $ley->fuente,
		];
		$this->db->insert('leyes_fuente', $tabla_leyes_fuente);

		//Insertar la URL del estado de la ley
		/** @noinspection PhpLanguageLevelInspection */
		$tabla_urlley = [
			'url_ley' => $ley->url_ley,
			'rel_idley' => $ley_id,
			'rel_idestadoley' => $ley->estado,
		];
		$this->db->insert('urlley', $tabla_urlley);


		//Insertar otro tema
		//Insertar subtema
		//insertar otrosubtema
		$temas = $ley->temas;
		$subtemas = $ley->subtemas;
		$otrossubtemas = $ley->otros_subtemas;
		$otrotema = $ley->otro_tema;

		foreach ($temas as $t)
		{
			$idtema = $t;
			if($idtema!=0)
			{
				$sub_temas = $subtemas[$idtema];
				foreach ($sub_temas as $st)
				{
					$idsubtema = $st;
					if($idsubtema!=0){
						//Insertar la relacion noticia subtema
						/** @noinspection PhpLanguageLevelInspection */
						$tabla_ley_subtema = [
							'rel_idleyes' => $ley_id,
							'rel_idsubtema' => $idsubtema,
						];
						$this->db->insert('ley_subtema', $tabla_ley_subtema);

					}else{
						//Insertar el otro subtema
						/** @noinspection PhpLanguageLevelInspection */
						$tabla_otrosubtema = [
							'nombre_otrosubtema' => $otrossubtemas[$idtema],
							'rel_idtema' => $idtema,
						];
						$this->db->insert('otrosubtema', $tabla_otrosubtema);
						$otro_subtema_id = $this->db->insert_id();

						//Relacion de otrosubtema con la ley
						/** @noinspection PhpLanguageLevelInspection */
						$tabla_ley_otrosubtema = [
							'rel_idleyes' => $ley_id,
							'rel_idotrosubtema '=>$otro_subtema_id,
						];
						$this->db->insert('ley_otrosubtema', $tabla_ley_otrosubtema);

					}
				}
			}else{
				//Insertar otro tema
				/** @noinspection PhpLanguageLevelInspection */
				$tabla_otrotema = [
					'nombre_otrotema' => $otrotema,
					'rel_idcuestionario' => $ley->rel_idcuestionario,
					'rel_idusuario' => $ley->rel_idusuario,
				];
				$this->db->insert('otrotema', $tabla_otrotema);
				$otro_tema_id = $this->db->insert_id();

				//Relacion de otro con la ley
				/** @noinspection PhpLanguageLevelInspection */
				$tabla_ley_otrotema =[
					'rel_idleyes' => $ley_id,
					'rel_idotrotema' => $otro_tema_id,
				];
				$this->db->insert('ley_otrotema', $tabla_ley_otrotema);
			}
		}

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}

	}

	//Leer la fuente por identificador para impresion
	public function leerFuentePorID($idfuente)
	{
		$sql = "SELECT *     "
			."FROM fuente  "
			."WHERE fuente.idfuente = ?  "
			."  "
			."   ";
		$qry = $this->db->query($sql, [$idfuente, ]);
		return $qry->row();
	}

	//Cambiar el estado de una ley
	public function cambiarEstadoLey($identificador, $estado)
	{
		/** @noinspection PhpLanguageLevelInspection */
		$data = [
			'esta_activa' => $estado,
		];
		$this->db->where('idleyes', $identificador);
		$this->db->update('leyes', $data);
	}






}
