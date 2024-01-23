<?php

class SubTema extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
        $this->load->library('session');
		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('SubTema_model');

	}
	public function index()
	{
		$dt['subtemas']=$this->SubTema_model->leerSubtemaTemaCuestionario();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('subtema/vsubtema',$dt);
		$this->load->view('html/pie');
	}
	public function crearSubTema()
	{
		$dts['temas']=$this->SubTema_model->leerTemas();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('subtema/vcrearsubtema',$dts);
		$this->load->view('html/pie');
	}
	public function agregarSubTema()
	{
		$dts = array(
				'nombre_subtema' => $this->input->post('nombre_subtema'),
				'rel_idtema' => $this->input->post('idtema'));
		$this->SubTema_model->agregarSubTema($dts);
		redirect ('subTema');
	}
	public function editarSubTema($idt)
	{
		$dt['subtema']=$this->SubTema_model->leerSubTemaPorId($idt);
		$dt['temas']=$this->SubTema_model->leerTemas();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('subtema/veditarsubtema',$dt);
		$this->load->view('html/pie');
	}
	public function modificarSubTema($idt)
	{
		$dts = array(
				'nombre_subtema' => $this->input->post('nombre_subtema'),
				'rel_idtema' => $this->input->post('idtema'));
		$this->SubTema_model->modificarSubTema($dts,$idt);
		redirect ('subTema');
	}


}
