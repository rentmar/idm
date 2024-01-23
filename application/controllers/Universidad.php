<?php
class Universidad extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
        $this->load->library('session');
		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Universidad_model');
	}

	public function index()
	{
		$dt['universidades']=$this->Universidad_model->leerUniversidades();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('universidades/vuniversidad',$dt);
		$this->load->view('html/pie');
	}

	public function crearUniversidad()
	{
		$dt['departamentos']=$this->Universidad_model->leerDepartamentos();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('universidades/vcrearuniversidad',$dt);
		$this->load->view('html/pie');
	}
	public function editarUniversidad($idu)
	{
		$dt['departamentos']=$this->Universidad_model->leerDepartamentos();
		$dt['deptose']=$this->Universidad_model->leerDepartamentoUniversidad($idu);
		$dt['u']=$this->Universidad_model->leerUniversidadId($idu);
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('universidades/veditaruniversidad',$dt);
		$this->load->view('html/pie');
	}

	public function agregarUniversidad()
	{
		$dtchkbox=array();
		$departamentos=$this->Universidad_model->leerDepartamentos();
		$dts = array(
				'nombre_universidad' => $this->input->post('nombre_universidad'),
				'sigla_universidad'=> $this->input->post('sigla_universidad'));
		if ($this->input->post('d0') == NULL) {
			foreach ($departamentos as $d)
			{
				if ($this->input->post('d'.$d->iddepartamento) != NULL)
				{
					array_push($dtchkbox,$this->input->post('d'.$d->iddepartamento));
				}
			}
		}
		if ($this->input->post('d0') != NULL)
		{
			foreach ($departamentos as $d)
			{
				array_push($dtchkbox,$d->iddepartamento);
			}
		}
		$this->Universidad_model->agregarUniversidad($dts,$dtchkbox);
		redirect ('Universidad');
	}
	
	public function modificarUniversidad($idu)
	{
		$dts = array(
				'nombre_universidad' => $this->input->post('nombre_universidad'),
				'sigla_universidad'=> $this->input->post('sigla_universidad'));
		$dtchkbox=array();
		$departamentos=$this->Universidad_model->leerDepartamentos();
		foreach ($departamentos as $d)
		{
			if ($this->input->post('d'.$d->iddepartamento) != NULL)
			{
				array_push($dtchkbox,$this->input->post('d'.$d->iddepartamento));
			}
		}
		$this->Universidad_model->modificarUniversidad($dts,$dtchkbox,$idu);
		redirect ('Universidad');
	}
}
