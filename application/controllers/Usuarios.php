<?php

class Usuarios extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->model('Departamento_model');
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

	}

	public function crearUsuario($grupo)
	{
		$data['grupo']=$grupo;
		$data['grupos'] = $this->ion_auth->groups()->result();
		$data['departamentos'] = $this->Departamento_model->leerDepartamentos();


		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
	    $this->load->view('usuarios/vformulario_usuario', $data);
		$this->load->view('html/pie');
	}

	public function procesarCrear($g)
	{
		$data['grupo']=$this->input->post('tipo');
		$grupo = $this->input->post('tipo');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('usuario', 'Nombre de usuario', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('apellido', 'Apellido', 'required');
		//$this->form_validation->set_rules('carnet', 'Carnet de Identidad', 'required|numeric');
		//$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password1', 'Confirmar Password', 'required|matches[password]');

		if($this->form_validation->run()==false)
		{
			$data['grupos'] = $this->ion_auth->groups()->result();
			$data['departamentos'] = $this->Departamento_model->leerDepartamentos();
			//$data['universidades']= $this->Departamento_model->leerUniversidades();
			$this->load->view('html/encabezado');
			$this->load->view('html/navbar');
			$this->load->view('usuarios/vformulario_usuario', $data);
			$this->load->view('html/pie');
		}else{
			/*$usr = $this->usuario();
			if(!$this->Formulario_model->crearUsuario($usr)){
				$this->mensaje('Usuario no creado, intente de nuevo', 'warning');
				redirect('usuarios/listar/'.$grupo);
			}else{
				$this->mensaje('Nuevo usuario creado', 'success');
				redirect('usuarios/listar/'.$grupo);
			}*/

			//echo "Valido";


			$usuario = $this->input->post('usuario');
			$password = $this->input->post('password');
			$email = $this->input->post('email');
			$departamento = $this->input->post('departamento');
			/** @noinspection PhpLanguageLevelInspection */
			$datos_extra = [
				'first_name' => $this->input->post('nombre'),
				'last_name' => $this->input->post('apellido'),
				'carnet_identidad' => $this->input->post('carnet'),
				'rel_iddepartamento' => $this->input->post('departamento'),
				'grupo' => $grupo,
			];

			if(!$this->ion_auth->register($usuario, $password, $email, $datos_extra, $grupo)){
				$this->mensaje('Usuario no creado, intente de nuevo', 'warning');
				redirect('usuarios/listar/'.$grupo);
			}else{
				$this->mensaje('Nuevo usuario creado', 'success');
				redirect('usuarios/listar/'.$grupo);
			}
		}
	}

	private function usuario(){
		$usuario = new stdClass();

		$usuario->username = $this->input->post('usuario');
		$usuario->password  = $this->input->post('password');
		$usuario->first_name = $this->input->post('nombre');
		$usuario->last_name = $this->input->post('apellido');
		$usuario->email = $this->input->post('email');
		$usuario->rel_iddepartamento = $this->input->post('departamento');
		$usuario->grupo = $this->input->post('tipo');

		return $usuario;

	}



	public function editarUsuario($idusuario)
	{
		$data['enleyes']=count($this->Departamento_model->leerUsuarioPerteneceGrupo($idusuario,4));
		$data['grupo']=$this->Departamento_model->leerGrupoPorIdUser($idusuario);
		$usuario = $this->ion_auth->user($idusuario)->row();
		$data['usuario'] = $usuario;
		$data['grupos'] = $this->ion_auth->groups()->result();
		$data['usuario_grupos'] = $this->ion_auth->get_users_groups($usuario->id)->result();
		$data['departamentos'] = $this->Departamento_model->leerDepartamentos();
		$data['universidades']=$this->Departamento_model->leerUniversidades();



		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('usuarios/vformulario_usuario_editar', $data);
		$this->load->view('html/pie');
	}

	public function editarUsrLog()
	{
		//echo "editar usuario logeado";
		//echo "<br><br>";
		$usuario = $this->ion_auth->user()->row();
		$data['usuario'] = $usuario;
		$data['grupos'] = $this->ion_auth->groups()->result();
		$data['departamentos'] = $this->Departamento_model->leerDepartamentos();

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('usuarios/vformulario_monitor_editar', $data);
		$this->load->view('html/pie');
	}

	public function procesarUsrLog()
	{
		$idusuario = $this->input->post('idusuario');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('apellido', 'Apellido', 'required');
		$this->form_validation->set_rules('carnet', 'Carnet de Identidad', 'numeric');
		if($this->form_validation->run()==false)
		{
			$usuario = $this->ion_auth->user($idusuario)->row();
			$data['usuario'] = $usuario;
			$data['grupos'] = $this->ion_auth->groups()->result();
			$data['departamentos'] = $this->Departamento_model->leerDepartamentos();
			$this->load->view('usuarios/vformulario_monitor_editar', $data);
		}else{
			/** @noinspection PhpLanguageLevelInspection */
			$datos_extra = [
				'first_name' => $this->input->post('nombre'),
				'last_name' => $this->input->post('apellido'),
				'carnet_identidad' => $this->input->post('carnet'),
				'geolocalizacion' => $this->input->post('ubicacion'),
				'direccion' => $this->input->post('direccion'),
			];

			if($this->ion_auth->update($idusuario, $datos_extra)){
				//echo "Usuario modificado";
			}else{
				//echo "Usuario no modificado";
			}
		}

	}

	public function procesarEditar()
	{
		$grupocuestionario=$this->input->post('grupoleyes');
		$idusuario = $this->input->post('idusuario');
		$idgrupo=$this->input->post('idgrupo');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('apellido', 'Apellido', 'required');
		$this->form_validation->set_rules('carnet', 'Carnet de Identidad', 'required|numeric');

		if($this->form_validation->run()==false)
		{
			$usuario = $this->ion_auth->user($idusuario)->row();
			$data['usuario'] = $usuario;
			$data['grupos'] = $this->ion_auth->groups()->result();
			$data['departamentos'] = $this->Departamento_model->leerDepartamentos();
			$this->load->view('usuarios/vformulario_usuario_editar', $data);
		}else{
		
			$datos_extra = [
				'first_name' => $this->input->post('nombre'),
				'last_name' => $this->input->post('apellido'),
				'carnet_identidad' => $this->input->post('carnet'),
				'geolocalizacion' => $this->input->post('ubicacion'),
				'rel_iddepartamento' => $this->input->post('iddepartamento'),
				'direccion' => $this->input->post('direccion'),
				'rel_iduniversidad'=>$this->input->post('iduniversidad')
			];
			$this->Departamento_model->modificarUsuario($idusuario,$datos_extra);
			if ($grupocuestionario!=NULL)
			{
				$engrupo=count($this->Departamento_model->leerUsuarioPerteneceGrupo($idusuario,$grupocuestionario));
				if ($engrupo==0)
				{
					$this->Departamento_model->agregarUsuarioAGrupo($idusuario,$grupocuestionario);
				}
			}
			$this->listar($idgrupo);
		}

	}

	public function editarPwd()
	{
		$usuario = $this->ion_auth->user()->row();
		$data['usuario'] = $usuario;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('usuarios/vformulario_pwd', $data);
		$this->load->view('html/pie');

	}

	public function procesarEditPwd()
	{
		$idusuario = $this->input->post('idusuario');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pass', 'Contraseña', 'required');
		$this->form_validation->set_rules('pass1', 'Confirmar Contraseña', 'required|matches[pass]');


		if($this->form_validation->run()==false)
		{
			$usuario = $this->ion_auth->user($idusuario)->row();
			$data['usuario'] = $usuario;
			$this->load->view('html/encabezado');
			$this->load->view('html/navbar');
			$this->load->view('usuarios/vformulario_pwd', $data);
			$this->load->view('html/pie');
		}else{
			/** @noinspection PhpLanguageLevelInspection */
			$datos_extra = [
				'password' => $this->input->post('pass'),
			];

			if($this->ion_auth->update($idusuario, $datos_extra)){
				//echo "Contraseña modificada";
				redirect('inicio');
			}else{
				//echo "Contraseña no modificado";
				redirect('inicio');
			}
		}

	}


	public function listar($grupo)
	{
		if($grupo == 1){
			//Administradores
			$data['titulo'] = 'Administradores';
		}elseif ($grupo == 2){
			//Supervisores
			$data['titulo'] = 'Supervisores';
		}elseif ($grupo == 3){
			//Encuestadores
			$data['titulo'] = 'Encuestadores';
		}
		$data['grupo']=$grupo;
		$data['usuarios']= $this->Departamento_model->leerUsuarioPorIdGrupo($grupo);
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('usuarios/vusuarios_lista', $data);
		$this->load->view('html/pie');
	}

	//Cambiar el estado de un usuario
	public function cambiarEstadoUsuario($identificador)
	{
		$idusuario = $identificador;
		$usuario = $this->ion_auth->user($idusuario)->row();
		if($usuario->active)
		{
			//Funcion complementaria
			$estado = 0;
			$mensaje = "Usuario ".$usuario->username." Inhabilitado";
			$this->mensaje($mensaje, 'info');
		}else{
			//Funcion complementaria
			$estado = 1;
			$mensaje = "Usuario ".$usuario->username." Habilitado";
			$this->mensaje($mensaje, 'info');
		}
		//Actualizar estado
		/** @noinspection PhpLanguageLevelInspection */
		$datos = [
			'active' => $estado,
		];
		$this->ion_auth->update($idusuario, $datos);
		redirect('inicio');
	}

	//Despliegue de mensaje
	public function mensaje($mensaje, $clase){
		/** @noinspection PhpLanguageLevelInspection */
		$this->session->set_flashdata([
			'mensaje' => $mensaje,
			'clase' => $clase,
		]);
	}
}
