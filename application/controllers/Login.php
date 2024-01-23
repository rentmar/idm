<?php

class Login extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
        $this->load->library('session');
		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Cuestionario_model');

	}
	public function index(){
	    if(!$this->ion_auth->logged_in())
		{
			//No inicio de session
			$this->session->sess_destroy();
			$this->load->view('login/login.php');

		}
		else
		{
			//Sesion iniciada
			redirect('inicio/', 'refresh');
		}
	}

	public function validar(){
		if($this->ion_auth->login($this->input->post('identidad'), $this->input->post('password'), false ))
		{
			$log_user = $this->ion_auth->user()->row();
			$departamento = $this->Cuestionario_model->leerDepartamento($log_user->rel_iddepartamento);
			//$this->session->set_userdata('usuario', []);
			//$this->session->set_userdata('usuario', $log_user);
			$this->session->set_userdata('sesion_activa', true);
			$this->session->set_userdata('iddepartamento', $departamento->iddepartamento );
			$this->session->set_userdata('departamento', $departamento->nombre_departamento);
			$this->session->set_userdata('edicion_activa', false);

			$this->session->set_userdata('es_nueva_noticia', false);
			$this->session->set_userdata('es_nueva_noticia1', false);
			$this->session->set_userdata('es_nueva_noticia2', false);
			$this->session->set_userdata('es_nueva_ley', false);
			$this->session->set_userdata('nuevo_form', 0);

			$this->session->set_userdata('noticia_nueva', []);
			$this->session->set_userdata('noticia_nueva1', []);
			$this->session->set_userdata('noticia_nueva2', []);
			$this->session->set_userdata('ley_nueva', []);

			$this->session->set_userdata('noticia_editable', 10);

			$this->session->set_userdata('consulta', []);

			redirect('inicio/', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('log_mensaje', $this->ion_auth->errors());
			redirect('login/', 'refresh');
		}
	}

	public function logout()
	{
		$this->ion_auth->logout();
		//Terminar sesion
		$this->load->library('session');
		$this->session->sess_destroy();
		//Redirigir al login
		redirect('login/', 'refresh');
	}
	private function objetoLey()
	{
		$noticia = new stdClass;
		$noticia->idnoticia = '';
		$noticia->fecha_registro = '';
		$noticia->fecha_noticia = '';
		$noticia->titular = '';
		$noticia->resumen = '';
		$noticia->url_noticia = '';

		$noticia->rel_idmedio = '';
		$noticia->rel_idcuestionario = '';
		$noticia->rel_idusuario = '';

		$noticia->iddepartamento = '';

		$noticia->actores = [];
		$noticia->temas = [];
		$noticia->subtemas = [];
		$noticia->medio = [];
		$noticia->tipo_medio = [];

		$noticia->es_segundo_paso = false;
		$noticia->es_preenvio = false;

		return $noticia;
	}


}
