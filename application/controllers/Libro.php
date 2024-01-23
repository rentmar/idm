<?php

class Libro extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('ion_auth');
		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Departamento_model');
		$this->load->model('Libro_model');

		if($this->session->sesion_activa ===  null){
			$this->session->sess_destroy();
			redirect('/');
		}
	}

	//Landing
	public function index(){
		$usuario = $this->ion_auth->user()->row();
		$libros = $this->Libro_model->leerLibros($usuario->id);

		$datos['libros'] = $libros;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('libro/vlibros_inicio', $datos);
		$this->load->view('html/pie');
	}

	//Crear libro
	public function crearLibro(){
		$deps = $this->Departamento_model->leerDepartamentos();
		$usuario = $this->ion_auth->user()->row();

		$datos['departamentos'] = $deps;
		$datos['usuario'] = $usuario;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('libro/vlibros_crear', $datos);
		$this->load->view('html/pie');
	}

	public function insertarLibro(){
		$libro = $this->libro();
		//$departamento = $this->Departamento_model->leerDepartamento($libro->iddepartamento);
		//$libro->nombre_departamento = $departamento->nombre_departamento;
		$idlibro = $this->Libro_model->crearLibro($libro);
		if($idlibro !== false){
			redirect('libro/');
		}
	}

	//Editar libro
	public function editarLibro($identificador){
		$idlibro = $identificador;
		$libro = $this->Libro_model->leerLibro($idlibro);
		$libro_info = json_decode($libro->libro_informacion);
		$usuario = $this->ion_auth->user()->row();
		$deps = $this->Departamento_model->leerDepartamentos();

		/*var_dump($libro);
		echo '<br>';
		var_dump($libro_info);*/

		$datos['libro'] = $libro;
		$datos['libro_info'] = $libro_info;
		$datos['usuario'] = $usuario;
		$datos['departamentos'] = $deps;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('libro/vlibros_editar', $datos);
		$this->load->view('html/pie');

	}
	public function updateLibro(){
		$idlibro = $this->input->post('idlibro');
		$datos_libro = $this->libro();

		/*var_dump($datos_libro);
		echo '<br><br>';
		var_dump($idlibro);*/

		$this->Libro_model->updateLibro($idlibro, $datos_libro);
		redirect('libro/');


	}

	private function libro(){
		$departamento = $this->Departamento_model->leerDepartamento($this->input->post('departamento'));

		$libro = new stdClass();
		$libro->numero_libro = $this->input->post('num_libro');
		$libro->fecha_apertura = $this->input->post('fecha_apertura');
		$libro->fecha_cierre = $this->input->post('fecha_cierre');
		$libro->ciudad_apertura = $this->input->post('ciudad_apertura');
		$libro->ciudad_cierre = $this->input->post('ciudad_cierre');
		$libro->iddepartamento = $this->input->post('departamento');
		$libro->nombre_departamento = $departamento->nombre_departamento;
		$libro->municipio = $this->input->post('municipio');
		$libro->partidas_validas = $this->input->post('partida_valida');
		$libro->partidas_nulas = $this->input->post('partida_nula');
		$libro->partidas_blancas = $this->input->post('partida_blanca');
		$libro->observaciones = $this->input->post('observaciones');
		$libro->idusuario = $this->input->post('idusuario');
		return $libro;
	}


}
