<?php

class Repositorio extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('session');
		$this->load->model('Formulario_model');
		$this->load->model('Departamento_model');
		$this->load->model('Tema_model');
		$this->load->model('Noticia_model');

	}
	public function index()
	{
		//Formulario
		$forms = $this->Formulario_model->leerCuestionarios();
		//Departamento
		$dep = $this->Departamento_model->leerDepartamentos();

		$data['forms'] = $forms;
		$data['dep'] = $dep;

		$this->load->view('repositorio/encabezado');
		$this->load->view('repositorio/navbar');
		$this->load->view('repositorio/vrepositorio_inicio', $data);
		$this->load->view('repositorio/pie');

	}

	//Respuesta a peticion ajax
	public function gettemas()
	{
		$json = array();
		$idformulario = $this->input->post('formID');
		$json = $this->Tema_model->leerTemasPorFormulario($idformulario);
		header('Content-Type: application/json');
		echo json_encode($json);
	}

	//Metodo para mostrar noticias
	public function noticias()
	{
		$consulta = $this->objetoConsulta();
		//Primer validador - Comprobar el intervalo de fechas
		//var_dump($consulta);
		if($consulta->fecha_inicio > $consulta->fecha_fin)
		{
			$this->mensaje('Intervalo de fechas incorrecto', 'warning');
			redirect('repositorio');
		}else{
			$noticias = $this->Noticia_model->repositorioNoticias($consulta);

			//var_dump($noticias);

			$datos['noticias'] = $noticias;

			$this->load->view('repositorio/encabezado');
			$this->load->view('repositorio/navbar');
			$this->load->view('repositorio/vrepositorio_noticias', $datos);
			$this->load->view('repositorio/pie');
		}
	}

	private function objetoConsulta()
	{
		$ids = new stdClass();
		$ids->fecha_inicio = '';
		$ids->fecha_fin = '';
		$ids->idcuestionario = '';
		$ids->idtema = '';
		$ids->iddepartamento = '';

		//Capturar datos
		$ids->fecha_inicio = $this->fecha_unix($this->input->post('fecha_inicio'));
		$ids->fecha_fin = $this->fecha_unix($this->input->post('fecha_fin')) ;
		$ids->idcuestionario = $this->input->post('idcuestionario');
		$ids->idtema = $this->input->post('idtema');
		$ids->iddepartamento = $this->input->post('iddepartamento');

		return $ids;
	}

	private function fecha_unix($fecha)
	{
		$fecha_std = str_replace('/', '-', $fecha);
		$fecha_unix = strtotime($fecha_std);
		return $fecha_unix;
	}

	//Despliegue de mensaje
	public function mensaje($mensaje, $clase){
		/** @noinspection PhpLanguageLevelInspection */
		$this->session->set_flashdata([
			'mensaje' => $mensaje,
			'clase' => $clase,
		]);
	}
}
