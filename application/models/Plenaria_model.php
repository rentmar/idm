<?php


class Plenaria_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Crear nueva entrada de plenaria general
	public function crearPlenariaGeneral($nueva_plenaria){
		$plenaria = $nueva_plenaria;
		/*
		 * INICIAR LA TRANSACCION
		 */
		$this->db->trans_begin();
		//Almacenar la plenaria
		/** @noinspection PhpLanguageLevelInspection */
		$data_plenaria = [
			'fecha_registro' => $plenaria->fecha_registro,
			'fecha_plenaria' => $plenaria->fecha_norma,
			'plenaria_puntos_agenda' => $plenaria->puntos_agenda,
			'plenaria_agenda_cumplida' => $plenaria->cumpliento_agenda,
			'plenaria_puntos_pendientes' => $plenaria->asunto_sin_tratar,
			'plenaria_puntos_varios' => $plenaria->puntos_varios,
			'rel_idtpl' => $plenaria->tipo_plenaria['idtipoplenaria'],
			'rel_id' => $plenaria->idusuario,
			'rel_idcuestionario' => $plenaria->idcuestionario,
			'rel_idinsseg' => $plenaria->idinstancia_seguimiento,
			'monitores_seguimiento' => $plenaria->monitores,
		];
		$this->db->insert('plenaria_plurinacional', $data_plenaria);
		$plenaria_identificador = $this->db->insert_id();
		//Norma extraordinaria
		if($plenaria->norma_extraordinaria['existe'] == 1){
			/** @noinspection PhpLanguageLevelInspection */
			$data_norma_extraordinaria = [
				'plne_datos' => $plenaria->norma_extraordinaria['nombre'],
				'rel_idplenaria' => $plenaria_identificador,
			];
			$this->db->insert('plenaria_norma_extraord', $data_norma_extraordinaria);
		}
		if($this->db->trans_status() === FALSE ){
			//Error, cancela la transaccion
			$this->db->trans_rollback();
			return false;
		}else{
			//Todas las consultas se realizaron correctamente
			$this->db->trans_commit();
			return true;
		}
	}
	//Crear nueva entrada de plenaria departamental
	public function crearPlenariaDepartamental($nueva_plenaria){
		$plenaria = $nueva_plenaria;
		/*
		 * INICIAR LA TRANSACCION
		 */
		$this->db->trans_begin();
		//Almacenar la plenaria
		/** @noinspection PhpLanguageLevelInspection */
		$data_plenaria = [
			'fecha_registro' => $plenaria->fecha_registro,
			'fecha_plenaria' => $plenaria->fecha_norma,
			'plenaria_puntos_agenda' => $plenaria->puntos_agenda,
			'plenaria_agenda_cumplida' => $plenaria->cumpliento_agenda,
			'plenaria_puntos_pendientes' => $plenaria->asunto_sin_tratar,
			'plenaria_puntos_varios' => $plenaria->puntos_varios,
			'rel_idtpl' => $plenaria->tipo_plenaria['idtipoplenaria'],
			'rel_id' => $plenaria->idusuario,
			'rel_idcuestionario' => $plenaria->idcuestionario,
			'rel_idinsseg' => $plenaria->idinstancia_seguimiento,
			'monitores_seguimiento' => $plenaria->monitores,
		];
		$this->db->insert('plenaria_plurinacional', $data_plenaria);
		$plenaria_identificador = $this->db->insert_id();
		//Norma extraordinaria
		if($plenaria->norma_extraordinaria['existe'] == 1){
			/** @noinspection PhpLanguageLevelInspection */
			$data_norma_extraordinaria = [
				'plne_datos' => $plenaria->norma_extraordinaria['nombre'],
				'rel_idplenaria' => $plenaria_identificador,
			];
			$this->db->insert('plenaria_norma_extraord', $data_norma_extraordinaria);
		}
		//Datos adicionales para la plenaria departamental
		/** @noinspection PhpLanguageLevelInspection */
		$data_plenaria_dep = [
			'idplenaria' => $plenaria_identificador,
			'rel_iddepartamento' => $plenaria->departamento['iddepartamento'],
		];
		$this->db->insert('plenaria_departamental', $data_plenaria_dep);

		if($this->db->trans_status() === FALSE ){
			//Error, cancela la transaccion
			$this->db->trans_rollback();
			return false;
		}else{
			//Todas las consultas se realizaron correctamente
			$this->db->trans_commit();
			return true;
		}
	}
	//Crear nueva entrada de plenaria municipal
	public function crearPlenariaMunicipal($nueva_plenaria){
		$plenaria = $nueva_plenaria;
		/*
		 * INICIAR LA TRANSACCION
		 */
		$this->db->trans_begin();
		//Almacenar la plenaria
		/** @noinspection PhpLanguageLevelInspection */
		$data_plenaria = [
			'fecha_registro' => $plenaria->fecha_registro,
			'fecha_plenaria' => $plenaria->fecha_norma,
			'plenaria_puntos_agenda' => $plenaria->puntos_agenda,
			'plenaria_agenda_cumplida' => $plenaria->cumpliento_agenda,
			'plenaria_puntos_pendientes' => $plenaria->asunto_sin_tratar,
			'plenaria_puntos_varios' => $plenaria->puntos_varios,
			'rel_idtpl' => $plenaria->tipo_plenaria['idtipoplenaria'],
			'rel_id' => $plenaria->idusuario,
			'rel_idcuestionario' => $plenaria->idcuestionario,
			'rel_idinsseg' => $plenaria->idinstancia_seguimiento,
			'monitores_seguimiento' => $plenaria->monitores,
		];
		$this->db->insert('plenaria_plurinacional', $data_plenaria);
		$plenaria_identificador = $this->db->insert_id();
		//Norma extraordinaria
		if($plenaria->norma_extraordinaria['existe'] == 1){
			/** @noinspection PhpLanguageLevelInspection */
			$data_norma_extraordinaria = [
				'plne_datos' => $plenaria->norma_extraordinaria['nombre'],
				'rel_idplenaria' => $plenaria_identificador,
			];
			$this->db->insert('plenaria_norma_extraord', $data_norma_extraordinaria);
		}
		//Datos adicionales para la plenaria municipal
		/** @noinspection PhpLanguageLevelInspection */
		$data_plenaria_mun = [
			'idplenaria' => $plenaria_identificador,
			'rel_idmunicipio' => $plenaria->municipio['idmunicipio'],
		];
		$this->db->insert('plenaria_municipal', $data_plenaria_mun);

		if($this->db->trans_status() === FALSE ){
			//Error, cancela la transaccion
			$this->db->trans_rollback();
			return false;
		}else{
			//Todas las consultas se realizaron correctamente
			$this->db->trans_commit();
			return true;
		}
	}

	//Leer todas las plenarias de un usuario
	public function leerPlenarias($idusuario)
	{
		$sql = "SELECT *     "
			."FROM plenaria_plurinacional    "
			."LEFT JOIN users ON users.id = plenaria_plurinacional.rel_id   "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = plenaria_plurinacional.rel_idinsseg   "
			."LEFT JOIN tipoplenaria ON tipoplenaria.idtpl = plenaria_plurinacional.rel_idtpl "
			."LEFT JOIN tipo_plenaria_informacion ON tipo_plenaria_informacion.idtpinf = tipoplenaria.rel_idtpinf  "
			."WHERE plenaria_plurinacional.rel_id = ? AND plenaria_plurinacional.activo = ?  "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idusuario, 1, ]);
		return $qry->result();
	}

	//Leer el tipo de instancia de seguimiento de una plenaria
	public function tipoInstanciaSeguimiento($idplenaria){
		$sql = "SELECT plenaria_plurinacional.idplenaria, instancia_seguimiento.idinsseg, instancia_seguimiento.instancia      "
			."FROM plenaria_plurinacional    "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = plenaria_plurinacional.rel_idinsseg   "
			."WHERE plenaria_plurinacional.idplenaria = ?   "
			." "
			."  "
			."  "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idplenaria, ]);
		return $qry->row();
	}

	//Plenaria por identificador
	public function leerPlenariaPorId($idplenaria){
		$sql = "SELECT plenaria_plurinacional.idplenaria, plenaria_plurinacional.fecha_plenaria, plenaria_plurinacional.plenaria_puntos_agenda, plenaria_plurinacional.plenaria_agenda_cumplida, plenaria_plurinacional.plenaria_puntos_pendientes,plenaria_plurinacional.plenaria_puntos_varios, plenaria_plurinacional.rel_idtpl AS idtipoplenaria, instancia_seguimiento.idinsseg, instancia_seguimiento.instancia, plenaria_plurinacional.monitores_seguimiento, plenaria_departamental.rel_iddepartamento, departamento.iddepartamento, departamento.nombre_departamento, plenaria_municipal.rel_idmunicipio, municipio.idmunicipio, municipio.municipio_nombre, plenaria_plurinacional.activo          "
			."FROM plenaria_plurinacional       "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = plenaria_plurinacional.rel_idinsseg       "
			."LEFT JOIN plenaria_departamental ON plenaria_departamental.idplenaria = plenaria_plurinacional.idplenaria     "
			."LEFT JOIN plenaria_municipal ON plenaria_municipal.idplenaria = plenaria_plurinacional.idplenaria   "
			."LEFT JOIN departamento ON departamento.iddepartamento = plenaria_departamental.rel_iddepartamento   "
			."LEFT JOIN municipio ON municipio.idmunicipio = plenaria_municipal.rel_idmunicipio   "
			."WHERE plenaria_plurinacional.idplenaria = ?   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idplenaria, ]);
		return $qry->row();
	}

	//Plenaria norma extraordinaria
	//Comprueba si la plenaria incluyo una norma extraordinaria
	//Retorna:
	// - Retorna la informacion de la norma extraordinaria
	// - false si no se incluyo una norma extraordinaria
	// -
	public function plenariaNormaExtraordinaria($identificador){
		$idplenaria = $identificador;
		$this->db->from('plenaria_norma_extraord' );
		/** @noinspection PhpLanguageLevelInspection */
		$this->db->where(['rel_idplenaria'=>$identificador,]);
		$otro_num = $this->db->count_all_results();

		if($otro_num == 1)
		{
			$query = $this->db->get_where('plenaria_norma_extraord', array('rel_idplenaria' => $idplenaria));
			return $query->row();
		}else{
			return false;
		}
	}

	//Plenaria tipo plenaria
	public function plenariaTipoId($identificador)
	{
		$idplenaria = $identificador;
		$sql = "SELECT tipoplenaria.idtpl, tipoplenaria.rel_idtpinf, tipo_plenaria_informacion.idtpinf, tipo_plenaria_informacion.tipo_plenaria_nombre    "
			."FROM plenaria_plurinacional       "
			."LEFT JOIN tipoplenaria ON tipoplenaria.idtpl = plenaria_plurinacional.rel_idtpl       "
			."LEFT JOIN tipo_plenaria_informacion ON tipo_plenaria_informacion.idtpinf = tipoplenaria.rel_idtpinf     "
			."WHERE plenaria_plurinacional.idplenaria = ?   "
			."   "
			."   "
			."   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idplenaria, ]);
		return $qry->row();
	}


	//Actualizar la informacion de la plenaria
	public function modificarPlenariaDatos($datos)
	{
		//Datos de la plenaria en formato array
		$idplenaria = $datos['idplenaria'];
		/** @noinspection PhpLanguageLevelInspection */
		$datos_plenaria = [
			'fecha_plenaria' => $datos['fecha_plenaria'],
			'plenaria_puntos_agenda' => $datos['puntos_agenda'],
			'plenaria_agenda_cumplida' => $datos['cumplimiento'],
			'plenaria_puntos_pendientes' => $datos['descripcion_pendiente'],
			'plenaria_puntos_varios' => $datos['puntos_varios'],
			'monitores_seguimiento' => $datos['monitores'],
		];

		$this->db->where('idplenaria', $idplenaria);
		$this->db->update('plenaria_plurinacional', $datos_plenaria);
	}

	//Actualizar el tipo de plenaria
	public function modificarTipoPlenaria($datos){
		//datos del tipo de plenaria en forma de array
		$idplenaria = $datos['idplenaria'];
		/** @noinspection PhpLanguageLevelInspection */
		$datos_plenaria = [
			'rel_idtpl' => $datos['idtipoplenaria'],
		];
		$this->db->where('idplenaria', $idplenaria);
		$this->db->update('plenaria_plurinacional', $datos_plenaria);
	}

	//Modificar una norma extraordinaria existente
	public function modificarNormaExtraordinaria($datos){
		$idnormaextra = $datos['idnormaextra'];
		//Datos de la norma extraordinaria en forma de array
		/** @noinspection PhpLanguageLevelInspection */
		$norma = [
			'plne_datos' => $datos['informacion'],
		];
		$this->db->where('idplne', $idnormaextra);
		$this->db->update('plenaria_norma_extraord', $norma);

	}

	//Crear una entrada de norma extraordinaria
	public function crearNormaExtra($datos){
		/** @noinspection PhpLanguageLevelInspection */
		$norma = [
			'plne_datos' => $datos['informacion'],
			'rel_idplenaria' => $datos['idplenaria'],
		];
		$this->db->insert('plenaria_norma_extraord', $norma);
	}

	//Leer todas las plenarias
	public function leerTodasLasPlenarias(){
		$sql = "SELECT *    "
			."FROM plenaria_plurinacional       "
			."LEFT JOIN users ON users.id = plenaria_plurinacional.rel_id      "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = plenaria_plurinacional.rel_idinsseg      "
			."LEFT JOIN tipoplenaria ON tipoplenaria.idtpl = plenaria_plurinacional.rel_idtpl    "
			."LEFT JOIN tipo_plenaria_informacion ON tipo_plenaria_informacion.idtpinf = tipoplenaria.rel_idtpinf     "
			."   "
			."     "
			."  "
			."   "
			."   ";
		$qry = $this->db->query($sql );
		return $qry->result();
	}

	public function cambiarEstado($identificador, $estado)
	{
		/** @noinspection PhpLanguageLevelInspection */
		$data = [
			'activo' => $estado,
		];
		$this->db->where('idplenaria', $identificador);
		$this->db->update('plenaria_plurinacional', $data);
	}

	public function reportePlenaria($parametros)
	{
		$consulta = $parametros;
		//Array de placeholders
		/** @noinspection PhpLanguageLevelInspection */
		$placeholder = [];

		$sql = "SELECT p.idplenaria, p.fecha_registro, p.fecha_plenaria, instancia_seguimiento.instancia, departamento.nombre_departamento, municipio.municipio_nombre, p.plenaria_puntos_agenda, p.plenaria_agenda_cumplida, p.plenaria_puntos_pendientes, p.plenaria_puntos_varios, p.monitores_seguimiento, tipo_plenaria_informacion.tipo_plenaria_nombre, users.username as monitor     "
			."FROM plenaria_plurinacional as p  "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = p.rel_idinsseg  "
			."LEFT JOIN plenaria_departamental ON plenaria_departamental.idplenaria = p.idplenaria  "
			."LEFT JOIN plenaria_municipal ON plenaria_municipal.idplenaria = p.idplenaria  "
			."LEFT JOIN departamento ON departamento.iddepartamento = plenaria_departamental.rel_iddepartamento  "
			."LEFT JOIN municipio ON municipio.idmunicipio = plenaria_municipal.rel_idmunicipio  "
			."LEFT JOIN tipoplenaria ON tipoplenaria.idtpl = p.rel_idtpl  "
			."LEFT JOIN tipo_plenaria_informacion ON tipo_plenaria_informacion.idtpinf = tipoplenaria.rel_idtpinf  "
			."LEFT JOIN users ON users.id = p.rel_id  "
			."  "
			."  "
			."  "
			."  "
			."WHERE p.activo = 1 AND (p.fecha_plenaria BETWEEN ? AND ?)  "
			."  ";

		/** @noinspection PhpLanguageLevelInspection */

		//Añadir el intervalo de fechas al placeholder
		array_push($placeholder, $consulta->fecha_inicio);
		array_push($placeholder, $consulta->fecha_fin);


		$sql .= 'ORDER BY p.fecha_plenaria ASC   ';
		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}

	public function reportePlenariaMunicipal($parametros){
		$consulta = $parametros;
		//Array de placeholders
		/** @noinspection PhpLanguageLevelInspection */
		$placeholder = [];

		$sql = "SELECT p.idplenaria, p.fecha_registro, p.fecha_plenaria, instancia_seguimiento.instancia, departamento.nombre_departamento, municipio.municipio_nombre, p.plenaria_puntos_agenda, p.plenaria_agenda_cumplida, p.plenaria_puntos_pendientes, p.plenaria_puntos_varios, p.monitores_seguimiento, tipo_plenaria_informacion.tipo_plenaria_nombre, users.username as monitor     "
			."FROM plenaria_plurinacional as p  "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = p.rel_idinsseg  "
			."LEFT JOIN plenaria_municipal ON plenaria_municipal.idplenaria = p.idplenaria  "
			."LEFT JOIN municipio ON municipio.idmunicipio = plenaria_municipal.rel_idmunicipio  "
			."LEFT JOIN departamento ON departamento.iddepartamento = municipio.rel_iddepartamento  "
			."LEFT JOIN tipoplenaria ON tipoplenaria.idtpl = p.rel_idtpl    "
			."LEFT JOIN tipo_plenaria_informacion ON tipo_plenaria_informacion.idtpinf = tipoplenaria.rel_idtpinf    "
			."LEFT JOIN users ON users.id = p.rel_id  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."WHERE p.activo = 1 AND (p.fecha_plenaria BETWEEN ? AND ?)  "
			."AND instancia_seguimiento.idinsseg = ?  ";

		/** @noinspection PhpLanguageLevelInspection */

		//Añadir el intervalo de fechas al placeholder
		array_push($placeholder, $consulta->fecha_inicio);
		array_push($placeholder, $consulta->fecha_fin);
		array_push($placeholder, $consulta->idinstancia);

		if($consulta->iddepartamento !=0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND departamento.iddepartamento  = ?  ";
			array_push($placeholder, $consulta->iddepartamento);
		}
		if($consulta->idmunicipio !=0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND municipio.idmunicipio  = ?  ";
			array_push($placeholder, $consulta->idmunicipio);
		}

		$sql .= 'ORDER BY p.fecha_plenaria ASC   ';
		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();

	}

	public function reportePlenariaDepartamental($parametros){
		$consulta = $parametros;
		//Array de placeholders
		/** @noinspection PhpLanguageLevelInspection */
		$placeholder = [];

		$sql = "SELECT p.idplenaria, p.fecha_registro, p.fecha_plenaria, instancia_seguimiento.instancia, departamento.nombre_departamento, p.plenaria_puntos_agenda, p.plenaria_agenda_cumplida, p.plenaria_puntos_pendientes, p.plenaria_puntos_varios, p.monitores_seguimiento, tipo_plenaria_informacion.tipo_plenaria_nombre, users.username     "
			."FROM plenaria_plurinacional as p  "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = p.rel_idinsseg  "
			."LEFT JOIN plenaria_departamental ON plenaria_departamental.idplenaria = p.idplenaria  "
			."LEFT JOIN departamento ON departamento.iddepartamento = plenaria_departamental.rel_iddepartamento  "
			."LEFT JOIN tipoplenaria ON tipoplenaria.idtpl = p.rel_idtpl    "
			."LEFT JOIN tipo_plenaria_informacion ON tipo_plenaria_informacion.idtpinf = tipoplenaria.rel_idtpinf      "
			."LEFT JOIN users ON users.id = p.rel_id    "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."WHERE p.activo = 1 AND (p.fecha_plenaria BETWEEN ? AND ?)  "
			."AND instancia_seguimiento.idinsseg = ?  ";

		/** @noinspection PhpLanguageLevelInspection */

		//Añadir el intervalo de fechas al placeholder
		array_push($placeholder, $consulta->fecha_inicio);
		array_push($placeholder, $consulta->fecha_fin);
		array_push($placeholder, $consulta->idinstancia);

		if($consulta->iddepartamento !=0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND departamento.iddepartamento  = ?  ";
			array_push($placeholder, $consulta->iddepartamento);
		}


		$sql .= 'ORDER BY p.fecha_plenaria ASC   ';
		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();

	}

	public function reportePlenariaPlurinacional($parametros){
		$consulta = $parametros;
		//Array de placeholders
		/** @noinspection PhpLanguageLevelInspection */
		$placeholder = [];

		$sql = "SELECT p.idplenaria, p.fecha_registro, p.fecha_plenaria, instancia_seguimiento.instancia, p.plenaria_puntos_agenda, p.plenaria_agenda_cumplida, p.plenaria_puntos_pendientes, p.plenaria_puntos_varios, p.monitores_seguimiento, tipo_plenaria_informacion.tipo_plenaria_nombre, users.username as monitor          "
			."FROM plenaria_plurinacional as p    "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = p.rel_idinsseg    "
			."LEFT JOIN tipoplenaria ON tipoplenaria.idtpl = p.rel_idtpl    "
			."LEFT JOIN tipo_plenaria_informacion ON tipo_plenaria_informacion.idtpinf = tipoplenaria.rel_idtpinf    "
			."LEFT JOIN users ON users.id = p.rel_id    "
			."      "
			."    "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."WHERE p.activo = 1 AND (p.fecha_plenaria BETWEEN ? AND ?)  "
			."AND instancia_seguimiento.idinsseg = 1  ";

		/** @noinspection PhpLanguageLevelInspection */

		//Añadir el intervalo de fechas al placeholder
		array_push($placeholder, $consulta->fecha_inicio);
		array_push($placeholder, $consulta->fecha_fin);


		$sql .= 'ORDER BY p.fecha_plenaria ASC   ';
		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}



}
