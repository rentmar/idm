<?php

class Ley extends CI_Controller
{
//    protected $_idformulario;
    public function __construct()
    {

        	parent::__construct();
        $this->settings = new stdClass();
        $this->load->model('Ley_model');
		$this->load->model('Cuestionario_model');
		$this->load->model('Noticia_model');
		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('ion_auth');
		$this->_idformulario = 4;
                $this->load->library('form_validation');
		//Comprobacion de session
		if($this->session->sesion_activa ===  null)
                {
                    $this->session->sess_destroy();
                    redirect('/');
		}
    }
    public function index()
    {
    	//var_dump($this->session->userdata());
		$usuario = $this->ion_auth->user()->row();
		
		$dt['leyes'] = $this->Ley_model->leerLeyesEstado($usuario->id);

        $this->load->view('html/encabezado');
        $this->load->view('html/navbar');
        $this->load->view('ley/vley',$dt);
        $this->load->view('html/pie');

    }

	public function crearley()
	{
		/*
		 * COMPROBAR SI SE CREA NUEVA NUEVA LEY
		 */
		if(!$this->session->es_nueva_ley)
		{
			//Nueva noticia inactiva
			$this->session->set_userdata('es_nueva_ley', true);
			$ley_objeto = $this->objetoLey();
			$this->session->set_userdata('ley_nueva', []);
			$this->session->set_userdata('ley_nueva', $ley_objeto);
			$ley = $this->session->ley_nueva;
		}else{
			//Nueva ley activa
			$ley = $this->session->ley_nueva;
		}


		//var_dump($this->session->userdata());
		/*
		 * DATOS PARA LLENADO DE FORMULARIO
		 */
		//Informacion del usuario logueado
		$usuario = $this->ion_auth->user()->row();
		//Temas
		$this->Cuestionario_model->setCuestionarioID($this->_idformulario);
		$tema = $this->Cuestionario_model->leerTema();

		$data['ley'] = $ley;
		$data['tema'] = $tema;
		$data['estado_ley'] = $this->Cuestionario_model->leerEstadosDeLey();
		$data['fuente_ley'] = $this->Cuestionario_model->leerFuentesDeLey();
		$data['idformulario'] = $this->_idformulario;
		$data['idusuario'] = $usuario->id;


		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vleyes_form', $data);
		$this->load->view('html/pie');
	}

	public function subtemas()
	{
		//Extraer la variable de session
		$ley = $this->session->ley_nueva;
		if(is_null($ley->es_segundo_paso)){
			$this->session->set_userdata('es_nueva_ley', false);
			$this->session->set_userdata('ley_nueva', []);
			$this->session->set_userdata('ley_insert', []);
			$this->mensaje('Datos incompletos, termine el proceso una vez iniciado. Por favor intente llenar un nuevo formulario de leyes.', 'danger' );
			redirect('inicio');
		}

		if(!$ley->es_segundo_paso){
			$ley->es_segundo_paso= true;
		}
		//Capturar temas
		$temas = $this->input->post('idtema[]');
		$ley->temas = $temas;
		//Datos generales
		$ley->fecha_ley = $this->fecha_unix($this->input->post('fecha'));
		$ley->fuente = $this->input->post('idfuente');
		$ley->estado = $this->input->post('idestadoley');
		$ley->codigo = $this->input->post('codigo_ley');
		$ley->titulo = $this->input->post('nombreley');
		$ley->resumen = $this->input->post('resumen');
		$ley->url_ley = $this->input->post('url_ley');

		$ley->rel_idusuario = $this->input->post('idusuario');
		$ley->rel_idcuestionario = $this->input->post('idformulario');

		$otro_tema = $this->input->post('tema0');
		$ley->otro_tema = $otro_tema;


		//Actualizar la variable de session
		$this->session->set_userdata('ley_nueva', []);
		$this->session->set_userdata('ley_nueva', $ley);

		if(empty($ley->temas))
		{
			$this->session->set_userdata('es_nueva_ley', false);
			$this->session->set_userdata('ley_nueva', []);
			$this->session->set_userdata('ley_insert', []);
			$this->mensaje('Datos incompletos, termine el proceso una vez iniciado. Por favor intente llenar un nuevo formulario de leyes.', 'danger' );
			//redirect('inicio');
		}

		//var_dump($this->session->userdata());
		$data['ley'] = $ley;
		$this->Cuestionario_model->setTemaIDs($ley->temas);
		$temas_sel = $this->Cuestionario_model->leerTemasPorIDs();
		$subtemas_sel = $this->Cuestionario_model->leerSubtemasPorIDs();

		//echo "<br><br>";
		//var_dump($subtemas_sel);

		$data['temas_sel'] = $temas_sel;
		$data['subtemas_sel'] = $subtemas_sel;
		$data['estado_ley'] = $this->Cuestionario_model->leerEstadosDeLeyID($ley->estado);
		$data['fuente_ley'] = $this->Ley_model->leerFuentePorID($ley->fuente);

		//var_dump($this->session->userdata());

		/*
		 * CARGA DE VISTAS
		 */
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vley_subtemas', $data);
		$this->load->view('html/pie');
	}

