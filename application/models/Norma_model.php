<?php

class Norma_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function leerTIposDeProponentes()
	{
		$sql = "SELECT    "
			."COLUMN_TYPE AS proponentes      "
			."FROM    "
			."INFORMATION_SCHEMA.COLUMNS  "
			."WHERE TABLE_NAME = 'norma_general' "
			."AND COLUMN_NAME= 'proponente'  "
			." "
			."  ";
		$qry = $this->db->query($sql, [ ]);
		return $qry->result();
	}

	public function leerOpcionesDeProponentes()
	{
		$table = 'norma_general';
		$field = 'proponente';
		$query = " SHOW COLUMNS FROM `$table` LIKE '$field' ";
		$row = $this->db->query(" SHOW COLUMNS FROM `$table` LIKE '$field' ")->row()->Type;
		$regex = "/'(.*?)'/";
		preg_match_all( $regex , $row, $enum_array );
		$enum_fields = $enum_array[1];
		return $enum_fields ;
	}

	//Crear nuevo registro para la norma
	public function crearNorma($norma_nueva){
		//Objeto norma
		$norma = $norma_nueva;
		$norma_json = json_encode($norma);
		/*
		 * INICIAR LA TRANSACCION
		 */
		$this->db->trans_begin();
		/** @noinspection PhpLanguageLevelInspection */
		$data_norma = [
			'fecha_registro' => $norma->fecha_registro,
			'fecha_norma' => $norma->fecha_norma,
			'fecha_primer_envio' => $norma->fecha_primer_envio,
			'estado_norma' => $norma->estado,
			'norma_remitente' => $norma->remitente,
			'norma_destinatario' => $norma->destinatario,
			'norma_segundo_envio' => $norma->segundo_envio['remitente'],
			'norma_nombre ' => $norma->nombre,
			'norma_codigo' => $norma->codigo,
			'norma_objeto' => $norma->objeto,
			'norma_observaciones' => $norma->observaciones,
			'proponente' => $norma->proponente['proponente'],
			'rel_id' => $norma->idusuario,
			'rel_idinsseg' => $norma->instancia_seguimiento,
			'rel_idcuestionario' => $norma->idcuestionario ,
			'datos_adicionales' => $norma_json,
		];
		$this->db->insert('norma_general', $data_norma );
		$norma_identificador = $this->db->insert_id();

		//Almacenar tema 1
		if($norma->tema1['idtema'] == 0){
			//Es otro tema ()normaotrotema
			/** @noinspection PhpLanguageLevelInspection */
			$datos_otro_tema = [
				'descripcion_otrotema' => $norma->tema1['tema'],
				'rel_idnormg' => $norma_identificador,
				'tema_ordinal' => 1,
			];
			$this->db->insert('normaotrotema', $datos_otro_tema);
		}else{
			//Tema del listado (norma_tema)
			/** @noinspection PhpLanguageLevelInspection */
			$datos_tema = [
				'rel_idnormg' => $norma_identificador,
				'rel_idtema' => $norma->tema1['idtema'],
				'tema_ordinal' => 1,
			];
			$this->db->insert('norma_tema', $datos_tema);
		}

		//Almacenar tema 2
		if($norma->tema2['idtema'] == 0){
			//Es otro tema ()normaotrotema
			/** @noinspection PhpLanguageLevelInspection */
			$datos_otro_tema = [
				'descripcion_otrotema' => $norma->tema2['tema'],
				'rel_idnormg' => $norma_identificador,
				'tema_ordinal' => 2,
			];
			$this->db->insert('normaotrotema', $datos_otro_tema);
		}else{
			//Tema del listado (norma_tema)
			/** @noinspection PhpLanguageLevelInspection */
			$datos_tema = [
				'rel_idnormg' => $norma_identificador,
				'rel_idtema' => $norma->tema2['idtema'],
				'tema_ordinal' => 2,
			];
			$this->db->insert('norma_tema', $datos_tema);
		}

		//Nota adicional si se trata de otro proponente
		if($norma->proponente['idproponente'] == 2){
			/** @noinspection PhpLanguageLevelInspection */
			$datos_otro_proponente = [
				'otro_descripcion' => $norma->proponente['otro'],
				'rel_idnormg' => $norma_identificador,
			];
			$this->db->insert('proponente_otro ', $datos_otro_proponente);
		}

		//Llenado adicional de la norma plurinacional
		/** @noinspection PhpLanguageLevelInspection */
		$datos_addnorma = [
			'idnormg' => $norma_identificador,
			'fecha_sol_repo' => $norma->fecha_reposicion,
			'proponente_solrepo' => $norma->remitente_reposicion,
			'destinatario_solrepo' => $norma->detinatario_reposicion,
			'enlace' => $norma->enlace,
			'obs_metodologicas' => $norma->obs_metodologicas,
		];
		$this->db->insert('norma_plurinacional', $datos_addnorma);

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

	//Crear nuevo registro para la norma
	public function crearNormaLeyPromulgada($norma_nueva){
		//Objeto norma
		$norma = $norma_nueva;
		$norma_json = json_encode($norma);
		/*
		 * INICIAR LA TRANSACCION
		 */
		$this->db->trans_begin();
		/** @noinspection PhpLanguageLevelInspection */
		$data_norma = [
			'fecha_registro' => $norma->fecha_registro,
			'fecha_norma' => $norma->fecha_norma,
			'fecha_norma_lit' => $norma->fecha_norma_literal,
			'fecha_primer_envio' => '',
			'estado_norma' => 1,
			'norma_remitente' => '',
			'norma_destinatario' => '',
			'norma_segundo_envio' => '',
			'norma_nombre ' => $norma->nombre,
			'norma_codigo' => $norma->codigo,
			'norma_objeto' => $norma->objeto,
			'norma_observaciones' => $norma->observaciones,
			'proponente' => '',
			'rel_id' => $norma->idusuario,
			'rel_idinsseg' => $norma->instancia_seguimiento,
			'rel_idcuestionario' => $norma->idcuestionario ,
			'datos_adicionales' =>  $norma_json,
		];
		$this->db->insert('norma_general', $data_norma );
		$norma_identificador = $this->db->insert_id();

		//Almacenar tema 1
		if($norma->tema1['idtema'] == 0){
			//Es otro tema ()normaotrotema
			/** @noinspection PhpLanguageLevelInspection */
			$datos_otro_tema = [
				'descripcion_otrotema' => $norma->tema1['tema'],
				'rel_idnormg' => $norma_identificador,
				'tema_ordinal' => 1,
			];
			$this->db->insert('normaotrotema', $datos_otro_tema);
		}else{
			//Tema del listado (norma_tema)
			/** @noinspection PhpLanguageLevelInspection */
			$datos_tema = [
				'rel_idnormg' => $norma_identificador,
				'rel_idtema' => $norma->tema1['idtema'],
				'tema_ordinal' => 1,
			];
			$this->db->insert('norma_tema', $datos_tema);
		}

		//Almacenar tema 2
		if($norma->tema2['idtema'] == 0){
			//Es otro tema ()normaotrotema
			/** @noinspection PhpLanguageLevelInspection */
			$datos_otro_tema = [
				'descripcion_otrotema' => $norma->tema2['tema'],
				'rel_idnormg' => $norma_identificador,
				'tema_ordinal' => 2,
			];
			$this->db->insert('normaotrotema', $datos_otro_tema);
		}else{
			//Tema del listado (norma_tema)
			/** @noinspection PhpLanguageLevelInspection */
			$datos_tema = [
				'rel_idnormg' => $norma_identificador,
				'rel_idtema' => $norma->tema2['idtema'],
				'tema_ordinal' => 2,
			];
			$this->db->insert('norma_tema', $datos_tema);
		}


		//Llenado adicional de la norma plurinacional
		/** @noinspection PhpLanguageLevelInspection */
		$datos_addnorma = [
			'idnormg' => $norma_identificador,
			'cod_proyecto_ley' => $norma->codigo_proy_ley,
			'comentario' => $norma->comentarios,
			'enlace' => $norma->enlace,
			'obs_metodologicas' => $norma->obs_metodologicas,
		];
		$this->db->insert('norma_plurinacional_lp', $datos_addnorma);

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

	//Crear nuevo registro para la norma
	public function crearNormaDepartamental($norma_nueva){
		//Objeto norma
		$norma = $norma_nueva;
		/*
		 * INICIAR LA TRANSACCION
		 */
		$this->db->trans_begin();
		/** @noinspection PhpLanguageLevelInspection */
		$data_norma = [
			'fecha_registro' => $norma->fecha_registro,
			'fecha_norma' => $norma->fecha_norma,
			'fecha_primer_envio' => $norma->fecha_primer_envio,
			'estado_norma' => $norma->estado,
			'norma_remitente' => $norma->remitente,
			'norma_destinatario' => $norma->destinatario,
			'norma_segundo_envio' => $norma->segundo_envio['remitente'],
			'norma_nombre ' => $norma->nombre,
			'norma_codigo' => $norma->codigo,
			'norma_objeto' => $norma->objeto,
			'norma_observaciones' => $norma->observaciones,
			'proponente' => $norma->proponente['proponente'],
			'rel_id' => $norma->idusuario,
			'rel_idinsseg' => $norma->instancia_seguimiento,
			'rel_idcuestionario' => $norma->idcuestionario ,
		];
		$this->db->insert('norma_general', $data_norma );
		$norma_identificador = $this->db->insert_id();

		//Almacenar tema 1
		if($norma->tema1['idtema'] == 0){
			//Es otro tema ()normaotrotema
			/** @noinspection PhpLanguageLevelInspection */
			$datos_otro_tema = [
				'descripcion_otrotema' => $norma->tema1['tema'],
				'rel_idnormg' => $norma_identificador,
				'tema_ordinal' => 1,
			];
			$this->db->insert('normaotrotema', $datos_otro_tema);
		}else{
			//Tema del listado (norma_tema)
			/** @noinspection PhpLanguageLevelInspection */
			$datos_tema = [
				'rel_idnormg' => $norma_identificador,
				'rel_idtema' => $norma->tema1['idtema'],
				'tema_ordinal' => 1,
			];
			$this->db->insert('norma_tema', $datos_tema);
		}

		//Almacenar tema 2
		if($norma->tema2['idtema'] == 0){
			//Es otro tema ()normaotrotema
			/** @noinspection PhpLanguageLevelInspection */
			$datos_otro_tema = [
				'descripcion_otrotema' => $norma->tema2['tema'],
				'rel_idnormg' => $norma_identificador,
				'tema_ordinal' => 2,
			];
			$this->db->insert('normaotrotema', $datos_otro_tema);
		}else{
			//Tema del listado (norma_tema)
			/** @noinspection PhpLanguageLevelInspection */
			$datos_tema = [
				'rel_idnormg' => $norma_identificador,
				'rel_idtema' => $norma->tema2['idtema'],
				'tema_ordinal' => 2,
			];
			$this->db->insert('norma_tema', $datos_tema);
		}

		//Nota adicional si se trata de otro proponente
		if($norma->proponente['idproponente'] == 2){
			/** @noinspection PhpLanguageLevelInspection */
			$datos_otro_proponente = [
				'otro_descripcion' => $norma->proponente['otro'],
				'rel_idnormg' => $norma_identificador,
			];
			$this->db->insert('proponente_otro ', $datos_otro_proponente);
		}

		//Registrar el departamento
		/** @noinspection PhpLanguageLevelInspection */
		$datos_departamento = [
			'idnormg' => $norma_identificador,
			'rel_iddepartamento' => $norma->departamento['iddepartamento'],
		];
		$this->db->insert('norma_departamental', $datos_departamento);

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

	//Crear nuevo registro para la norma
	public function crearNormaMunicipal($norma_nueva){
		//Objeto norma
		$norma = $norma_nueva;
		/*
		 * INICIAR LA TRANSACCION
		 */
		$this->db->trans_begin();
		/** @noinspection PhpLanguageLevelInspection */
		$data_norma = [
			'fecha_registro' => $norma->fecha_registro,
			'fecha_norma' => $norma->fecha_norma,
			'fecha_primer_envio' => $norma->fecha_primer_envio,
			'estado_norma' => $norma->estado,
			'norma_remitente' => $norma->remitente,
			'norma_destinatario' => $norma->destinatario,
			'norma_segundo_envio' => $norma->segundo_envio['remitente'],
			'norma_nombre ' => $norma->nombre,
			'norma_codigo' => $norma->codigo,
			'norma_objeto' => $norma->objeto,
			'norma_observaciones' => $norma->observaciones,
			'proponente' => $norma->proponente['proponente'],
			'rel_id' => $norma->idusuario,
			'rel_idinsseg' => $norma->instancia_seguimiento,
			'rel_idcuestionario' => $norma->idcuestionario ,
		];
		$this->db->insert('norma_general', $data_norma );
		$norma_identificador = $this->db->insert_id();

		//Almacenar tema 1
		if($norma->tema1['idtema'] == 0){
			//Es otro tema ()normaotrotema
			/** @noinspection PhpLanguageLevelInspection */
			$datos_otro_tema = [
				'descripcion_otrotema' => $norma->tema1['tema'],
				'rel_idnormg' => $norma_identificador,
				'tema_ordinal' => 1,
			];
			$this->db->insert('normaotrotema', $datos_otro_tema);
		}else{
			//Tema del listado (norma_tema)
			/** @noinspection PhpLanguageLevelInspection */
			$datos_tema = [
				'rel_idnormg' => $norma_identificador,
				'rel_idtema' => $norma->tema1['idtema'],
				'tema_ordinal' => 1,
			];
			$this->db->insert('norma_tema', $datos_tema);
		}

		//Almacenar tema 2
		if($norma->tema2['idtema'] == 0){
			//Es otro tema ()normaotrotema
			/** @noinspection PhpLanguageLevelInspection */
			$datos_otro_tema = [
				'descripcion_otrotema' => $norma->tema2['tema'],
				'rel_idnormg' => $norma_identificador,
				'tema_ordinal' => 2,
			];
			$this->db->insert('normaotrotema', $datos_otro_tema);
		}else{
			//Tema del listado (norma_tema)
			/** @noinspection PhpLanguageLevelInspection */
			$datos_tema = [
				'rel_idnormg' => $norma_identificador,
				'rel_idtema' => $norma->tema2['idtema'],
				'tema_ordinal' => 2,
			];
			$this->db->insert('norma_tema', $datos_tema);
		}

		//Nota adicional si se trata de otro proponente
		if($norma->proponente['idproponente'] == 2){
			/** @noinspection PhpLanguageLevelInspection */
			$datos_otro_proponente = [
				'otro_descripcion' => $norma->proponente['otro'],
				'rel_idnormg' => $norma_identificador,
			];
			$this->db->insert('proponente_otro ', $datos_otro_proponente);
		}

		//Almacenar el municipio
		/** @noinspection PhpLanguageLevelInspection */
		$datos_municipio = [
			'idnormg' => $norma_identificador,
			'rel_idmunicipio' => $norma->municipio['idmunicipio'],
		];
		$this->db->insert('norma_municipal', $datos_municipio);

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

	//Leer las normativas que registra un usuario
	public function leerNormas($idusuario)
	{
		$sql = "SELECT *     "
			."FROM norma_general    "
			."LEFT JOIN users ON users.id = norma_general.rel_id   "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = norma_general.rel_idinsseg  "
			."WHERE users.id = ? AND norma_general.activo = ?    "
			."   "
			."   ";
		$qry = $this->db->query($sql, [$idusuario, 1, ]);
		return $qry->result();
	}

	//Leer una normativa por ID
	//Leer otro proponente de norma por id de norma
	public function leerNormaPorId($idnorma)
	{
		$sql = "SELECT *     "
			."FROM norma_general    "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = norma_general.rel_idinsseg   "
			."LEFT JOIN norma_departamental ON norma_departamental.idnormg = norma_general.idnormag "
			."LEFT JOIN norma_municipal ON norma_municipal.idnormg = norma_general.idnormag  "
			."LEFT JOIN norma_tema ON norma_tema.rel_idnormg = norma_general.idnormag   "
			."LEFT JOIN tema ON tema.idtema = norma_tema.rel_idtema   "
			."LEFT JOIN departamento ON departamento.iddepartamento = norma_departamental.rel_iddepartamento   "
			."LEFT JOIN municipio ON municipio.idmunicipio = norma_municipal.rel_idmunicipio   "
			."WHERE norma_general.idnormag = ?   "
			."   ";
		$qry = $this->db->query($sql, [$idnorma, ]);
		return $qry->row();
	}
	public function leerNormaOtroPropID($idnorma)
	{

		//Comprobar si existe el tema
		$sql = "SELECT COUNT(*) AS hay_tema     "
			. "FROM proponente_otro    "
			. "   "
			. "WHERE proponente_otro.rel_idnormg = ?  "
			. "   "
			. "   "
			. "   ";
		$qry = $this->db->query($sql, [$idnorma,]);

		$indicador =  $qry->row();
		if($indicador->hay_tema == 0){
			return false;
		}elseif ($indicador->hay_tema == 1){
			$sql = "SELECT *     "
				. "FROM proponente_otro    "
				. "   "
				. "WHERE proponente_otro.rel_idnormg = ?  "
				. "   "
				. "   "
				. "   ";
			$qry = $this->db->query($sql, [$idnorma,]);
			return $qry->row();
		}
	}

	//Tema de la norma
	public function leerTemaNorma($idnorma, $ordinal){
		//Comprobar si existe el tema
		$sql = "SELECT COUNT(*) as hay_tema  "
			. "FROM norma_general    "
			. "LEFT JOIN norma_tema ON norma_tema.rel_idnormg = norma_general.idnormag   "
			. "LEFT JOIN tema ON tema.idtema = norma_tema.rel_idtema  "
			. "WHERE norma_general.idnormag = ? AND norma_tema.tema_ordinal = ?   "
			. "   "
			. "   ";
		$qry = $this->db->query($sql, [$idnorma, $ordinal,]);
		$indicador =  $qry->row();
		if($indicador->hay_tema == 0){
			return false;
		}elseif ($indicador->hay_tema == 1){
			$sql = "SELECT tema.idtema, tema.nombre_tema, tema.rel_idcuestionario, norma_tema.tema_ordinal, norma_tema.idntema  "
				. "FROM norma_general    "
				. "LEFT JOIN norma_tema ON norma_tema.rel_idnormg = norma_general.idnormag   "
				. "LEFT JOIN tema ON tema.idtema = norma_tema.rel_idtema  "
				. "WHERE norma_general.idnormag = ? AND norma_tema.tema_ordinal = ?   "
				. "   "
				. "   ";
			$qry = $this->db->query($sql, [$idnorma, $ordinal,]);
			return $qry->row();
		}
	}

	//Comprobar si el tema de norma es distinto a los del listado proporcionado
	public function otroTemaNorma($idnorma, $ordinal)
	{
		$sql = "SELECT *     "
			. "FROM normaotrotema    "
			. "   "
			. "WHERE normaotrotema.rel_idnormg = ? AND normaotrotema.tema_ordinal = ?  "
			. "   "
			. "   "
			. "   ";
		$qry = $this->db->query($sql, [$idnorma, $ordinal,]);
		return $qry->row();
	}


	//Actualizar el estado de una norma
	public function modificarEstadoNorma($datos){
		$idnorma = $datos['idnorma'];
		/** @noinspection PhpLanguageLevelInspection */
		$datos_norma = [
			'estado_norma' => $datos['idestado'],
			'fecha_primer_envio' => '',
		];
		$this->db->where('idnormag', $idnorma);
		$this->db->update('norma_general', $datos_norma);
	}

	//Actualizar la procedencia de la norma
	public function modificarProcedenciaNorma($datos)
	{
		$idnorma = $datos['idnorma'];
		/** @noinspection PhpLanguageLevelInspection */
		$datos_norma = [
			'fecha_norma' => $datos['fecha'],
			'norma_remitente' => $datos['remitente'],
			'norma_destinatario ' => $datos['destino'],
			'norma_segundo_envio ' => $datos['segundo_envio'],
		];
		$this->db->where('idnormag', $idnorma);
		$this->db->update('norma_general', $datos_norma);
	}

	public function modificarDatosNorma($datos){
		$idnorma = $datos['idnorma'];
		/** @noinspection PhpLanguageLevelInspection */
		$datos_norma = [
			'norma_codigo' => $datos['codigo'],
			'norma_nombre' => $datos['nombre'],
			'norma_objeto' => $datos['objeto'],
			'norma_observaciones ' => $datos['observaciones'],
		];
		$this->db->where('idnormag', $idnorma);
		$this->db->update('norma_general', $datos_norma);
	}

	//Modificar el proponente de una norma
	public function modificarProponenteNorma($datos){
		$idnorma = $datos['idnorma'];
		//Discriminante del tipo de proponente
		$tipo_proponente = $datos['tipo_proponente'];


		//Iniciar la transaccion
		$this->db->trans_begin();
		//Comprobar el tipo de proponente
		if($tipo_proponente == 1){
			$tipo_literal = "oficialismo";
			//Comprobar si existe un registro de otro proponente
			if($this->comprobarOtroProponenteIDnorma($idnorma) == true){
				//Existe un registro
				//Borrar el registro de la tabla proponente_otro
				$this->db->delete('proponente_otro', array('rel_idnormg ' => $idnorma));
				//Actualizar el campo proponente
				/** @noinspection PhpLanguageLevelInspection */
				$proponente = [
					'proponente' => $tipo_literal,
				];
				$this->db->where('idnormag', $idnorma);
				$this->db->update('norma_general', $proponente);


			}else{
				//No existe registro
				//Actualizar el campo proponente
				/** @noinspection PhpLanguageLevelInspection */
				$proponente = [
					'proponente' => $tipo_literal,
				];
				$this->db->where('idnormag', $idnorma);
				$this->db->update('norma_general', $proponente);
			}
		}elseif ($tipo_proponente == 2){
			$tipo_literal = "oposicion";
			//Comprobar si existe un registro de otro proponente
			if($this->comprobarOtroProponenteIDnorma($idnorma) == true){
				//Existe un registro
				//Borrar el registro de la tabla proponente_otro
				$this->db->delete('proponente_otro', array('rel_idnormg ' => $idnorma));
				//Actualizar el campo proponente
				/** @noinspection PhpLanguageLevelInspection */
				$proponente = [
					'proponente' => $tipo_literal,
				];
				$this->db->where('idnormag', $idnorma);
				$this->db->update('norma_general', $proponente);


			}else{
				//No existe registro
				//Actualizar el campo proponente
				/** @noinspection PhpLanguageLevelInspection */
				$proponente = [
					'proponente' => $tipo_literal,
				];
				$this->db->where('idnormag', $idnorma);
				$this->db->update('norma_general', $proponente);
			}
		}elseif ($tipo_proponente == 3){
			$tipo_literal = "otros";
			//Existe registro de otro proponente
			if($this->comprobarOtroProponenteIDnorma($idnorma) == true){
				//Existe un registro
				//Actualizar el campo proponente
				/** @noinspection PhpLanguageLevelInspection */
				$proponente = [
					'proponente' => $tipo_literal,
				];
				$this->db->where('idnormag', $idnorma);
				$this->db->update('norma_general', $proponente);
				//Actualizar el registro de la tabla proponente_otro
				$idotroproponente = $datos['idpropotro'];
				/** @noinspection PhpLanguageLevelInspection */
				$datos_otro_proponente = [
					'otro_descripcion' => $datos['otroproponente_info'],
				];
				$this->db->where('idpropotro', $idotroproponente);
				$this->db->update('proponente_otro', $datos_otro_proponente);
			}else{
				//No existe registro
				//Actualizar el campo proponente
				/** @noinspection PhpLanguageLevelInspection */
				$proponente = [
					'proponente' => $tipo_literal,
				];
				$this->db->where('idnormag', $idnorma);
				$this->db->update('norma_general', $proponente);
				//Crear el registro de la tabla proponente_otro
				/** @noinspection PhpLanguageLevelInspection */
				$datos_nuevo_otro_proponente = [
					'otro_descripcion' => $datos['otroproponente_info'],
					'rel_idnormg' => $idnorma,
				];
				$this->db->insert('proponente_otro', $datos_nuevo_otro_proponente);
			}
		}
		//Comprobacion de la transaccion Almacenar/Cancelar
		if($this->db->trans_status() === false)
		{
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
	}

	//Comprobar si existe otro proponente registrado
	private function comprobarOtroProponenteIDnorma($identificador){
		$idnorma = $identificador;
		//Comprobar si existe el proponete por conteo
		$this->db->select('*');
		$this->db->from('proponente_otro');
		$this->db->where('rel_idnormg', $idnorma);
		$indicador_otros = $this->db->count_all_results();
		if($indicador_otros > 0){
			return true;
		}else{
			return false;
		}
	}

	//Leer la instancia por el identificador de la norma
	public function instanciaNorma($identificador){
		$idnorma = $identificador;
		$sql = "SELECT norma_general.idnormag, instancia_seguimiento.idinsseg, instancia_seguimiento.instancia     "
			. "FROM norma_general    "
			. "LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = norma_general.rel_idinsseg   "
			. "WHERE norma_general.idnormag = ?  "
			. "   "
			. "   "
			. "   ";
		$qry = $this->db->query($sql, [$idnorma,]);
		return $qry->row();
	}

	//Actualizar el tema 1 de la normativa
	public function modificarTema1($datos)
	{
		$idnorma = $datos['idnorma'];
		$ordinal = 1;
		//Iniciar el proceso de transaccion
		$this->db->trans_begin();
		if ($datos['idtema_seleccion'] == 0) {
			/* NO ES UN TEMA DE LISTA */
			$otrotema = $this->Norma_model->otroTemaNorma($idnorma, 1);
			if ($otrotema != null) {
				//Actualizar el registro
				/** @noinspection PhpLanguageLevelInspection */
				$dat_otro_tema = [
					'descripcion_otrotema' => $datos['tema_descripcion'],
				];
				$this->db->where('idnotema', $datos['idotrotema']);
				$this->db->update('normaotrotema', $dat_otro_tema);
			} else {
				//Borrar el registro previo de tema
				$this->db->where('idntema', $datos['idrelacional']);
				$this->db->delete('norma_tema');
				//Crear el registro
				/** @noinspection PhpLanguageLevelInspection */
				$dat_otro_tema = [
					'descripcion_otrotema' => $datos['tema_descripcion'],
					'rel_idnormg' => $idnorma,
					'tema_ordinal' => $ordinal,
				];
				$this->db->insert('normaotrotema', $dat_otro_tema);
			}
		} else {
			/* ES UN TEMA DE LISTA */
			$otrotema = $this->Norma_model->otroTemaNorma($idnorma, 1);
			if ($otrotema != null) {
				//Eliminar otro tema1
				$this->db->where('idnotema', $datos['idotrotema']);
				$this->db->delete('normaotrotema');
				//Insertar el tema (lista) seleccionado
				/** @noinspection PhpLanguageLevelInspection */
				$datos_nuevo_tema_lista = [
					'rel_idnormg' => $idnorma,
					'rel_idtema' => $datos['idtema_seleccion'],
					'tema_ordinal' => $ordinal,
				];
				$this->db->insert('norma_tema', $datos_nuevo_tema_lista);
			} else {
				//Actualizar el tema seleccionado del listado
				/** @noinspection PhpLanguageLevelInspection */
				$datos_nuevo_tema_lista = [
					'rel_idtema' => $datos['idtema_seleccion'],
				];
				$this->db->where('idntema', $datos['idrelacional']);
				$this->db->update('norma_tema', $datos_nuevo_tema_lista);
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}

	//Actualizar el tema 1 de la normativa
	public function modificarTema2($datos)
	{
		$idnorma = $datos['idnorma'];
		$ordinal = 2;
		//Iniciar el proceso de transaccion
		$this->db->trans_begin();
		if ($datos['idtema_seleccion'] == 0) {
			/* NO ES UN TEMA DE LISTA */
			$otrotema = $this->Norma_model->otroTemaNorma($idnorma, $ordinal);
			if ($otrotema != null) {
				//Actualizar el registro
				/** @noinspection PhpLanguageLevelInspection */
				$dat_otro_tema = [
					'descripcion_otrotema' => $datos['tema_descripcion'],
				];
				$this->db->where('idnotema', $datos['idotrotema']);
				$this->db->update('normaotrotema', $dat_otro_tema);
			} else {
				//Borrar el registro previo de tema
				$this->db->where('idntema', $datos['idrelacional']);
				$this->db->delete('norma_tema');
				//Crear el registro
				/** @noinspection PhpLanguageLevelInspection */
				$dat_otro_tema = [
					'descripcion_otrotema' => $datos['tema_descripcion'],
					'rel_idnormg' => $idnorma,
					'tema_ordinal' => $ordinal,
				];
				$this->db->insert('normaotrotema', $dat_otro_tema);
			}
		} else {
			/* ES UN TEMA DE LISTA */
			$otrotema = $this->Norma_model->otroTemaNorma($idnorma, $ordinal);
			if ($otrotema != null) {
				//Eliminar otro tema1
				$this->db->where('idnotema', $datos['idotrotema']);
				$this->db->delete('normaotrotema');
				//Insertar el tema (lista) seleccionado
				/** @noinspection PhpLanguageLevelInspection */
				$datos_nuevo_tema_lista = [
					'rel_idnormg' => $idnorma,
					'rel_idtema' => $datos['idtema_seleccion'],
					'tema_ordinal' => $ordinal,
				];
				$this->db->insert('norma_tema', $datos_nuevo_tema_lista);
			} else {
				//Actualizar el tema seleccionado del listado
				/** @noinspection PhpLanguageLevelInspection */
				$datos_nuevo_tema_lista = [
					'rel_idtema' => $datos['idtema_seleccion'],
				];
				$this->db->where('idntema', $datos['idrelacional']);
				$this->db->update('norma_tema', $datos_nuevo_tema_lista);
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}

	public function modificarFechaPrimerEnvio($datos){
		$idnorma = $datos['idnorma'];
		/** @noinspection PhpLanguageLevelInspection */
		$datos_fecha_primer_envio = [
			'fecha_primer_envio' => $datos['fecha_primer_envio'],
		];
		$this->db->where('idnormag', $idnorma );
		$this->db->update('norma_general', $datos_fecha_primer_envio);
	}

	//Leer una norma plurinacional
	//Leer una normativa por ID
	//Leer otro proponente de norma por id de norma
	public function leerNormaPlurinacionalPorId($idnorma)
	{
		$sql = "SELECT *     "
			."FROM norma_general    "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = norma_general.rel_idinsseg   "
			."LEFT JOIN norma_plurinacional ON norma_plurinacional.idnormg = norma_general.idnormag   "
			."  "
			."   "
			."   "
			."   "
			."   "
			."WHERE norma_general.idnormag = ?   "
			."   ";
		$qry = $this->db->query($sql, [$idnorma, ]);
		return $qry->row();
	}

	//Modificar los datos generales de la norma asamblea plirinacinal
	public function modificarDatGenNormaPl($datos)
	{
		$idnorma = $datos['idnorma'];
		//Array de modificacion
		/** @noinspection PhpLanguageLevelInspection */
		$datos_generales = [
			'norma_codigo' => $datos['codigo'],
			'norma_nombre' => $datos['nombre'],
			'norma_objeto' => $datos['objeto'],
		];
		$this->db->where('idnormag', $idnorma );
		$this->db->update('norma_general', $datos_generales);
	}

	public function modificarDatPresen($datos)
	{
		$idnorma = $datos['idnorma'];
		//Array de modificacion
		/** @noinspection PhpLanguageLevelInspection */
		$datos_generales = [
			'fecha_norma' => $datos['fecha_presentacion'],
			'norma_remitente' => $datos['remitente'],
			'norma_destinatario' => $datos['destinatario'],
		];
		$this->db->where('idnormag', $idnorma );
		$this->db->update('norma_general', $datos_generales);
	}

	//Actualizar datos de datos reposicion
	public function modificarDatReposicion($datos){
		$idnorma = $datos['idnorma'];
		//Array de modificacion
		/** @noinspection PhpLanguageLevelInspection */
		$datos_reposicion = [
			'fecha_sol_repo' => $datos['fecha_reposicion'],
			'proponente_solrepo' => $datos['remitente_reposicion'],
			'destinatario_solrepo' => $datos['destinatario_reposicion'],
		];
		$this->db->where('idnormg', $idnorma );
		$this->db->update('norma_plurinacional', $datos_reposicion);
	}

	//Actualizar otros
	public function modificarDatOtros($datos){
		$idnorma = $datos['idnorma'];
		$this->db->trans_begin();
		//Actualizar el campo observaciones de la norma_general
		/** @noinspection PhpLanguageLevelInspection */
		$datos_norma_general = [
			'norma_observaciones' => $datos['observaciones'],
		];
		$this->db->where('idnormag', $idnorma );
		$this->db->update('norma_general', $datos_norma_general);

		//Actualizar el resto de los campos en norma_plurinacional
		/** @noinspection PhpLanguageLevelInspection */
		$datos_norma_plurinacional = [
			'enlace' => $datos['enlace'],
			'obs_metodologicas' => $datos['obs_metodologicas'],
		];
		$this->db->where('idnormg', $idnorma );
		$this->db->update(' norma_plurinacional', $datos_norma_plurinacional);


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
	}

	public function leerNormasRegistradas()
	{
		$sql = "SELECT *       "
			."FROM norma_general        "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = norma_general.rel_idinsseg      "
			."LEFT JOIN norma_departamental ON norma_departamental.idnormg = norma_general.idnormag   "
			."LEFT JOIN norma_municipal ON norma_municipal.idnormg = norma_general.idnormag      "
			."LEFT JOIN norma_tema ON norma_tema.rel_idnormg = norma_general.idnormag      "
			."LEFT JOIN tema ON tema.idtema = norma_tema.rel_idtema      "
			."LEFT JOIN departamento ON departamento.iddepartamento = norma_departamental.rel_iddepartamento      "
			."LEFT JOIN municipio ON municipio.idmunicipio = norma_municipal.rel_idmunicipio       "
			."LEFT JOIN users ON users.id = norma_general.rel_id   "
			."   "
			."   ";
		$qry = $this->db->query($sql, [ ]);
		return $qry->result();
	}

	public function cambiarEstado($identificador, $estado)
	{
		/** @noinspection PhpLanguageLevelInspection */
		$data = [
			'activo' => $estado,
		];
		$this->db->where('idnormag', $identificador);
		$this->db->update('norma_general', $data);
	}

	public function reporteNormaGeneral($parametros){
		$consulta = $parametros;
		//Array de placeholders
		/** @noinspection PhpLanguageLevelInspection */
		$placeholder = [];

		$sql = "SELECT ng.idnormag, ng.fecha_registro, ng.fecha_norma, ng.fecha_norma_lit, instancia_seguimiento.instancia, departamento.nombre_departamento, municipio.municipio_nombre, mundep.nombre_departamento AS departamento_municipio, ng.estado_norma, ng.norma_codigo, ng.norma_nombre, ng.norma_objeto, ng.norma_observaciones, ng.datos_adicionales, users.username, instancia_seguimiento.idinsseg     "
			."FROM norma_general as ng  "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = ng.rel_idinsseg  "
			."LEFT JOIN norma_plurinacional ON norma_plurinacional.idnormg = ng.idnormag  "
			."LEFT JOIN norma_departamental ON norma_departamental.idnormg = ng.idnormag  "
			."LEFT JOIN norma_municipal ON norma_municipal.idnormg = ng.idnormag  "
			."LEFT JOIN departamento ON departamento.iddepartamento = norma_departamental.rel_iddepartamento   "
			."LEFT JOIN municipio ON municipio.idmunicipio = norma_municipal.rel_idmunicipio   "
			."LEFT JOIN departamento AS mundep ON mundep.iddepartamento = municipio.rel_iddepartamento  "
			."LEFT JOIN users ON users.id = ng.rel_id  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."WHERE ng.activo = 1 AND (ng.fecha_registro BETWEEN ? AND ?)  "
			."  ";

		/** @noinspection PhpLanguageLevelInspection */

		//Añadir el intervalo de fechas al placeholder
		array_push($placeholder, $consulta->fecha_inicio);
		array_push($placeholder, $consulta->fecha_fin);
		if($consulta->iddepartamento !=0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND departamento.iddepartamento  = ?  OR mundep.iddepartamento = ?  ";
			array_push($placeholder, $consulta->iddepartamento);
			array_push($placeholder, $consulta->iddepartamento);
		}
		if($consulta->idmunicipio !=0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND municipio.idmunicipio  = ?  ";
			array_push($placeholder, $consulta->idmunicipio);
		}

		$sql .= 'ORDER BY ng.fecha_registro ASC   ';
		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}

	//Reporte Municipal
	public function reporteNormaMunicipal($parametros){
		$consulta = $parametros;
		//Array de placeholders
		/** @noinspection PhpLanguageLevelInspection */
		$placeholder = [];

		$sql = "SELECT ng.idnormag, ng.fecha_registro, ng.fecha_norma, instancia_seguimiento.instancia, departamento.nombre_departamento, municipio.municipio_nombre, mundep.nombre_departamento AS departamento_municipio, ng.estado_norma, ng.norma_codigo, ng.norma_nombre, ng.norma_objeto, ng.norma_observaciones, users.username     "
			."FROM norma_general as ng  "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = ng.rel_idinsseg  "
			."LEFT JOIN norma_plurinacional ON norma_plurinacional.idnormg = ng.idnormag  "
			."LEFT JOIN norma_departamental ON norma_departamental.idnormg = ng.idnormag  "
			."LEFT JOIN norma_municipal ON norma_municipal.idnormg = ng.idnormag  "
			."LEFT JOIN departamento ON departamento.iddepartamento = norma_departamental.rel_iddepartamento   "
			."LEFT JOIN municipio ON municipio.idmunicipio = norma_municipal.rel_idmunicipio   "
			."LEFT JOIN departamento AS mundep ON mundep.iddepartamento = municipio.rel_iddepartamento  "
			."LEFT JOIN users ON users.id = ng.rel_id  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."WHERE ng.activo = 1 AND (ng.fecha_registro BETWEEN ? AND ?)  "
			."AND instancia_seguimiento.idinsseg = 3    ";

		/** @noinspection PhpLanguageLevelInspection */

		//Añadir el intervalo de fechas al placeholder
		array_push($placeholder, $consulta->fecha_inicio);
		array_push($placeholder, $consulta->fecha_fin);
		if($consulta->iddepartamento !=0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND departamento.iddepartamento  = ?  OR mundep.iddepartamento = ?  ";
			array_push($placeholder, $consulta->iddepartamento);
			array_push($placeholder, $consulta->iddepartamento);
		}
		if($consulta->idmunicipio !=0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND municipio.idmunicipio  = ?  ";
			array_push($placeholder, $consulta->idmunicipio);
		}

		$sql .= 'ORDER BY ng.fecha_registro ASC   ';
		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}

	//Reporte Municipal
	public function reporteNormaDepartamental($parametros){
		$consulta = $parametros;
		//Array de placeholders
		/** @noinspection PhpLanguageLevelInspection */
		$placeholder = [];

		$sql = "SELECT ng.idnormag, ng.fecha_registro, ng.fecha_norma, instancia_seguimiento.instancia, departamento.nombre_departamento, municipio.municipio_nombre, mundep.nombre_departamento AS departamento_municipio, ng.estado_norma, ng.norma_codigo, ng.norma_nombre, ng.norma_objeto, ng.norma_observaciones, users.username     "
			."FROM norma_general as ng  "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = ng.rel_idinsseg  "
			."LEFT JOIN norma_plurinacional ON norma_plurinacional.idnormg = ng.idnormag  "
			."LEFT JOIN norma_departamental ON norma_departamental.idnormg = ng.idnormag  "
			."LEFT JOIN norma_municipal ON norma_municipal.idnormg = ng.idnormag  "
			."LEFT JOIN departamento ON departamento.iddepartamento = norma_departamental.rel_iddepartamento   "
			."LEFT JOIN municipio ON municipio.idmunicipio = norma_municipal.rel_idmunicipio   "
			."LEFT JOIN departamento AS mundep ON mundep.iddepartamento = municipio.rel_iddepartamento  "
			."LEFT JOIN users ON users.id = ng.rel_id  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."WHERE ng.activo = 1 AND (ng.fecha_registro BETWEEN ? AND ?)  "
			."AND instancia_seguimiento.idinsseg = 2    ";

		/** @noinspection PhpLanguageLevelInspection */

		//Añadir el intervalo de fechas al placeholder
		array_push($placeholder, $consulta->fecha_inicio);
		array_push($placeholder, $consulta->fecha_fin);
		if($consulta->iddepartamento !=0)
		{
			//Agregar el discriminante a la sentencia SQL
			$sql .= "AND departamento.iddepartamento  = ?    ";
			array_push($placeholder, $consulta->iddepartamento);
		}

		$sql .= 'ORDER BY ng.fecha_registro ASC   ';
		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}

	//Reporte Norma Plurinacional
	public function reporteNormaPlurinacional($parametros){
		$consulta = $parametros;
		//Array de placeholders
		/** @noinspection PhpLanguageLevelInspection */
		$placeholder = [];

		$sql = "SELECT ng.idnormag, ng.fecha_registro, users.username, norma_plurinacional.obs_metodologicas, ng.norma_codigo, ng.norma_nombre, ng.norma_objeto, ng.proponente, ng.norma_remitente, ng.norma_destinatario, ng.fecha_norma, norma_plurinacional.proponente_solrepo, norma_plurinacional.destinatario_solrepo, norma_plurinacional.fecha_sol_repo, ng.norma_observaciones, norma_plurinacional.enlace   "
			."FROM norma_general AS ng  "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = ng.rel_idinsseg  "
			."LEFT JOIN norma_plurinacional ON norma_plurinacional.idnormg = ng.idnormag  "
			."  "
			."  "
			."   "
			."   "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."LEFT JOIN users ON users.id = ng.rel_id  "
			."WHERE ng.activo = 1 AND (ng.fecha_registro BETWEEN ? AND ?)  "
			."AND instancia_seguimiento.idinsseg = 1   ";

		/** @noinspection PhpLanguageLevelInspection */

		//Añadir el intervalo de fechas al placeholder
		array_push($placeholder, $consulta->fecha_inicio);
		array_push($placeholder, $consulta->fecha_fin);


		$sql .= 'ORDER BY ng.fecha_registro ASC   ';
		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}

	//Reporte Norma Plurinacional
	public function reporteNormaPlurinacionalLP($parametros){
		$consulta = $parametros;
		//Array de placeholders
		/** @noinspection PhpLanguageLevelInspection */
		$placeholder = [];

		$sql = "SELECT *   "
			."FROM norma_general AS ng  "
			."LEFT JOIN instancia_seguimiento ON instancia_seguimiento.idinsseg = ng.rel_idinsseg  "
			."LEFT JOIN norma_plurinacional_lp ON norma_plurinacional_lp.idnormg = ng.idnormag  "
			."  "
			."  "
			."   "
			."   "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."  "
			."LEFT JOIN users ON users.id = ng.rel_id  "
			."WHERE ng.activo = 1 AND (ng.fecha_registro BETWEEN ? AND ?)  "
			."AND instancia_seguimiento.idinsseg = 4   ";

		/** @noinspection PhpLanguageLevelInspection */

		//Añadir el intervalo de fechas al placeholder
		array_push($placeholder, $consulta->fecha_inicio);
		array_push($placeholder, $consulta->fecha_fin);


		$sql .= 'ORDER BY ng.fecha_registro ASC   ';
		$qry = $this->db->query($sql, $placeholder);
		return $qry->result();
	}







}
