<?php

class TipoMedio extends CI_Controller{
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
		$dt['tipomedio']=$this->MedioComunicacion_model->leerTipoMedio();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('tipomedio/vtipomedio',$dt);
		$this->load->view('html/pie');
	}
	public function crearTipoMedio()
	{
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('tipomedio/vcreartipomedio');
		$this->load->view('html/pie');
	}
	public function editarTipoMedio($idtm)
	{
		$dt['tm']=$this->MedioComunicacion_model->leerTipoMedioPorId($idtm);
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('tipomedio/veditartipomedio',$dt);
		$this->load->view('html/pie');
	}
	public function agregarTipoMedio()
	{
		$dts = array(
				'nombre_tipo' => $this->input->post('nombre_tipomedio'));
		$this->MedioComunicacion_model->agregarTipoMedio($dts);
		redirect ('tipoMedio');
	}
	public function modificarTipoMedio($idtm)
	{
		$dts = array(
				'nombre_tipo' => $this->input->post('nombre_tipomedio'));
		$this->MedioComunicacion_model->modificarTipoMedio($dts,$idtm);
		redirect ('tipoMedio');
	}
}