	private function objetoLey()
	{
		$ley = new stdClass;
		$ley->idley = '';
		$ley->fecha_registro = '';
		$ley->fecha_ley = '';
		$ley->fuente = '';
		$ley->estado = '';

		$ley->codigo = '';
		$ley->titulo = '';

		$ley->resumen = '';
		$ley->url_ley = '';

		$ley->rel_idcuestionario = '';
		$ley->rel_idusuario = '';

		$ley->iddepartamento = '';

		$ley->temas = [];
		$ley->subtemas = [];

		$ley->es_segundo_paso = false;
		$ley->es_preenvio = false;

		return $ley;
	}

	public function preenvio()
	{
		//var_dump($this->session->userdata());
		//Extraer la variable de session nueva noticia
		$ley = $this->session->ley_nueva;
		//var_dump($ley);
		if(!$ley->es_preenvio) {
			$ley->es_preenvio = true;
		}
		//Definir la fecha de registro de la ley
		$ley->fecha_registro = now();
		//definir los identificadores de los subtemas
		$idtemas = array_filter($ley->temas) ;
		//Capturar subtemas
		$subtemas = [];
		foreach ($idtemas as $t)
		{
			$subtemas[$t] = $this->input->post('tema'.$t);
		}
		$ley->subtemas = $subtemas; //Guardar los subtemas
		//Capturar otros subtemas
		$otros_subtemas = [];
		foreach ($idtemas as $t)
		{
			$otros_subtemas[$t] = $this->input->post('otrosubtema'.$t);
		}
		$ley->otros_subtemas = $otros_subtemas; //Guardar otros subtemas
		//Actualizar la bandera de cambio
		$ley->es_preenvio = true;

		//Colocar la ley en la pila de insercion
		$this->session->set_userdata('ley_insert', []);
		$this->session->set_userdata('ley_insert', $ley);

		//Actualizar la variable de session
		$this->session->set_userdata('ley_nueva', []);
		$this->session->set_userdata('ley_nueva', $ley);

		$ley = $this->session->ley_nueva;

		//var_dump($this->session->userdata());

		/*var_dump($ley->subtemas);
		echo "<br><br>";
		var_dump($this->session->userdata());*/

		//Si no hay seleccion de subtemas
		foreach (array_filter($ley->temas) as $t)
		{
				$subtemas_de_tema = $ley->subtemas[$t];
				//var_dump($subtemas_de_tema);
				//echo "<br>";
				if(empty($subtemas_de_tema)) {
					$this->session->set_userdata('es_nueva_ley', false);
					$this->session->set_userdata('ley_nueva', []);
					$this->session->set_userdata('ley_insert', []);
					$this->mensaje('Datos incompletos, debe seleccionar por lo menos un subtema por tema, antes del envio', 'danger');
					redirect('inicio');
				}
		}



		$this->Cuestionario_model->setTemaIDs($ley->temas);
		$temas_sel = $this->Cuestionario_model->leerTemasPorIDs();
		$subtemas_sel = $this->Cuestionario_model->leerSubtemasPorIDs();

		$datos['temas_sel'] = $temas_sel;
		$datos['subtemas_sel'] = $subtemas_sel;
		$datos['ley'] = $ley;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vley_preenvio',$datos);
		$this->load->view('html/pie');


	}

