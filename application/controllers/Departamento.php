<?php
class Departamento extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
        $this->load->library('session');
		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Departamento_model');
	}

	public function index()
	{
		$dt['departamentos']=$this->Departamento_model->leerDepartamentos();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('departamentos/vdepartamento',$dt);
		$this->load->view('html/pie');
	}

	public function crearDepartamento()
	{
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('departamentos/vcreardepartamento');
		$this->load->view('html/pie');
	}
	public function editarDepartamento($idd)
	{
		$dt['d']=$this->Departamento_model->leerDepartamento($idd);
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('departamentos/veditardepartamento',$dt);
		$this->load->view('html/pie');
	}

	public function agregarDepartamento()
	{
		$dts = array(
				'nombre_departamento' => $this->input->post('nombre_departamento'));
		$this->Departamento_model->crearDepartamento($dts);
		redirect ('Departamento');
	}
	public function modificarDepartamento($idd)
	{
		$dts = array(
				'nombre_departamento' => $this->input->post('nombre_departamento'));
		$this->Departamento_model->updateDepartamento($idd,$dts);
		redirect ('Departamento');
	}
}
