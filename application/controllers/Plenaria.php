<?php

class Plenaria extends CI_Controller{

	protected $_idformulario;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->model('Instanciaseguimiento_model');
		$this->load->model('TPlenaria_model');
		$this->load->model('Plenaria_model');
		$this->load->model('Cuestionario_model');
		$this->load->model('Municipio_model');
		$this->load->helper('date');

		//Identificador del formulario - Ajustar
		$this->_idformulario = 6;


		if($this->session->sesion_activa ===  null){
			$this->session->sess_destroy();
			redirect('/');
		}
	}

	public function index()
	{
		//Datos para el formulario
		$usuario = $this->ion_auth->user()->row();
		$instancias = $this->Instanciaseguimiento_model->leerInstancias();


		$datos['usuario'] = $usuario;
		$datos['instancias'] = $instancias;
		$datos['idformulario'] = $this->_idformulario;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vplenaria', $datos);
		$this->load->view('html/pie');
	}

	//Datos json Tipos de plenaria nacional
	public function getTiposPlenaria()
	{
		$json = array();
		$instancia = $this->input->post('instancia');
		$json = $this->TPlenaria_model->leerTPlenariaPorISeguimiento($instancia);
		header('Content-Type: application/json');
		echo json_encode($json);
	}

	//Datos json Tipo de plenaria por identificador
	public function getTipoPlenaria()
	{
		$json = array();
		$identificador = $this->input->post('identificador');
		$json = $this->TPlenaria_model->leerTPlenariaPorID($identificador);
		header('Content-Type: application/json');
		echo json_encode($json);

	}

	//Grabar informacion
	public function crearPlenaria()
	{
		$instancia = $this->input->post('idinstancia_seg_pre');
		if($instancia == 1){
			//Nacional
			$plenaria = $this->plenariaGeneral();
			$this->Plenaria_model->crearPlenariaGeneral($plenaria);
		}elseif($instancia == 2){
			//Departamental
			$plenaria = $this->plenariaDepartamental();
			$this->Plenaria_model->crearPlenariaDepartamental($plenaria);
		}elseif($instancia ==3) {
			//Municipal
			$plenaria = $this->plenariaMunicipal();
			$this->Plenaria_model->crearPlenariaMunicipal($plenaria);
		}
		redirect('inicio');
	}

	//Objeto Plenaria General
	private function plenariaGeneral()
	{
		$plenaria = new stdClass();
		$plenaria->idinstancia_seguimiento = $this->input->post('idinstancia_seg_pre');
		$plenaria->fecha_registro = time();
		$plenaria->fecha_norma = $this->input->post('fecha_plenaria_unix_pre');
		$plenaria->puntos_agenda = $this->input->post('puntos_agenda_pre');
		$plenaria->cumpliento_agenda = $this->input->post('cumlimiento_agenda_pre');
		$plenaria->asunto_sin_tratar = $this->input->post('asunto_sintratar_pre');
		$plenaria->puntos_varios = $this->input->post('puntos_varios_pre');
		$plenaria->monitores = $this->input->post('monitores_pre');
		/** @noinspection PhpLanguageLevelInspection */
		$plenaria->norma_extraordinaria = [
			'existe' => $this->input->post('existe_norma_ingresada_pre'),
			'nombre' => $this->input->post('norma_ingresada_pre'),
		];
		/** @noinspection PhpLanguageLevelInspection */
		$plenaria->tipo_plenaria = [
			'idtipoplenaria' => $this->input->post('id_tipo_plenaria_pre'),
			'nombre_tipo' => $this->input->post('tipo_plenaria_pre'),
		];
		$plenaria->idusuario = $this->input->post('idusuario_pre');
		$plenaria->idcuestionario = $this->input->post('idcuestionario_pre');
		$plenaria->monitores = $this->input->post('monitores_pre');

		return $plenaria;
	}

	//Objeto plenaria departamental
	private function plenariaDepartamental()
	{
		$plenaria = new stdClass();
		$plenaria->idinstancia_seguimiento = $this->input->post('idinstancia_seg_pre');
		$plenaria->fecha_registro = time();
		$plenaria->fecha_norma = $this->input->post('fecha_plenaria_unix_pre');
		$plenaria->puntos_agenda = $this->input->post('puntos_agenda_pre');
		$plenaria->cumpliento_agenda = $this->input->post('cumlimiento_agenda_pre');
		$plenaria->asunto_sin_tratar = $this->input->post('asunto_sintratar_pre');
		$plenaria->puntos_varios = $this->input->post('puntos_varios_pre');
		$plenaria->monitores = $this->input->post('monitores_pre');
		/** @noinspection PhpLanguageLevelInspection */
		$plenaria->norma_extraordinaria = [
			'existe' => $this->input->post('existe_norma_ingresada_pre'),
			'nombre' => $this->input->post('norma_ingresada_pre'),
		];
		/** @noinspection PhpLanguageLevelInspection */
		$plenaria->tipo_plenaria = [
			'idtipoplenaria' => $this->input->post('id_tipo_plenaria_pre'),
			'nombre_tipo' => $this->input->post('tipo_plenaria_pre'),
		];
		$plenaria->idusuario = $this->input->post('idusuario_pre');
		$plenaria->idcuestionario = $this->input->post('idcuestionario_pre');

		//Capturar departamento
		/** @noinspection PhpLanguageLevelInspection */
		$plenaria->departamento = [
			'iddepartamento' => $this->input->post('iddepple_pre'),
			'nombre' => $this->input->post('depple_pre'),
		];

		return $plenaria;
	}

	//Objeto plenaria departamental
	private function plenariaMunicipal()
	{
		$plenaria = new stdClass();
		$plenaria->idinstancia_seguimiento = $this->input->post('idinstancia_seg_pre');
		$plenaria->fecha_registro = time();
		$plenaria->fecha_norma = $this->input->post('fecha_plenaria_unix_pre');
		$plenaria->puntos_agenda = $this->input->post('puntos_agenda_pre');
		$plenaria->cumpliento_agenda = $this->input->post('cumlimiento_agenda_pre');
		$plenaria->asunto_sin_tratar = $this->input->post('asunto_sintratar_pre');
		$plenaria->puntos_varios = $this->input->post('puntos_varios_pre');
		$plenaria->monitores = $this->input->post('monitores_pre');
		/** @noinspection PhpLanguageLevelInspection */
		$plenaria->norma_extraordinaria = [
			'existe' => $this->input->post('existe_norma_ingresada_pre'),
			'nombre' => $this->input->post('norma_ingresada_pre'),
		];
		/** @noinspection PhpLanguageLevelInspection */
		$plenaria->tipo_plenaria = [
			'idtipoplenaria' => $this->input->post('id_tipo_plenaria_pre'),
			'nombre_tipo' => $this->input->post('tipo_plenaria_pre'),
		];
		$plenaria->idusuario = $this->input->post('idusuario_pre');
		$plenaria->idcuestionario = $this->input->post('idcuestionario_pre');

		//Capturar departamento
		/** @noinspection PhpLanguageLevelInspection */
		$plenaria->departamento = [
			'iddepartamento' => $this->input->post('iddepple_pre'),
			'nombre' => $this->input->post('depple_pre'),
		];

		/** @noinspection PhpLanguageLevelInspection */
		$plenaria->municipio = [
			'idmunicipio' => $this->input->post('idmunnorma_pre'),
			'nombre' => $this->input->post('munnorma_pre'),
		];

		return $plenaria;
	}

	//Listado de registros
	public function editar(){
		$usuario = $this->ion_auth->user()->row();
		$plenarias = $this->Plenaria_model->leerPlenarias($usuario->id);

		$data['cuestionario'] = $this->Cuestionario_model->leerCuestionario($this->_idformulario);
		$data['plenarias'] = $plenarias;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vplenaria_lista', $data);
		$this->load->view('html/pie');
	}

	//Edicion
	public function editarPlenaria($identificador){
		$idplenaria = $identificador;
		$plenaria = $this->Plenaria_model->leerPlenariaPorId($idplenaria);
		$norma_incluida = $this->Plenaria_model->plenariaNormaExtraordinaria($idplenaria);
		$tipo_plenaria = $this->Plenaria_model->plenariaTipoId($idplenaria);
		$tipos_plenarias = $this->TPlenaria_model->leerTPlenariaPorISeguimiento($plenaria->idinsseg);


		$datos['plenaria'] = $plenaria;
		$datos['norma_incluida'] = $norma_incluida;
		$datos["tipo_plenaria"] = $tipo_plenaria;
		$datos["tipos"] = $tipos_plenarias;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vplenaria_editar', $datos);
		$this->load->view('html/pie');

	}

	/*
	 * Rutinas de edicion
	 */
	//Modificar la informacion general de la plenaria
	public function editarPlenariaDatos($identificador){
		$idplenaria = $identificador;
		//Capturar la informacion modificada
		/** @noinspection PhpLanguageLevelInspection */
		$plenaria_info_general = [
			'idplenaria' => $idplenaria,
			'fecha_plenaria' =>$this->fecha_unix($this->input->post('fechaplenaria')),
			'puntos_agenda' => $this->input->post('puntosagenda'),
			'cumplimiento' => $this->input->post('cumplimientoagenda'),
			'descripcion_pendiente' => $this->input->post('asuntopendiente'),
			'puntos_varios' => $this->input->post('puntosvarios'),
			'monitores' => $this->input->post('monitores'),
		];

		//Actualizar los datos
		$this->Plenaria_model->modificarPlenariaDatos($plenaria_info_general);
		//redireccion
		redirect('plenaria/editarPlenaria/'.$idplenaria);
	}

	//Modificar el tipo de plenaria
	public function editarPlenariaTipo($identificador){
		$idplenaria = $identificador;
		/** @noinspection PhpLanguageLevelInspection */
		$tipo_plenaria = [
			'idplenaria' => $idplenaria,
			'idtipoplenaria' => $this->input->post('instanciaseguimientoplenaria'),
		];
		//Actualizar la informacion
		$this->Plenaria_model->modificarTipoPlenaria($tipo_plenaria);
		redirect('plenaria/editarPlenaria/'.$idplenaria);
	}

	//Modificar/Crear la norma extraordinaria
	public function editarNormaExtraordinaria($identificador){
		$idplenaria = $identificador;
		$idnormaextraordinaria = $this->input->post('idplne');
		$informacion = $this->input->post('normaextraordinaria');


		if($idnormaextraordinaria == 0){
			//No existe norma extraordinaria registrada
			//Crear
			echo "Crear"."<br>";
			/** @noinspection PhpLanguageLevelInspection */
			$norma_extra = [
				'informacion' => $informacion,
				'idplenaria' => $idplenaria,
			];
			$this->Plenaria_model->crearNormaExtra($norma_extra);

		}else{
			//Existe la norma
			//Actualizar
			/** @noinspection PhpLanguageLevelInspection */
			$norma_extra = [
				'idnormaextra' => $idnormaextraordinaria,
				'informacion' => $informacion,
				'idplenaria' => $idplenaria,
			];
			$this->Plenaria_model->modificarNormaExtraordinaria($norma_extra);
		}
		redirect('plenaria/editarPlenaria/'.$idplenaria);
	}

	//JSON - Muncipios
	public function getMunicipiosReporte(){
		$json = array();
		$iddepartamento = $this->input->post('iddepartamento');

		$json = $this->Municipio_model->leerMunicipiosPorDepartamento($iddepartamento);
		header('Content.Type: application/json');
		echo json_encode($json);
	}

	//Cambiar el formato MM/DD/YY a unix timestamp
	private function fecha_unix($fecha)
	{
		list($anio, $mes, $dia) = explode('-', $fecha);
		$fecha_unix = mktime(0, 0, 0, $mes, $dia, $anio);
		return $fecha_unix;
	}





}
