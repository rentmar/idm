<?php
date_default_timezone_set('America/La_Paz');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Encuesta extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('ion_auth');
		$this->load->model('Encuesta_model');
		$this->load->model('Departamento_model');
		$this->load->library('encryption');
		$this->load->helper('form');
		$this->load->helper('date');

		if($this->session->sesion_activa ===  null){
			$this->session->sess_destroy();
			redirect('/');
		}
	}

	//Vista para las encuestas definidas
	public function index()
	{
		//Leer todas las encuestas
		$data['encuestas'] = $this->Encuesta_model->leerTodasLasEncuestas();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_index', $data);
		$this->load->view('html/pie');
	}
	public function verTiempo()
	{
		$fecha = new DateTime();
		$min = ($fecha->getTimestamp()-$this->input->post('inicio'))/60;
		return $min;
	}
	//Vista para los Modulos
	public function moduloUI()
	{
		//Leer todos los modulos
		$datos['modulos'] = $this->Encuesta_model->leerTodosLosModulos();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_modulo', $datos);
		$this->load->view('html/pie');
	}

	public  function seccionUI()
	{
		//Leer todas las secciones
		$datos['secciones'] = $this->Encuesta_model->leerTodasLasSecciones();
//		echo "<pre>";var_dump($datos);echo "</pre>";
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_seccion', $datos);
		$this->load->view('html/pie');
	}

	public function preguntaUI()
	{
		//Leer todas las preguntas
		$datos['preguntas'] = $this->Encuesta_model->leerTodasLasPreguntas();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_pregunta', $datos);
		$this->load->view('html/pie');
	}
	public function crearPregunta()
	{
		$datos['secciones'] = $this->Encuesta_model->leerTodasLasSecciones();
		$datos['respuestas'] = $this->Encuesta_model->leerTodasLasRespuestas();
		$datos['tipo_pregunta'] = $this->Encuesta_model->leerTiposDePregunta();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vcrearpregunta', $datos);
		$this->load->view('html/pie');
	}
	public function agregarPreguntaUI()
	{
		$dtcheck=[];
		$respuestas=$this->Encuesta_model->leerTodasLasRespuestas();
		$dts=array(
			"uipregunta_nombre"=>$this->input->post("nombre_pregunta"),
			"uiorden_pregunta"=>$this->input->post("ordenpregunta"),
			"rel_iduiseccion"=>$this->input->post("idseccion"),
			"rel_iduitipopregunta"=>$this->input->post('idtipopregunta'));
		foreach ($respuestas as $r)
		{
			if ($this->input->post("resp".$r->iduirespuesta)!=null)
			{
				array_push($dtcheck,$this->input->post("resp".$r->iduirespuesta));
			}
		}
		if (count($dtcheck)!=0)
		{
			$this->Encuesta_model->agregarPreguntaUI($dts,$dtcheck);
			redirect('Encuesta/preguntaUI');
		}
	}
	public function editarPreguntaUI($idp)
	{
		$dt['tipos']=$this->Encuesta_model->leerTiposPreguntas();
		$dt['tipo']=$this->Encuesta_model->leerTipoPreguntaId($idp);
		$dt['pregunta']=$this->Encuesta_model->leerPreguntaId($idp);
		$dt['respuestas'] = $this->Encuesta_model->leerTodasLasRespuestas();
		$dt['respuestas_pregunta']=$this->Encuesta_model->leerRespuestasPreguntaId($idp);
		$dt['secciones'] = $this->Encuesta_model->leerTodasLasSecciones();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/veditarpregunta', $dt);
		$this->load->view('html/pie');
	}
	public function modificarPreguntaUI($idp)
	{
		$dtcheck=[];
		$respuestas=$this->Encuesta_model->leerTodasLasRespuestas();
		foreach ($respuestas as $r)
		{
			if ($this->input->post("resp".$r->iduirespuesta)!=null)
			{
				array_push($dtcheck,$this->input->post("resp".$r->iduirespuesta));
			}
		}
		$dts=array(
			"uipregunta_nombre"=>$this->input->post("nombre_pregunta"),
			"uiorden_pregunta"=>$this->input->post("ordenpregunta"),
			"rel_iduiseccion"=>$this->input->post("idseccion"),
			"rel_iduitipopregunta"=>$this->input->post("idtipo"));
		$this->Encuesta_model->modificarPreguntaUI($dts,$dtcheck,$idp);
		redirect('Encuesta/preguntaUI');
	}
	public function respuestaUI()
	{
		//Leer Todas las respuestas
		$datos['respuestas'] = $this->Encuesta_model->leerTodasLasRespuestas();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_respuesta', $datos);
		$this->load->view('html/pie');
	}
	public function crearRespuestaUI()
	{
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vcrearrespuesta');
		$this->load->view('html/pie');
	}
	public function agregarRespuestaUI()
	{
		$dts=array(
			"uinombre_respuesta"=>$this->input->post("nombre_respuesta"));
		$this->Encuesta_model->agregarRespuestaUI($dts);
		redirect('Encuesta/respuestaUI');
	}
	//Rutina para creacion de encuestas
	public function crearEncuesta()
	{
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_crearencuesta');
		$this->load->view('html/pie');
	}

	public function procesarCrearEncuesta()
	{
		$nombre_encuesta = $this->input->post('nombre_cuestionario');
		if($this->Encuesta_model->crearNuevaEncuesta($nombre_encuesta)){
			$this->mensaje('Encuesta creada', 'success');
			redirect('inicio');
		}else{
			$this->mensaje('No se creo la encuesta, intente otra vez', 'warning');
			redirect('inicio');
		}
	}
	public function editarEncuesta($id)
	{
		$idencuesta = $id;
		$encuesta = $this->Encuesta_model->leerEncuestaPorID($idencuesta);
		$datos['encuesta'] = $encuesta;
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_editarencuesta', $datos );
		$this->load->view('html/pie');

	}

	public function procesarEditarEncuesta()
	{
		$iduiencuesta = $this->input->post('iduiencuesta');
		$nombre_encuesta = $this->input->post('nombre_cuestionario');

		if($this->Encuesta_model->actualizarEncuesta($iduiencuesta, $nombre_encuesta)){
			$this->mensaje('Encuesta editada', 'success');
			redirect('inicio');
		}else{
			$this->mensaje('No se pudo editar, intente otra vez', 'warning');
			redirect('inicio');
		}

	}

	//Despliegue de mensaje
	public function mensaje($mensaje, $clase){
		/** @noinspection PhpLanguageLevelInspection */
		$this->session->set_flashdata([
			'mensaje' => $mensaje,
			'clase' => $clase,
		]);
	}

	public function crearModulo()
	{
		$data['encuestas'] = $this->Encuesta_model->leerTodasLasEncuestas();

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_crearmodulo', $data);
		$this->load->view('html/pie');
	}

	public function procesarCrearModulo()
	{
		$nombre_modulo = $this->input->post('nombre_modulo');
		$orden_modulo = $this->input->post('orden_modulo');
		$idencuesta = $this->input->post('idencuesta');

		if($this->Encuesta_model->crearModulo($nombre_modulo, $orden_modulo, $idencuesta)){
			$this->mensaje('Modulo creado', 'success');
			redirect('inicio');
		}else{
			$this->mensaje('No se pudo crear modulo, intente otra vez', 'warning');
			redirect('inicio');
		}
	}
	public function crearSeccion()
	{
		$data['modulos'] = $this->Encuesta_model->leerModulos();
		$data['subtemas'] = $this->Encuesta_model->leerSubtemas();

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vcrearseccion', $data);
		$this->load->view('html/pie');
	}
	public function escrituraEnUiseccion()
	{
		$orden_seccion = $this->input->post('ordenDseccion');
		$modulo = $this->input->post('modulo');
		$subtema = $this->input->post('subtema');


		if($this->Encuesta_model->crearSeccion($orden_seccion, $modulo, $subtema)){
			$this->mensaje('Seccion creado', 'success');
			redirect('inicio');
		}else{
			$this->mensaje('No se pudo crear seccion, intente otra vez', 'warning');
			redirect('inicio');
		}
	}
	public function editarSeccion($id)
	{
		$iduiseccion = $id;
		$seccion0 = $this->Encuesta_model->leerUiseccion($iduiseccion);
		$seccion1 = $this->Encuesta_model->leerModulo($seccion0[0]->rel_iduimodulo);
		$seccion2 = $this->Encuesta_model->leerSubtema($seccion0[0]->rel_idsubtema);
//echo "<pre>";var_dump($seccion0,$seccion1, $seccion2);echo "</pre>";
		$datos['seccion0'] = $seccion0;
		$datos['seccion1'] = $seccion1;
		$datos['seccion2'] = $seccion2;
		$datos['modulos'] = $this->Encuesta_model->leerModulos();
		$datos['subtemas'] = $this->Encuesta_model->leerSubtemas();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/veditarseccion', $datos );
		$this->load->view('html/pie');
	}
	public function edicionEnUiseccion()
	{
		$ordenDseccion0 = $this->input->post('ordenDseccion0');
		$orden_seccion = $this->input->post('ordenDseccion');
		$modulo = $this->input->post('modulo');
		$subtema = $this->input->post('subtema');
//echo "<pre>";var_dump($ordenDseccion0,$orden_seccion,$modulo,$subtema);echo "</pre>";
		$this->Encuesta_model->actualizarSeccion($ordenDseccion0,$orden_seccion, $modulo, $subtema);
		redirect('inicio');
	}
	public function editarModulo($id)
	{
		$idmodulo = $id;
		$datos['encuestas'] = $this->Encuesta_model->leerTodasLasEncuestas();

		$modulo = $this->Encuesta_model->leerModuloPorID($idmodulo);
		$datos['modulo'] = $modulo;
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_editarmodulo', $datos );
		$this->load->view('html/pie');
	}
	public function procesarEditarModulo()
	{
		$idmodulo = $this->input->post('idmodulo');
		$nombre_modulo = $this->input->post('nombre_modulo');
		$orden_modulo = $this->input->post('orden_modulo');
		$idencuesta = $this->input->post('idencuesta');;

		if($this->Encuesta_model->actualizarModulo($idmodulo, $nombre_modulo, $orden_modulo, $idencuesta)){
			$this->mensaje('Modulo editado', 'success');
			redirect('inicio');
		}else{
			$this->mensaje('No se pudo editar, intente otra vez', 'warning');
			redirect('inicio');
		}

	}
	public function geolocalizacionUI()
	{
		$datos['localizaciones'] = $this->Encuesta_model->leerLocalizaciones();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_localizacion', $datos);
		$this->load->view('html/pie');
	}
	public function crearLocalizacion()
	{
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_crearlocalizacion');
		$this->load->view('html/pie');
	}
	public function agregarLocalizacion()
	{
		$dts=array(
		'nombre_geolocal'=>$this->input->post('nombrelocalizacion'),
		'latitud_geolocal'=>$this->input->post('latitud'),
		'longitud_geolocal'=>$this->input->post('longitud'));
		$this->Encuesta_model->agregarLocalizacion($dts);
		redirect('encuesta/geolocalizacionUI');
	}
	public function editarLocalizacion($idl)
	{
		$datos['localizacion'] = $this->Encuesta_model->leerLocalizacionId($idl);
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_editarlocalizacion',$datos);
		$this->load->view('html/pie');
	}
	public function modificarLocalizacion($idl)
	{
		$dts=array(
		'nombre_geolocal'=>$this->input->post('nombrelocalizacion'),
		'latitud_geolocal'=>$this->input->post('latitud'),
		'longitud_geolocal'=>$this->input->post('longitud'));
		$this->Encuesta_model->modificarLocalizacion($idl,$dts);
		redirect('encuesta/geolocalizacionUI');
	}
	//Despliegue de tarjetas
	public function encuestaInicio()
	{
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_inicio');
		$this->load->view('html/pie');
	}

	//Vista de los formularios
	public function formulariosEncuesta()
	{
		$datos['encuestas'] = $this->Encuesta_model->leerEncuestas();

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_lista', $datos);
		$this->load->view('html/pie');
	}

	//generar la vista de un formulario
	public function verFormEncuesta($identificador)
	{
		$iduiencuesta = $identificador;
		$encuesta = $this->Encuesta_model->leerEncuestaPorID($iduiencuesta);
		$modulos = $this->Encuesta_model->leerModulosPorIdEncuesta($iduiencuesta);


		//Array de orden
		$orden_modulos = [];
		foreach ($modulos as $m)
		{
			$orden_modulos[] = $m->uiorden_modulo;
		}
		$orden_modulos_min = min($orden_modulos);
		$orden_modulos_max = max($orden_modulos);

		//Extraer las secciones de una encuesta
		$secciones = $this->Encuesta_model->leerSeccionesDeUnaEncuesta($iduiencuesta);


		//Extraer las preguntas de una encuesta
		$preguntas = $this->Encuesta_model->leerPreguntasDeUnaEncuesta($iduiencuesta);
		//Extraer las respuestas de una encuesta
		$respuestas = $this->Encuesta_model->leerRespuestasDeUnaEncuesta($iduiencuesta);


		/*echo "secciones:";
		echo "<br>";
		var_dump($secciones);
		echo "<br><br>";

		echo "preguntas:";
		echo "<br>";
		var_dump($secciones);
		echo "<br><br>";

		echo "respuestas:";
		echo "<br>";
		var_dump($respuestas);
		echo "<br><br>";*/



		//Subvista para la Seleccion de modulos
		$datos_modulo['modulos'] = $modulos;
		$datos_modulo['orden_mod_min'] = $orden_modulos_min;
		$datos_modulo['secciones'] = $secciones;
		$datos_modulo['preguntas'] = $preguntas;
		$datos_modulo['respuestas'] = $respuestas;
		$sel_modulos = $this->load->view('encuesta/svencuesta_plantilla_selmodulo', $datos_modulo, TRUE);


		//Subvista para los modulos
		$cont_modulos = $this->load->view('encuesta/svencuesta_plantilla_contmodulo', '', TRUE);

		$datos['encuesta'] = $encuesta;
		$datos['modulos'] = $modulos;
		$datos['secciones'] = $secciones;
		$datos['preguntas'] = $preguntas;
		$datos['respuestas'] = $respuestas;
		$datos['orden_mod_min'] = $orden_modulos_min;
		$datos['orden_mod_max'] = $orden_modulos_max;

		//Datos del formulario
		$datos['sel_modulos'] = $sel_modulos;
		$datos['cont_modulo'] = $cont_modulos;
		$datos['no_es_vista_previa'] = false;
		$datos['idencuesta'] = $iduiencuesta;

		$this->load->view('encuesta/vencuesta_plantilla', $datos);


	}

	public function cambiarEstado($identificador)
	{

		$iduiencuesta = $identificador;
		$encuesta = $this->Encuesta_model->leerEncuestaPorID($iduiencuesta);
		$datos['encuesta'] = $encuesta;


		if($encuesta->encuesta_activa)
		{
			//Esta activa, funcion complementaria
			$estado = 0;
		}else{
			//No esta activa, funcion complementaria
			$estado = 1;
		}
		$this->Encuesta_model->cambiarEstado($iduiencuesta, $estado);
		redirect('encuesta/formulariosEncuesta');
	}

	public function capturarDatosEncuesta()
	{
		$n = $this->input->post('nombre');
		$a = $this->input->post('apellido');
		$e = $this->input->post('edad');

		echo "Nombre: ".$n." ".$a."<br>";
		echo "Edad: ".$e;

	}
	public function encuestaAusuarios()
	{
		//Leer a todos los usuarios en el grupo encuestadores
		$encuestadores= $this->ion_auth->users('encuestadores')->result();
		$datos['usuariose']=[];
		foreach ($encuestadores as $e)
		{
			$encuest=array(
					'id'=>$e->id,
					'username'=>$e->username,
					'numero_encuestas'=>count($this->Encuesta_model->leerEncuestasAsignadasUsuario($e->id)),
					'usadas'=>count($this->Encuesta_model->leerEncuestasUsadasUsuario($e->id)));
			array_push($datos['usuariose'],$encuest);
		}
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_ausuarios', $datos);
		$this->load->view('html/pie');
	}
	public function asignarEncuesta($identificador)
	{
		$usuario=$this->Encuesta_model->leerUsuarioID($identificador);
		$encuestass=$this->Encuesta_model->leerTodasLasEncuestas();
		$geolocal = $this->Encuesta_model->leerTodasLasAreasTrabajo();
		$datos['usuario']=$usuario;
		$datos['encuestas']=$encuestass;
		$datos['geolocal'] = $geolocal;
//		echo "<pre>";var_dump($datos);echo "</pre>";
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vasignar_encuesta', $datos);
		$this->load->view('html/pie');

	}
	public function guardarAsignacionDencuesta()
	{
		$idencuestador = $this->input->post('idusuario1');
		$encuestador = $this->input->post('usuario1');
		$carnet = $this->input->post('carnetid1');
		$idencuesta = $this->input->post('idencuesta1');
		$nencuestas = $this->input->post('nencuestas1');
		$idgeolocal = $this->input->post('idgeolocal');

		$datos['idencuestador'] = $idencuestador;
		$datos['idencuesta'] = $idencuesta;
		$datos['encuestador'] = $encuestador;
		$datos['carnet'] = $carnet;
		$datos['nencuestas'] = $nencuestas;
		$datos['idgeolocal'] = $idgeolocal;

		$cifrado = new stdClass();
		for($i=1;$i<=$nencuestas;$i++)
		{
			$dt = $encuestador."|".$i."|".$carnet;
			$cifrado->$i = substr(md5(uniqid(Rand(), true)), 16, 16);
		}

		if($this->Encuesta_model->escribirEncuestaAsignada($datos,$cifrado)){
			$this->mensaje('Encuestas asignadas', 'success');
			redirect('encuesta/encuestaAusuarios');
		}else{
			$this->mensaje('No se pudo asignar encuestas', 'warning');
			redirect('encuesta/encuestaAusuarios');
		}

	}
	public function cifrar($cdt)
	{
		$ri=rand(10,99);
		$ro=rand(10,99);
		$dt=strval($ri).$cdt.strval($ro);
		$num=strlen($dt);
		$inicio=round($num/2)-1;
		$cant=$num;
		if (fmod($num,2)==0)
		{
			$cant=$num-1;
		}
		$encnom="";
		$j=-1;
		$cad="";
		for ($i=0;$i<=$cant;$i++)
		{	
			$inicio=$inicio+$j*$i;
			$cad=substr($dt,$inicio,1);
			//$encnom=$encnom.$cad;
			switch ($cad)
			{
				case 'a':$encnom=$encnom.'u';break;
				case 'A':$encnom=$encnom.'U';break;
				case 'e':$encnom=$encnom.'o';break;
				case 'E':$encnom=$encnom.'O';break;
				case 'o':$encnom=$encnom.'e';break;
				case 'O':$encnom=$encnom.'E';break;
				case 'u':$encnom=$encnom.'a';break;
				case 'U':$encnom=$encnom.'A';break;
				case '-':$encnom=$encnom.'+';break;
				case '_':$encnom=$encnom.'(';break;
				default:$encnom=$encnom.$cad;
			}
			$j=$j*(-1);
		}
		return $encnom;
	}
	public function decifrar($dtcif)
	{
		$dtdecif="";
		$num=strlen($dtcif);
		if (fmod($num,2)==0)
		{
			$num=$num-1;
			$n=round($num/2);
			for ($i=0;$i<=$n-1;$i++)
			{
				$cad=$dtcif[$num-(2*$i+1)];
				switch ($cad)
				{
				case 'u':$dtdecif=$dtdecif.'a';break;
				case 'U':$dtdecif=$dtdecif.'A';break;
				case 'o':$dtdecif=$dtdecif.'e';break;
				case 'O':$dtdecif=$dtdecif.'E';break;
				case 'e':$dtdecif=$dtdecif.'o';break;
				case 'E':$dtdecif=$dtdecif.'O';break;
				case 'a':$dtdecif=$dtdecif.'u';break;
				case 'A':$dtdecif=$dtdecif.'U';break;
				case '+':$dtdecif=$dtdecif.'-';break;
				case '(':$dtdecif=$dtdecif.'_';break;
				default:$dtdecif=$dtdecif.$cad;
				}
				
			}
		}
		else
		{
			$n=round($num/2)-1;
			for ($i=0;$i<=$n;$i++)
			{
				$cad=$dtcif[$num-(2*$i+1)];
				switch ($cad)
				{
				case 'u':$dtdecif=$dtdecif.'a';break;
				case 'U':$dtdecif=$dtdecif.'A';break;
				case 'o':$dtdecif=$dtdecif.'e';break;
				case 'O':$dtdecif=$dtdecif.'E';break;
				case 'e':$dtdecif=$dtdecif.'o';break;
				case 'E':$dtdecif=$dtdecif.'O';break;
				case 'a':$dtdecif=$dtdecif.'u';break;
				case 'A':$dtdecif=$dtdecif.'U';break;
				case '+':$dtdecif=$dtdecif.'-';break;
				case '(':$dtdecif=$dtdecif.'_';break;
				default:$dtdecif=$dtdecif.$cad;
				}
			}
		}
		
		for ($i=0;$i<=$n-1;$i++)
		{
			$cad=$dtcif[(2*$i+1)];
			switch ($cad)
				{
				case 'u':$dtdecif=$dtdecif.'a';break;
				case 'U':$dtdecif=$dtdecif.'A';break;
				case 'o':$dtdecif=$dtdecif.'e';break;
				case 'O':$dtdecif=$dtdecif.'E';break;
				case 'e':$dtdecif=$dtdecif.'o';break;
				case 'E':$dtdecif=$dtdecif.'O';break;
				case 'a':$dtdecif=$dtdecif.'u';break;
				case 'A':$dtdecif=$dtdecif.'U';break;
				case '+':$dtdecif=$dtdecif.'-';break;
				case '(':$dtdecif=$dtdecif.'_';break;
				default:$dtdecif=$dtdecif.$cad;
				}
		}
		return substr($dtdecif,2,-2);
	}
	

		private function fecha_unix($fecha)
	{
		list($anio, $mes, $dia) = explode('-', $fecha);
		$fecha_unix = mktime(0, 0, 0, $mes, $dia, $anio);
		return $fecha_unix;
	}

	public function verEncuestasAsignadas($identificador)
	{
		$idusuario = $identificador;
		$datos['encuestas'] = $this->Encuesta_model->leerEncuestasAsignadasUsuario($idusuario);
		$datos['usuario'] = $this->ion_auth->user($idusuario)->row();

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_asignadas', $datos);
		$this->load->view('html/pie');
	}
	

	public function reportesEncuesta()
	{
		if(isset($this->session->consulta_encuesta)){
			//Existe una consulta almacenada;
//			echo "datos consulta_encuesta en la session";
			$this->session->unset_userdata("consulta_encuesta");
		}
		$encuesta = $this->Encuesta_model->leerTodasLasEncuestas();
		$departamento = $this->Departamento_model->leerDepartamentos();

		$datos['encuesta'] = $encuesta;
		$datos['departamento'] = $departamento;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_reportes', $datos);
		$this->load->view('html/pie');

	}

	public function procesarConsulta()
	{
		$consulta = $this->consulta();
		if(!isset($this->session->consulta_encuesta)){
			//La consulta no esta almacenada en la session
			$this->session->set_userdata('consulta_encuesta', []);
			$this->session->set_userdata('consulta_encuesta', $consulta);
		}
		//Validador de la fecha
		if($consulta->edad_inicial > $consulta->edad_final ){
			$this->mensaje('Intervalo de edad incorrecto', 'warning');
			redirect('encuesta/reportesEncuesta');
		}else{
			//Intervalo de edad correcto
			$nombre_encuesta = $this->Encuesta_model->leerEncuestaPorID($consulta->iduiencuesta);
			$edad_inicial =  $consulta->edad_inicial;
			$edad_final = $consulta->edad_final;

			if((int)$consulta->sexo==0)
			{
				$sexo = 0;
			}elseif((int)$consulta->sexo==1)
			{
				$sexo = 'Masculino';
			}elseif ((int)$consulta->sexo==2)
			{
				$sexo = 'Femenino';
			}

			if((int)$consulta->area==0)
			{
				$area = 0;
			}elseif((int)$consulta->area==1)
			{
				$area = 'Urbana';
			}elseif ((int)$consulta->area==2)
			{
				$area = 'Rural';
			}
			//$encuesta_resultado = $this->Encuesta_model->resultadosEncuesta($consulta);
			$encuesta_datos_generales = $this->Encuesta_model->resultadosEncuestaDatosGeneralesActivos($consulta);
			$departamento = $this->Departamento_model->leerDepartamento($consulta->iddepartamento);

			$datos['sexo'] = $sexo;
			$datos['area'] = $area;
			$datos['encuesta_nombre'] = $nombre_encuesta;
			//$datos['encuesta_resultado'] = $encuesta_resultado;
			$datos['edad_inicial'] = $consulta->edad_inicial;
			$datos['edad_final'] = $consulta->edad_final;
			$datos['consulta'] = $consulta;
			$datos['departamento'] = $departamento;
			$datos['encuesta_datos_generales'] = $encuesta_datos_generales;


			$this->load->view('html/encabezado');
			$this->load->view('html/navbar');
			$this->load->view('encuesta/vencuesta_resultado', $datos);
			$this->load->view('html/pie');
		}
	}

	private function consulta()
	{
		$consulta = new stdClass();
		$consulta->fecha_inicio = $this->input->post('fecha_inicio');
		$consulta->fecha_fin = $this->input->post('fecha_fin');
		$consulta->iduiencuesta = $this->input->post('iduiencuesta');
		$consulta->edad_inicial = $this->input->post('edadinicial');
		$consulta->edad_final = $this->input->post('edadfinal');
		$consulta->sexo = $this->input->post('sexo');
		$consulta->area = $this->input->post('area');
		$consulta->iddepartamento = $this->input->post('iddepartamento');

		return $consulta;
	}

	public function exportarExcel()
	{
		if(!isset($this->session->consulta_encuesta)){
			redirect('encuesta/reportesEncuesta');
		}
		$consulta = $this->session->consulta_encuesta;
		$nombre_encuesta = $this->Encuesta_model->leerEncuestaPorID($consulta->iduiencuesta);
		$edad_inicial =  $consulta->edad_inicial;
		$edad_final = $consulta->edad_final;
		if((int)$consulta->sexo==0)
		{
			$sexo = 0;
		}elseif((int)$consulta->sexo==1)
		{
			$sexo = 'Masculino';
		}elseif ((int)$consulta->sexo==2)
		{
			$sexo = 'Femenino';
		}

		if((int)$consulta->area==0)
		{
			$area = 0;
		}elseif((int)$consulta->area==1)
		{
			$area = 'Urbana';
		}elseif ((int)$consulta->area==2)
		{
			$area = 'Rural';
		}


		$encuestas_resultados = $this->Encuesta_model->leerLasEncuestasCompletadas($consulta);
		$secciones = $this->Encuesta_model->leerPreguntasDeUnaEncuesta($consulta->iduiencuesta);

		if(!empty($consulta)){
			$filename = "reporte-encuestas.xlsx";
			$ruta = 'assets/info/';
			$plantilla = $ruta.'plantilla-encuesta-json-vr.xlsx';
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getSheet(0)->setTitle('Encuestas');
			$worksheet = $spreadsheet->getActiveSheet();


			$sheet->setCellValue('E3', $nombre_encuesta->uinombre_encuesta);
			if($edad_inicial!=0 && $edad_final !=0){
				$sheet->setCellValue('C5', $consulta->edad_inicial);
				$sheet->setCellValue('D5', $consulta->edad_final);
			}
			if($consulta->sexo) {
				$sheet->setCellValue('C6', $sexo);
			}
			if($consulta->area){
				$sheet->setCellValue('C7', $area);
			}

			$eje_y = 13;
			foreach ($encuestas_resultados as $n)
			{
				$sheet->setCellValue('A'.$eje_y, $n->idformcomp);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_fc));
				$sheet->setCellValue('C'.$eje_y, $n->hash_fc);
				$sheet->setCellValue('D'.$eje_y, $n->username);
				$sheet->setCellValue('E'.$eje_y, number_format($n->latidud_fc,3, ",",""));
				$sheet->setCellValue('F'.$eje_y, number_format($n->longitud_fc, 3, ",", ""));
				$sheet->setCellValue('G'.$eje_y, $n->edad);
				$sheet->setCellValue('H'.$eje_y, $n->sexo);
				if($consulta->iduiencuesta == 3):
					$sheet->setCellValue('I'.$eje_y, $n->sit_lab);
					$sheet->setCellValue('J'.$eje_y, $n->sit_edu);
				else:
					$sheet->setCellValue('I'.$eje_y, $n->sit_laboral);
					$sheet->setCellValue('J'.$eje_y, $n->sit_educativa);
				endif;
				$sheet->setCellValue('K'.$eje_y, $n->area);
				$sheet->setCellValue('L'.$eje_y, $n->ciudad);
				$sheet->setCellValue('M'.$eje_y, $n->zona);
				$sheet->setCellValue('N'.$eje_y, $n->tiempo);
				$eje_y++;
			}

			$sheet = $spreadsheet->getSheet(1)->setTitle('Respuestas');
			$worksheet = $spreadsheet->getActiveSheet();
			$sheet->setCellValue('E3', $nombre_encuesta->uinombre_encuesta);
			if($edad_inicial!=0 && $edad_final !=0){
				$sheet->setCellValue('C5', $consulta->edad_inicial);
				$sheet->setCellValue('D5', $consulta->edad_final);
			}
			if($consulta->sexo) {
				$sheet->setCellValue('C6', $sexo);
			}
			if($consulta->area){
				$sheet->setCellValue('C7', $area);
			}

			//Imprimir Preguntas
			//Preguntas
			$eje_X = 'O';
			$eje_y = 12;
			foreach ($secciones as $s):
				if($s->iduiseccion != 59):
					$eje_auxiliar = $eje_y+1;
					$sheet->setCellValue($eje_X.$eje_y, $s->etiqueta_seccion);
					$sheet->setCellValue($eje_X.$eje_auxiliar, $s->uipregunta_nombre);
					$eje_X++;
				endif;
			endforeach;
			$eje_x_offset = $eje_X;

			$eje_y = 14;
			$eje_X = 'O';
			foreach ($encuestas_resultados as $n)
			{
				$sheet->setCellValue('A'.$eje_y, $n->idformcomp);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_fc));
				$sheet->setCellValue('C'.$eje_y, $n->hash_fc);
				$sheet->setCellValue('D'.$eje_y, $n->username);
				$sheet->setCellValue('E'.$eje_y, number_format($n->latidud_fc,3, ",",""));
				$sheet->setCellValue('F'.$eje_y, number_format($n->longitud_fc, 3, ",", ""));
				$sheet->setCellValue('G'.$eje_y, $n->edad);
				$sheet->setCellValue('H'.$eje_y, $n->sexo);
				if($consulta->iduiencuesta == 3):
					$sheet->setCellValue('I'.$eje_y, $n->sit_lab);
					$sheet->setCellValue('J'.$eje_y, $n->sit_edu);
				else:
					$sheet->setCellValue('I'.$eje_y, $n->sit_laboral);
					$sheet->setCellValue('J'.$eje_y, $n->sit_educativa);
				endif;
				$sheet->setCellValue('K'.$eje_y, $n->area);
				$sheet->setCellValue('L'.$eje_y, $n->ciudad);
				$sheet->setCellValue('M'.$eje_y, $n->zona);
				$sheet->setCellValue('N'.$eje_y, $n->tiempo);
				$eje_X = 'O';
				$registro = json_decode($n->formcj) ;
				if(isset($registro)):
				foreach ($registro as $r){
					if($r->idtipopregunta==1){
						$respuesta = $r->respuestas;
						$sheet->setCellValue($eje_X.$eje_y, $respuesta->respuesta);
						$eje_X++;
					}
					elseif ($r->idtipopregunta==2){
						$sheet->setCellValue($eje_X.$eje_y, $r->tipopregunta);
						$eje_X++;

					}
					elseif ($r->idtipopregunta==3){
						//Pregunta abierta simple
						$respuesta = $r->respuestas;
						$sheet->setCellValue($eje_X.$eje_y, $respuesta->respuesta);
						$eje_X++;
					}
					elseif ($r->idtipopregunta==4){
						//Seleccion multiple, mas una respuesta abierta (otro)
						$respuesta = $r->respuestas;
						$literal_respuesta = ' ';
						$rptmp = '';
						foreach ($respuesta as $rp){
							if(!$rp->es_otro){
								$rptmp = $rp->respuesta;
							}else{
								$rptmp = $rp->respuesta."(".$rp->otro_txt.")";
							}
							$literal_respuesta .= $rptmp."/";
						}
						$sheet->setCellValue($eje_X.$eje_y, $literal_respuesta);
						$eje_X++;
					}elseif ($r->idtipopregunta==5){
						$eje_x_des = $eje_x_offset;
						//Seleccion multiple cuantificada
						$respuesta = $r->respuestas;
						$literal_respuesta = ' ';
						$rptmp = '';
						foreach ($respuesta as $rp){
							if($rp->idopcion != 8):
							$sheet->setCellValue($eje_x_des.$eje_y, $rp->valor);
							$eje_x_des++;
							endif;
						}

						/*foreach ($respuesta as $rp){
							if($rp->idopcion == 1){
								$rptmp = "Presidente: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 2){
								$rptmp = "Vicepresidente: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 3){
								$rptmp = "Ministros: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 4){
								$rptmp = "Senadores y diputados: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 5){
								$rptmp = "Jueces: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 6){
								$rptmp = "Fiscales: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 7){
								$rptmp = "Alcaldes: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 8){

							}elseif ($rp->idopcion == 9){
								$rptmp = "Gobernadores: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 10){
								$rptmp = "Autoridades del Órgano Electoral: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 11){
								$rptmp = "Policía: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 12){
								$rptmp = "Militares: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 13){
								$rptmp = "Iglesia: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 14){
								$rptmp = "Organismos internacionales: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 15){
								$rptmp = "Medios de comunicación: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 16){
								$rptmp = "ONGs: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 17){
								$rptmp = "Comités Cívicos: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 18){
								$rptmp = "Universidades: "."(".$rp->valor.")";
							}elseif ($rp->idopcion == 19){
								$rptmp = "Organizaciones sociales: "."(".$rp->valor.")";
							}
							$literal_respuesta .= $rptmp."/";
						}

						$sheet->setCellValue($eje_X.$eje_y, $literal_respuesta);
						$eje_X++;*/
					}elseif ($r->idtipopregunta==6){
						$sheet->setCellValue($eje_X.$eje_y, $r->tipopregunta);
						$eje_X++;
					}
				}
				endif;
				$eje_y++;
			}

			$sheet = $spreadsheet->setActiveSheetIndex(0);
			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");
		}else{
			$this->mensaje('Generar otro reporte', 'info');
			redirect('encuesta/reportesEncuesta');
		}
	}

	public function reasignarEncuesta($identificador)
	{
		$idencuesta = $identificador;


		$encuesta = $this->Encuesta_model->leerEncuestaAsignadaPorID($idencuesta);
		$usuario_actual = $this->Encuesta_model->leerUsuarioID($encuesta->rel_idusuario);

		$area_trabajo = $this->Encuesta_model->geolocalizacionPorID($encuesta->rel_idgeolocal);




		$encuestadores = $this->ion_auth->users(5)->result();
		$geolocal = $this->Encuesta_model->leerTodasLasAreasTrabajo();

		$datos['usuario_actual']=$usuario_actual;
		$datos['encuesta']=$encuesta;
		$datos['encuestadores'] = $encuestadores;
		$datos['geolocal'] = $geolocal;
		$datos['area_trabajo'] = $area_trabajo;


		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_reasignar', $datos);
		$this->load->view('html/pie');


	}

	public function procesarReasignacion()
	{
		$consulta = $this->consultaReasignar();


		if($this->Encuesta_model->actualizarAsignacion($consulta))
		{
			$this->mensaje('Encuestas re asignada', 'success');
			redirect('encuesta/encuestaAusuarios');

		}else{
			$this->mensaje('No se pudo reasignar la encuesta', 'warning');
			redirect('encuesta/encuestaAusuarios');

		}

	}

	private function consultaReasignar()
	{
		$consulta = new stdClass();
		$consulta->idencuesta = $this->input->post('idencuesta');
		$consulta->idusuario = $this->input->post('idusuario1');
		$consulta->nuevo_usuario = $this->input->post('idusuario');
		$consulta->idgeolocalizacion = $this->input->post('idgeolocal');

		return $consulta;
	}

	public function administrar($identificador)
	{
		$idencuesta = $identificador;

		//Crear la variable de session para la administracion
		if(!isset($this->session->admin_encuesta))
		{
			$this->session->set_userdata('admin_encuesta', []);
			$this->session->set_userdata('admin_encuesta', $idencuesta);
		}



		$datos['encuesta_datos_generales'] = $this->Encuesta_model->listarFormulariosLlenos($idencuesta);
		$datos['idencuesta'] = $idencuesta;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_administrador', $datos);
		$this->load->view('html/pie');
	}

	public function cambiarEstadoRegistro($identificador)
	{
		$idformcomp = $identificador;
		$form_encuesta = $this->Encuesta_model->formularioCompletadoPorID($identificador);
		$idencuesta = $this->session->admin_encuesta;
		if($form_encuesta->es_valida)
		{
			$estado = 0;
		}else{
			$estado = 1;
		}
		$this->Encuesta_model->cambiarEstadoFormulario($idformcomp, $estado);
		redirect('encuesta/administrar/'.$idencuesta);
	}

	public function finalizarAdministrador()
	{
		$this->session->unset_userdata('admin_encuesta');
		redirect('encuesta/formulariosEncuesta');
	}

	public function editarRegistroEncuesta($identificador)
	{
		$idencuesta_completada = $identificador;
		$form_completado = $this->Encuesta_model->formularioCompletadoPorID($idencuesta_completada);

		$datos['form'] = $form_completado;
		$datos['idencuesta'] = $idencuesta_completada;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('encuesta/vencuesta_editarreg', $datos);
		$this->load->view('html/pie');

	}

	public function procesarModificarRegistro()
	{
		$nuevo_registro = $this->capturarRegistro();
		$this->Encuesta_model->actualizarRegistro($nuevo_registro);
		redirect('encuesta/administrar/'.$nuevo_registro->idencuesta);
	}

	private function capturarRegistro()
	{
		$registro = new stdClass();

		$registro->idformcomp = $this->input->post('idformcomp');
		$registro->ciudad = $this->input->post('nombreciudad');
		$registro->zona = $this->input->post('nombrezona');
		$registro->latitud = $this->input->post('latitud');
		$registro->longitud = $this->input->post('longitud');
		$registro->idencuesta = $this->input->post('idencuesta');
		$registro->area = $this->input->post('nombrearea');

		return $registro;
	}

	public function exportarExcelCodificado()
	{
		if(!isset($this->session->consulta_encuesta)){
			redirect('encuesta/reportesEncuesta');
		}
		$consulta = $this->session->consulta_encuesta;
		$nombre_encuesta = $this->Encuesta_model->leerEncuestaPorID($consulta->iduiencuesta);
		$edad_inicial =  $consulta->edad_inicial;
		$edad_final = $consulta->edad_final;
		if((int)$consulta->sexo==0)
		{
			$sexo = 0;
		}elseif((int)$consulta->sexo==1)
		{
			$sexo = 'Masculino';
		}elseif ((int)$consulta->sexo==2)
		{
			$sexo = 'Femenino';
		}

		if((int)$consulta->area==0)
		{
			$area = 0;
		}elseif((int)$consulta->area==1)
		{
			$area = 'Urbana';
		}elseif ((int)$consulta->area==2)
		{
			$area = 'Rural';
		}


		$encuestas_resultados = $this->Encuesta_model->leerLasEncuestasCompletadas($consulta);
		$secciones = $this->Encuesta_model->leerPreguntasDeUnaEncuesta($consulta->iduiencuesta);

		if(!empty($consulta)){
			$filename = "reporte-encuestas-cod.xlsx";
			$ruta = 'assets/info/';
			$plantilla = $ruta.'plantilla-encuesta-json-vr.xlsx';
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getSheet(0)->setTitle('Encuestas');
			$worksheet = $spreadsheet->getActiveSheet();


			$sheet->setCellValue('E3', $nombre_encuesta->uinombre_encuesta." - CODIFICADO");
			if($edad_inicial!=0 && $edad_final !=0){
				$sheet->setCellValue('C5', $consulta->edad_inicial);
				$sheet->setCellValue('D5', $consulta->edad_final);
			}
			if($consulta->sexo) {
				$sheet->setCellValue('C6', $sexo);
			}
			if($consulta->area){
				$sheet->setCellValue('C7', $area);
			}

			$eje_y = 13;
			foreach ($encuestas_resultados as $n)
			{
				$sheet->setCellValue('A'.$eje_y, $n->idformcomp);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_fc));
				$sheet->setCellValue('C'.$eje_y, $n->hash_fc);
				$sheet->setCellValue('D'.$eje_y, $n->username);
				$sheet->setCellValue('E'.$eje_y, number_format($n->latidud_fc,3, ",",""));
				$sheet->setCellValue('F'.$eje_y, number_format($n->longitud_fc, 3, ",", ""));
				$sheet->setCellValue('G'.$eje_y, $n->edad);
				$sheet->setCellValue('H'.$eje_y, $n->sexo);
				if($consulta->iduiencuesta == 3):
					$sheet->setCellValue('I'.$eje_y, $n->sit_lab);
					$sheet->setCellValue('J'.$eje_y, $n->sit_edu);
				else:
					$sheet->setCellValue('I'.$eje_y, $n->sit_laboral);
					$sheet->setCellValue('J'.$eje_y, $n->sit_educativa);
				endif;
				$sheet->setCellValue('K'.$eje_y, $n->area);
				$sheet->setCellValue('L'.$eje_y, $n->ciudad);
				$sheet->setCellValue('M'.$eje_y, $n->zona);
				$sheet->setCellValue('N'.$eje_y, $n->tiempo);
				$eje_y++;
			}

			$sheet = $spreadsheet->getSheet(1)->setTitle('Respuestas');
			$worksheet = $spreadsheet->getActiveSheet();
			$sheet->setCellValue('E3', $nombre_encuesta->uinombre_encuesta." - CODIFICADO");
			if($edad_inicial!=0 && $edad_final !=0){
				$sheet->setCellValue('C5', $consulta->edad_inicial);
				$sheet->setCellValue('D5', $consulta->edad_final);
			}
			if($consulta->sexo) {
				$sheet->setCellValue('C6', $sexo);
			}
			if($consulta->area){
				$sheet->setCellValue('C7', $area);
			}

			//Imprimir Preguntas
			//Preguntas
			$eje_X = 'O';
			$eje_y = 12;
			foreach ($secciones as $s):
				if($s->iduiseccion != 59):
					$eje_auxiliar = $eje_y+1;
					$sheet->setCellValue($eje_X.$eje_y, $s->etiqueta_seccion);
					$sheet->setCellValue($eje_X.$eje_auxiliar, $s->uipregunta_nombre);
					$eje_X++;
				endif;
			endforeach;
			$eje_x_offset = $eje_X;

			$eje_y = 14;
			$eje_X = 'O';
			foreach ($encuestas_resultados as $n)
			{
				$sheet->setCellValue('A'.$eje_y, $n->idformcomp);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_fc));
				$sheet->setCellValue('C'.$eje_y, $n->hash_fc);
				$sheet->setCellValue('D'.$eje_y, $n->username);
				$sheet->setCellValue('E'.$eje_y, number_format($n->latidud_fc,3, ",",""));
				$sheet->setCellValue('F'.$eje_y, number_format($n->longitud_fc, 3, ",", ""));
				$sheet->setCellValue('G'.$eje_y, $n->edad);
				$sheet->setCellValue('H'.$eje_y, $n->sexo);
				if($consulta->iduiencuesta == 3):
					$sheet->setCellValue('I'.$eje_y, $n->sit_lab);
					$sheet->setCellValue('J'.$eje_y, $n->sit_edu);
				else:
					$sheet->setCellValue('I'.$eje_y, $n->sit_laboral);
					$sheet->setCellValue('J'.$eje_y, $n->sit_educativa);
				endif;
				$sheet->setCellValue('K'.$eje_y, $n->area);
				$sheet->setCellValue('L'.$eje_y, $n->ciudad);
				$sheet->setCellValue('M'.$eje_y, $n->zona);
				$sheet->setCellValue('N'.$eje_y, $n->tiempo);
				$eje_X = 'O';
				$registro = json_decode($n->formcj) ;
				if(isset($registro)):
				foreach ($registro as $r){
					if($r->idtipopregunta==1){
						$respuesta = $r->respuestas;
						$sheet->setCellValue($eje_X.$eje_y, $respuesta->codigo);
						$eje_X++;
					}
					elseif ($r->idtipopregunta==2){
						$sheet->setCellValue($eje_X.$eje_y, $r->tipopregunta);
						$eje_X++;

					}
					elseif ($r->idtipopregunta==3){
						//Pregunta abierta simple
						$respuesta = $r->respuestas;
						$sheet->setCellValue($eje_X.$eje_y, $respuesta->codigo);
						$eje_X++;
					}
					elseif ($r->idtipopregunta==4){
						//Seleccion multiple, mas una respuesta abierta (otro)
						$respuesta = $r->respuestas;
						$literal_respuesta = ' ';
						$rptmp = '';
						foreach ($respuesta as $rp){
							if(!$rp->es_otro){
								$rptmp = $rp->codigo;
							}else{
								$rptmp = $rp->codigo."(".$rp->otro_txt.")";
							}
							$literal_respuesta .= $rptmp."/";
						}
						$sheet->setCellValue($eje_X.$eje_y, $literal_respuesta);
						$eje_X++;
					}elseif ($r->idtipopregunta==5){
						//Seleccion multiple cuantificada
						$eje_x_des = $eje_x_offset;
						//Seleccion multiple cuantificada
						$respuesta = $r->respuestas;
						$literal_respuesta = ' ';
						$rptmp = '';
						foreach ($respuesta as $rp){
							if($rp->idopcion != 8):
								$sheet->setCellValue($eje_x_des.$eje_y, $rp->codigo);
								$eje_x_des++;
							endif;
						}
						/*$respuesta = $r->respuestas;
						$literal_respuesta = ' ';
						$rptmp = '';
						foreach ($respuesta as $rp){
							if($rp->idopcion == 1){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 2){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 3){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 4){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 5){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 6){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 7){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 8){

							}elseif ($rp->idopcion == 9){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 10){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 11){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 12){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 13){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 14){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 15){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 16){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 17){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 18){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}elseif ($rp->idopcion == 19){
								$rptmp = $rp->codigo."(".$rp->valor.")";
							}
							$literal_respuesta .= $rptmp."/";
						}

						$sheet->setCellValue($eje_X.$eje_y, $literal_respuesta);
						$eje_X++;*/
					}elseif ($r->idtipopregunta==6){
						$sheet->setCellValue($eje_X.$eje_y, $r->tipopregunta);
						$eje_X++;
					}
				}
				endif;
				$eje_y++;

			}

			$sheet = $spreadsheet->setActiveSheetIndex(0);
			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");
		}else{
			$this->mensaje('Generar otro reporte', 'info');
			redirect('encuesta/reportesEncuesta');
		}


	}

	public function exportarExcelDepartamentos()
	{
		if(!isset($this->session->consulta_encuesta)){
			redirect('encuesta/reportesEncuesta');
		}
		$consulta = $this->session->consulta_encuesta;
		$nombre_encuesta = $this->Encuesta_model->leerEncuestaPorID($consulta->iduiencuesta);
		$edad_inicial =  $consulta->edad_inicial;
		$edad_final = $consulta->edad_final;
		if((int)$consulta->sexo==0)
		{
			$sexo = 0;
		}elseif((int)$consulta->sexo==1)
		{
			$sexo = 'Masculino';
		}elseif ((int)$consulta->sexo==2)
		{
			$sexo = 'Femenino';
		}

		if((int)$consulta->area==0)
		{
			$area = 0;
		}elseif((int)$consulta->area==1)
		{
			$area = 'Urbana';
		}elseif ((int)$consulta->area==2)
		{
			$area = 'Rural';
		}


		$encuestas_resultados = $this->Encuesta_model->leerLasEncuestasCompletadas($consulta);
		$secciones = $this->Encuesta_model->leerPreguntasDeUnaEncuesta($consulta->iduiencuesta);
		$contador = $this->Encuesta_model->contarEncuestasPorCiudad($consulta);

		if(!empty($consulta)){
			$filename = "reporte-encuestas-dep.xlsx";
			$ruta = 'assets/info/';
			$plantilla = $ruta.'plantilla-encuesta-json.xlsx';
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getSheet(0)->setTitle('Encuestas');
			$worksheet = $spreadsheet->getActiveSheet();

			$eje_y = 13;
			foreach ($encuestas_resultados as $n)
			{
				$sheet->setCellValue('A'.$eje_y, $n->idformcomp);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_fc));
				$sheet->setCellValue('C'.$eje_y, $n->hash_fc);
				$sheet->setCellValue('D'.$eje_y, $n->username);
				$sheet->setCellValue('E'.$eje_y, number_format($n->latidud_fc,3, ",",""));
				$sheet->setCellValue('F'.$eje_y, number_format($n->longitud_fc, 3, ",", ""));
				$sheet->setCellValue('G'.$eje_y, $n->edad);
				$sheet->setCellValue('H'.$eje_y, $n->sexo);
				if($consulta->iduiencuesta == 3):
					$sheet->setCellValue('I'.$eje_y, $n->sit_lab);
					$sheet->setCellValue('J'.$eje_y, $n->sit_edu);
				else:
					$sheet->setCellValue('I'.$eje_y, $n->sit_laboral);
					$sheet->setCellValue('J'.$eje_y, $n->sit_educativa);
				endif;
				$sheet->setCellValue('K'.$eje_y, $n->area);
				$sheet->setCellValue('L'.$eje_y, $n->ciudad);
				$sheet->setCellValue('M'.$eje_y, $n->zona);
				$sheet->setCellValue('N'.$eje_y, $n->tiempo);
				$eje_y++;
			}

			$sheet = $spreadsheet->getSheet(1)->setTitle('Respuestas');
			$worksheet = $spreadsheet->getActiveSheet();
			$sheet->setCellValue('E3', $nombre_encuesta->uinombre_encuesta." - CODIFICADO");
			if($edad_inicial!=0 && $edad_final !=0){
				$sheet->setCellValue('C5', $consulta->edad_inicial);
				$sheet->setCellValue('D5', $consulta->edad_final);
			}
			if($consulta->sexo) {
				$sheet->setCellValue('C6', $sexo);
			}
			if($consulta->area){
				$sheet->setCellValue('C7', $area);
			}

			//Imprimir Preguntas
			//Preguntas
			$eje_X = 'O';
			$eje_y = 12;
			foreach ($secciones as $s):
				if($s->iduiseccion != 59):
					$eje_auxiliar = $eje_y+1;
					$sheet->setCellValue($eje_X.$eje_y, $s->etiqueta_seccion);
					$sheet->setCellValue($eje_X.$eje_auxiliar, $s->uipregunta_nombre);
					$eje_X++;
				endif;
			endforeach;
			$eje_x_offset = $eje_X;

			$eje_y = 14;
			$eje_X = 'O';
			foreach ($encuestas_resultados as $n)
			{
				$sheet->setCellValue('A'.$eje_y, $n->idformcomp);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_fc));
				$sheet->setCellValue('C'.$eje_y, $n->hash_fc);
				$sheet->setCellValue('D'.$eje_y, $n->username);
				$sheet->setCellValue('E'.$eje_y, number_format($n->latidud_fc,3, ",",""));
				$sheet->setCellValue('F'.$eje_y, number_format($n->longitud_fc, 3, ",", ""));
				$sheet->setCellValue('G'.$eje_y, $n->edad);
				$sheet->setCellValue('H'.$eje_y, $n->sexo);
				if($consulta->iduiencuesta == 3):
					$sheet->setCellValue('I'.$eje_y, $n->sit_lab);
					$sheet->setCellValue('J'.$eje_y, $n->sit_edu);
				else:
					$sheet->setCellValue('I'.$eje_y, $n->sit_laboral);
					$sheet->setCellValue('J'.$eje_y, $n->sit_educativa);
				endif;
				$sheet->setCellValue('K'.$eje_y, $n->area);
				$sheet->setCellValue('L'.$eje_y, $n->ciudad);
				$sheet->setCellValue('M'.$eje_y, $n->zona);
				$sheet->setCellValue('N'.$eje_y, $n->tiempo);
				$eje_X = 'O';
				$registro = json_decode($n->formcj) ;
				if(isset($registro)):
					foreach ($registro as $r){
						if($r->idtipopregunta==1){
							$respuesta = $r->respuestas;
							$sheet->setCellValue($eje_X.$eje_y, $respuesta->codigo);
							$eje_X++;
						}
						elseif ($r->idtipopregunta==2){
							$sheet->setCellValue($eje_X.$eje_y, $r->tipopregunta);
							$eje_X++;

						}
						elseif ($r->idtipopregunta==3){
							//Pregunta abierta simple
							$respuesta = $r->respuestas;
							$sheet->setCellValue($eje_X.$eje_y, $respuesta->codigo);
							$eje_X++;
						}
						elseif ($r->idtipopregunta==4){
							//Seleccion multiple, mas una respuesta abierta (otro)
							$respuesta = $r->respuestas;
							$literal_respuesta = ' ';
							$rptmp = '';
							foreach ($respuesta as $rp){
								if(!$rp->es_otro){
									$rptmp = $rp->codigo;
								}else{
									$rptmp = $rp->codigo."(".$rp->otro_txt.")";
								}
								$literal_respuesta .= $rptmp."/";
							}
							$sheet->setCellValue($eje_X.$eje_y, $literal_respuesta);
							$eje_X++;
						}elseif ($r->idtipopregunta==5){
							//Seleccion multiple cuantificada
							$eje_x_des = $eje_x_offset;
							//Seleccion multiple cuantificada
							$respuesta = $r->respuestas;
							$literal_respuesta = ' ';
							$rptmp = '';
							foreach ($respuesta as $rp){
								if($rp->idopcion != 8):
									$sheet->setCellValue($eje_x_des.$eje_y, $rp->codigo);
									$eje_x_des++;
								endif;
							}

						}elseif ($r->idtipopregunta==6){
							$sheet->setCellValue($eje_X.$eje_y, $r->tipopregunta);
							$eje_X++;
						}
					}
				endif;
				$eje_y++;

			}

			$sheet = $spreadsheet->setActiveSheetIndex(0);
			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");
		}else{
			$this->mensaje('Generar otro reporte', 'info');
			redirect('encuesta/reportesEncuesta');
		}
	}

	public function pruebasReportes(){
		$encuesta = $this->Encuesta_model->leerUnaEncuestaPorID();

		var_dump($encuesta);
		echo "<br>";
		echo "<br>";


		$resultados = json_decode($encuesta->formcj) ;

		var_dump($resultados);
		echo "<br>";
		echo "<br>";

		foreach ($resultados as $r){
			echo $r->idseccion." ".$r->etiqueta." ".$r->idpregunta." ".$r->pregunta." ".$r->idtipopregunta." ".$r->tipopregunta;

			echo "<br>";
		}

		echo "<br>";
		echo "<br>";
		$idencuesta = 2;
		$secciones = $this->Encuesta_model->leerPreguntasDeUnaEncuesta($idencuesta);
		var_dump($secciones);

		echo "<br>";
		echo "<br>";
		$eje_x = 'A';
		for ($i=0;$i<100;$i++){
			echo $eje_x;
			$eje_x++;
			echo "<br>";
		}
		echo "<br>";
		echo "<br>";
		echo "<br>";
		$consulta = new stdClass();
		$consulta->iduiencuesta = 2;
		$encuestas = $this->Encuesta_model->leerLasEncuestasCompletadas($consulta);
		foreach($encuestas as $n){
			echo $n->idformcomp;
			echo " / ";
			echo $n->fecha_fc;
			echo " / ";
			echo $n->hash_fc;
			echo " / ";

			$registro = json_decode($n->formcj);
			foreach ($registro as $r){}

			echo "<br>";
		}
		echo "<br>";
		echo "<br>";
		echo "<br>";

		$pregunta = $this->Encuesta_model->leerLosDatosPregunta(62);

		var_dump($pregunta);
		echo "<br>";
		echo "<br>";
		$opciones = json_decode($pregunta->pregunta_datos) ;
		var_dump($opciones);




	}

	//Datos json Tipos de plenaria nacional
	public function getSeccionesPreguntas()
	{
		$json = array();
		$idencuesta = $this->input->post('identificador');
		$json = $this->Encuesta_model->leerPreguntasDeUnaEncuesta($idencuesta);
		header('Content-Type: application/json');
		echo json_encode($json);
	}




}