	//Registrar ley en la db
	public function registrarley()
	{
		$ley = $this->session->ley_insert;
		if($this->Ley_model->crearLey($ley))
		{
			$this->session->set_userdata('nuevo_c1', false);
			$this->session->set_userdata('reforma', []);
			$this->session->set_userdata('nuevo_c2', false);
			$this->session->set_userdata('inst', []);
			$this->session->set_userdata('noticia_insert', []);
			$this->session->set_userdata('es_nueva_noticia', false);
			$this->session->set_userdata('noticia_nueva', []);
			$this->session->set_userdata('es_nueva_noticia1', false);
			$this->session->set_userdata('noticia_nueva1', []);
			$this->session->set_userdata('es_nueva_noticia2', false);
			$this->session->set_userdata('noticia_nueva2', []);
			$this->session->set_userdata('es_nueva_ley', false);
			$this->session->set_userdata('ley_nueva', []);
			$this->session->set_userdata('ley_insert', []);
			redirect('/');
		}else{
			echo "Error";
		}
	}
	//Rutina de dd/mm/AA a unix timestamp
	private function fecha_unix($fecha)
	{
		$fecha_std = str_replace('/', '-', $fecha);
		$fecha_unix = strtotime($fecha_std);
		return $fecha_unix;
	}
	public function estadoLey($idl)
	{
		$usuario = $this->ion_auth->user()->row();
		$dt['leyes'] =$this->Cuestionario_model->leerLeyesIdUsuario($usuario->id);
        $dt['estados'] = $this->Cuestionario_model->leerEstadosDeLey();
		$dt['idley']=$idl;
		$dt['estadose']=$this->Ley_model->leerEstadosEnLey($idl);
		$this->load->view('html/encabezado');
        $this->load->view('html/navbar');
        $this->load->view('ley/vactualizar_ley',$dt);
        $this->load->view('html/pie');
	}
    public function actualizarLey($idl)
    {
		$idel = $this->input->post('idestadoley');
		if (count($this->Ley_model->leerEstadoLey($idl,$idel))==0)
		{
			$dtestado=array(
						'rel_idleyes'=>$idl,
						'rel_idestadoley'=>$this->input->post('idestadoley'),
						'fecha_estadoley'=>$this->fecha_unix($this->input->post('fechaestado'))
						);
			$dttitulo=array(
						'nombre_ley'=>trim($this->input->post('titulo')),
						'rel_idestadoley'=>$this->input->post('idestadoley'),
						'rel_idley'=>$idl
						);
			$dtcodigo=array(
						'codigo_ley'=>$this->input->post('codigo'),
						'rel_idestadoley'=>$this->input->post('idestadoley'),
						'rel_idley'=>$idl
						);
			$dturl=array(
						'url_ley'=>$this->input->post('url'),
						'rel_idestadoley'=>$this->input->post('idestadoley'),
						'rel_idley'=>$idl
						);
			$this->Ley_model->insertarEstadoDeLey($dtestado,$dttitulo,$dtcodigo,$dturl);
		}        
		redirect('Ley');
    }

