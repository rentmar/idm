<?php

class Actor extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
        $this->load->library('session');
		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Actor_model');

	}
	public function index()
	{	
		$dts['actores']=$this->Actor_model->leerActores();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('actor/vactor',$dts);
		$this->load->view('html/pie');
	}
	public function crearActor()
	{
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('actor/vcrearactor');
		$this->load->view('html/pie');
	}
	public function editarActor($ida)
	{
		$dt['a']=$this->Actor_model->leerActorPorId($ida);
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('actor/veditaractor',$dt);
		$this->load->view('html/pie');
	}
	public function agregarActor()
	{
		$dts = array(
				'nombre_actor' => $this->input->post('nombre_actor'));
		$this->Actor_model->agregarActor($dts);
	    redirect('Actor');
	}
	public function modificarActor($ida)
	{
		$dts = array(
				'nombre_actor' => $this->input->post('nombre_actor'));
		$this->Actor_model->modificarActor($dts,$ida);
		redirect ('Actor');
		
	}
}
