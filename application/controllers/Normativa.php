<?php


class Normativa extends CI_Controller{

	protected $_idformulario;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->model('Cuestionario_model');
		$this->load->model('Instanciaseguimiento_model');
		$this->load->model('Departamento_model');
		$this->load->model('Norma_model');
		$this->load->model('Municipio_model');
		$this->load->model('Tema_model');
		$this->load->model('SubTema_model');
		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');

		//Identificador del formulario - Ajustar
		$this->_idformulario = 5;

		date_default_timezone_set("America/La_Paz");


		if($this->session->sesion_activa ===  null){
			$this->session->sess_destroy();
			redirect('/');
		}
	}

	public function index()
	{
		//Informacion del usuario logueado
		$usuario = $this->ion_auth->user()->row();
		//Temas
		$this->Cuestionario_model->setCuestionarioID($this->_idformulario);
		$tema = $this->Cuestionario_model->leerTema();
		$instancias = $this->Instanciaseguimiento_model->leerInstancias();
		$proponentes = $this->Norma_model->leerOpcionesDeProponentes();


		//Informacion para el formulario
		$data['idformulario'] = $this->_idformulario;
		$data['usuario'] = $usuario;
		$data['instancias'] = $instancias;
		$data['tema'] = $tema;
		$data['proponentes'] = $proponentes;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vnorma', $data);
		$this->load->view('html/pie');
	}

	//Rutina para la redireccion de normativas, segun su tipo
	public function normativaSeleccion($identificador){
		$idinstancia = $identificador;
		if($idinstancia == 1)
		{
			redirect('normativa/nuevaNormaAsambleaLegislativa');

		}elseif ($idinstancia == 4){
			redirect('normativa/nuevaNormaAsambleaLegislativaLp');
		}else{
			redirect('normativa/');
		}
	}

	//Formulario para normas de instancia de Asamblea legislativa plurinacional
	//PL(Proyecto de ley)
	public function nuevaNormaAsambleaLegislativa()
	{
		$idinstancia = 1;
		$usuario = $this->ion_auth->user()->row();

		$instancia = $this->Instanciaseguimiento_model->leerInstancia($idinstancia);
		$this->Cuestionario_model->setCuestionarioID($this->_idformulario);
		$tema = $this->Cuestionario_model->leerTema();

		$data['instancia'] = $instancia;
		$data['idformulario'] = $this->_idformulario;
		$data['usuario'] = $usuario;
		$data['tema'] = $tema;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vnorma_plurinacional', $data);
		$this->load->view('html/pie');
	}
	//Formulario para normas de instancia de Asamblea legislativa plurinacional
	//LP(Ley Promulgada)
	public function nuevaNormaAsambleaLegislativaLp()
	{
		$idinstancia = 4;
		$usuario = $this->ion_auth->user()->row();

		$instancia = $this->Instanciaseguimiento_model->leerInstancia($idinstancia);
		$this->Cuestionario_model->setCuestionarioID($this->_idformulario);
		$tema = $this->Cuestionario_model->leerTema();



		$data['instancia'] = $instancia;
		$data['idformulario'] = $this->_idformulario;
		$data['usuario'] = $usuario;
		$data['tema'] = $tema;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vnorma_plurinacional_lp', $data);
		$this->load->view('html/pie');
	}

	//JSON - Departamentos
	public function getDepartamentos(){
		$json = array();
		$json = $this->Departamento_model->leerDepartamentos();
		header('Content.Type: application/json');
		echo json_encode($json);
	}

	//JSON - Muncipios
	public function getMunicipios(){
		$json = array();
		$json = $this->Municipio_model->leerMuncipiosDepartamentos();
		header('Content.Type: application/json');
		echo json_encode($json);
	}

	//JSON - Tema
	public function getTema()
	{
		$json = array();
		$idtema = $this->input->post('identificador');
		$json = $this->Tema_model->leerTemaPorId($idtema);
		header('Content-Type: application/json');
		echo  json_encode($json);
	}

	//Crear norma
	public function crearNorma()
	{
		$instancia = $this->input->post('idinstancia_seg_pre');

		if($instancia == 1){
			//Nacional
			$norma = $this->normaGeneral();

			var_dump($norma);
			$this->Norma_model->crearNorma($norma);

		}elseif($instancia == 2){
			//Departamental
			$norma = $this->normaDepartamental();
			$this->Norma_model->crearNormaDepartamental($norma);

		}elseif($instancia ==3) {
			//Municipal
			$norma = $this->normaMunicipal();
			$this->Norma_model->crearNormaMunicipal($norma);
		}
		elseif ($instancia == 4){
			//Nacional LP (Ley Promulgada)
			$norma = $this->normaGeneralLeyPromulgada();
			$this->Norma_model->crearNormaLeyPromulgada($norma);
		}
		else{
			echo "Sin instancia de seguimiento";
		}
		redirect('inicio/');
	}

	//Objeto Norma General
	private function normaGeneral()
	{
		$norma = new stdClass();
		$norma->instancia_seguimiento = $this->input->post('idinstancia_seg_pre');
		$norma->estado = 0;
		$norma->fecha_registro = time();
		$norma->fecha_norma = $this->input->post('unixfecha_norma_plu_pre');
		$norma->fecha_primer_envio = 0;
		$norma->remitente = $this->input->post('remitente_plu_pre');
		$norma->destinatario = $this->input->post('destinatario_plu_pre');
		/** @noinspection PhpLanguageLevelInspection */
		$norma->segundo_envio = [
			'existe' => $this->input->post('existe_seg_remitente_pre'),
			'remitente' => $this->input->post('seg_remitente_pre'),
		];
		$norma->codigo = $this->input->post('codigo_plu_pre');
		$norma->nombre = $this->input->post('nombre_plu_pre');
		$norma->objeto = $this->input->post('objeto_plu_pre');
		/** @noinspection PhpLanguageLevelInspection */
		$norma->proponente = [
			'idproponente' => $this->input->post('idproponente_pre'),
			'proponente' => $this->input->post('proponente_pre'),
			'otro' => $this->input->post('proponentedes_pre'),
		];
		/** @noinspection PhpLanguageLevelInspection */
		$norma->tema1 = [
			'idtema' => $this->input->post('idtema1_pre') ,
			'tema' => $this->input->post('tema1_pre'),
		];
		/** @noinspection PhpLanguageLevelInspection */
		$norma->tema2 = [
			'idtema' => $this->input->post('idtema2_pre'),
			'tema' => $this->input->post('tema2_pre'),
		];
		/** @noinspection PhpLanguageLevelInspection */
		$norma->subtema1 = [
			'idsubtema' => $this->input->post('idsubtema1_pre') ,
			'subtema' => $this->input->post('subtema1_pre'),
		];
		/** @noinspection PhpLanguageLevelInspection */
		$norma->subtema2 = [
			'idsubtema' => $this->input->post('idsubtema2_pre'),
			'subtema' => $this->input->post('subtema2_pre'),
		];
		$norma->observaciones = $this->input->post('observaciones_plu_pre');
		$norma->obs_metodologicas = $this->input->post('observaciones_met_plu_pre');

		//Reposicion del proyecto de ley
		$norma->fecha_reposicion = $this->input->post('unixfecha_norma_solrep_plu_pre');
		$norma->remitente_reposicion = $this->input->post('remitente_solrep_plu_pre');
		$norma->detinatario_reposicion = $this->input->post('destinatario_solrep_plu_pre');
		$norma->enlace = $this->input->post('enlace_plu_pre');

		$norma->idusuario = $this->input->post('idusuario_pre');
		$norma->idcuestionario = $this->input->post('idcuestionario_pre');

		return $norma;
	}

	//Objeto Norma general Ley promulgada
	private function normaGeneralLeyPromulgada()
	{
		$norma = new stdClass();
		$norma->instancia_seguimiento = $this->input->post('idinstancia_seg_pre');
		$norma->estado = 1;
		$norma->fecha_registro = time();
		$norma->fecha_norma = $this->input->post('unixfecha_plu_lp_pre'); //unix
		$norma->fecha_norma_literal = $this->input->post('fecha_plu_lp_pre'); //literal
		$norma->fecha_primer_envio = 0;
		$norma->remitente = '';
		$norma->destinatario = '';

		$norma->codigo = $this->input->post('codigo_plu_lp_pre');
		$norma->nombre = $this->input->post('nombre_plu_lp_pre');
		$norma->objeto = $this->input->post('objeto_plu_lp_pre');

		/** @noinspection PhpLanguageLevelInspection */
		$norma->tema1 = [
			'idtema' => $this->input->post('idtema1_pre') ,
			'tema' => $this->input->post('tema1_pre'),
		];
		/** @noinspection PhpLanguageLevelInspection */
		$norma->tema2 = [
			'idtema' => $this->input->post('idtema2_pre'),
			'tema' => $this->input->post('tema2_pre'),
		];
		/** @noinspection PhpLanguageLevelInspection */
		$norma->subtema1 = [
			'idsubtema' => $this->input->post('idsubtema1_pre') ,
			'subtema' => $this->input->post('subtema1_pre'),
		];
		/** @noinspection PhpLanguageLevelInspection */
		$norma->subtema2 = [
			'idsubtema' => $this->input->post('idsubtema2_pre'),
			'subtema' => $this->input->post('subtema2_pre'),
		];

		$norma->codigo_proy_ley = $this->input->post('codigo_previo_plu_lp_pre');
		$norma->comentarios = $this->input->post('comentarios_plu_lp_pre');

		$norma->observaciones = $this->input->post('observaciones_plu_lp_pre');
		$norma->obs_metodologicas = $this->input->post('observaciones_met_plu_lp_pre');

		//Reposicion del proyecto de ley
		$norma->enlace = $this->input->post('enlace_plu_lp_pre');

		$norma->idusuario = $this->input->post('idusuario_plu_lp_pre');
		$norma->idcuestionario = $this->input->post('idcuestionario_plu_lp_pre');

		return $norma;
	}

	//Objeto Norma Departamental
	private function normaDepartamental()
	{
		$norma = new stdClass();

		$norma->instancia_seguimiento = $this->input->post('idinstancia_seg_pre');
		$norma->estado = $this->input->post('idestado_norma_pre');
		$norma->fecha_registro = time();
		$norma->fecha_norma = $this->input->post('fecha_norma_unix_pre');
		$norma->fecha_primer_envio = $this->input->post('fecha_primer_envio_pre_unix');
		$norma->remitente = $this->input->post('remitente_pre');
		$norma->destinatario = $this->input->post('destinatario_pre');
		/** @noinspection PhpLanguageLevelInspection */
		$norma->segundo_envio = [
			'existe' => $this->input->post('existe_seg_remitente_pre'),
			'remitente' => $this->input->post('seg_remitente_pre'),
		];
		$norma->codigo = $this->input->post('cod_norma_pre');
		$norma->nombre = $this->input->post('nom_norma_pre');
		$norma->objeto = $this->input->post('obj_norma_pre');
		/** @noinspection PhpLanguageLevelInspection */
		$norma->proponente = [
			'idproponente' => $this->input->post('idproponente_pre'),
			'proponente' => $this->input->post('proponente_pre'),
			'otro' => $this->input->post('proponentedes_pre'),
		];
		/** @noinspection PhpLanguageLevelInspection */
		$norma->tema1 = [
			'idtema' => $this->input->post('idtema1_pre') ,
			'tema' => $this->input->post('tema1_pre'),
		];
		/** @noinspection PhpLanguageLevelInspection */
		$norma->tema2 = [
			'idtema' => $this->input->post('idtema2_pre'),
			'tema' => $this->input->post('tema2_pre'),
		];
		$norma->observaciones = $this->input->post('observaciones_pre');
		$norma->idusuario = $this->input->post('idusuario_pre');
		$norma->idcuestionario = $this->input->post('idcuestionario_pre');

		//capturar el departamento
		/** @noinspection PhpLanguageLevelInspection */
		$norma->departamento = [
			'iddepartamento' => $this->input->post('iddepnorma_pre'),
			'departamento' => $this->input->post('depnorma_pre'),
		];

		return $norma;

	}

	//Objeto Norma Municipal
	private function normaMunicipal()
	{
		$norma = new stdClass();
		$norma->instancia_seguimiento = $this->input->post('idinstancia_seg_pre');
		$norma->estado = $this->input->post('idestado_norma_pre');
		$norma->fecha_registro = time();
		$norma->fecha_norma = $this->input->post('fecha_norma_unix_pre');
		$norma->fecha_primer_envio = $this->input->post('fecha_primer_envio_pre_unix');
		$norma->remitente = $this->input->post('remitente_pre');
		$norma->destinatario = $this->input->post('destinatario_pre');
		/** @noinspection PhpLanguageLevelInspection */
		$norma->segundo_envio = [
			'existe' => $this->input->post('existe_seg_remitente_pre'),
			'remitente' => $this->input->post('seg_remitente_pre'),
		];
		$norma->codigo = $this->input->post('cod_norma_pre');
		$norma->nombre = $this->input->post('nom_norma_pre');
		$norma->objeto = $this->input->post('obj_norma_pre');
		/** @noinspection PhpLanguageLevelInspection */
		$norma->proponente = [
			'idproponente' => $this->input->post('idproponente_pre'),
			'proponente' => $this->input->post('proponente_pre'),
			'otro' => $this->input->post('proponentedes_pre'),
		];
		/** @noinspection PhpLanguageLevelInspection */
		$norma->tema1 = [
			'idtema' => $this->input->post('idtema1_pre') ,
			'tema' => $this->input->post('tema1_pre'),
		];
		/** @noinspection PhpLanguageLevelInspection */
		$norma->tema2 = [
			'idtema' => $this->input->post('idtema2_pre'),
			'tema' => $this->input->post('tema2_pre'),
		];
		$norma->observaciones = $this->input->post('observaciones_pre');
		$norma->idusuario = $this->input->post('idusuario_pre');
		$norma->idcuestionario = $this->input->post('idcuestionario_pre');

		//capturar el departamento
		/** @noinspection PhpLanguageLevelInspection */
		$norma->departamento = [
			'iddepartamento' => $this->input->post('iddepnorma_pre'),
			'departamento' => $this->input->post('depnorma_pre'),
		];

		//Capturar el municipio
		/** @noinspection PhpLanguageLevelInspection */
		$norma->municipio = [
			'idmunicipio' => $this->input->post('idmunnorma_pre'),
			'municipio' => $this->input->post('munnorma_pre'),
		];

		return $norma;

	}

	//Listado de registros
	public function editar(){
		$usuario = $this->ion_auth->user()->row();
		$normas = $this->Norma_model->leerNormas($usuario->id);
		$data['cuestionario'] = $this->Cuestionario_model->leerCuestionario($this->_idformulario);
		$data['normas'] = $normas;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vnorma_lista', $data);
		$this->load->view('html/pie');
	}

	//Editar la informacion de la norma
	public function editarNorma($identificador)
	{
		$usuario = $this->ion_auth->user()->row();
		$idnorma = $identificador;
		//Identificar la instacia de la norma
		$instancia = $this->Norma_model->instanciaNorma($idnorma);
		if($instancia->idinsseg == 1)
		{
			redirect('normativa/editarNormaAsambleaPlurinacional/'.$idnorma);
		}elseif($instancia->idinsseg == 4){
			redirect('normativa/editarNormaAsambleaPlurinacionalLp/'.$idnorma);
		}
		//Extraer la norma
		$norma = $this->Norma_model->leerNormaPorId($idnorma);
		$otro_proponente = $this->Norma_model->leerNormaOtroPropID($idnorma);
		$tema1 = $this->Norma_model->leerTemaNorma($idnorma, 1);
		$tema2 = $this->Norma_model->leerTemaNorma($idnorma, 2);
		$otro_tema1 = $this->Norma_model->otroTemaNorma($idnorma, 1);
		$otro_tema2 = $this->Norma_model->otroTemaNorma($idnorma, 2);

		//Temas del cuestionario
		$this->Cuestionario_model->setCuestionarioID($this->_idformulario);
		$tema = $this->Cuestionario_model->leerTema();


		$datos['norma'] = $norma;
		$datos['tema'] = $tema;
		$datos['otro_proponente'] = $otro_proponente;
		$datos['tema1'] = $tema1;
		$datos['tema2'] = $tema2;
		$datos['otro_tema1'] = $otro_tema1;
		$datos['otro_tema2'] = $otro_tema2;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vnorma_editar', $datos);
		$this->load->view('html/pie');
	}

	public function editarNormaEstado($identificador){
		$idnorma = $identificador;

		/** @noinspection PhpLanguageLevelInspection */
		$estado = [
			'idnorma' => $idnorma,
			'idestado' => $this->input->post('estadonorma'),
		];
		//Modificar
		$this->Norma_model->modificarEstadoNorma($estado);
		redirect('normativa/editarNorma/'.$idnorma);
	}

	public function editarNormaProcedencia($identificador){
		$idnorma = $identificador;
		/** @noinspection PhpLanguageLevelInspection */
		$datos_procedencia = [
			'idnorma' => $idnorma,
			'fecha' => $this->fecha_unix($this->input->post('fechanorma')) ,
			'remitente' => $this->input->post('remitentenorma'),
			'destino' => $this->input->post('destinatarionorma'),
			'segundo_envio' => $this->input->post('segundoenvionorma'),
		];

		//Modificar la informacion
		$this->Norma_model->modificarProcedenciaNorma($datos_procedencia);
		redirect('normativa/editarNorma/'.$idnorma);
	}

	public function editarNormaDatos($identificador){
		$idnorma = $identificador;
		/** @noinspection PhpLanguageLevelInspection */
		$datos_norma = [
			'idnorma' => $idnorma,
			'codigo' => $this->input->post('codigonorma'),
			'nombre' => $this->input->post('nombrenorma'),
			'objeto' => $this->input->post('objetonorma'),
			'observaciones' => $this->input->post('obsnorma'),
		];

		//Modificar la informacion
		$this->Norma_model->modificarDatosNorma($datos_norma);
		redirect('normativa/editarNorma/'.$idnorma);
	}

	public function editarNormaProponente($identificador){
		$idnorma = $identificador;
		/** @noinspection PhpLanguageLevelInspection */
		$datos_proponente = [
			'idnorma' => $idnorma,
			'tipo_proponente' => $this->input->post('proponente_norma'),
			'idpropotro' => $this->input->post('idotroproponente'),
			'otroproponente_info' => $this->input->post('otroproponente'),
		];
		$this->Norma_model->modificarProponenteNorma($datos_proponente);
		redirect('normativa/editarNorma/'.$idnorma);
	}

	public function editarNormaTemaUno($identificador){
		$idnorma = $identificador;
		/** @noinspection PhpLanguageLevelInspection */
		$datos_norma_tema1 = [
			'idnorma' => $idnorma,
			'idtema_seleccion' => $this->input->post('idtema'),
			'tema_descripcion' => $this->input->post('otrotema1normaed'),
			'idotrotema' => $this->input->post('idotrotema1'),
			'idrelacional' => $this->input->post('idrelacionaltema1'),
		];

		//var_dump($datos_norma_tema1);

		$this->Norma_model->modificarTema1($datos_norma_tema1);
		redirect('normativa/editarNorma/'.$idnorma);
	}
	public function editarNormaTemaDos($identificador){
		$idnorma = $identificador;
		/** @noinspection PhpLanguageLevelInspection */
		$datos_norma_tema2 = [
			'idnorma' => $idnorma,
			'idtema_seleccion' => $this->input->post('idtema2'),
			'tema_descripcion' => $this->input->post('otrotema2normaed'),
			'idotrotema' => $this->input->post('idotrotema2'),
			'idrelacional' => $this->input->post('idrelacionaltema2'),
		];

		//var_dump($datos_norma_tema2);
		$this->Norma_model->modificarTema2($datos_norma_tema2);
		redirect('normativa/editarNorma/'.$idnorma);
	}

	//Editar la fecha del primer envio
	public function editarFechaPrimerEnvio($identificador){
		$idnorma = $identificador;
		/** @noinspection PhpLanguageLevelInspection */
		$datos_fecha_primer_envio =[
			'idnorma' => $idnorma,
			'fecha_primer_envio' => $this->fecha_unix($this->input->post('fecha_primer_envio_pre')) ,
		];
		$this->Norma_model->modificarFechaPrimerEnvio($datos_fecha_primer_envio);
		redirect('normativa/editarNorma/'.$idnorma);

	}


	//Edicion de la Asamblea Plurinacional
	public function editarNormaAsambleaPlurinacional($identificador)
	{
		echo "Editar Norma Asamblea Plurinacional";
		//Extraer el usuario
		$usuario = $this->ion_auth->user()->row();
		//Identificador de la norma
		$idnorma = $identificador;
		//Identificar la instancia de la norma
		$instancia = $this->Norma_model->instanciaNorma($idnorma);
		//Extraer la norma por el identificador
		$norma_plurinacional = $this->Norma_model->leerNormaPlurinacionalPorId($idnorma);
		//Datos de la norma
		$norma_plurinacional_datos = json_decode($norma_plurinacional->datos_adicionales);
		//codigo
		$codigo = $norma_plurinacional_datos->codigo;
		$nombre_norma = $norma_plurinacional_datos->nombre;
		$objeto_norma = $norma_plurinacional_datos->objeto;

		$proponente = $norma_plurinacional_datos->proponente;




		echo "<br><br>";
		echo "Usuario: "."<br>";
		var_dump($usuario);
		echo "<br><br>";
		echo "Norma: "."<br>";
		var_dump($idnorma);
		echo "<br><br>";
		echo "Instancia: "."<br>";
		var_dump($instancia);
		echo "<br><br>";
		echo "Norma: "."<br>";
		var_dump($norma_plurinacional);
		echo "<br><br>";
		echo "Norma datos: "."<br>";
		var_dump($norma_plurinacional_datos);
		echo "<br><br>";
		var_dump($codigo);
		echo "<br><br>";
		var_dump($proponente);




		$datos['idformulario'] = $this->_idformulario;
		$datos['usuario'] = $usuario;
		$datos['instancia'] = $instancia;
		$datos['codigo'] = $codigo;
		$datos['nombre_norma'] = $nombre_norma;
		$datos['objeto_norma'] = $objeto_norma;
		$datos['proponente'] = $proponente;

		$datos['remitente'] = $norma_plurinacional_datos->remitente;
		$datos['destinatario'] = $norma_plurinacional_datos->destinatario;


		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vnorma_plurinacional_edit', $datos);
		$this->load->view('html/pie');


		/*
		$usuario = $this->ion_auth->user()->row();
		$idnorma = $identificador;
		//Identificar la instacia de la norma
		$instancia = $this->Norma_model->instanciaNorma($idnorma);

		//Extraer la norma
		$norma = $this->Norma_model->leerNormaPlurinacionalPorId($idnorma);
		$otro_proponente = $this->Norma_model->leerNormaOtroPropID($idnorma);
		$tema1 = $this->Norma_model->leerTemaNorma($idnorma, 1);
		$tema2 = $this->Norma_model->leerTemaNorma($idnorma, 2);
		$otro_tema1 = $this->Norma_model->otroTemaNorma($idnorma, 1);
		$otro_tema2 = $this->Norma_model->otroTemaNorma($idnorma, 2);

		//Temas del cuestionario
		$this->Cuestionario_model->setCuestionarioID($this->_idformulario);
		$tema = $this->Cuestionario_model->leerTema();

		$datos['norma'] = $norma;
		$datos['tema'] = $tema;
		$datos['otro_proponente'] = $otro_proponente;
		$datos['tema1'] = $tema1;
		$datos['tema2'] = $tema2;
		$datos['otro_tema1'] = $otro_tema1;
		$datos['otro_tema2'] = $otro_tema2;


		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vnorma_asamblea_editar', $datos);
		$this->load->view('html/pie');*/
	}

	public function editarNormaAsambleaPlurinacionalLp($identificador)
	{
		echo "Editar Norma Asamblea Plurinacional LP";
		//Extraer el usuario actual
		$usuario = $this->ion_auth->user()->row();

		/*$usuario = $this->ion_auth->user()->row();
		$idnorma = $identificador;
		//Identificar la instacia de la norma
		$instancia = $this->Norma_model->instanciaNorma($idnorma);

		//Extraer la norma
		$norma = $this->Norma_model->leerNormaPlurinacionalPorId($idnorma);
		$otro_proponente = $this->Norma_model->leerNormaOtroPropID($idnorma);
		$tema1 = $this->Norma_model->leerTemaNorma($idnorma, 1);
		$tema2 = $this->Norma_model->leerTemaNorma($idnorma, 2);
		$otro_tema1 = $this->Norma_model->otroTemaNorma($idnorma, 1);
		$otro_tema2 = $this->Norma_model->otroTemaNorma($idnorma, 2);

		//Temas del cuestionario
		$this->Cuestionario_model->setCuestionarioID($this->_idformulario);
		$tema = $this->Cuestionario_model->leerTema();

		$datos['norma'] = $norma;
		$datos['tema'] = $tema;
		$datos['otro_proponente'] = $otro_proponente;
		$datos['tema1'] = $tema1;
		$datos['tema2'] = $tema2;
		$datos['otro_tema1'] = $otro_tema1;
		$datos['otro_tema2'] = $otro_tema2;


		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vnorma_asamblea_editar', $datos);
		$this->load->view('html/pie');*/
	}


	//Edicion de la norma plurinacional
	public function editarNmplDatos($identificador){
		$idnorma = $identificador;
		/** @noinspection PhpLanguageLevelInspection */
		$datos_generales = [
			'idnorma' => $idnorma,
			'codigo' => $this->input->post('codigonorma'),
			'nombre' => $this->input->post('nombrenorma'),
			'objeto' => $this->input->post('objetonorma'),
		];

		$this->Norma_model->modificarDatGenNormaPl($datos_generales);
		redirect('normativa/editarNormaAsambleaPlurinacional/'.$idnorma);
	}

	//Editar presentacion del proyecto de ley
	public function editarNmpPresentacion($identificador){
		$idnorma = $identificador;
		/** @noinspection PhpLanguageLevelInspection */
		$datos_presentacion = [
			'idnorma' => $idnorma,
			'fecha_presentacion' => $this->fecha_unix($this->input->post('fechapresentacion')),
			'remitente' => $this->input->post('normaremitente'),
			'destinatario' => $this->input->post('normadestinatario'),
		];
		$this->Norma_model->modificarDatPresen($datos_presentacion);
		redirect('normativa/editarNormaAsambleaPlurinacional/'.$idnorma);
	}

	//Editar ultima reposicion del proyecto de ley
	public function editarNmplReposicion($identificador)
	{
		$idnorma = $identificador;
		/** @noinspection PhpLanguageLevelInspection */
		$datos_reposicion = [
			'idnorma' => $idnorma,
			'fecha_reposicion' =>$this->fecha_unix($this->input->post('fechareposicion')),
			'remitente_reposicion' => $this->input->post('normaremitenterepo'),
			'destinatario_reposicion' => $this->input->post('normadestinatariorepo'),
		];
		$this->Norma_model->modificarDatReposicion($datos_reposicion);
		redirect('normativa/editarNormaAsambleaPlurinacional/'.$idnorma);
	}

	//Editar otros de la norma plurinacional
	public function editarNmplOtros($identificador){
		$idnorma = $identificador;
		/** @noinspection PhpLanguageLevelInspection */
		$datos_otros = [
			'idnorma' => $idnorma,
			'observaciones' =>$this->input->post('observaciones'),
			'enlace' => $this->input->post('enlace'),
			'obs_metodologicas' => $this->input->post('obsmet'),
		];

		$this->Norma_model->modificarDatOtros($datos_otros);
		redirect('normativa/editarNormaAsambleaPlurinacional/'.$idnorma);
	}

	public function editarNmplTemaUno($identificador){
		$idnorma = $identificador;

	}

	public function editarNmplTemaDos($identificador){
		$idnorma = $identificador;
	}

	//Cambiar el formato MM/DD/YY a unix timestamp
	private function fecha_unix($fecha)
	{
		list($anio, $mes, $dia) = explode('-', $fecha);
		$fecha_unix = mktime(0, 0, 0, $mes, $dia, $anio);
		return $fecha_unix;
	}

	//JSON - SubTema
	public function getSubtema()
	{
		$json = array();
		$idtema = $this->input->post('identificador');
		$json = $this->SubTema_model->leerSubtemasdeTemasActivos($idtema);
		//$json = $this->Tema_model->leerTemaPorId($idtema);
		header('Content-Type: application/json');
		echo  json_encode($json);
	}


}
