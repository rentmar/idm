<?php

class MedioComunicacion extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
        $this->load->library('session');
		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('MedioComunicacion_model');

	}
	public function index()
	{
		$dt['medios']=$this->MedioComunicacion_model->leerMedioComunicacion();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('medio_comunicacion/vmediocomunicacion',$dt);
		$this->load->view('html/pie');
	}
	public function crearMedioComunicacion()
	{
		$dt['departamentos']=$this->MedioComunicacion_model->leerDepartamento();
		$dt['tipos']=$this->MedioComunicacion_model->leerTipoMedio();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('medio_comunicacion/vcrearmedio',$dt);
		$this->load->view('html/pie');
	}
	public function agregarMedioComunicacion()
	{
		$dtchkbox=array();
		$departamentos=$this->MedioComunicacion_model->leerDepartamento();
		$dts = array(
				'nombre_medio' => $this->input->post('nombre_medio'),
				'rel_idtipomedio'=> $this->input->post('idtipomedio'));
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
		$this->MedioComunicacion_model->agregarMedioComunicacion($dts,$dtchkbox);
		redirect ('MedioComunicacion');
	}
	public function editarMedioComunicacion($idm)
	{
		$dt['medio']=$this->MedioComunicacion_model->leerMedioPorId($idm);
		$dt['departamentos']=$this->MedioComunicacion_model->leerDepartamento();
		$dt['tipos']=$this->MedioComunicacion_model->leerTipoMedio();
		$dt['medio_departamento']=$this->MedioComunicacion_model->leerDepartamentoMedioId($idm);
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('medio_comunicacion/veditarmedio',$dt);
		$this->load->view('html/pie');
	}
	public function modificarMedioComunicacion($idm)
	{
		$dts = array(
				'nombre_medio' => $this->input->post('nombre_medio'),
				'rel_idtipomedio'=> $this->input->post('rel_idtipomedio'));
		$dtchkbox=array();
		$departamentos=$this->MedioComunicacion_model->leerDepartamento();
		foreach ($departamentos as $d)
		{
			if ($this->input->post('d'.$d->iddepartamento) != NULL)
			{
				array_push($dtchkbox,$this->input->post('d'.$d->iddepartamento));
			}
		}
		$this->MedioComunicacion_model->modificarMedioComunicacion($dts,$dtchkbox,$idm);
		redirect ('MedioComunicacion');
	}
}
