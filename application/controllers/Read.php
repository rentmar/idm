<?php

class Read extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Readurl_model');
		$this->load->model('Encuesta_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
	}

	public function url($identificador)
	{
		$hash = $identificador;
		$encuesta = $this->Readurl_model->autenticar($hash);
		if(!$encuesta){
			echo "No existe encuesta";
		}else{
			if(!$encuesta->usado){
				//Encuesta vigente
				redirect('read/encuesta/'.$hash);

			}else{
				//Encuesta usada
				redirect('read/encuestaExpirada');
			}
		}
	}

	public function encuesta($hash){
		if(!$this->Readurl_model->autenticar($hash))
		{
			redirect('read/encuestaExpirada');
		}
		$bandera = $this->Readurl_model->autenticarSegundo($hash);
		if(!$bandera){
			redirect('read/encuestaExpirada');
		}
		$encuesta = $this->Readurl_model->autenticar($hash);
		$datos_generales = $encuesta;
		$iduiencuesta = $encuesta->rel_iduiencuesta;


		//Temporizador
		$fecha = new DateTime();

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


		$preguntas_validar = [];
		foreach ($preguntas as $pr)
		{
			$preguntas_validar[] = $pr->iduipregunta;
		}


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
		$datos['idencuesta'] = $iduiencuesta;

		//Datos del formulario
		$datos['sel_modulos'] = $sel_modulos;
		$datos['cont_modulo'] = $cont_modulos;
		$datos['no_es_vista_previa'] = true;
		$datos['datos_generales'] = $datos_generales;
		$datos['tiempo'] = $fecha->getTimestamp();

		//Dato para validar formulario
		$datos['preguntas_validar'] = $preguntas_validar;

		$this->load->view('encuesta/vencuesta_plantilla', $datos);



	}

	public function encuestaExpirada()
	{
		$this->load->view('mensajes/vde_expirada');
	}

	public function capturar()
	{
		$formulario = new stdClass();
		$formulario_respuestas = array();
		$seccion_actual = new stdClass();
		$info_general = $this->datoGenerales();
		$idencuesta = $info_general->iduiencuesta;
		if($idencuesta == 2){
			$cont_secciones = new stdClass();
			/*var_dump($info_general);
			echo "<br>";
			echo "<br>";
			echo "Encuesta identificador;"."<br>";
			echo $idencuesta;
			echo "<br>";
			echo "<br>";*/
			//Extraer los modulos de la encuesta.
			$modulos = $this->Encuesta_model->leerModulosEncuesta($idencuesta);
			foreach ($modulos as $m):
				$secciones_modulo = $this->Encuesta_model->leerSeccionesModulo($m->iduimodulo);
				$i = 0;
				foreach ($secciones_modulo as $sec){
//				echo "IDseccion: ".$sec->iduiseccion." Etiqueta_seccion: ".$sec->etiqueta_seccion." ";
//				echo "<br>";
					//Extraer las preguntas de una seccion
					$pregunta = $this->Encuesta_model->leerPreguntaSeccion($sec->iduiseccion);
					if(isset($pregunta)){
						//var_dump($pregunta);
//					echo "IDpregunta: ".$pregunta->iduipregunta." Pregunta: ".$pregunta->uipregunta_nombre." IDtipopregunta: ".$pregunta->iduitipopregunta." Tipo pregunta: ".$pregunta->nombre_tipopregunta;
//					echo "<br>";

						if($pregunta->iduitipopregunta == 1):
//						echo "Respuesta Simple - Radio button<br>";
							$respuesta = $this->respuestaTipo1($pregunta->iduipregunta);
//						echo "Respuesta:  ";
							$respuesta_tmp = $respuesta;
//						var_dump($respuesta_tmp);

						elseif ($pregunta->iduitipopregunta == 2):
//						echo "Respuesta Multiple - checkbox<br>";
						elseif ($pregunta->iduitipopregunta == 3):
//						echo "Pregunta Abierta simple - input<br>";
							$respuesta_tmp = $this->respuestaTipo3($pregunta->iduipregunta);
//						echo "Respuesta: ";
						//var_dump($respuesta_tmp);
						elseif ($pregunta->iduitipopregunta == 4):
							//echo "Seleccion multiple, resp abierta - checkbox input<br>";
							$respuesta_tmp = $this->respuestaTipo4($pregunta->iduipregunta);
						//echo "Respuesta: ";
						//var_dump($respuesta_tmp);
						elseif ($pregunta->iduitipopregunta == 5):
							//echo "Seleccion multiple cuantificada - checkbox input<br>";
							$respuesta_tmp = $this->respuestaTipo5($pregunta->iduipregunta);
							//echo "Respuesta: ";
							//var_dump($respuesta_tmp);
						endif;
						//echo "<br>";
						//echo "<br>";
						//echo "Seccion actual: ";
						$seccion_actual = $this->objetoSeccion($sec->iduiseccion, $sec->etiqueta_seccion, $pregunta->iduipregunta, $pregunta->uipregunta_nombre, $pregunta->iduitipopregunta, $pregunta->nombre_tipopregunta, $respuesta_tmp, $m->iduimodulo, $m->uinombre_modulo);
						//var_dump($seccion_actual);
						$formulario->{$i} = $seccion_actual;
						$i++;
						//echo "<br>";
					}

				}
			endforeach;

			//echo "<br>";
			//echo "<br>";
			//echo "OBJETO:<br>";
			//var_dump($formulario);
			$info_general->fecha = now('America/La_Paz');
			//echo "<br>";
			//echo "<br>";
			//var_dump($info_general);
			if($this->Readurl_model->guardarDatosEncuesta($info_general, $formulario))
			{
				//Informacion guardada con exito
				$this->success();

			}else{
				//Informacion no guardada
				$this->failure();
			}

		}
		elseif ($idencuesta == 3){
			$cont_secciones = new stdClass();

			//Extraer los modulos de la encuesta.
			$modulos = $this->Encuesta_model->leerModulosEncuesta($idencuesta);
			$i=0;
			foreach ($modulos as $m):
				//echo $m->iduimodulo."  ";
				//echo $m->uinombre_modulo;
				//echo "<br><br>";
				$secciones_modulo = $this->Encuesta_model->leerSeccionesModulo($m->iduimodulo);
				foreach ($secciones_modulo as $sec):
					$pregunta = $this->Encuesta_model->leerPreguntaSeccion($sec->iduiseccion);
					if(isset($pregunta)):
						if($pregunta->iduitipopregunta == 1):
							$respuesta = $this->respuestaTipo1($pregunta->iduipregunta);
							$respuesta_tmp = $respuesta;
						elseif ($pregunta->iduitipopregunta == 2):
						elseif ($pregunta->iduitipopregunta == 3):
							$respuesta_tmp = $this->respuestaTipo3($pregunta->iduipregunta);
						elseif ($pregunta->iduitipopregunta == 4):
							$respuesta_tmp = $this->respuestaTipo4($pregunta->iduipregunta);
						//var_dump($respuesta_tmp);
						elseif ($pregunta->iduitipopregunta == 5):
							//echo "Seleccion multiple cuantificada - checkbox input<br>";
							$respuesta_tmp = $this->respuestaTipo5($pregunta->iduipregunta);
							//echo "Respuesta: ";
							//var_dump($respuesta_tmp);
						endif;
						$seccion_actual = $this->objetoSeccion($sec->iduiseccion, $sec->etiqueta_seccion, $pregunta->iduipregunta, $pregunta->uipregunta_nombre, $pregunta->iduitipopregunta, $pregunta->nombre_tipopregunta, $respuesta_tmp, $m->iduimodulo, $m->uinombre_modulo);
						//var_dump($seccion_actual);
						$formulario->{$i} = $seccion_actual;
						$i++;
					endif;
				endforeach;

			endforeach;


			$info_general->fecha = now('America/La_Paz');
			//var_dump($info_general);
			//echo "<br><br><br>";
			//var_dump($formulario);
			//echo "<br><br><br>";
			//echo "<br><br><br>";
			//echo $info_general->situacion_laboral."-".$info_general->otra_ocupacion;



			//Almacenar informacion
			if($this->Readurl_model->guardarDatEnc($info_general, $formulario)){
				//Informacion guardada con exito
				$this->success();
			}else{
				//Informacion no guardada
				$this->failure();
			}
			/*if($this->Readurl_model->guardarDatosEncuesta($info_general, $formulario))
			{
				//Informacion guardada con exito
				$this->success();

			}else{
				//Informacion no guardada
				$this->failure();
			}*/


		}
		else{
			//Rutinas anteriores para la captura de datos
			$info_general = $this->datos();
			//Extraer las preguntas de una encuesta
			$preguntas = $this->Encuesta_model->leerPreguntasDeUnaEncuesta($info_general->iduiencuesta);
			//Extraer las respuestas de una encuesta
			$respuestas = $this->Encuesta_model->leerRespuestasDeUnaEncuesta($info_general->iduiencuesta);

			$idpreguntas_form = [];
			foreach ($preguntas as $p)
			{
				$idpreguntas_form[] = $p->iduipregunta;
			}
			$idrespuestas_form = [];
			foreach ($idpreguntas_form as $r)
			{
				$idrespuestas_form[$r] = $this->input->post('pregunta'.$r);
			}

			$info_general->fecha = now('America/La_Paz');

			if($this->Readurl_model->guardarDatos($info_general, $idpreguntas_form, $idrespuestas_form))
			{
				//Informacion guardada con exito
				$this->success();

			}else{
				//Informacion no guardada
				$this->failure();
			}

		}

		/*
		//Rutinas anteriores para la captura de datos
		$info_general = $this->datos();
		//Extraer las preguntas de una encuesta
		$preguntas = $this->Encuesta_model->leerPreguntasDeUnaEncuesta($info_general->iduiencuesta);
		//Extraer las respuestas de una encuesta
		$respuestas = $this->Encuesta_model->leerRespuestasDeUnaEncuesta($info_general->iduiencuesta);

		$idpreguntas_form = [];
		foreach ($preguntas as $p)
		{
			$idpreguntas_form[] = $p->iduipregunta;
		}
		$idrespuestas_form = [];
		foreach ($idpreguntas_form as $r)
		{
			$idrespuestas_form[$r] = $this->input->post('pregunta'.$r);
		}

		$info_general->fecha = now('America/La_Paz');

		if($this->Readurl_model->guardarDatos($info_general, $idpreguntas_form, $idrespuestas_form))
		{
			//Informacion guardada con exito
			$this->success();

		}else{
			//Informacion no guardada
			$this->failure();
		}*/
	}
	private function objetoSeccion($idseccion, $etiqueta, $idpregunta, $pregunta, $idtipopregunta, $tipopregunta, $respuesta, $idmodulo, $modulo)
	{
		$seccion = new stdClass();

		$seccion->idseccion = $idseccion;
		$seccion->etiqueta = $etiqueta;
		$seccion->idpregunta = $idpregunta;
		$seccion->pregunta = $pregunta;
		$seccion->idtipopregunta = $idtipopregunta;
		$seccion->tipopregunta = $tipopregunta;
		$seccion->respuestas = $respuesta;
		$seccion->idmodulo = $idmodulo;
		$seccion->modulo = $modulo;

		return $seccion;
	}


	private function datos()
	{
		$fecha = new DateTime();
		$datos = new stdClass();
		$datos->fecha = '';
		$datos->iduiencuesta = $this->input->post('iduiencuesta'); //El identificador del formulario vacio
		$datos->hash = $this->input->post('numero_formh'); //El identificador del formulario asignado
		$datos->idusuario = $this->input->post('idusuario'); //El identificador del encuestador
		$datos->idgeolocal = $this->input->post('idgeolocal'); //El identificador del area asignada
		$datos->latitud = $this->input->post('latitud_f'); //Latitud donde el formulario es llenado
		$datos->longitud = $this->input->post('longitud_f'); //Longitud donde el formulario es llenado
		$datos->idencuesta = $this->input->post('idencuesta_asignada'); //Identificador de la encuesta asigmafa
		$datos->area = $this->input->post('area');

		//Informacion General
		$datos->edad = $this->input->post('edad');
		$datos->sexo = $this->input->post('sexo');
		$datos->ciudad = $this->input->post('ciudad');
		$datos->zona = $this->input->post('zona');
		$tiempo_calculado = ($fecha->getTimestamp()-$this->input->post('tiempoinicio'))/60;
		$datos->tiempo = round($tiempo_calculado, 0, PHP_ROUND_HALF_UP);
		$datos->otra_ocupacion = $this->input->post('sit_laboral_otro');
		return $datos;
	}

	public function success()
	{
		$this->load->view('mensajes/vde_confirmacion');
	}
	public function failure()
	{
		$this->load->view('mensajes/vde_error');
	}

	private function datoGenerales()
	{
		$fecha = new DateTime();
		$datos = new stdClass();
		$datos->fecha = '';
		$datos->iduiencuesta = $this->input->post('iduiencuesta'); //El identificador del formulario vacio
		$datos->hash = $this->input->post('numero_formh'); //El identificador del formulario asignado
		$datos->idusuario = $this->input->post('idusuario'); //El identificador del encuestador
		$datos->idgeolocal = $this->input->post('idgeolocal'); //El identificador del area asignada
		$datos->latitud = $this->input->post('latitud_f'); //Latitud donde el formulario es llenado
		$datos->longitud = $this->input->post('longitud_f'); //Longitud donde el formulario es llenado
		$datos->idencuesta = $this->input->post('idencuesta_asignada'); //Identificador de la encuesta asigmafa
		$datos->area = $this->input->post('area');

		//Informacion General
		$datos->edad = $this->input->post('edad');
		$datos->sexo = $this->input->post('sexo');
		$datos->ciudad = $this->input->post('ciudad');
		$datos->zona = $this->input->post('zona');
		$tiempo_calculado = ($fecha->getTimestamp()-$this->input->post('tiempoinicio'))/60;
		$datos->tiempo = round($tiempo_calculado, 0, PHP_ROUND_HALF_UP);
		$datos->situacion_laboral = $this->input->post('sit_laboral');
		$datos->situacion_educativa = $this->input->post('sit_educativa');
		$datos->otra_ocupacion = $this->input->post('sit_laboral_otro');

		return $datos;
	}

	private function objModulo($identificador, $nombre)
	{
		$modulo = new stdClass();
		$modulo->idmodulo = $identificador;
		$modulo->nombre = $nombre;

		return $modulo;
	}

	private function objSeccion($idseccion, $etiqueta, $idpregunta, $pregunta, $tipo)
	{
		$seccion = new stdClass();
		$seccion->idseccion = $idseccion;
		$seccion->etiqueta = $etiqueta;
		$seccion->idpregunta = $idpregunta;
		$seccion->pregunta = $pregunta;
		$seccion->tipo = $tipo;

		return $seccion;
	}

	//Respuesta radio button - Seleccion simple
	private function respuestaTipo1($idpregunta){
		$respuesta = $this->input->post("pregunta".$idpregunta);
		$objRespuesta = new stdClass();
		foreach ($respuesta as $r=>$value){
			//echo $respuesta[$r];
			$resp_temporal = $this->Encuesta_model->leerRespuestaTipo1($idpregunta, $respuesta[$r]);
		}
		$objRespuesta->idrespuesta = $resp_temporal->iduirespuesta;
		$objRespuesta->respuesta = $resp_temporal->uinombre_respuesta;
		$objRespuesta->codigo = $resp_temporal->codigo_respuesta;
		return $objRespuesta;
	}

	//Respuesta checkbox - Seleccion multiple
	private function respuestaTipo2(){

	}

	//Respuesta input simple - Abierta simple
	private function respuestaTipo3($idpregunta){
		$respuesta_txt = $this->input->post("pregunta".$idpregunta);
		$respuesta = $this->Encuesta_model->leerRespuestaTipo3($idpregunta);
		$objRespuesta = new stdClass();
		$objRespuesta->idrespuesta = $respuesta->iduirespuesta;
		$objRespuesta->respuesta = $respuesta_txt;
		$objRespuesta->codigo = $respuesta->codigo_respuesta;
		return $objRespuesta;
	}

	//Respuesta checkbox, un input - Seleccion multiple mas otro
	private function respuestaTipo4($idpregunta){
		$respuesta = $this->input->post("pregunta".$idpregunta);
		$respuesta_otro = $this->input->post("pregunta".$idpregunta."otro");

		$respuesta_db = $this->Encuesta_model->leerRespuestaTipo4($idpregunta);
		$objRespuesta = new stdClass();
		$i = 0;
		foreach ($respuesta as $r=>$value){
			//echo $respuesta[$r];
			if($respuesta[$r] == 'OTRO'){
				$rp_tmp = $this->objetoTipo4($respuesta_db->iduirespuesta, $respuesta[$r], $respuesta_db->etiqueta_seccion, true, $respuesta_otro);
			}else{
				$rp_tmp = $this->objetoTipo4($respuesta_db->iduirespuesta, $respuesta[$r], $respuesta_db->etiqueta_seccion, false, ' ');
			}
			$objRespuesta->{$i} = $rp_tmp;
			$i++;
		}
		return $objRespuesta;
	}
	private function objetoTipo4($idrespuesta, $respuesta, $codigo, $es_otro, $otro)
	{
		$respuesta_opcion = new stdClass();
		$respuesta_opcion->idrespuesta = $idrespuesta;
		$respuesta_opcion->respuesta = $respuesta;
		$complemento_codigo = substr($respuesta, 0, 3);
		$respuesta_opcion->codigo = $codigo.$complemento_codigo;
		$respuesta_opcion->es_otro = $es_otro;
		$respuesta_opcion->otro_txt = $otro;

		return $respuesta_opcion;
	}

	//Respuesta checkbox input numerico - Seleccion multiple cuantificada
	private function respuestaTipo5($idpregunta)
	{
		$idpregunta = $idpregunta;

		//Capturar el valor de los ns/nr
		$respuesta_nsnr = $this->input->post('pregunta'.$idpregunta);
		//Datos de las opciones
		$respuesta_db = $this->Encuesta_model->leerRespuestaTipo5($idpregunta);
		$opciones = json_decode($respuesta_db->pregunta_datos);

		$objRespuestas = new stdClass();

		//Respuesta
		$i = 0;
		foreach ($opciones as $op){
			if($op->idopcion != 8):
			if(in_array($op->idopcion, $respuesta_nsnr)){
				$rp_tmp = $this->objetoTipo5($respuesta_db->iduirespuesta, $op->idopcion, "No Sabe/No Responde", $respuesta_db->etiqueta_seccion."NSNR") ;
			}else{
				$clave = 'opcion'.$op->idopcion.'text';
				$cantidad = $this->input->post($clave);
				$complemento_codigo = substr($op->literal, 0, 3);
				$rp_tmp = $this->objetoTipo5($respuesta_db->iduirespuesta, $op->idopcion, $cantidad, $respuesta_db->etiqueta_seccion.$complemento_codigo) ;
			}
			$objRespuestas->{$i} = $rp_tmp;
			$i++;
			endif;
		}
		return $objRespuestas;
	}

	private function objetoTipo5($idrespuesta, $idopcion, $valor, $codigo){
		$respuesta_selmulc = new stdClass();
		$respuesta_selmulc->idrespuesta = $idrespuesta;
		$respuesta_selmulc->idopcion = $idopcion;
		$respuesta_selmulc->valor = $valor;
		$respuesta_selmulc->codigo = $codigo;
		return $respuesta_selmulc;
	}

	private function respuestaTp1()
	{
		$respuesta = new stdClass();
		$de = new stdClass();
		$de->id = 1;
		$de->nombre = "pregunta";

		for ($i = 1; $i <= 10; $i++) {
			$objeto = "pregunta".$i;
			$respuesta->{$objeto}= $de;
		}
		return $respuesta;
	}

}