	public function cancelarNuevo()
	{
		$this->session->set_userdata('es_nueva_ley', false);
		$this->session->set_userdata('ley_nueva', []);
		$this->session->set_userdata('ley_insert', []);

		//Limpiar las variables de session y colocar la bandera en su estado original
		$this->session->set_userdata('nuevo_c1', false);
		$this->session->set_userdata('reforma', []);
		//Redireccionar al inicio
		redirect('inicio/');
	}
	public function editar()
	{
		$usuario = $this->ion_auth->user()->row();
		
		$dt['leyes'] =$this->Cuestionario_model->leerLeyesIdUsuario($usuario->id);
		$dt['cuestionario'] = $this->Cuestionario_model->leerCuestionario($this->_idformulario);
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vley_lista', $dt);
		$this->load->view('html/pie');
	}
	public function editarLey($idley)
	{
		$usuario = $this->ion_auth->user()->row();
		$l=$this->Ley_model->leerLeyPorId($idley);
		$dt['fuentes']=$this->Ley_model->leerfuentes();
		$dt['ley']= $l;
		$dt['fuente']=$this->Ley_model->leerFuenteLey($idley);
		$estadosdeley=$this->Ley_model->leerEstadosDeLey($idley);
		$datosestado=array();
		foreach ($estadosdeley as $el)
		{
			$nl=$this->Ley_model->leerNombreLeyIdEstado($idley,$el->rel_idestadoley);
			$cl=$this->Ley_model->leerCodigoLeyIdEstado($idley,$el->rel_idestadoley);
			$ul=$this->Ley_model->leerUrlLeyIdEstado($idley,$el->rel_idestadoley);
			$dtestado=array(
					'idestadoley'=>$el->rel_idestadoley,
					'nombre_estadoley'=>$el->nombre_estadoley,
					'fecha_estadoley'=>$el->fecha_estadoley,
					'nombre_ley'=>$nl->nombre_ley,
					'codigo_ley'=>$cl->codigo_ley,
					'url_ley'=>$ul->url_ley
					);
			array_push($datosestado,$dtestado);
		}
		$dt['datosestado']=$datosestado;
		/*$dt['temas']=$this->Ley_model->leerTemasCuestionario($this->_idformulario);
		$dt['temase']=$this->Ley_model->leerTemasLey($idley);
		$dt['otrotema']=$this->Ley_model->leerOtroTemaLey($idley);
		$dt['otrosubtema']=$this->Ley_model->leerOtroSubTemaLey($idley);
		$dt['subtemase']=$this->Ley_model->leerSubtemasLey($idley);
		foreach ($dt['temase'] as $te)
		{
			$subtemas[$te->idtema]=$this->Ley_model->leerSubtemasPorTema($te->idtema);
		}
		$dt['subtemas']=$subtemas;
		$dt['na']=$this->Noticia_model->leerNoticiaActores($idnoticia);*/
		
		$dt['temas']=$this->Ley_model->leerTemasCuestionario($this->_idformulario);
		$dt['temase']=$this->Ley_model->leerTemasLey($idley);
		$dt['otrotema']=$this->Ley_model->leerOtroTemaLey($idley);
		$dt['otrosubtema']=$this->Ley_model->leerOtroSubTemaLey($idley);
		$dt['subtemase']=$this->Ley_model->leerSubtemasLey($idley);
		if(count($dt['temase'])!=0)
		{
			foreach ($dt['temase'] as $te)
			{
				$subtemas[$te->idtema]=$this->Noticia_model->leerSubtemasPorTema($te->idtema);
			}
			$dt['subtemas']=$subtemas;
		}
		else 
		{
			$dt['subtemas']=null;
		}
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vley_editar', $dt);
		$this->load->view('html/pie');
	}
	public function modificarLey($idley)
	{
		$l=$this->Ley_model->leerLeyPorId($idley);
		$accion=$this->input->post('accion');
		if ($accion==1)
		{
			//$fecha=$this->fecha_unix($this->input->post('fecha'));
			//$this->Ley_model->modificarFechaLey($idley,$fecha);
			$this->Ley_model->modificarFuenteLey($idley,$this->input->post('rel_idfuente'));
		}
		elseif ($accion==2)
		{	
			$this->Ley_model->modificarResumenLey($idley,$this->input->post('resumen'));
		}
		elseif ($accion==3)
		{	
			$estley=$this->input->post("el");
			$dtestado=array(
					'rel_idleyes'=>$idley,
					'rel_idestadoley'=>$this->input->post('idestadoley'.$estley)
					);
			$dtfecha = array(
					'fecha_estadoley'=>$this->fecha_unix($this->input->post('fecha'.$estley))
					);
			$dttitulo = array(
					'nombre_ley'=>trim($this->input->post('tituloley'.$estley))
					);
			$dtcodigo = array(
					'codigo_ley'=>$this->input->post('codigoley'.$estley)
					);
			$dturl = array(
					'url_ley'=>$this->input->post('urlley'.$estley)
					);
			var_dump($dtestado);
			echo "<br>";
			$this->Ley_model->modificarDatosLey($dtestado,$dtfecha,$dttitulo,$dtcodigo,$dturl);
			
		}
		elseif ($accion==4)
		{	
			$dtchkboxst=array();
			$dtotrosubtemas=array();
			$subtemas=$this->Ley_model->leerTodoSubTemas();
			$temas=$this->Ley_model->leerTodoTemas();
			if ($this->input->post('cnttemas')!=0)
			{
				foreach ($subtemas as $st)
				{	
					if ($this->input->post('st'.$st->idsubtema)!=null)
					{
						array_push($dtchkboxst,$this->input->post('st'.$st->idsubtema));
					}
				}
				foreach ($temas as $t)
				{
					if ($this->input->post('te'.$t->idtema)!=null)
					{
						$idte=$this->input->post('te'.$t->idtema);
						if ($this->input->post('ost'.$idte)!=null)
						{
							array_push($dtotrosubtemas,array('nombre_otrosubtema'=>$this->input->post('otrosubtema'.$t->idtema),
															'rel_idtema'=>$t->idtema));
						}
					}
				}
			}
			if ($this->input->post('otrotema')=="")
			{
				$dtsotrotema=array();
			}
			else
			{
				$dtsotrotema=array(
							'nombre_otrotema'=>$this->input->post('otrotema'),
							'rel_idcuestionario'=>$this->input->post('idcuestionario'),
							'rel_idusuario'=>$this->input->post('idusuario'));
			}

			
			$this->Ley_model->modificarSubTemasLey($idley,$dtchkboxst,$dtsotrotema,$dtotrosubtemas);
			
		}
		
		redirect('Ley/editar');
	}
	public function editarTemas()
	{
		$temase=array();
		$subtemase=array();
		$usuario = $this->ion_auth->user()->row();
		$dt['idusuario']=$usuario->id;
		$dt['idcuestionario']=$this->_idformulario;
		$dt['idley']=$this->input->post('idley');
		$temas=$this->Ley_model->leerTemasCuestionario($this->_idformulario);
		foreach ($temas as $t)
		{	
			if ($this->input->post('t'.$t->idtema)!=null)
			{
				$temase[$t->idtema]=$this->Ley_model->leerTemaPorId($t->idtema);
				$subtemase[$t->idtema]=$this->Ley_model->leerSubtemasPorTema($t->idtema);
			}
		}
		if ($this->input->post('idot')!=null)
		{
			$dt['otrotema']=$this->input->post('otrotema');
		}
		else
		{
			$dt['otrotema']=null;
		}
		$dt['temase']=$temase;
		$dt['subtemase']=$subtemase;
		$dt['cntTemas']=count($temase);
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/veditartema_ley',$dt);
		$this->load->view('html/pie');
	}

	public function iniciarCreacion()
	{
		$this->session->set_userdata('nuevo_c1', false);
		$this->session->set_userdata('reforma', []);
		$this->session->set_userdata('nuevo_c2', false);
		$this->session->set_userdata('inst', []);
		$this->session->set_userdata('noticia_insert', []);
		$this->session->set_userdata('es_nueva_noticia', false);
		$this->session->set_userdata('noticia_nueva', []);
		$this->session->set_userdata('es_nueva_noticia1', false);
		$this->session->set_userdata('noticia_nueva1', []);
		$this->session->set_userdata('es_nueva_noticia2', false);
		$this->session->set_userdata('noticia_nueva2', []);
		$this->session->set_userdata('es_nueva_ley', false);
		$this->session->set_userdata('ley_nueva', []);
		$this->session->set_userdata('ley_insert', []);
		redirect('ley/crearLey');
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
