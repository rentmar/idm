<?php
class Noticia extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->helper('form');
		$this->load->model('Noticia_model');
		$this->load->model('Actor_model');
		$this->load->model('Cuestionario_model');
        $this->load->helper('date');        
        $this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');

		if($this->session->sesion_activa ===  null){
			$this->session->sess_destroy();
			redirect('/');
		}
    }
    public function index()
    {
		$this->load->view('inicio/vinicio_index.php');
    }
    public function registrarNoticia()
    {

    	$noticia = $this->session->noticia_insert;
		//$this->Noticia_model->crearNoticia($noticia);
		if($this->Noticia_model->crearNoticia($noticia))
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
			redirect('/');
		}else{
			echo "Error";
		}
    }
	public function editarNoticia($idnoticia)
	{
		$usuario = $this->ion_auth->user()->row();
		$n=$this->Noticia_model->leerNoticiaPorId($idnoticia);
		$medio=$this->Noticia_model->leerMedioPorId($n->rel_idmedio);
		$dt['actores']=$this->Noticia_model->leerTodoActores();
		$dt['medios']=$this->Noticia_model->leerMediosPorTipoDepartamento($medio->rel_idtipomedio,$usuario->rel_iddepartamento);
		$dt['tipos']=$this->Noticia_model->leerTipos();
		$dt['noticia']= $n;
		$dt['na']=$this->Noticia_model->leerNoticiaActores($idnoticia);
		$dt['medio']=$medio;
		$dt['temas']=$this->Noticia_model->leerTemasCuestionario($this->_idformulario);
		$dt['temase']=$this->Noticia_model->leerTemasNoticia($idnoticia);
		$dt['otrotema']=$this->Noticia_model->leerOtroTemaNoticia($idnoticia);
		$dt['otrosubtema']=$this->Noticia_model->leerOtroSubTemaNoticia($idnoticia);
		$dt['subtemase']=$this->Noticia_model->leerSubtemasNoticia($idnoticia);
		foreach ($dt['temase'] as $te)
		{
			$subtemas[$te->idtema]=$this->Noticia_model->leerSubtemasPorTema($te->idtema);
		}
		$dt['subtemas']=$subtemas;
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('cuestionarios/vnoticia_editar_inst', $dt);
		$this->load->view('html/pie');
	}
	public function modificarNoticia($idn)
	{
		$n=$this->Noticia_model->leerNoticiaPorId($idn);
		$accion=$this->input->post('accion');
		if ($accion==1)
		{
			$fecha=$this->fecha_unix($this->input->post('fecha'));
			$this->Noticia_model->modificarFechaNoticia($idn,$fecha);
		}
		elseif ($accion==2)
		{	
			$this->Noticia_model->modificarMedioNoticia($idn,$this->input->post('idmedio'));
		}
		elseif ($accion==3)
		{	
			$dts = array(
						'titular'=>$this->input->post('titular'),
						'resumen'=>$this->input->post('resumen'),
						'url_noticia'=>$this->input->post('url')
						);
			$this->Noticia_model->modificarDatosNoticia($idn,$dts);
		}
		elseif ($accion==4)
		{	
			$dtchkbox=array();
			$actores=$this->Noticia_model->leerTodoActores();
			foreach ($actores as $a)
			{	
				if ($this->input->post('a'.$a->idactor)!=null)
				{
					array_push($dtchkbox,$this->input->post('a'.$a->idactor));
				}
			}
			$this->Noticia_model->modificarActoresNoticia($idn,$dtchkbox);
		}
		elseif ($accion==5)
		{	
			$dtchkboxst=array();
			$dtotrosubtemas=array();
			$subtemas=$this->Noticia_model->leerTodoSubTemas();
			$temas=$this->Noticia_model->leerTodoTemas();
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
			/*echo "Numrero de Temas: ";
			echo $this->input->post('cnttemas');
			echo "<br><br>";
			echo "Numero de otro Tema: ";
			echo count($dtsotrotema);
			echo "<br><br>";
			var_dump($dtsotrotema);
			echo "<br><br>";
			echo "Numero de Sub Temas: ";
			echo count($dtchkboxst);
			echo "<br><br>";
			var_dump($dtchkboxst);
			echo "<br><br>";
			echo "Numero de otro SubTemas: ";
			echo count($dtotrosubtemas);
			echo "<br><br>";
			var_dump($dtotrosubtemas);*/
			
			$this->Noticia_model->modificarSubTemasNoticia($idn,$dtchkboxst,$dtsotrotema,$dtotrosubtemas);
		
		}
		if ($n->rel_idcuestionario==1)
		{
			redirect('Reformaelectoral/editar');
		}
		elseif ($n->rel_idcuestionario==2)
		{
			redirect('Instdemocratica/editar');
		}
		elseif ($n->rel_idcuestionario==3)
		{
			redirect('Censo/editar');
		}
	}
    //Cambiar el formato MM/DD/YY a unix timestamp
    private function fecha_unix($fecha) 
	{
        list($anio, $mes, $dia) = explode('-', $fecha);
        $fecha_unix = mktime(0, 0, 0, $mes, $dia, $anio);
        return $fecha_unix;
    }
}
