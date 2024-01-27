<?php

class Formulario extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
        $this->load->library('session');
		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Formulario_model');

	}
	public function index()
	{

		$datos['no_es_vista_previa'] = 1;
		$datos['ciudad'] = $this->Formulario_model->getCiudad();
		$datos['zona'] = $this->Formulario_model->getZona();
		$datos['lugar'] = $this->Formulario_model->getLugar();
		$datos['formularios_base'] = $this->Formulario_model->getFormularios();
	    $this->load->view('formularios/vformulario_plantilla', $datos);
	}
	public function crearFormulario()
	{
		//var_dump($this->Formulario_model->getFormularios());
		$usuario = $this->ion_auth->user()->row();
		$datos['no_es_vista_previa'] = 1;
		$datos['ciudad'] = $this->Formulario_model->getCiudad();
		$datos['zona'] = $this->Formulario_model->getZona();
		$datos['lugar'] = $this->Formulario_model->getLugar();
		$datos['formularios_base'] = $this->Formulario_model->getFormularios();
		$datos['usuario'] = $usuario;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('formularios/vcrearcuestionario', $datos);
		$this->load->view('html/pie2');
	}
	public function editarFormulario($idf)
	{
		$dt['editform']=$this->Formulario_model->leerCuestionarioPorId($idf);
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('formularios/veditarcuestionario',$dt);
		$this->load->view('html/pie');
	}
	public function agregarFormulario()
	{
		$dts = array(
				'nombre_cuestionario'=>$this->input->post('nombre_cuestionario'));
		$this->Formulario_model->agregarFormulario($dts);
		redirect ('Formulario');
	}
	public function modificarFormulario($idf)
	{
		$dts = array(
				'nombre_cuestionario'=>$this->input->post('nombre_cuestionario'));
		$this->Formulario_model->modificarFormulario($dts,$idf);
		redirect ('Formulario');
	}

	public function getZona()
	{
		$json = array();
		$idciudad = $this->input->post('ciudadID');
		$json = $this->Formulario_model->leerZonaPorIdciudad($idciudad);

		header('Content-Type: application/json');
		echo json_encode($json);
	}

	public function procesarCrearFormulario(){
		$form = $this->formularioDatosGenerales();
		$idform =  $this->Formulario_model->crearFormulario($form);
		redirect('formulario/formulariocmp/'.$idform, 'refresh');

	}

	private function formularioDatosGenerales(){
		$formulario = new stdClass();
		$formulario->nombre_lugar = $this->input->post('nombre_lugar');
		$formulario->fecha_fc = $this->input->post('fecha_registro');
		$formulario->latitud_fc = $this->input->post('latitud_f');
		$formulario->longitud_fc = $this->input->post('longitud_f');
		$formulario->rel_idciudad = $this->input->post('idciudad');
		$formulario->rel_idzona = $this->input->post('idzona');
		$formulario->rel_idlugar = $this->input->post('idlugar');
		$formulario->rel_idusuario = $this->input->post('idusuario');
		$formulario->rel_iduiformulario = $this->input->post('idformulario');

		return $formulario;
	}

	public function formulariocmp($idform){
		$idformulario = $idform;
		$complemento = $this->Formulario_model->buscarComplementoFormulario($idformulario);
		$formresp = $this->Formulario_model->getFormularioPorID($idformulario);
		$subfamilia = $this->Formulario_model->getFamiliaSubfamilia();



		$datos['formulario_resp'] = $formresp;
		$datos['familias'] = $this->Formulario_model->getFamilias();
		$datos['subfamilias'] = $subfamilia;
		$this->load->view('formularios/vform_complemento', $datos);
	}

	private function respuestas(){
		$respuestas = new stdClass();

		//$items = $this->Formulario_model->



	}

	public function subfamilia($idform, $idsubfamilia)
	{
		$idsubflia = $idsubfamilia;
		$idformulario = $idform;
		//$datos[];
		$formresp = $this->Formulario_model->getFormularioPorID($idformulario);
		$datos['formulario_resp'] = $formresp;
		$datos['items'] = $this->Formulario_model->getItemPorSubfamilia($idsubflia);
		$datos['familia'] = $this->Formulario_model->getFamiliaId($idsubflia);
		$this->load->view('formularios/vform_subf_item', $datos);
	}

	public function familia($idform, $idfamilia){
		$idflia = $idfamilia;
		$idformulario = $idform;
		$formresp = $this->Formulario_model->getFormularioPorID($idformulario);
		$datos['formulario_resp'] = $formresp;
		$datos['items'] = $this->Formulario_model->getItemPorFamilia($idflia);
		$datos['familia'] = $this->Formulario_model->getFamiliaId($idflia);
		$this->load->view('formularios/vform_fam_item', $datos);

	}

	//Vista para el despliegue de las subfamilias o items
	public function items($idform, $idfamilia){
		$idflia = $idfamilia;
		$idformulario = $idform;
		$complemento = $this->Formulario_model->buscarComplementoFormulario($idformulario);
		$formresp = $this->Formulario_model->getFormularioPorID($idformulario);

		$numeroSubfamilias = $this->Formulario_model->numeroSubflias($idflia);

		$datos['formulario_resp'] = $formresp;
		$datos['familia'] = $this->Formulario_model->getFamiliaId($idflia);



		if($numeroSubfamilias==0){
			//NO existen subfamilias
			//Buscar todos los items de una familia
			$items = $this->Formulario_model->getItemPorFamilia($idflia);
			$datos['items'] =$items;
			$this->load->view('formularios/vform_flia_item', $datos);
		}else{
			//Existen subfamilias
			$subfamilias = $this->Formulario_model->getSubflias_de_una_flia($idflia);
			$datos['subfamilias'] = $subfamilias;
			$this->load->view('formularios/vform_subfam_item', $datos);
		}
	}


	//Captura de los datos
	public function procesaritem(){
		$idformresp = $this->input->post('idformresp');
		$codigo = $this->input->post('codigo');

		echo 'idformresp: '.$idformresp;
		echo '<br>';
		echo 'codigo: '.$codigo;
		echo '<br><br><br>';

		//Estructura de datos
		$marcaPrecios = $this->Formulario_model->getMarcasPrecios($idformresp, $codigo);
		var_dump($marcaPrecios);
		echo '<br>';
		echo '<br>';

		$precios_json = $marcaPrecios['marca'];
		var_dump($precios_json);
		echo '<br>';
		echo '<br>';

		$precios = json_decode($precios_json);
		var_dump($precios);
		echo '<br>';
		echo '<br>';

		foreach ($precios as $p):
			echo $p->idmarca.' '.$p->marca.' '.$p->precio;
			echo '<br>';
		endforeach;


		foreach ($precios as $p):
			$lbl = 'precio-'.$p->idmarca;
			$p->precio = $this->input->post($lbl);
		endforeach;
		var_dump($precios);
		echo '<br>';
		echo '<br>';

		//COnvertir a json
		$precios_mod_json = json_encode($precios);
		var_dump($precios_mod_json);

		echo '<br>';
		echo '<br>';

		//Extraer el formulario complemento
		$form_cmp = $this->Formulario_model->getFormCmp($idformresp);
		//var_dump($form_cmp);
		echo $form_cmp->idfrcmp;

		//Actualizar el registro usando el codigo como referencia
		$this->Formulario_model->actualizarPrecios($form_cmp->idfrcmp, $codigo, $precios_mod_json);

		//











	}



}
