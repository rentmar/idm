<?php
class Noticia_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function insertarNoticia($DatosNoticia)
    {
		$this->db->insert('noticia',$DatosNoticia);
    }
	public function insertarOtroTema($dtot,$ost)
	{
		$this->db->trans_start();
			$this->db->insert('tema',$dtot);
			$idtema=$this->db->insert_id();
		/** @noinspection PhpLanguageLevelInspection */
		$datoOtroSubTema=[
			   'nombre_subtema'=>$ost,
			   'rel_idtema'=>$idtema];
			$this->db->insert('subtema',$datoOtroSubTema);
			$q=$this->db->insert_id();
		$this->db->trans_complete();
		return $q;
	}
	public function leerNoticiaPorId($idnoticia)
	{
		$this->db->where('idnoticia',$idnoticia);
		$q= $this->db->get('noticia');
		return $q->row();
	}
	public function leerTodoActores()
	{
		$q= $this->db->get('actor');
		return $q->result();
	}
	public function leerTipos()
	{
		$q= $this->db->get('tipo_medio');
		return $q->result();
	}
	public function leerMedioPorId($idm)
	{
		$this->db->where('idmedio',$idm);
		$q= $this->db->get('medio_comunicacion');
		return $q->row();
	}
	public function leerMediosPorTipoDepartamento($idtipo,$iddep)
	{
		$sql = "SELECT medio_comunicacion.idmedio,medio_comunicacion.nombre_medio "
			."FROM medio_departamento "
			."LEFT JOIN medio_comunicacion ON medio_departamento.rel_idmedio=medio_comunicacion.idmedio "
			."WHERE medio_departamento.rel_iddepartamento = ".$iddep." AND rel_idtipomedio =".$idtipo;
		$qry = $this->db->query($sql);
		return $qry->result();
	}
	public function leerNoticiaMedioPorId($idnoticia)
	{
		$this->db->where('rel_idnoticia',$idnoticia);
		$q= $this->db->get('noticia_medio');
		return $q->row();
	}
	public function leerSubtemasNoticia($idn)
	{
		$sql = "SELECT subtema.idsubtema,subtema.nombre_subtema "
			."FROM noticia_subtema "
			."LEFT JOIN subtema ON noticia_subtema.rel_idsubtema=subtema.idsubtema "
			."WHERE noticia_subtema.rel_idnoticia = ".$idn;
		$qry = $this->db->query($sql);
		return $qry->result();
	}
	public function leerTemasNoticia($idn)
	{
		$sql = "SELECT DISTINCT tema.idtema,tema.nombre_tema "
			."FROM noticia_subtema "
			."LEFT JOIN subtema ON noticia_subtema.rel_idsubtema=subtema.idsubtema "
			."LEFT JOIN tema ON subtema.rel_idtema=tema.idtema "
			."WHERE noticia_subtema.rel_idnoticia = ".$idn;
		$qry = $this->db->query($sql);
		return $qry->result();
	}
	public function leerSubtemasPorTema($idt)
	{
		$this->db->where('rel_idtema',$idt);
		$q= $this->db->get('subtema');
		return $q->result();
	}
	public function leerTemasCuestionario($idc)
	{
		$this->db->where('rel_idcuestionario',$idc);
		$q= $this->db->get('tema');
		return $q->result();
	}
	public function leerTemaPorSubtema($ids)
	{
		$this->db->where('idsubtema',$ids);
		$q= $this->db->get('subtema');
		return $q->row();
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
	public function leerTemaPorId($idt)
	{
		$this->db->where('idtema',$idt);
		$q= $this->db->get('tema');
		return $q->row();
	}
	public function leerOtroTemaNoticia($idnoticia)
	{
		$sql = "SELECT otrotema.idotrotema,otrotema.nombre_otrotema,otrotema.rel_idcuestionario "
			."FROM noticia_otrotema "
			."LEFT JOIN otrotema ON noticia_otrotema.rel_idotrotema=otrotema.idotrotema "
			."WHERE noticia_otrotema.rel_idnoticia = ".$idnoticia;
		$qry = $this->db->query($sql);
		return $qry->row();
	}
	public function leerOtroSubTemaNoticia($idnoticia)
	{
		$sql = "SELECT otrosubtema.idotrosubtema,otrosubtema.nombre_otrosubtema,otrosubtema.rel_idtema "
			."FROM noticia_otrosubtema "
			."LEFT JOIN otrosubtema ON noticia_otrosubtema.rel_idotrosubtema=otrosubtema.idotrosubtema "
			."WHERE noticia_otrosubtema.rel_idnoticia = ".$idnoticia;
		$qry = $this->db->query($sql);
		return $qry->row();
	}
	public function leerNoticiaActores($idn)
	{
		$this->db->where('rel_idnoticia',$idn);
		$q= $this->db->get('noticia_actor');
		return $q->result();
	}
	public function leerNoticiasUsuario($idusuario,$idcuestionario)
	{
		$sql = "SELECT idnoticia,fecha_registro,fecha_noticia,titular,nombre_medio "
			."FROM noticia "
			."LEFT JOIN medio_comunicacion ON noticia.rel_idmedio=medio_comunicacion.idmedio "
			."WHERE noticia.rel_idusuario = ".$idusuario." AND noticia.rel_idcuestionario=".$idcuestionario;
		$qry = $this->db->query($sql);
		return $qry->result();
	}
	//Extrae una noticia por su identificador
	public function leerNoticiaID($idnoticia){
		$sql = "SELECT * "
			."FROM noticia AS n  "
			."LEFT JOIN medio_comunicacion ON medio_comunicacion.idmedio = n.rel_idmedio  "
			."WHERE n.idnoticia = ?  ";
		$qry = $this->db->query($sql, [$idnoticia,  ]);
		return $qry->row();
	}
	public function modificarNoticia($idn,$dts)
	{
		$this->db->where('idnoticia', $idn);
		$this->db->update('noticia', $dts);
	}

	public function crearNoticia($noticia)
	{
		/*
		 *
		 * INICIAR LA TRANSACCION
		 */
		$this->db->trans_begin();
		//Insertar la noticia
		/** @noinspection PhpLanguageLevelInspection */
		$ntc = [
			'fecha_registro' => time() ,
			'fecha_noticia' => $noticia->fecha_noticia ,
			'titular' => $noticia->titular,
			'resumen' => $noticia->resumen,
			'url_noticia' => $noticia->url_noticia,
			//'rel_idsubtema' => 1, //Campo de compatibilidad
			'rel_idmedio' => $noticia->rel_idmedio,
			'rel_idusuario' => $noticia->rel_idusuario,
			'rel_idcuestionario' => $noticia->rel_idcuestionario,
		];
		$this->db->insert('noticia', $ntc);
		$noticia_id = $this->db->insert_id();

		//Insertar actores
		$actrs = $noticia->actores;

		foreach ($actrs as $a){
			/** @noinspection PhpLanguageLevelInspection */
			$actores = [
				'rel_idnoticia' => $noticia_id ,
				'rel_idactor' => $a,
			];
			$this->db->insert('noticia_actor', $actores);
		}
		//Insertar otro tema
		//Insertar subtema
		//insertar otrosubtema
		$temas = $noticia->temas;
		$subtemas = $noticia->subtemas;
		$otrossubtemas = $noticia->otros_subtemas;
		$otrotema = $noticia->otro_tema;

		foreach ($temas as $t)
		{
			//Tema es una bandera
			$idtema = $t;
			if($idtema!=0)
			{
				$stemas = $subtemas[$idtema];
				foreach ($stemas as $st)
				{
					$idsubtema = $st;
					if($idsubtema!=0)
					{
						//Insertar la relacion noticia subtema
						//echo $idsubtema." / ";
						/** @noinspection PhpLanguageLevelInspection */
						$not_subt = [
							'rel_idnoticia' => $noticia_id,
							'rel_idsubtema' => $idsubtema,
						];
						$this->db->insert('noticia_subtema', $not_subt);
					}else{
						//echo "insertar otro subtema: ".$otrossubtemas[$idtema];
						//Insertar el otro subtema
						/** @noinspection PhpLanguageLevelInspection */
						$ot_st = [
							'nombre_otrosubtema' => $otrossubtemas[$idtema],
							'rel_idtema' => $idtema,
						];
						$this->db->insert('otrosubtema', $ot_st);
						$otro_st_id = $this->db->insert_id();
						//Relacion de otrosubtema con la noticia
						/** @noinspection PhpLanguageLevelInspection */
						$not_ost = [
							'rel_idnoticia' => $noticia_id,
							'rel_idotrosubtema '=>$otro_st_id,
						];
						$this->db->insert('noticia_otrosubtema', $not_ost);
					}
				}

			}else{
				//Insertar otro tema
				//echo "Registrar otro tema: ".$otrotema;
				/** @noinspection PhpLanguageLevelInspection */
				$ot = [
					'nombre_otrotema' => $otrotema,
					'rel_idcuestionario' => $noticia->rel_idcuestionario,
					'rel_idusuario' => $noticia->rel_idusuario,
				];
				$this->db->insert('otrotema', $ot);
				$otro_tema_id = $this->db->insert_id();
				//Relacion de otro con la noticia
				/** @noinspection PhpLanguageLevelInspection */
				$not_ot =[
					'rel_idnoticia' => $noticia_id,
					'rel_idotrotema' => $otro_tema_id,
				];
				$this->db->insert('noticia_otrotema', $not_ot);
			}
		}



		if ($this->db->trans_status() === FALSE){
			//Hubo errores en la consulta, entonces se cancela la transacción.
			$this->db->trans_rollback();
			return false;
		}else{
			//Todas las consultas se hicieron correctamente.
			$this->db->trans_commit();
			return true;
		}


	}

	//Extraer actores de una noticia
	public function leerActores($idnoticia)
	{
		$sql = "SELECT * "
			."FROM noticia AS n  "
			."LEFT JOIN noticia_actor ON noticia_actor.rel_idnoticia = n.idnoticia  "
			."LEFT JOIN actor ON actor.idactor = noticia_actor.rel_idactor  "
			."WHERE n.idnoticia = ?   ";
		$qry = $this->db->query($sql, [$idnoticia,  ]);
		return $qry->result();
	}

	//Extraer temas de una noticia
	public function leerTemas($idnoticia)
	{
		$sql = "SELECT DISTINCT tema.idtema, tema.nombre_tema "
			."FROM noticia AS n  "
			."LEFT JOIN noticia_subtema ON noticia_subtema.rel_idnoticia = n.idnoticia  "
			."LEFT JOIN subtema ON subtema.idsubtema = noticia_subtema.rel_idsubtema  "
			."LEFT JOIN tema ON tema.idtema = subtema.rel_idtema  "
			."WHERE n.idnoticia = ?   ";
		$qry = $this->db->query($sql, [$idnoticia,  ]);
		return $qry->result();
	}

	//Extraer los subtemas de la noticia
	public function leerSubtemas($idnoticia)
	{
		$sql = "SELECT *   "
			."FROM noticia AS n   "
			."LEFT JOIN noticia_subtema ON noticia_subtema.rel_idnoticia = n.idnoticia   "
			."LEFT JOIN subtema ON subtema.idsubtema = noticia_subtema.rel_idsubtema  "
			."WHERE n.idnoticia = ?   ";
		$qry = $this->db->query($sql, [$idnoticia,  ]);
		return $qry->result();
	}

	//Extraer los otrostemas de la noticia
	public function leerOtrotema($idnoticia)
	{
		$sql = "SELECT *   "
			."FROM noticia AS n   "
			."LEFT JOIN noticia_subtema ON noticia_subtema.rel_idnoticia = n.idnoticia   "
			."LEFT JOIN subtema ON subtema.idsubtema = noticia_subtema.rel_idsubtema  "
			."WHERE n.idnoticia = ?   ";
		$qry = $this->db->query($sql, [$idnoticia,  ]);
		return $qry->row();
	}

	//Extraer lo otros subtemas de la noticia
	public function leerOtrosubtemas($idnoticia)
	{
		$sql = "SELECT *   "
			."FROM noticia AS n   "
			."LEFT JOIN noticia_otrosubtema ON noticia_otrosubtema.rel_idnoticia = n.idnoticia   "
			."LEFT JOIN otrosubtema ON otrosubtema.idotrosubtema = noticia_otrosubtema.rel_idotrosubtema  "
			."WHERE n.idnoticia = ?   ";
		$qry = $this->db->query($sql, [$idnoticia,  ]);
		return $qry->result();
	}
	public function leerTodasNoticiasCuestionarioUsuario($idcuestionario, $idusuario){
		$sql = "SELECT * "
			."FROM noticia  "
			."LEFT JOIN medio_comunicacion ON medio_comunicacion.idmedio = noticia.rel_idmedio  "
			."WHERE noticia.rel_idusuario = ? AND noticia.rel_idcuestionario = ? ";
		$qry = $this->db->query($sql, [$idusuario, $idcuestionario ]);
		return $qry->result();
	}
    public function modificarFechaNoticia($idn,$f)
	{
		$this->db->set('fecha_noticia',$f);
		$this->db->where('idnoticia', $idn);
		$this->db->update('noticia');
	}
	public function modificarMedioNoticia($idn,$idm)
	{
		$this->db->set('rel_idmedio',$idm);
		$this->db->where('idnoticia', $idn);
		$this->db->update('noticia');
	}
	public function modificarDatosNoticia($idn,$dts)
	{
		$this->db->set($dts);
		$this->db->where('idnoticia', $idn);
		$this->db->update('noticia');
	}
	public function modificarActoresNoticia($idn,$dtchkbox)
	{
		$this->db->trans_start();
			$this->db->where('rel_idnoticia',$idn);
			$this->db->delete('noticia_actor');
			foreach ($dtchkbox as $idactor)
			{
				$dtna=array('rel_idnoticia'=>$idn,
						'rel_idactor'=>$idactor
						);
				$this->db->insert('noticia_actor',$dtna);
			}
		$this->db->trans_complete();
	}
	public function modificarSubTemasNoticia($idn,$dtchkboxst,$dtsotrotema,$dtotrosubtemas)
	{
		$this->db->trans_start();
			if (count($dtsotrotema)!=0)
			{
				$this->db->where('rel_idnoticia',$idn);
				$not=count($this->db->get('noticia_otrotema')->result());
				if ($not==0)
				{
					//echo "inserta otro tema";
					//echo "<br><br>";
					$this->db->insert('otrotema',$dtsotrotema);
					$idotrotema=$this->db->insert_id();
					$dtot=array('rel_idnoticia'=>$idn,
							'rel_idotrotema'=>$idotrotema
							);
					$this->db->insert('noticia_otrotema',$dtot);
				}
				else
				{
					//echo "edita otro tema";
					//echo "<br><br>";
					$this->db->where('rel_idnoticia',$idn);
					$ot=$this->db->get('noticia_otrotema')->row();
					$this->db->set('nombre_otrotema',$dtsotrotema['nombre_otrotema']);
					$this->db->where('idotrotema',$ot->rel_idotrotema);
					$this->db->update('otrotema');
				}
			}
			else
			{
				$this->db->where('rel_idnoticia',$idn);
				$not=count($this->db->get('noticia_otrotema')->result());
				if ($not!=0)
				{
					//echo "borra otro tema";
					//echo "<br><br>";
					$this->db->where('rel_idnoticia',$idn);
					$ot=$this->db->get('noticia_otrotema')->row();
					$idot=$ot->rel_idotrotema;
					$this->db->where('rel_idnoticia',$idn);
					$this->db->delete('noticia_otrotema');
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
				$this->db->where('rel_idnoticia',$idn);
				$this->db->delete('noticia_subtema');
				foreach ($dtchkboxst as $idst)
				{
					$dtst=array('rel_idnoticia'=>$idn,
							'rel_idsubtema'=>$idst
							);
					$this->db->insert('noticia_subtema',$dtst);
				}
			}
			else 
			{
				//echo "borra subtemas";
				//echo "<br><br>";
				$this->db->where('rel_idnoticia',$idn);
				$nst=count($this->db->get('noticia_subtema')->result());
				if ($nst!=0)
				{
					$this->db->where('rel_idnoticia',$idn);
					$this->db->delete('noticia_subtema');
				}
			}
			if (count($dtotrosubtemas)!=0)
			{
				$this->db->where('rel_idnoticia',$idn);
				$nost=count($this->db->get('noticia_otrosubtema')->result());
				if ($nost!=0)
				{
					//echo "replaza otro subtemas";
					//echo "<br><br>";
					$this->db->where('rel_idnoticia',$idn);
					$otrost=$this->db->get('noticia_otrosubtema')->result();
					foreach ($otrost as $ost)
					{
						$idost=$ost->rel_idotrosubtema;
						$this->db->where('rel_idotrosubtema',$idost);
						$this->db->delete('noticia_otrosubtema');	
						$this->db->where('idotrosubtema',$idost);
						$this->db->delete('otrosubtema');
					}
					foreach ($dtotrosubtemas as $dtost)
					{
						$this->db->insert('otrosubtema',$dtost);
						$idotrosubtema=$this->db->insert_id();
						$dtnost=array('rel_idnoticia'=>$idn,
										'rel_idotrosubtema'=>$idotrosubtema);
						$this->db->insert('noticia_otrosubtema',$dtnost);
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
						$dtnost=array('rel_idnoticia'=>$idn,
										'rel_idotrosubtema'=>$idotrosubtema);
						$this->db->insert('noticia_otrosubtema',$dtnost);
					}
				}
			}
			else 
			{
				$this->db->where('rel_idnoticia',$idn);
				$nost=count($this->db->get('noticia_otrosubtema')->result());
				if ($nost!=0)
				{
					echo "borra otro subtemas";
					echo "<br><br>";
					$this->db->where('rel_idnoticia',$idn);
					$otrost=$this->db->get('noticia_otrosubtema')->result();
					foreach ($otrost as $ost)
					{
						$idost=$ost->rel_idotrosubtema;
						$this->db->where('rel_idotrosubtema',$idost);
						$this->db->delete('noticia_otrosubtema');	
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

	//Funcion para busqueda de noticias y generacion de reportes no multiples
	public function reporteNoticias($parametros)
	{
		//Solo la fecha de la noticia

		$consulta = $parametros;
		//Array de placeholders
		$placeholder = [];

		$sql = "SELECT DISTINCT n.idnoticia, n.fecha_registro, n.fecha_noticia, n.titular, n.url_noticia, n.resumen, medio_comunicacion.nombre_medio, tipo_medio.nombre_tipo, cuestionario.nombre_cuestionario, universidad.nombre_universidad, departamento.nombre_departamento, users.username  "
			."FROM noticia AS n  "
			."LEFT JOIN cuestionario ON cuestionario.idcuestionario = n.rel_idcuestionario  "
			."LEFT JOIN users ON users.id = n.rel_idusuario  "
			."LEFT JOIN departamento ON departamento.iddepartamento = users.rel_iddepartamento  "
			."LEFT JOIN medio_comunicacion ON medio_comunicacion.idmedio = n.rel_idmedio  "
			."LEFT JOIN tipo_medio ON tipo_medio.idtipomedio = medio_comunicacion.rel_idtipomedio  "
			."LEFT JOIN universidad ON universidad.iduniversidad = users.rel_iduniversidad  "
			."LEFT JOIN noticia_subtema ON noticia_subtema.rel_idnoticia = n.idnoticia  "
			."LEFT JOIN subtema ON subtema.idsubtema = noticia_subtema.rel_idsubtema  "
			."LEFT JOIN tema ON tema.idtema = subtema.rel_idtema  "
			."LEFT JOIN noticia_actor ON noticia_actor.rel_idnoticia = n.idnoticia  "
			."LEFT JOIN actor ON actor.idactor = noticia_actor.rel_idactor  "
			."WHERE (n.fecha_noticia BETWEEN ? AND ?)  "
			."  ";

		/** @noinspection PhpLanguageLevelInspection */

		//Añadir el intervalo de fechas al placeholder
		array_push($placeholder, $consulta->fecha_inicio);
		array_push($placeholder, $consulta->fecha_fin);

		//Añadir el resto de los discriminantes
		if($consulta->iddepartamento !=0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND departamento.iddepartamento  = ?  ";
			array_push($placeholder, $consulta->iddepartamento);
		}
		if ($consulta->idtipomedio != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND tipo_medio.idtipomedio = ?  ";
			array_push($placeholder, $consulta->idtipomedio);
		}
		if ($consulta->idmedio != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND medio_comunicacion.idmedio = ?  ";
			array_push($placeholder, $consulta->idmedio);
		}
		if ($consulta->idactor != 0 )
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND actor.idactor = ?  ";
			array_push($placeholder, $consulta->idactor);
		}
		if ($consulta->iduniversidad != 0 )
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND universidad.iduniversidad = ?  ";
			array_push($placeholder, $consulta->iduniversidad);
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
		$sql .= 'ORDER BY n.fecha_noticia ASC ';
		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}

	//Funcion para busqueda de noticias y generacion de reportes no multiples
	public function reportesNoticiasDatos($parametros)
	{
		//Solo la fecha de la noticia

		$consulta = $parametros;
		//Array de placeholders
		$placeholder = [];

		$sql = "SELECT *  "
			."FROM noticia AS n  "
			."LEFT JOIN cuestionario ON cuestionario.idcuestionario = n.rel_idcuestionario  "
			."LEFT JOIN users ON users.id = n.rel_idusuario  "
			."LEFT JOIN departamento ON departamento.iddepartamento = users.rel_iddepartamento  "
			."LEFT JOIN medio_comunicacion ON medio_comunicacion.idmedio = n.rel_idmedio  "
			."LEFT JOIN tipo_medio ON tipo_medio.idtipomedio = medio_comunicacion.rel_idtipomedio  "
			."LEFT JOIN universidad ON universidad.iduniversidad = users.rel_iduniversidad  "
			."LEFT JOIN noticia_subtema ON noticia_subtema.rel_idnoticia = n.idnoticia  "
			."LEFT JOIN subtema ON subtema.idsubtema = noticia_subtema.rel_idsubtema  "
			."LEFT JOIN tema ON tema.idtema = subtema.rel_idtema  "
			."LEFT JOIN noticia_actor ON noticia_actor.rel_idnoticia = n.idnoticia  "
			."LEFT JOIN actor ON actor.idactor = noticia_actor.rel_idactor  "
			."WHERE n.esta_activa=1 AND (n.fecha_noticia BETWEEN ? AND ?)  "
			."  ";

		/** @noinspection PhpLanguageLevelInspection */

		//Añadir el intervalo de fechas al placeholder
		array_push($placeholder, $consulta->fecha_inicio);
		array_push($placeholder, $consulta->fecha_fin);

		//Añadir el resto de los discriminantes
		if($consulta->idcuestionario !=0)
		{
			$sql .= "AND cuestionario.idcuestionario = ?  ";
			array_push($placeholder, $consulta->idcuestionario);
		}
		if($consulta->iddepartamento !=0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND departamento.iddepartamento  = ?  ";
			array_push($placeholder, $consulta->iddepartamento);
		}
		if ($consulta->idtipomedio != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND tipo_medio.idtipomedio = ?  ";
			array_push($placeholder, $consulta->idtipomedio);
		}
		if ($consulta->idmedio != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND medio_comunicacion.idmedio = ?  ";
			array_push($placeholder, $consulta->idmedio);
		}
		if ($consulta->idactor != 0 )
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND actor.idactor = ?  ";
			array_push($placeholder, $consulta->idactor);
		}
		if ($consulta->iduniversidad != 0 )
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND universidad.iduniversidad = ?  ";
			array_push($placeholder, $consulta->iduniversidad);
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
		$sql .= 'ORDER BY n.fecha_noticia ASC ';
		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}

	//Funcion para  busqueda de noticias y generacion de reportes con multiples resultados
	public function reportesDatosMultiples($parametros)
	{
		$identificadores = $parametros;

	}


	//Funcion para la creacion de nuevos registros de ley
	public function crearLey($ley)
	{
		/*
		 *
		 * INICIAR LA TRANSACCION
		 */
		$this->db->trans_begin();
		//Insertar la ley
		/** @noinspection PhpLanguageLevelInspection */
		$ly = [
			'fecha_registro' => $ley->fecha_registro ,
			//'fecha_ley' => $ley->fecha_ley ,
			'resumen' => $ley->resumen,
			'rel_idcuestionario' => $ley->rel_idcuestionario,
			'rel_idusuario' => $ley->rel_idusuario,
		];
		$this->db->insert('leyes', $ly);
		$ley_id = $this->db->insert_id();

		//Insertar el codigo de la ley
		/** @noinspection PhpLanguageLevelInspection */
		$cdly = [
			'codigo_ley' => $ley->codigo,
			'rel_idley' => $ley_id,
			'rel_idestadoley' => $ley->estado,
		];
		$this->db->insert('codigoley', $cdly);
		$codigo_id = $this->db->insert_id();

		//Insertar el nombre de la ley
		/** @noinspection PhpLanguageLevelInspection */
		$nmbrley = [
			'nombre_ley' => $ley->titulo,
			'rel_idestadoley' => $ley->estado,
			'rel_idley' => $ley_id,
		];
		$this->db->insert('nombreley', $nmbrley);
		$nombre_ley_id = $this->db->insert_id();

		//insertar el estado en q se encuentra la ley
		/** @noinspection PhpLanguageLevelInspection */
		$estdly = [
			'rel_idleyes' => $ley_id,
			'rel_idestadoley' => $ley->estado,
			'fecha_estadoley ' => $ley->fecha_ley,
		];
		$this->db->insert('leyes_estadoley', $estdly);

		//Insertar la fuente de la ley
		/** @noinspection PhpLanguageLevelInspection */
		$lysfnt = [
			'rel_idleyes' => $ley_id,
			'rel_idfuente' => $ley->fuente,
		];
		$this->db->insert('leyes_fuente', $lysfnt);

		//Insertar la URL del estado de la ley
		/** @noinspection PhpLanguageLevelInspection */
		$urlly = [
			'url_ley' => $ley->url_ley,
			'rel_idley' => $ley_id,
			'rel_idestadoley' => $ley->estado,
		];
		$this->db->insert('urlley', $urlly);


		//Insertar otro tema
		//Insertar subtema
		//insertar otrosubtema
		$temas = $ley->temas;
		$subtemas = $ley->subtemas;
		$otrossubtemas = $ley->otros_subtemas;
		$otrotema = $ley->otro_tema;

		foreach ($temas as $t)
		{
			//Tema es una bandera
			$idtema = $t;
			if($idtema!=0)
			{
				$stemas = $subtemas[$idtema];
				foreach ($stemas as $st)
				{
					$idsubtema = $st;
					if($idsubtema!=0)
					{
						//Insertar la relacion noticia subtema
						//echo $idsubtema." / ";
						/** @noinspection PhpLanguageLevelInspection */
						$ley_subt = [
							'rel_idleyes' => $ley_id,
							'rel_idsubtema' => $idsubtema,
						];
						$this->db->insert('ley_subtema', $ley_subt);
					}else{
						//echo "insertar otro subtema: ".$otrossubtemas[$idtema];
						//Insertar el otro subtema
						/** @noinspection PhpLanguageLevelInspection */
						$ot_st = [
							'nombre_otrosubtema' => $otrossubtemas[$idtema],
							'rel_idtema' => $idtema,
						];
						$this->db->insert('otrosubtema', $ot_st);
						$otro_st_id = $this->db->insert_id();
						//Relacion de otrosubtema con la ley
						/** @noinspection PhpLanguageLevelInspection */
						$ley_ost = [
							'rel_idleyes' => $ley_id,
							'rel_idotrosubtema '=>$otro_st_id,
						];
						$this->db->insert('ley_otrosubtema', $ley_ost);
					}
				}

			}else{
				//Insertar otro tema
				//echo "Registrar otro tema: ".$otrotema;
				/** @noinspection PhpLanguageLevelInspection */
				$ot = [
					'nombre_otrotema' => $otrotema,
					'rel_idcuestionario' => $ley->rel_idcuestionario,
					'rel_idusuario' => $ley->rel_idusuario,
				];
				$this->db->insert('otrotema', $ot);
				$otro_tema_id = $this->db->insert_id();
				//Relacion de otro con la ley
				/** @noinspection PhpLanguageLevelInspection */
				$ley_ot =[
					'rel_idleyes' => $ley_id,
					'rel_idotrotema' => $otro_tema_id,
				];
				$this->db->insert('ley_otrotema', $ley_ot);
			}
		}



		if ($this->db->trans_status() === FALSE){
			//Hubo errores en la consulta, entonces se cancela la transacción.
			$this->db->trans_rollback();
			return false;
		}else{
			//Todas las consultas se hicieron correctamente.
			$this->db->trans_commit();
			return true;
		}
	}

	//Filtrar noticias por tipo de medio
	public function noticiaPorTipomedio($consulta)
	{
		$fecha_inicio = $consulta->fecha_inicio;
		$fecha_fin = $consulta->fecha_fin;
		$idtipomedio = $consulta->idtipomedio;

		$sql = "SELECT n.idnoticia, n.fecha_registro, n.fecha_noticia, n.titular, n.resumen, n.url_noticia, medio_comunicacion.idmedio, medio_comunicacion.nombre_medio, tipo_medio.idtipomedio, tipo_medio.nombre_tipo, cuestionario.idcuestionario, cuestionario.nombre_cuestionario, users.id, users.username, universidad.iduniversidad, universidad.nombre_universidad, universidad.sigla_universidad, departamento.iddepartamento, departamento.nombre_departamento, n.esta_activa   "
			."FROM noticia AS n   "
			."LEFT JOIN cuestionario ON cuestionario.idcuestionario = n.rel_idcuestionario   "
			."LEFT JOIN users ON users.id = n.rel_idusuario   "
			."LEFT JOIN departamento ON departamento.iddepartamento = users.rel_iddepartamento   "
			."LEFT JOIN universidad ON universidad.iduniversidad = users.rel_iduniversidad   "
			."LEFT JOIN medio_comunicacion ON medio_comunicacion.idmedio = n.rel_idmedio   "
			."LEFT JOIN tipo_medio ON tipo_medio.idtipomedio = medio_comunicacion.rel_idtipomedio     "
			."WHERE n.esta_activa = 1 AND tipo_medio.idtipomedio = ?  AND (n.fecha_noticia BETWEEN ? AND ?)   "
			."ORDER BY n.fecha_noticia ASC ";
		$qry = $this->db->query($sql, [$idtipomedio, $fecha_inicio, $fecha_fin,  ]);
		return $qry->result();
	}

	public function noticiaPorCuestionario($consulta)
	{
		$fecha_inicio = $consulta->fecha_inicio;
		$fecha_fin = $consulta->fecha_fin;
		$idcuestionario = $consulta->idcuestionario;

		$sql = "SELECT n.idnoticia, n.fecha_registro, n.fecha_noticia, n.titular, n.resumen, n.url_noticia, medio_comunicacion.idmedio, medio_comunicacion.nombre_medio, tipo_medio.idtipomedio, tipo_medio.nombre_tipo, cuestionario.idcuestionario, cuestionario.nombre_cuestionario, users.id, users.username, universidad.iduniversidad, universidad.nombre_universidad, universidad.sigla_universidad, departamento.iddepartamento, departamento.nombre_departamento, n.esta_activa   "
			."FROM noticia AS n   "
			."LEFT JOIN cuestionario ON cuestionario.idcuestionario = n.rel_idcuestionario   "
			."LEFT JOIN users ON users.id = n.rel_idusuario   "
			."LEFT JOIN departamento ON departamento.iddepartamento = users.rel_iddepartamento   "
			."LEFT JOIN universidad ON universidad.iduniversidad = users.rel_iduniversidad   "
			."LEFT JOIN medio_comunicacion ON medio_comunicacion.idmedio = n.rel_idmedio   "
			."LEFT JOIN tipo_medio ON tipo_medio.idtipomedio = medio_comunicacion.rel_idtipomedio     "
			."WHERE n.esta_activa = 1 AND  cuestionario.idcuestionario = ?  AND (n.fecha_noticia BETWEEN ? AND ?)   ";
		$qry = $this->db->query($sql, [$idcuestionario, $fecha_inicio, $fecha_fin,  ]);
		return $qry->result();
	}
    public function noticiaPorDepartamento($consulta)
	{
		$fecha_inicio = $consulta->fecha_inicio;
		$fecha_fin = $consulta->fecha_fin;
		$iddepartamento = $consulta->iddepartamento;

		$sql = "SELECT n.idnoticia, n.fecha_registro, n.fecha_noticia, n.titular, n.resumen, n.url_noticia, medio_comunicacion.idmedio, medio_comunicacion.nombre_medio, tipo_medio.idtipomedio, tipo_medio.nombre_tipo, cuestionario.idcuestionario, cuestionario.nombre_cuestionario, users.id, users.username, universidad.iduniversidad, universidad.nombre_universidad, universidad.sigla_universidad, departamento.iddepartamento, departamento.nombre_departamento, n.esta_activa   "
			."FROM noticia AS n   "
			."LEFT JOIN cuestionario ON cuestionario.idcuestionario = n.rel_idcuestionario   "
			."LEFT JOIN users ON users.id = n.rel_idusuario   "
			."LEFT JOIN departamento ON departamento.iddepartamento = users.rel_iddepartamento   "
			."LEFT JOIN universidad ON universidad.iduniversidad = users.rel_iduniversidad   "
			."LEFT JOIN medio_comunicacion ON medio_comunicacion.idmedio = n.rel_idmedio   "
			."LEFT JOIN tipo_medio ON tipo_medio.idtipomedio = medio_comunicacion.rel_idtipomedio     "
			."WHERE n.esta_activa=1 AND departamento.iddepartamento = ?  AND (n.fecha_noticia BETWEEN ? AND ?)   "
			."ORDER BY n.fecha_noticia ASC ";
		$qry = $this->db->query($sql, [$iddepartamento, $fecha_inicio, $fecha_fin,  ]);
		return $qry->result();
	}
	public function noticiaPorUniversidad($consulta)
	{
		$fecha_inicio = $consulta->fecha_inicio;
		$fecha_fin = $consulta->fecha_fin;
		$iduniversidad = $consulta->iduniversidad;

		$sql = "SELECT n.idnoticia, n.fecha_registro, n.fecha_noticia, n.titular, n.resumen, n.url_noticia, medio_comunicacion.idmedio, medio_comunicacion.nombre_medio, tipo_medio.idtipomedio, tipo_medio.nombre_tipo, cuestionario.idcuestionario, cuestionario.nombre_cuestionario, users.id, users.username, universidad.iduniversidad, universidad.nombre_universidad, universidad.sigla_universidad, departamento.iddepartamento, departamento.nombre_departamento, n.esta_activa   "
			."FROM noticia AS n   "
			."LEFT JOIN cuestionario ON cuestionario.idcuestionario = n.rel_idcuestionario   "
			."LEFT JOIN users ON users.id = n.rel_idusuario   "
			."LEFT JOIN departamento ON departamento.iddepartamento = users.rel_iddepartamento   "
			."LEFT JOIN universidad ON universidad.iduniversidad = users.rel_iduniversidad   "
			."LEFT JOIN medio_comunicacion ON medio_comunicacion.idmedio = n.rel_idmedio   "
			."LEFT JOIN tipo_medio ON tipo_medio.idtipomedio = medio_comunicacion.rel_idtipomedio     "
			."WHERE n.esta_activa=1 AND  universidad.iduniversidad = ?  AND (n.fecha_noticia BETWEEN ? AND ?)   "
			."ORDER BY n.fecha_noticia ASC ";
		$qry = $this->db->query($sql, [$iduniversidad, $fecha_inicio, $fecha_fin,  ]);
		return $qry->result();
	}

	//Rutina para filtrar temas
	public function noticiaPorTemas($consulta)
	{
		$fecha_inicio = $consulta->fecha_inicio;
		$fecha_fin = $consulta->fecha_fin;
		$idtema = $consulta->idtema;
		$sql = "SELECT t.nombre_tema, t.idtema, subtema.rel_idtema, subtema.idsubtema, subtema.nombre_subtema, noticia_subtema.rel_idsubtema, noticia_subtema.rel_idnoticia, noticia.idnoticia, noticia.titular, noticia.esta_activa     "
			."FROM tema AS t     "
			."LEFT JOIN subtema ON t.idtema = subtema.rel_idtema   "
			."LEFT JOIN noticia_subtema ON noticia_subtema.rel_idsubtema = subtema.idsubtema   "
			."LEFT JOIN noticia ON noticia_subtema.rel_idnoticia = noticia.idnoticia   "
			."WHERE noticia.esta_activa = 1 AND t.idtema = ? AND (noticia.fecha_noticia BETWEEN ? AND ?)   "
			."GROUP BY noticia.idnoticia   "
			."     "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idtema, $fecha_inicio, $fecha_fin,  ]);
		return $qry->result();
	}

	public function noticiaPorId($idnoticia)
	{
		$sql = "SELECT *    "
			."FROM noticia AS n     "
			."LEFT JOIN medio_comunicacion ON medio_comunicacion.idmedio = n.rel_idmedio   "
			."LEFT JOIN tipo_medio ON tipo_medio.idtipomedio = medio_comunicacion.rel_idtipomedio   "
			."LEFT JOIN cuestionario ON cuestionario.idcuestionario = n.rel_idcuestionario   "
			."LEFT JOIN users ON users.id = n.rel_idusuario   "
			."LEFT JOIN departamento ON departamento.iddepartamento = users.rel_iddepartamento   "
			."LEFT JOIN universidad ON universidad.iduniversidad = users.rel_iduniversidad     "
			."WHERE n.idnoticia = ?   "
			."   ";
		$qry = $this->db->query($sql, [$idnoticia,  ]);
		return $qry->row();
	}


   	public function noticiaPorActor($consulta)
	{
		$fecha_inicio = $consulta->fecha_inicio;
		$fecha_fin = $consulta->fecha_fin;
		$idactor = $consulta->idactor;

		$sql = "SELECT n.idnoticia, n.fecha_registro, n.fecha_noticia, n.titular, n.resumen, n.url_noticia, medio_comunicacion.idmedio, medio_comunicacion.nombre_medio, tipo_medio.idtipomedio, tipo_medio.nombre_tipo, cuestionario.idcuestionario, cuestionario.nombre_cuestionario, users.id, users.username, universidad.iduniversidad, universidad.nombre_universidad, universidad.sigla_universidad, departamento.iddepartamento, departamento.nombre_departamento, n.esta_activa   "
			."FROM noticia AS n   "
			."LEFT JOIN cuestionario ON cuestionario.idcuestionario = n.rel_idcuestionario   "
			."LEFT JOIN users ON users.id = n.rel_idusuario   "
			."LEFT JOIN departamento ON departamento.iddepartamento = users.rel_iddepartamento   "
			."LEFT JOIN universidad ON universidad.iduniversidad = users.rel_iduniversidad   "
			."LEFT JOIN medio_comunicacion ON medio_comunicacion.idmedio = n.rel_idmedio   "
			."LEFT JOIN tipo_medio ON tipo_medio.idtipomedio = medio_comunicacion.rel_idtipomedio     "
			."LEFT JOIN noticia_actor ON noticia_actor.rel_idnoticia = n.idnoticia "
            ."LEFT JOIN actor ON actor.idactor = noticia_actor.rel_idactor "
			."WHERE n.esta_activa=1 AND actor.idactor = ?  AND (n.fecha_noticia BETWEEN ? AND ?)   ";
		$qry = $this->db->query($sql, [$idactor, $fecha_inicio, $fecha_fin,  ]);
		return $qry->result();
	}

	public function leerTodasLasNoticias()
	{
		$sql = "SELECT *   "
			."FROM noticia AS n   "
			."LEFT JOIN medio_comunicacion ON n.rel_idmedio = medio_comunicacion.idmedio   "
			."LEFT JOIN tipo_medio ON tipo_medio.idtipomedio = medio_comunicacion.rel_idtipomedio   "
			."LEFT JOIN cuestionario ON n.rel_idcuestionario = cuestionario.idcuestionario   "
			."LEFT JOIN users ON users.id = n.rel_idusuario   "
			."LEFT JOIN universidad ON users.rel_iduniversidad = universidad.iduniversidad   "
			."     "
			."ORDER BY n.idnoticia ASC  "
			."   "
			."   ";
		$qry = $this->db->query($sql );
		return $qry->result();
	}

	public function cambiarEstado($identificador, $estado)
	{
		/** @noinspection PhpLanguageLevelInspection */
		$data = [
			'esta_activa' => $estado,
		];
		$this->db->where('idnoticia', $identificador);
		$this->db->update('noticia', $data);
	}

	public function otroTemaNoticiaPorId($idnoticia)
	{
		$sql = "SELECT *   "
			."FROM noticia AS n   "
			."LEFT JOIN noticia_otrotema ON n.idnoticia = noticia_otrotema.rel_idnoticia   "
			."LEFT JOIN otrotema ON noticia_otrotema.rel_idotrotema = otrotema.idotrotema   "
			."LEFT JOIN cuestionario ON otrotema.rel_idcuestionario = cuestionario.idcuestionario   "
			."WHERE n.idnoticia = ?  "
			."ORDER BY n.fecha_noticia ASC   "
			."   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idnoticia,  ]);
		return $qry->row();
	}

	public function otroSubtemaNoticiaPorId($idnoticia)
	{
		$sql = "SELECT *   "
			."FROM noticia AS n   "
			."LEFT JOIN noticia_otrosubtema ON n.idnoticia = noticia_otrosubtema.rel_idnoticia   "
			."LEFT JOIN otrosubtema ON noticia_otrosubtema.rel_idotrosubtema = otrosubtema.idotrosubtema   "
			."LEFT JOIN tema ON otrosubtema.rel_idtema = tema.idtema   "
			."LEFT JOIN cuestionario ON tema.rel_idcuestionario = cuestionario.idcuestionario  "
			."WHERE n.idnoticia = ?   "
			."ORDER BY n.fecha_noticia ASC   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idnoticia,  ]);
		return $qry->result();

	}

	public function reportesNoticiasDatosID($parametros)
	{
		//Solo la fecha de la noticia

		$consulta = $parametros;
		//Array de placeholders
		$placeholder = [];

		$sql = "SELECT DISTINCT n.idnoticia, n.esta_activa  "
			."FROM noticia AS n  "
			."LEFT JOIN cuestionario ON cuestionario.idcuestionario = n.rel_idcuestionario  "
			."LEFT JOIN users ON users.id = n.rel_idusuario  "
			."LEFT JOIN departamento ON departamento.iddepartamento = users.rel_iddepartamento  "
			."LEFT JOIN medio_comunicacion ON medio_comunicacion.idmedio = n.rel_idmedio  "
			."LEFT JOIN tipo_medio ON tipo_medio.idtipomedio = medio_comunicacion.rel_idtipomedio  "
			."LEFT JOIN universidad ON universidad.iduniversidad = users.rel_iduniversidad  "
			."LEFT JOIN noticia_subtema ON noticia_subtema.rel_idnoticia = n.idnoticia  "
			."LEFT JOIN subtema ON subtema.idsubtema = noticia_subtema.rel_idsubtema  "
			."LEFT JOIN tema ON tema.idtema = subtema.rel_idtema  "
			."LEFT JOIN noticia_actor ON noticia_actor.rel_idnoticia = n.idnoticia  "
			."LEFT JOIN actor ON actor.idactor = noticia_actor.rel_idactor  "
			."WHERE n.esta_activa=1 AND (n.fecha_noticia BETWEEN ? AND ?)  "
			."  ";

		/** @noinspection PhpLanguageLevelInspection */

		//Añadir el intervalo de fechas al placeholder
		array_push($placeholder, $consulta->fecha_inicio);
		array_push($placeholder, $consulta->fecha_fin);

		//Añadir el resto de los discriminantes
		if($consulta->idcuestionario !=0)
		{
			$sql .= "AND cuestionario.idcuestionario = ?  ";
			array_push($placeholder, $consulta->idcuestionario);
		}
		if($consulta->iddepartamento !=0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND departamento.iddepartamento  = ?  ";
			array_push($placeholder, $consulta->iddepartamento);
		}
		if ($consulta->idtipomedio != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND tipo_medio.idtipomedio = ?  ";
			array_push($placeholder, $consulta->idtipomedio);
		}
		if ($consulta->idmedio != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND medio_comunicacion.idmedio = ?  ";
			array_push($placeholder, $consulta->idmedio);
		}
		if ($consulta->idactor != 0 )
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND actor.idactor = ?  ";
			array_push($placeholder, $consulta->idactor);
		}
		if ($consulta->iduniversidad != 0 )
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND universidad.iduniversidad = ?  ";
			array_push($placeholder, $consulta->iduniversidad);
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

		$sql .= 'ORDER BY n.fecha_noticia ASC   ';

		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}



	public function repositorioNoticias($parametros)
	{
		//Solo la fecha de la noticia
		$consulta = $parametros;

		//Array de placeholders
		$placeholder = [];

		$sql = "SELECT *  "
			."FROM noticia AS n  "
			."LEFT JOIN users ON n.rel_idusuario = users.id  "
			."LEFT JOIN departamento ON departamento.iddepartamento = users.rel_iddepartamento  "
			."LEFT JOIN medio_comunicacion ON medio_comunicacion.idmedio = n.rel_idmedio "
			."LEFT JOIN cuestionario ON n.rel_idcuestionario = cuestionario.idcuestionario  "
			."LEFT JOIN noticia_subtema ON noticia_subtema.rel_idnoticia = n.idnoticia   "
			."LEFT JOIN subtema ON noticia_subtema.rel_idsubtema = subtema.idsubtema  "
			."LEFT JOIN tema ON subtema.rel_idtema = tema.idtema  "
			."WHERE n.esta_activa = 1 AND (n.fecha_noticia BETWEEN ? AND ?)  "
			."  "
			."  "
			."  "
			."  "
			."  ";

		/** @noinspection PhpLanguageLevelInspection */

		//Añadir el intervalo de fechas al placeholder
		array_push($placeholder, $consulta->fecha_inicio);
		array_push($placeholder, $consulta->fecha_fin);

		//Añadir el resto de los discriminantes
		if($consulta->idcuestionario !=0)
		{
			$sql .= "AND cuestionario.idcuestionario = ?  ";
			array_push($placeholder, $consulta->idcuestionario);
		}
		if ($consulta->idtema != 0 )
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND tema.idtema = ?   ";
			array_push($placeholder, $consulta->idtema);
		}
		if($consulta->iddepartamento !=0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND departamento.iddepartamento  = ?  ";
			array_push($placeholder, $consulta->iddepartamento);
		}
		$sql .= 'ORDER BY n.fecha_noticia ASC   ';

		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();

	}


	//Metodo para el cambio de cuestionario
	public function cambioCuestionario($datos)
	{
		$datos_formulario = $datos;
		$noticia = $datos_formulario['noticia'];
		$nuevo_idcuestionario = $datos_formulario['nuevo_idcuestionario'];
		$temas = $datos_formulario['temas_nuevos'];
		$subtemas = $datos_formulario['subtemas_nuevos'];
		$otrossubtemas = $datos_formulario['otrossubtemas_nuevos'] ;
		$otrotema = $datos_formulario['otrotema_nuevo'];
		$existe_otro_tema = $datos_formulario['otros_temas_ajustados'];
		$existe_otro_subtema = $datos_formulario['otros_subtemas_ajustados'];
		/*
		 *
		 * INICIAR LA TRANSACCION
		 */

		$this->db->trans_begin();

		/*
		 * Borrar los anteriores registros
		 *
		 */
		//Borrar registro  de noticia_otrosubtema
		$this->db->delete('noticia_otrosubtema', array('rel_idnoticia' => $noticia->idnoticia));

		//Borrar registro de noticia_otrotema
		$this->db->delete('noticia_otrotema', array('rel_idnoticia' => $noticia->idnoticia));

		//Borrar registro de noticia_subtema
		$this->db->delete('noticia_subtema', array('rel_idnoticia' => $noticia->idnoticia));

		/*
		 * Actualizar el campo rel_idcuestionario de la Tabla Noticia
		 *
		 */
		/** @noinspection PhpLanguageLevelInspection */
		$data_noticia = [
			'rel_idcuestionario' => $nuevo_idcuestionario,
		];
		$this->db->where('idnoticia', $noticia->idnoticia);
		$this->db->update('noticia', $data_noticia);

		/*
		 * Insertar los nuevos registros
		 *
		 */

		//Insertar temas y subtemas
		foreach ($temas as $t)
		{
			$idtema = $t;
			if($idtema!=0)
			{
				$stemas = $subtemas[$idtema];
				foreach ($stemas as $st)
				{
					$idsubtema = $st;
					if($idsubtema!=0)
					{
						//Insertar la relacion noticia subtema
						//echo $idsubtema." / ";
						/** @noinspection PhpLanguageLevelInspection */
						$not_subt = [
							'rel_idnoticia' => $noticia->idnoticia,
							'rel_idsubtema' => $idsubtema,
						];
						$this->db->insert('noticia_subtema', $not_subt);
					}
				}
			}
		}

		/*
		 * Insertar Otro tema
		 *
		 */
		if($existe_otro_tema) //Comprobar si existe un otro tema definido
		{
			//Insertar otro tema
			//echo "Registrar otro tema: ".$otrotema;
			/** @noinspection PhpLanguageLevelInspection */
			$ot = [
				'nombre_otrotema' => $otrotema,
				'rel_idcuestionario' => $noticia->rel_idcuestionario,
				'rel_idusuario' => $noticia->rel_idusuario,
			];
			$this->db->insert('otrotema', $ot);
			$otro_tema_id = $this->db->insert_id();
			//Relacion de otro con la noticia
			/** @noinspection PhpLanguageLevelInspection */
			$not_ot =[
				'rel_idnoticia' => $noticia->idnoticia,
				'rel_idotrotema' => $otro_tema_id,
			];
			$this->db->insert('noticia_otrotema', $not_ot);
		}
		//insertar otrosubtema
		if($existe_otro_subtema)
		{
			foreach ($temas as $t){
				$idtema = $t;
				if($idtema!=0)
				{
					$stemas = $subtemas[$idtema];
					foreach ($stemas as $st)
					{

						/** @noinspection PhpLanguageLevelInspection */
						$ot_st = [
							'nombre_otrosubtema' => $otrossubtemas[$idtema],
							'rel_idtema' => $idtema,
						];

						if($otrossubtemas[$idtema]!=''){
							$this->db->insert('otrosubtema', $ot_st);
							$otro_st_id = $this->db->insert_id();
						}

						//Relacion de otrosubtema con la noticia
						/** @noinspection PhpLanguageLevelInspection */
						$not_ost = [
							'rel_idnoticia' => $noticia->idnoticia,
							'rel_idotrosubtema '=>$otro_st_id,
						];
						if($otrossubtemas[$idtema]!=''){
							$this->db->insert('noticia_otrosubtema', $not_ost);
						}
					}
				}
			}
		}






		if ($this->db->trans_status() === FALSE){
			//Hubo errores en la consulta, entonces se cancela la transacción.
			$this->db->trans_rollback();
			return false;
		}else{
			//Todas las consultas se hicieron correctamente.
			$this->db->trans_commit();
			return true;
		}
	}

}
