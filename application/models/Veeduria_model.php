<?php

class Veeduria_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function leerFormularios()
	{
		$sql = "SELECT *    "
			."FROM form_veeduria      "
			."    "
			."  "
			." "
			."  "
			." "
			."  ";
		$qry = $this->db->query($sql, [ ]);
		return $qry->result();
	}

	//Extraer el formulario tipo 1
	public function formEncuestadoresSupervisores(){
		$sql = "SELECT *    "
			."FROM form_veeduria_enc_sup      "
			."LEFT JOIN form_veeduria ON form_veeduria.idfv = form_veeduria_enc_sup.idfv    "
			."  "
			." "
			."  "
			." "
			."  ";
		$qry = $this->db->query($sql, [ ]);
		return $qry->row();
	}

	//Extraer el formulario tipo 2
	public function formCiudadania(){
		$sql = "SELECT *    "
			."FROM form_veeduria_ciudadania     "
			."LEFT JOIN form_veeduria ON form_veeduria.idfv = form_veeduria_ciudadania.idfv "
			."  "
			." "
			."  "
			." "
			."  ";
		$qry = $this->db->query($sql, [ ]);
		return $qry->row();
	}

	//Extraer el formulario tipo 3
	public function formVeedores(){
		$sql = "SELECT *    "
			."FROM form_veeduria_veedores     "
			."LEFT JOIN form_veeduria ON form_veeduria.idfv = form_veeduria_veedores.idfv "
			."  "
			." "
			."  "
			." "
			."  ";
		$qry = $this->db->query($sql, [ ]);
		return $qry->row();
	}

	//Extraer las secciones de un formulario
	public function formSecciones($idformulario){
		$sql = "SELECT *    "
			."FROM form_veeduria_seccion      "
			."WHERE form_veeduria_seccion.rel_idfv = ? "
			."ORDER BY ordinal ASC  "
			." "
			."  "
			." "
			."  ";
		$qry = $this->db->query($sql, [$idformulario, ]);
		return $qry->result();
	}

	//Extraer las secciones de un formulario
	public function leerPreguntasFormularios($idformulario){
		$sql = "SELECT form_veeduria_pregunta.idfvpreg AS idpregunta, form_veeduria_pregunta.pregunta AS pregunta, form_veeduria_pregunta.tipo AS tipo_pregunta, form_veeduria_pregunta.ordinal AS ordinal_pregunta, form_veeduria_pregunta.cod_preg AS codigo_pregunta, form_veeduria_pregunta.rel_idfvsec, form_veeduria_seccion.idfvsec AS idseccion, form_veeduria_seccion.nombre_seccion AS seccion, form_veeduria_seccion.cod_secc, form_veeduria_seccion.rel_idfv    "
			."FROM form_veeduria_pregunta      "
			."LEFT JOIN form_veeduria_seccion ON form_veeduria_seccion.idfvsec = form_veeduria_pregunta.rel_idfvsec   "
			."WHERE form_veeduria_seccion.rel_idfv = ?    "
			."ORDER BY form_veeduria_pregunta.ordinal ASC   "
			."  "
			." "
			."  ";
		$qry = $this->db->query($sql, [$idformulario, ]);
		return $qry->result();
	}


	//Insertar form1
	public function registrarForm($formulario){
		//Matriz de datos
		$form1 = $formulario;
		date_default_timezone_set('America/La_Paz');
		$fecha = time();

		//Iniciar la transaccion
		$this->db->trans_begin();

		//Insertar la respuesta en la tabla
		/** @noinspection PhpUnusedLocalVariableInspection */
		/** @noinspection PhpLanguageLevelInspection */
		$datos_formulario_respuesta = [
			'fecha_registro' => $fecha,
			'form_respuesta ' => json_encode($form1),
			'rel_idfv' => $form1->idformulario,
			'rel_idusr' => $form1->idusuario,
		];
		$this->db->insert('form_veeduria_respuesta', $datos_formulario_respuesta);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

	}

	public function registrarForm2($formulario){
		//Matriz de datos
		$form = $formulario;
		date_default_timezone_set('America/La_Paz');
		$fecha = time();

		//Iniciar la transaccion
		$this->db->trans_begin();

		//Insertar la respuesta en la tabla
		/** @noinspection PhpUnusedLocalVariableInspection */
		/** @noinspection PhpLanguageLevelInspection */
		$datos_formulario_respuesta = [
			'fecha_registro' => $fecha,
			'form_respuesta ' => json_encode($form),
			'rel_idfv' => $form->idformulario,
			'rel_idusr' => $form->idusuario,
		];
		//$this->db->insert('form_veeduria_respuesta', $datos_formulario_respuesta);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
	}

	/***
	 *
	 * EDICION
	 *
	**/

	public function leerFormUsuario($idusuario){
		$sql = "SELECT *    "
			."FROM form_veeduria_respuesta      "
			."LEFT JOIN form_veeduria ON form_veeduria.idfv = form_veeduria_respuesta.rel_idfv   "
			."WHERE form_veeduria_respuesta.rel_idusr = ?    "
			."AND form_veeduria_respuesta.es_valido = 1   "
			."  "
			." "
			."  ";
		$qry = $this->db->query($sql, [$idusuario, ]);
		return $qry->result();
	}

	//Leer formulario
	public function leerFormulario($idformulario){
		$sql = "SELECT *    "
			."FROM form_veeduria_respuesta      "
			."LEFT JOIN form_veeduria ON form_veeduria.idfv = form_veeduria_respuesta.rel_idfv  "
			."WHERE form_veeduria_respuesta.idfvresp =  ?    "
			."    "
			."    "
			."   "
			."  "
			."  ";
		$qry = $this->db->query($sql, [$idformulario, ]);
		return $qry->row();
	}

	//Insertar form1
	public function registrarFormEdicion($formulario, $idfr)
	{
		//Matriz de datos
		$form1 = $formulario;
		date_default_timezone_set('America/La_Paz');
		$fecha = time();

		//Iniciar la transaccion
		$this->db->trans_begin();

		//Insertar la respuesta en la tabla
		/** @noinspection PhpUnusedLocalVariableInspection */
		/** @noinspection PhpLanguageLevelInspection */
		$datos_formulario_respuesta = [
			'form_respuesta ' => json_encode($form1),
			'rel_idfv' => $form1->idformulario,
			//'rel_idusr' => $form1->idusuario,
		];

		/** @noinspection PhpLanguageLevelInspection */
		$identificador = [
			'idfvresp' => $idfr,
		];

		//$this->db->insert('form_veeduria_respuesta', $datos_formulario_respuesta);
		$this->db->update('form_veeduria_respuesta', $datos_formulario_respuesta, $identificador);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}

	public function leerFormResp(){
		$sql = "SELECT *    "
			."FROM form_veeduria_respuesta      "
			."LEFT JOIN form_veeduria ON form_veeduria.idfv = form_veeduria_respuesta.rel_idfv   "
			."LEFT JOIN users ON users.id = form_veeduria_respuesta.rel_idusr    "
			."   "
			."  "
			." "
			."  ";
		$qry = $this->db->query($sql, [ ]);
		return $qry->result();
	}

	public function cambiarEstado($identificador, $estado)
	{
		/** @noinspection PhpLanguageLevelInspection */
		$data = [
			'es_valido' => $estado,
		];
		$this->db->where('idfvresp', $identificador);
		$this->db->update('form_veeduria_respuesta', $data);
	}

	//Reporte: todos los formularios
	public function reporteFormularios(){
		$sql = "SELECT *   "
			."FROM form_veeduria_respuesta      "
			."LEFT JOIN form_veeduria ON form_veeduria.idfv = form_veeduria_respuesta.rel_idfv   "
			."LEFT JOIN users ON users.id = form_veeduria_respuesta.rel_idusr    "
			."WHERE form_veeduria_respuesta.es_valido = 1   "
			."  "
			." "
			."  ";
		$qry = $this->db->query($sql, [ ]);
		return $qry->result();
	}

	//Reporte: formularios de un tipo
	public function reporteTipoFormularios($tipo_formulario){
		$sql = "SELECT *  "
			."FROM form_veeduria_respuesta      "
			."LEFT JOIN form_veeduria ON form_veeduria.idfv = form_veeduria_respuesta.rel_idfv   "
			."LEFT JOIN users ON users.id = form_veeduria_respuesta.rel_idusr    "
			."WHERE form_veeduria_respuesta.rel_idfv = ?   "
			."AND form_veeduria_respuesta.es_valido = 1  "
			." "
			."  ";
		$qry = $this->db->query($sql, [$tipo_formulario, ]);
		return $qry->result();
	}


}
