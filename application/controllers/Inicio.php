<?php

class Inicio extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('ion_auth');
		$this->load->model('Formulario_model');

		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');
		
		if($this->session->sesion_activa ===  null){
			$this->session->sess_destroy();
			redirect('/');
		}

	}

	public function index()
	{
		$usuario = $this->ion_auth->user()->row();
		$idusuario = $usuario->id;

		$form_abiertos = $this->Formulario_model->getFormRespPorIdusuario($idusuario);


		$datos['no_es_vista_previa'] = 1;
		$datos['ciudad'] = $this->Formulario_model->getCiudad();
		$datos['zona'] = $this->Formulario_model->getZona();
		$datos['lugar'] = $this->Formulario_model->getLugar();
		$datos['formularios_base'] = $this->Formulario_model->getFormularios();


		$datos['usuario'] = $usuario;
		$datos['idusuario'] = $idusuario;
		$datos['form_abiertos'] = $form_abiertos;


		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('inicio/vinicio_index', $datos);
		$this->load->view('html/pie');
	}

	public function exito()
	{
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('mensajes/vde_confirmacion');
		$this->load->view('html/pie');
	}

	public function fracaso()
	{
		$this->load->view('mensajes/vde_error');

	}
}
