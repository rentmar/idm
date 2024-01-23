<?php

class Tema extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
        $this->load->library('session');
		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Tema_model');

	}
	public function index()
	{
		$dt['temas']=$this->Tema_model->leerTemaFormulario();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('tema/vtema',$dt);
		$this->load->view('html/pie');
	}
	public function crearTema()
	{
		$dts['cuestionarios']=$this->Tema_model->leerCustionarios();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('tema/vcreartema',$dts);
		$this->load->view('html/pie');
	}
	public function agregarTema()
	{
		$idusr=1;
		$dts = array(
				'nombre_tema' => $this->input->post('nombre_tema'),
				'rel_idcuestionario' => $this->input->post('idcuestionario'),
				);
		$this->Tema_model->agregarTema($dts);
		redirect ('tema');
	}
	public function editarTema($idt)
	{
		$dt['tema']=$this->Tema_model->leerTemaPorId($idt);
		$dt['cuestionarios']=$this->Tema_model->leerCustionarios();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('tema/veditartema',$dt);
		$this->load->view('html/pie');
	}
	public function modificarTema($idt)
	{
		$idusr=1;
		$dts = array(
				'nombre_tema' => $this->input->post('nombre_tema'),
				'rel_idcuestionario' => $this->input->post('idcuestionario'),
				'rel_idusuario' => $idusr);
		$this->Tema_model->modificarTema($dts,$idt);
		redirect ('tema');
	}
}
