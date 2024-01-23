<?php
class  Encuesta_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Leer todas las encuestas
	public function leerTodasLasEncuestas()
	{
		$this->db->where('encuesta_activa', 1);
		$q=$this->db->get('uiencuesta');
		return $q->result();
	}

	//Leer todos los modulos
	public function leerTodosLosModulos()
	{
		$sql = "SELECT *   "
			."FROM uimodulo     "
			."LEFT JOIN uiencuesta ON uiencuesta.iduiencuesta = uimodulo.rel_iduiencuesta   "
			."  "
			."  "
			."  "
			." "
			."  ";

		$qry = $this->db->query($sql);
		return $qry->result();
	}
	//Leer todas las secciones
	public  function  leerTodasLasSecciones()
	{
		$sql = "SELECT *   "
			."FROM uiseccion     "
			."LEFT JOIN uimodulo ON uiseccion.rel_iduimodulo = uimodulo.iduimodulo   "
			."LEFT JOIN uiencuesta ON uimodulo.rel_iduiencuesta = uiencuesta.iduiencuesta  "
			."LEFT JOIN subtema ON subtema.idsubtema = uiseccion.rel_idsubtema "
			."  "
			." "
			."  ";

		$qry = $this->db->query($sql);
		return $qry->result();
	}
	public  function  leerModulos()
	{
		$sql = "SELECT * "
			."FROM uimodulo ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}
	public  function  leerSubtemas()
	{
		$sql = "SELECT * "
			."FROM subtema ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}
	public function crearSeccion($ordenSeccion, $modulo, $subtema)
	{
		$this->db->trans_begin();

		$data = array(
			'uiorden_seccion' => $ordenSeccion,
			'rel_iduimodulo' => $modulo,
			'rel_idsubtema' => $subtema,
		);

		$this->db->insert('uiseccion', $data);


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}
	public function leerUiseccion($iduiseccion)
	{
		$sql = "SELECT * "
			."FROM uiseccion "
			."WHERE $iduiseccion = iduiseccion ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}
	public function leerModulo($iduimodulo)
	{
		$sql = "SELECT * "
			."FROM uimodulo "
			."WHERE $iduimodulo = iduimodulo ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}
	public function leerSubtema($idsubtema)
	{
		$sql = "SELECT * "
			."FROM subtema "
			."WHERE $idsubtema = idsubtema ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}
	public function actualizarSeccion($iduiseccion,$uiorden_seccion,$rel_iduimodulo,$rel_idsubtema)
	{
		$sql = "UPDATE uiseccion "
			."SET uiorden_seccion = ?, rel_iduimodulo = ?, rel_idsubtema = ? "
			."WHERE iduiseccion = ? ";
			$qry = $this->db->query($sql, [$uiorden_seccion, $rel_iduimodulo, $rel_idsubtema, $iduiseccion ]);
		return;
	}

	//Leer todas las preguntas
	public  function  leerTodasLasPreguntas()
	{
		$sql = "SELECT *   "
			."FROM uipregunta    "
			."LEFT JOIN uiseccion ON uipregunta.rel_iduiseccion = uiseccion.iduiseccion   "
			."LEFT JOIN uimodulo ON uiseccion.rel_iduimodulo = uimodulo.iduimodulo  "
			."LEFT JOIN uiencuesta ON uimodulo.rel_iduiencuesta = uiencuesta.iduiencuesta  "
			."LEFT JOIN uitipopregunta ON uitipopregunta.iduitipopregunta = uipregunta.rel_iduitipopregunta  "
			." "
			."  ";

		$qry = $this->db->query($sql);
		return $qry->result();
	}
	public function agregarPreguntaUI($dts,$dtcheck)
	{
		$orden=1;
		$this->db->trans_start();
			$this->db->insert("uipregunta",$dts);
			$id=$this->db->insert_id();
			foreach ($dtcheck as $r)
			{
				$dt= array(
						'rel_iduipregunta'=>$id,
						'rel_iduirespuesta'=>$r,
						'uiorden_respuesta'=>$orden);
				$this->db->insert('uirespuesta_pregunta',$dt);
				$orden=$orden+1;
			}
		$this->db->trans_complete();
		
	}
	public function leerPreguntaId($idp)
	{
		$this->db->where("iduipregunta",$idp);
		$q=$this->db->get("uipregunta");
		return $q->row();
	}
	public function modificarPreguntaUI($dts,$dtcheck,$idp)
	{
		$orden=0;
		$this->db->trans_start();
			$this->db->where("rel_iduipregunta",$idp);
			$this->db->delete("uirespuesta_pregunta");
			foreach ($dtcheck as $check)
			{
				$orden=$orden+1;
				$dtck=array('rel_iduirespuesta'=>$check,
							'rel_iduipregunta'=>$idp,
							'uiorden_respuesta'=>$orden);
				$this->db->where("iduipregunta",$idp);
				$this->db->insert("uirespuesta_pregunta",$dtck);
			}
			$this->db->where("iduipregunta",$idp);
			$this->db->update("uipregunta",$dts);
		$this->db->trans_complete();
	}
	public function leerTiposPreguntas()
	{
		$q=$this->db->get("uitipopregunta");
		return $q->result();
	}
	public function leerTipoPreguntaId($idp)
	{
		$this->db->where('iduipregunta',$idp);
		$q=$this->db->get("uipregunta");
		return $q->row();
	}
	//Leer todas las respuestas
	public  function  leerTodasLasRespuestas()
	{
		$sql = "SELECT *   "
			."FROM uirespuesta    "
			."   "
			."  "
			."  "
			."  "
			." "
			."  ";

		$qry = $this->db->query($sql);
		return $qry->result();
	}
	public function leerRespuestasPreguntaId($idp)
	{
		$this->db->where('rel_iduipregunta',$idp);
		$q=$this->db->get("uirespuesta_pregunta");
		return $q->result();
	}
	public function agregarRespuestaUI($dts)
	{
		$this->db->insert("uirespuesta",$dts);
	}
	//Insertar la encuesta
	public function crearNuevaEncuesta($nombre_encuesta)
	{

		$this->db->trans_begin();

		$data = array(
			'uinombre_encuesta' => $nombre_encuesta,
			'encuesta_activa ' => 1,
		);

		$this->db->insert('uiencuesta', $data);


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}

	//Datos de una encuesta por identificador
	public function leerEncuestaPorID($idencuesta)
	{
		$this->db->where('iduiencuesta',$idencuesta);
		$q=$this->db->get ('uiencuesta');
		return $q->row();
	}

	public function actualizarEncuesta($idencuesta, $nombre)
	{
		$this->db->trans_begin();

		$data = array(
			'uinombre_encuesta' => $nombre,
		);

		$this->db->where('iduiencuesta', $idencuesta);
		$this->db->update('uiencuesta ', $data);

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}

	public function crearModulo($nombre, $orden, $encuesta)
	{
		$this->db->trans_begin();

		$data = array(
			'uinombre_modulo' => $nombre,
			'uiorden_modulo' => $orden,
			'rel_iduiencuesta' => $encuesta,
		);

		$this->db->insert('uimodulo', $data);


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}


	}

	public function leerModuloPorID($idmodulo)
	{
		$this->db->where('iduimodulo',$idmodulo);
		$q=$this->db->get ('uimodulo');
		return $q->row();
	}

	public function actualizarModulo($idmodulo, $nombre, $orden, $idencuesta)
	{
		$this->db->trans_begin();

		$data = array(
			'uinombre_modulo' => $nombre,
			'uiorden_modulo' => $orden,
			'rel_iduiencuesta' => $idencuesta,
		);
		$this->db->where('iduimodulo', $idmodulo);
		$this->db->update('uimodulo ', $data);

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}
    public function leerLocalizaciones()
	{
		$q=$this->db->get("geolocalizacion");
		return $q->result();
	}
	public function agregarLocalizacion($dts)
	{
		$this->db->insert("geolocalizacion",$dts);
	}
	public function leerLocalizacionId($idl)
	{
		$this->db->where('idgeolocal',$idl);
		$q=$this->db->get("geolocalizacion");
		return $q->row();
	}
	public function modificarLocalizacion($idl,$dts)
	{
		$this->db->where('idgeolocal',$idl);
		$this->db->update("geolocalizacion",$dts);
	}
	//Habilitar/Deshabilitar Encuesta
	public function cambiarEstado($identificador, $estado)
	{
		/** @noinspection PhpLanguageLevelInspection */
		$data = [
			'encuesta_activa' => $estado,
		];
		$this->db->where('iduiencuesta', $identificador);
		$this->db->update('uiencuesta ', $data);
	}

	//Lee los modulos que pertenecen a una encuesta en orden ascendente
	public function leerModulosPorIdEncuesta($idencuesta)
	{
		$sql = "SELECT *   "
			."FROM uimodulo   "
			."WHERE uimodulo.rel_iduiencuesta = ?   "
			."   "
			."   "
			."  "
			."   "
			."   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idencuesta,  ]);
		return $qry->result();
	}

	//Leer las secciones de un modulo
	public function leerSeccionesDeUnaEncuesta($idencuesta)
	{
		$sql = "SELECT *   "
			."FROM uiseccion   "
			."LEFT JOIN uimodulo ON uiseccion.rel_iduimodulo = uimodulo.iduimodulo   "
			."LEFT JOIN uiencuesta ON uimodulo.rel_iduiencuesta = uiencuesta.iduiencuesta   "
			."WHERE uiencuesta.iduiencuesta = ?   "
			."ORDER BY uimodulo.uiorden_modulo, uiseccion.uiorden_seccion  "
			."   "
			."   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idencuesta,  ]);
		return $qry->result();
	}
	public function leerTodosLosUsuarios()
	{
		$sql = "SELECT users.id, first_name, last_name "
			."FROM users "
			."LEFT JOIN users_groups ON users_groups.user_id = users.id "
			."LEFT JOIN groups ON groups.id = users_groups.group_id "
			."WHERE name = 'monitores'";
		$qry = $this->db->query($sql);
		return $qry->result();

	}
	public function leerUsuarioID($id)
	{
		$sql = "SELECT users.id, users.username, users.carnet_identidad,departamento.nombre_departamento,users.geolocalizacion "
			."FROM users "
			."INNER JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento "
			."WHERE id =".$id;
		$qry = $this->db->query($sql);
		return $qry->row();
	}

	//Leer las respuestas de una encuesta
	public function leerRespuestasDeUnaEncuesta($idencuesta)
	{
		$sql = "SELECT uiencuesta.iduiencuesta, uimodulo.iduimodulo, uiseccion.iduiseccion, uiseccion.uiorden_seccion, uipregunta.iduipregunta, uipregunta.uipregunta_nombre, uipregunta.uiorden_pregunta, uirespuesta.iduirespuesta, uirespuesta.uinombre_respuesta, uirespuesta_pregunta.uiorden_respuesta, uirespuesta_pregunta.codigo_respuesta, uirespuesta_pregunta.pregunta_datos      "
			."FROM uipregunta   "
			."LEFT JOIN uiseccion ON uipregunta.rel_iduiseccion = uiseccion.iduiseccion   "
			."LEFT JOIN uimodulo ON uiseccion.rel_iduimodulo = uimodulo.iduimodulo   "
			."LEFT JOIN uiencuesta ON uimodulo.rel_iduiencuesta = uiencuesta.iduiencuesta   "
			."LEFT JOIN uirespuesta_pregunta ON uirespuesta_pregunta.rel_iduipregunta = uipregunta.iduipregunta  "
			."LEFT JOIN uirespuesta ON uirespuesta_pregunta.rel_iduirespuesta = uirespuesta.iduirespuesta   "
			."WHERE uiencuesta.iduiencuesta = ?   "
			."ORDER BY uipregunta.iduipregunta, uirespuesta_pregunta.uiorden_respuesta   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idencuesta,  ]);
		return $qry->result();
	}

	//Leer las respuestas de una pregunta
	public function leerPreguntasDeUnaEncuesta($idencuesta)
	{
		$sql = "SELECT uiencuesta.iduiencuesta, uimodulo.iduimodulo, uimodulo.uiorden_modulo, uiseccion.iduiseccion, uiseccion.etiqueta_seccion, uiseccion.uiorden_seccion, uipregunta.iduipregunta, uipregunta.uipregunta_nombre, uipregunta.uipregunta_nota,  uipregunta.uiorden_pregunta, uipregunta.rel_iduitipopregunta, uitipopregunta.iduitipopregunta, uitipopregunta.nombre_tipopregunta   "
			."FROM uipregunta     "
			."LEFT JOIN uitipopregunta ON uipregunta.rel_iduitipopregunta = uitipopregunta.iduitipopregunta   "
			."LEFT JOIN uiseccion ON uipregunta.rel_iduiseccion = uiseccion.iduiseccion      "
			."LEFT JOIN uimodulo ON uiseccion.rel_iduimodulo = uimodulo.iduimodulo    "
			."LEFT JOIN uiencuesta ON uimodulo.rel_iduiencuesta = uiencuesta.iduiencuesta   "
			."WHERE uiencuesta.iduiencuesta = ?   "
			."ORDER BY uimodulo.uiorden_modulo, uiseccion.uiorden_seccion, uipregunta.uiorden_pregunta      "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idencuesta,  ]);
		return $qry->result();
	}
	public function escribirEncuestaAsignada($datos,$cifrado)
	{
		$this->db->trans_begin();

		foreach ($cifrado as $c){
			$data = array(
				'hash_text' => $c,
				'rel_idusuario' => $datos['idencuestador'],
				'rel_iduiencuesta' => $datos['idencuesta'],
				'rel_idgeolocal' => $datos['idgeolocal'],
			);
			$this->db->insert('encuesta', $data);
		}


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;

		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}

	//Leer las encuestas asignadas a un usuario
	public function leerEncuestasAsignadasUsuario($idusuario)
	{
		$sql = "SELECT *    "
			."FROM encuesta   "
			."LEFT JOIN users ON encuesta.rel_idusuario = users.id   "
			."LEFT JOIN uiencuesta ON encuesta.rel_iduiencuesta = uiencuesta.iduiencuesta   "
			."LEFT JOIN geolocalizacion ON encuesta.rel_idgeolocal= geolocalizacion.idgeolocal  "
			."WHERE users.id = ?   "
			."  "
			."   ";
		$qry = $this->db->query($sql, [$idusuario,  ]);
		return $qry->result();
	}
	public function leerEncuestasUsadasUsuario($idusuario)
	{
		$sql = "SELECT *    "
			."FROM encuesta   "
			."LEFT JOIN users ON encuesta.rel_idusuario = users.id   "
			."LEFT JOIN uiencuesta ON encuesta.rel_iduiencuesta = uiencuesta.iduiencuesta   "
			."WHERE users.id = ?   "
			."AND encuesta.usado=1 "
			."   ";
		$qry = $this->db->query($sql, [$idusuario,  ]);
		return $qry->result();
	}
	public function encuestasAusuarios()
	{
		$sql = "SELECT users.id, first_name, last_name, uinombre_encuesta "
			."FROM users "
			."LEFT JOIN encuesta ON encuesta.rel_idusuario = users.id "
			."LEFT JOIN uiencuesta ON uiencuesta.iduiencuesta = encuesta.rel_iduiencuesta "
			."LEFT JOIN users_groups ON  users_groups.user_id = users.id "
			."WHERE group_id = 5 "
			."GROUP BY uinombre_encuesta, id "
			."ORDER BY id";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	public function leerTodasLasAreasTrabajo()
	{
		$sql = "SELECT * "
			."FROM geolocalizacion "
			." "
			." "
			." "
			." "
			." "
			." ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	public function leerTiposDePregunta()
	{
		$sql = "SELECT * "
			."FROM uitipopregunta "
			." "
			." "
			." "
			." "
			." "
			." ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	//Rutina para extraer los formularios de las encuestas llenadas segun los criterios
	// ENCUESTA, RANGO DE EDAD, SEXO, AREA, DEPARTAMENTO
	public function leerFormulariosLlenosPorConsulta($parametros)
	{
		//Solo la fecha de la noticia

		$consulta = $parametros;
		//Array de placeholders
		$placeholder = [];

		$sql = "SELECT *  "
			."FROM formulariocompletado  "
			."LEFT JOIN users ON formulariocompletado.rel_idusuario = users.id  "
			."LEFT JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento  "
			."WHERE formulariocompletado.rel_iduiencuesta = ?  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			." "
			."  ";

		/** @noinspection PhpLanguageLevelInspection */

		//Didcriminante del formulario
		array_push($placeholder, $consulta->iduiencuesta);

		//Añadir el rango de edades
		if($consulta->edad_inicial !=0 && $consulta->edad_final !=0)
		{
			$sql .= "AND (formulariocompletado.edad BETWEEN ? AND ? )  ";
			array_push($placeholder, $consulta->edad_inicial);
			array_push($placeholder, $consulta->edad_final);
		}
		if((int)$consulta->sexo != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND formulariocompletado.sexo = ?  ";
			array_push($placeholder, (int)$consulta->sexo);
		}
		if ((int)$consulta->area != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND formulariocompletado.area = ?  ";
			array_push($placeholder, (int)$consulta->area);
		}
		if ($consulta->iddepartamento != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND departamento.iddepartamento = ?  ";
			array_push($placeholder, $consulta->iddepartamento);
		}

		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}

	//Rutina para extraer los formularios de las encuestas llenadas segun los criterios
	// ENCUESTA, RANGO DE EDAD, SEXO, AREA, DEPARTAMENTO
	public function leerFormulariosLlenosPorConsultaID($parametros)
	{
		//Solo la fecha de la noticia

		$consulta = $parametros;
		//Array de placeholders
		$placeholder = [];

		$sql = "SELECT formulariocompletado.idformcomp  "
			."FROM formulariocompletado  "
			."LEFT JOIN users ON formulariocompletado.rel_idusuario = users.id  "
			."LEFT JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento  "
			."WHERE formulariocompletado.rel_iduiencuesta = ?  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			." "
			."  ";

		/** @noinspection PhpLanguageLevelInspection */

		//Didcriminante del formulario
		array_push($placeholder, $consulta->iduiencuesta);

		//Añadir el rango de edades
		if($consulta->edad_inicial !=0 && $consulta->edad_final !=0)
		{
			$sql .= "AND (formulariocompletado.edad BETWEEN ? AND ? )  ";
			array_push($placeholder, $consulta->edad_inicial);
			array_push($placeholder, $consulta->edad_final);
		}
		if((int)$consulta->sexo != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND formulariocompletado.sexo = ?  ";
			array_push($placeholder, (int)$consulta->sexo);
		}
		if ((int)$consulta->area != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND formulariocompletado.area = ?  ";
			array_push($placeholder, (int)$consulta->area);
		}
		if ($consulta->iddepartamento != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND departamento.iddepartamento = ?  ";
			array_push($placeholder, $consulta->iddepartamento);
		}

		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}

	public function resultadosEncuesta($parametros)
	{
		//Solo la fecha de la noticia

		$consulta = $parametros;
		//Array de placeholders
		$placeholder = [];

		$sql = "SELECT * "
			."FROM formulariocomp_respuestas AS fcr  "
			."INNER JOIN formulariocompletado ON fcr.rel_idformcomp = formulariocompletado.idformcomp   "
			."INNER JOIN users ON formulariocompletado.rel_idusuario = users.id  "
			."INNER JOIN uipregunta ON fcr.rel_idpregunta = uipregunta.iduipregunta  "
			."INNER JOIN uirespuesta ON fcr.rel_idrespuesta = uirespuesta.iduirespuesta  "
			."INNER JOIN uiseccion ON uipregunta.rel_iduiseccion = uiseccion.iduiseccion  "
			."INNER JOIN uimodulo ON uiseccion.rel_iduimodulo = uimodulo.iduimodulo"
			."  "
			."WHERE formulariocompletado.idformcomp  "
			." IN "
			."( "
			."SELECT formulariocompletado.idformcomp  "
			."FROM formulariocompletado  "
			."LEFT JOIN users ON formulariocompletado.rel_idusuario = users.id  "
			."LEFT JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento  "
			."WHERE formulariocompletado.rel_iduiencuesta = ?  "
			."AND formulariocompletado.es_valida = 1  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			." "
			."  ";

		/** @noinspection PhpLanguageLevelInspection */

		//Didcriminante del formulario
		array_push($placeholder, $consulta->iduiencuesta);

		//A単adir el rango de edades
		if($consulta->edad_inicial !=0 && $consulta->edad_final !=0)
		{
			$sql .= "AND (formulariocompletado.edad BETWEEN ? AND ? )  ";
			array_push($placeholder, $consulta->edad_inicial);
			array_push($placeholder, $consulta->edad_final);
		}
		if((int)$consulta->sexo != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND formulariocompletado.sexo = ?  ";
			array_push($placeholder, (int)$consulta->sexo);
		}
		if ((int)$consulta->area != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND formulariocompletado.area = ?  ";
			array_push($placeholder, (int)$consulta->area);
		}
		if ($consulta->iddepartamento != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND departamento.iddepartamento = ?  ";
			array_push($placeholder, $consulta->iddepartamento);
		}

		$sql .=" ) ";


		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}

	public function leerEncuestaAsignadaPorID($idencuesta)
	{
		$this->db->where('idencuesta',$idencuesta);
		$q=$this->db->get ('encuesta');
		return $q->row();
	}

	public function actualizarAsignacion($datos)
	{
		$consulta = $datos;
		$this->db->trans_begin();

		$data = array(
			'rel_idusuario' => $consulta->nuevo_usuario,
			'rel_idgeolocal' => $consulta->idgeolocalizacion,
		);
		$this->db->where('idencuesta', $consulta->idencuesta);
		$this->db->update('encuesta', $data);

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}
	public function geolocalizacionPorID($identificador)
	{
		$this->db->where('idgeolocal',$identificador);
		$q=$this->db->get ('geolocalizacion ');
		return $q->row();
	}

	public function resultadosEncuestaDatosGenerales($parametros)
	{
		//Solo la fecha de la noticia

		$consulta = $parametros;
		//Array de placeholders
		$placeholder = [];

		$sql = "SELECT * "
			."FROM formulariocompletado  "
			."LEFT JOIN users ON formulariocompletado.rel_idusuario = users.id   "
			."LEFT JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento  "
			."LEFT JOIN universidad ON users.rel_iduniversidad = universidad.iduniversidad  "
			."WHERE formulariocompletado.rel_iduiencuesta = ?  "
			." "
			." "
			." ";

		/** @noinspection PhpLanguageLevelInspection */

		//Didcriminante del formulario
		array_push($placeholder, $consulta->iduiencuesta);

		//Añadir el rango de edades
		if($consulta->edad_inicial !=0 && $consulta->edad_final !=0)
		{
			$sql .= "AND (formulariocompletado.edad BETWEEN ? AND ? )  ";
			array_push($placeholder, $consulta->edad_inicial);
			array_push($placeholder, $consulta->edad_final);
		}
		if((int)$consulta->sexo != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND formulariocompletado.sexo = ?  ";
			array_push($placeholder, (int)$consulta->sexo);
		}
		if ((int)$consulta->area != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND formulariocompletado.area = ?  ";
			array_push($placeholder, (int)$consulta->area);
		}
		if ($consulta->iddepartamento != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND departamento.iddepartamento = ?  ";
			array_push($placeholder, $consulta->iddepartamento);
		}



		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}

	public function formularioCompletadoPorID($identificador)
	{
		$this->db->where("idformcomp",$identificador);
		$q=$this->db->get("formulariocompletado");
		return $q->row();
	}

	public function cambiarEstadoFormulario($identificador, $estado)
	{
		/** @noinspection PhpLanguageLevelInspection */
		$data = [
			'es_valida' => $estado,
		];
		$this->db->where('idformcomp', $identificador);
		$this->db->update(' formulariocompletado', $data);
	}

	public function resultadosEncuestaDatosGeneralesActivos($parametros)
	{
		//Solo la fecha de la noticia

		$consulta = $parametros;
		//Array de placeholders
		$placeholder = [];

		$sql = "SELECT * "
			."FROM formulariocompletado  "
			."LEFT JOIN users ON formulariocompletado.rel_idusuario = users.id   "
			."LEFT JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento  "
			."LEFT JOIN universidad ON users.rel_iduniversidad = universidad.iduniversidad  "
			."WHERE formulariocompletado.rel_iduiencuesta = ?  "
			."AND formulariocompletado.es_valida = 1 "
			." "
			." ";

		/** @noinspection PhpLanguageLevelInspection */

		//Didcriminante del formulario
		array_push($placeholder, $consulta->iduiencuesta);

		//Añadir el rango de edades
		if($consulta->edad_inicial !=0 && $consulta->edad_final !=0)
		{
			$sql .= "AND (formulariocompletado.edad BETWEEN ? AND ? )  ";
			array_push($placeholder, $consulta->edad_inicial);
			array_push($placeholder, $consulta->edad_final);
		}
		if((int)$consulta->sexo != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND formulariocompletado.sexo = ?  ";
			array_push($placeholder, (int)$consulta->sexo);
		}
		if ((int)$consulta->area != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND formulariocompletado.area = ?  ";
			array_push($placeholder, (int)$consulta->area);
		}
		if ($consulta->iddepartamento != 0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND departamento.iddepartamento = ?  ";
			array_push($placeholder, $consulta->iddepartamento);
		}



		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}

	public function listarFormulariosLlenos($identificador)
	{
		//Solo la fecha de la noticia

		$idencuesta = $identificador;
		//Array de placeholders

		$sql = "SELECT * "
			."FROM formulariocompletado  "
			."LEFT JOIN users ON formulariocompletado.rel_idusuario = users.id   "
			."LEFT JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento  "
			."LEFT JOIN universidad ON users.rel_iduniversidad = universidad.iduniversidad  "
			."WHERE formulariocompletado.rel_iduiencuesta = ?  "
			." "
			." "
			." ";

		$qry = $this->db->query($sql, $idencuesta);
		return $qry->result();
	}

	public function actualizarRegistro($registro)
	{
		/** @noinspection PhpLanguageLevelInspection */
		$data = [
			'ciudad' => $registro->ciudad ,
			'zona' => $registro->zona ,
			'latidud_fc' => $registro->latitud ,
			'longitud_fc ' => $registro->longitud ,
			'area' => $registro->area,
		];
		$this->db->where('idformcomp', $registro->idformcomp);
		$this->db->update(' formulariocompletado', $data);
	}

	//Leer todas las encuestas, activas e inactivas
	public function leerEncuestas()
	{
		//$this->db->where('encuesta_activa', 1);
		$q=$this->db->get('uiencuesta');
		return $q->result();
	}

	public function leerModulosEncuesta($identificador)
	{
		$idencuesta = $identificador;
		$sql = "SELECT * "
			."FROM uimodulo  "
			."WHERE uimodulo.rel_iduiencuesta = ?   "
			."ORDER BY uimodulo.uiorden_modulo  "
			."  "
			."  "
			." "
			." "
			." ";

		$qry = $this->db->query($sql, $idencuesta);
		return $qry->result();
	}

	public function leerSeccionesModulo($identificador)
	{
		$idmodulo = $identificador;
		$sql = "SELECT * "
			."FROM uiseccion  "
			."LEFT JOIN uimodulo ON uiseccion.rel_iduimodulo = uimodulo.iduimodulo    "
			."WHERE uimodulo.iduimodulo = ?  "
			."ORDER BY uiseccion.uiorden_seccion  "
			."  "
			." "
			." "
			." ";

		$qry = $this->db->query($sql, $idmodulo);
		return $qry->result();
	}

	public function leerPreguntaSeccion($identificador)
	{
		$idseccion = $identificador;
		$sql = "SELECT * "
			."FROM uipregunta  "
			."LEFT JOIN uitipopregunta ON uipregunta.rel_iduitipopregunta = uitipopregunta.iduitipopregunta    "
			."WHERE uipregunta.rel_iduiseccion = ?  "
			."  "
			."  "
			." "
			." "
			." ";

		$qry = $this->db->query($sql, $idseccion);
		return $qry->row();
	}

	public function leerRespuestaTipo1($idpregunta, $idrespuesta)
	{
		$sql = "SELECT * "
			."FROM uirespuesta_pregunta  "
			."LEFT JOIN uirespuesta ON uirespuesta_pregunta.rel_iduirespuesta = uirespuesta.iduirespuesta   "
			."WHERE uirespuesta_pregunta.rel_iduipregunta = ? AND uirespuesta_pregunta.rel_iduirespuesta = ?    "
			."ORDER BY uirespuesta_pregunta.uiorden_respuesta  "
			."  "
			."  "
			." "
			." "
			." ";

		$qry = $this->db->query($sql, [$idpregunta, $idrespuesta]);
		return $qry->row();
	}

	public function leerRespuestaTipo3($idpregunta)
	{
		$sql = "SELECT * "
			."FROM uirespuesta_pregunta  "
			."LEFT JOIN uirespuesta ON uirespuesta_pregunta.rel_iduirespuesta = uirespuesta.iduirespuesta   "
			."WHERE uirespuesta_pregunta.rel_iduipregunta = ?    "
			."  "
			."  "
			."  "
			." "
			." "
			." ";

		$qry = $this->db->query($sql, [$idpregunta,]);
		return $qry->row();
	}

	public function leerRespuestaTipo4($idpregunta)
	{
		$sql = "SELECT * "
			."FROM uirespuesta_pregunta  "
			."LEFT JOIN uirespuesta ON uirespuesta_pregunta.rel_iduirespuesta = uirespuesta.iduirespuesta   "
			."LEFT JOIN uipregunta ON uirespuesta_pregunta.rel_iduipregunta = uipregunta.iduipregunta    "
			."LEFT JOIN uiseccion ON uipregunta.rel_iduiseccion = uiseccion.iduiseccion  "
			."WHERE uirespuesta_pregunta.rel_iduipregunta = ?  "
			." "
			." "
			." "
			." ";

		$qry = $this->db->query($sql, [$idpregunta,]);
		return $qry->row();
	}

	public function leerRespuestaTipo5($idpregunta)
	{
		$sql = "SELECT * "
			."FROM uirespuesta_pregunta  "
			."LEFT JOIN uirespuesta ON uirespuesta_pregunta.rel_iduirespuesta = uirespuesta.iduirespuesta   "
			."LEFT JOIN uipregunta ON uirespuesta_pregunta.rel_iduipregunta = uipregunta.iduipregunta    "
			."LEFT JOIN uiseccion ON uipregunta.rel_iduiseccion = uiseccion.iduiseccion  "
			."WHERE uirespuesta_pregunta.rel_iduipregunta = ?  "
			." "
			." "
			." "
			." ";

		$qry = $this->db->query($sql, [$idpregunta,]);
		return $qry->row();
	}

	public function leerLasEncuestasCompletadas($consulta){
		$idencuesta = $consulta->iduiencuesta;
		$sql = "SELECT *   "
			."FROM formulariocompletado  "
			."LEFT JOIN formulariocomp_json ON formulariocompletado.idformcomp = formulariocomp_json.rel_idform   "
			."LEFT JOIN users ON formulariocompletado.rel_idusuario = users.id  "
			."WHERE formulariocompletado.rel_iduiencuesta = ?    "
			."AND formulariocompletado.es_valida = 1  "
			."   "
			."  "
			."  "
			." "
			." ";

		$qry = $this->db->query($sql, [$idencuesta,]);
		return $qry->result();
	}

	public function leerLasEncuestasCompletadasDepartamento($consulta){
		$idencuesta = $consulta->iduiencuesta;
		$sql = "SELECT *   "
			."FROM formulariocompletado  "
			."LEFT JOIN formulariocomp_json ON formulariocompletado.idformcomp = formulariocomp_json.rel_idform   "
			."LEFT JOIN users ON formulariocompletado.rel_idusuario = users.id  "
			."WHERE formulariocompletado.rel_iduiencuesta = ?    "
			."AND formulariocompletado.es_valida = 1  "
			."   "
			."  "
			."  "
			." "
			." ";

		$qry = $this->db->query($sql, [$idencuesta,]);
		return $qry->result();
	}

	public function contarEncuestasPorCiudad($consulta){
		$idencuesta = $consulta->iduiencuesta;
		$sql = "SELECT formulariocompletado.idformcomp, formulariocompletado.ciudad, COUNT(*) AS numero    "
			."FROM formulariocompletado  "
			."WHERE formulariocompletado.es_valida = 1   "
			."AND formulariocompletado.rel_iduiencuesta = ?  "
			."GROUP by formulariocompletado.ciudad    "
			."  "
			."   "
			."  "
			."  "
			." "
			." ";

		$qry = $this->db->query($sql, [$idencuesta,]);
		return $qry->result();
	}

	public function leerSeccionesPreguntasModulo($identificador)
	{
		$idmodulo = $identificador;
		$sql = " "
			."  "
			."LEFT JOIN formulariocomp_json ON formulariocompletado.idformcomp = formulariocomp_json.rel_idform   "
			."LEFT JOIN users ON formulariocompletado.rel_idusuario = users.id  "
			."WHERE formulariocompletado.rel_iduiencuesta = ?    "
			."  "
			."   "
			."  "
			."  "
			." "
			." ";

		$qry = $this->db->query($sql, [$idencuesta,]);
		return $qry->result();
	}

	public function leerLosDatosPregunta($idpregunta)
	{
		$sql = "SELECT * "
			."FROM uirespuesta_pregunta  "
			."WHERE uirespuesta_pregunta.rel_iduipregunta = ?   "
			."    "
			."  "
			."   "
			."  "
			."  "
			." "
			." ";

		$qry = $this->db->query($sql, [$idpregunta, ]);
		return $qry->row();
	}

	public function leerUnaEncuestaPorID()
	{
		$sql = "SELECT *   "
			."FROM formulariocompletado  "
			."LEFT JOIN formulariocomp_json ON formulariocompletado.idformcomp = formulariocomp_json.rel_idform   "
			."WHERE formulariocompletado.rel_iduiencuesta = 2 AND formulariocompletado.idformcomp= 1585    "
			."  "
			."   "
			."  "
			."  "
			." "
			." ";

		$qry = $this->db->query($sql);
		return $qry->row();
	}







}
