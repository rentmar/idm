<?php

class Graficos extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
        $this->load->library('session');
		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Graficos_model');
		$this->load->model('Tema_model');
		$this->load->model('Actor_model');
		$this->load->helper('file');
		$this->load->model('Radial_model');
		$this->load->model('Departamento_model');

	}
	public function index()
	{
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('graficos/vgraficosinicio');
		$this->load->view('html/pie');
		//$this->load->view('graficos/vgraficop');
	}

	public function seleccionBubble()
	{	
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('graficos/vgraficoselectbubble');
		$this->load->view('html/pie');
	}
	public function llenarDatosBubbleXml()
	{
		$titulo="";
		$cargado=false;
		$departamentos = $this->Graficos_model->leerDepartamentos();
		$actores=$this->Graficos_model->leerActores();
		$dt['actores']=$actores;
		$cuestionarios=$this->Graficos_model->leerCuestionarios();
		$dt['cuestionarios']=$cuestionarios;
		$dt['tiposmedio']=$this->Graficos_model->leerTiposMedio();
		$fi=$this->fecha_unix($this->input->post('fecha_inicio'));
		$ff=$this->fecha_unix($this->input->post('fecha_fin'));
		$dt['fi']=$this->input->post("fecha_inicio");
		$dt['ff']=$this->input->post("fecha_fin");
		$a=$this->input->post('accion');
		$dt['accion']=$a;
		if ($a==1)
		{	
			$titulo="Formularios";
			$docXml="<root>\n";
			foreach ($cuestionarios as $c)
			{
				$opcion=$c->idcuestionario;
				if ($c->idcuestionario!=4)
				{
					$cantidades=array();
					foreach ($departamentos as $d)
					{
						array_push($cantidades,$this->Graficos_model->leerNumCuestionarioDepartamento($fi,$ff,$d->iddepartamento,$c->idcuestionario));
					}
					foreach($departamentos as $d)
					{
						$cant=$this->Graficos_model->leerNumCuestionarioDepartamento($fi,$ff,$d->iddepartamento,$c->idcuestionario);
						$val=0;
						if (max($cantidades)!=0)
						{
							$val=round(($cant*10/max($cantidades)));
						}
						$docXml=$docXml."\t<element>\n\t\t<iddepartamento".$opcion.">".$d->iddepartamento."</iddepartamento".$opcion.">\n\t\t";
						$docXml=$docXml."<nombre_departamento".$opcion.">".$d->nombre_departamento."</nombre_departamento".$opcion.">\n\t\t";
						$docXml=$docXml."<cantidad".$opcion.">".$cant."</cantidad".$opcion.">\n\t\t";
						$docXml=$docXml."<radio".$opcion.">".$val."</radio".$opcion.">\n\t</element>\n";
					}
				}
				else
				{
					$cantidades=array();
					foreach ($departamentos as $d)
					{
						array_push($cantidades,$this->Graficos_model->leerNumLeyDepartamento($fi,$ff,$d->iddepartamento,$c->idcuestionario));
					}
					foreach($departamentos as $d)
					{
						$cant=$this->Graficos_model->leerNumLeyDepartamento($fi,$ff,$d->iddepartamento,$c->idcuestionario);
						$val=0;
						if (max($cantidades)!=0)
						{
							$val=round(($cant*10/max($cantidades)));
						}
						$docXml=$docXml."\t<element>\n\t\t<iddepartamento".$opcion.">".$d->iddepartamento."</iddepartamento".$opcion.">\n\t\t";
						$docXml=$docXml."<nombre_departamento".$opcion.">".$d->nombre_departamento."</nombre_departamento".$opcion.">\n\t\t";
						$docXml=$docXml."<cantidad".$opcion.">".$cant."</cantidad".$opcion.">\n\t\t";
						$docXml=$docXml."<radio".$opcion.">".$val."</radio".$opcion.">\n\t</element>\n";
					}
				}
			}
			$docXml=$docXml."</root>\n";
			if (!write_file('datos/cuestionariobubble.xml',$docXml))
			{
				$cargado=false;
			}
			else
			{
				$cargado=true;
			}		
		}
		else if ($a==2)
		{
			$titulo="Temas";
			$docXml="<root>\n";
			foreach ($cuestionarios as $c)
			{
				$cuest=$c->idcuestionario;
				if ($c->idcuestionario!=4)
				{
					$temas=$this->Graficos_model->leerTemasIdCuestionaro($c->idcuestionario);
					foreach($temas as $t)
					{
						$docXml=$docXml."\t<element>\n\t\t<cuest".$cuest."_nomtema>".$t->nombre_tema."</cuest".$cuest."_nomtema>\n\t</element>\n";
					}
					foreach($temas as $t)
					{
						$tem=$t->idtema;
						$cantidades=array();
						foreach ($departamentos as $d)
						{
							array_push($cantidades,$this->Graficos_model->leerNumTemaDepartamento($fi,$ff,$d->iddepartamento,$t->idtema));
						}
						foreach($departamentos as $d)
						{
							$cant=$this->Graficos_model->leerNumTemaDepartamento($fi,$ff,$d->iddepartamento,$t->idtema);
							$valor=0;
							if (max($cantidades)!=0)
							{
								$valor=round(($cant*10/max($cantidades)));
							}
							//$docXml=$docXml."\t<element>\n\t\t<iddepartamento".$opcion.">".$d->iddepartamento."</iddepartamento".$opcion.">\n\t\t";
							$docXml=$docXml."\t<element>\n\t\t<cuest".$cuest."_departamento>".$d->nombre_departamento."</cuest".$cuest."_departamento>\n\t\t";
							$docXml=$docXml."<cuest".$cuest."_tema>".$t->nombre_tema."</cuest".$cuest."_tema>\n\t\t";
							$docXml=$docXml."<cuest".$cuest."_canttema>".$cant."</cuest".$cuest."_canttema>\n\t\t";
							$docXml=$docXml."<cuest".$cuest."_radiotema>".$valor."</cuest".$cuest."_radiotema>\n\t</element>\n";
						}
					}//*/
				}
			}
			$docXml=$docXml."</root>\n";
			if (!write_file('datos/temabubble.xml',$docXml))
			{
				$cargado=false;
			}
			else
			{
				$cargado=true;
			}		
		}
		else if ($a==3)
		{
			$titulo="Actores";
			$docXml="<root>\n";
			foreach ($actores as $a)
			{
				$cantidades=array();
				foreach ($departamentos as $d)
				{
					array_push($cantidades,$this->Graficos_model->leerNumActorDepartamento($fi,$ff,$d->iddepartamento,$a->idactor));
				}
				foreach($departamentos as $d)
				{
					$cant=$this->Graficos_model->leerNumActorDepartamento($fi,$ff,$d->iddepartamento,$a->idactor);
					$val=0;
					if (max($cantidades)!=0)
					{
						$val=round(($cant*10/max($cantidades)));
					}
					$docXml=$docXml."\t<element>\n\t\t<actor".$a->idactor.">".$a->nombre_actor."</actor".$a->idactor.">\n\t\t";
					$docXml=$docXml."<nombre_departamento".$a->idactor.">".$d->nombre_departamento."</nombre_departamento".$a->idactor.">\n\t\t";
					$docXml=$docXml."<cantidad".$a->idactor.">".$cant."</cantidad".$a->idactor.">\n\t\t";
					$docXml=$docXml."<radio".$a->idactor.">".$val."</radio".$a->idactor.">\n\t</element>\n";
				}
			}
			$docXml=$docXml."</root>\n";
			if (!write_file('datos/actorbubble.xml',$docXml))
			{
				$cargado=false;
			}
			else
			{
				$cargado=true;
			}	
		}
		/*else if ($a==4)
		{
			$titulo="Tipo Medio";
			$cargado=true;
		}
		else if ($a==5)
		{
			$titulo="Tipo Medio";
			$idtm=$this->input->post('idtipomedio');
			$dt['tipomedio']=$this->Graficos_model->leerTipoMedioId($idtm);
			$cantidades=array();
			foreach ($departamentos as $d)
			{
				array_push($cantidades,$this->Graficos_model->leerNumTipoMedioDepartamento($d->iddepartamento,$idtm));
			}
			$docXml="<root>\n";
			foreach($departamentos as $d)
			{
				$cant=$this->Graficos_model->leerNumTipoMedioDepartamento($d->iddepartamento,$idtm);
				$docXml=$docXml."\t<element>\n\t\t<iddepartamento>".$d->iddepartamento."</iddepartamento>\n\t\t";
				$docXml=$docXml."<nombre_departamento>".$d->nombre_departamento."</nombre_departamento>\n\t\t";
				$docXml=$docXml."<cantidad>".$cant."</cantidad>\n\t\t";
				if (max($cantidades)==0)
				{
					$valor=0;
					$docXml=$docXml."<radio>".$valor."</radio>\n\t</element>\n";
				}
				else
				{
					$docXml=$docXml."<radio>".round(($cant*10/max($cantidades)))."</radio>\n\t</element>\n";
				}
				$docXml=$docXml."</root>\n";
				if (!write_file('datos/tipomedio.xml',$docXml))
				{
					$cargado=false;
				}
				else
				{
					$cargado=true;
				}
			}
		}*/
		else 
		{
			
		}
		//------------------------------------------------ carga datos
		$dt['titulo']=$titulo;
		if ($cargado==false)
		{
			$this->load->view('graficos/vgraficosinicio');
		}
		else
		{
			$this->load->view('graficos/vgraficobubble',$dt);
		}
	}
	//------------------------------------------- barras
	public function seleccionBar()
	{	
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('graficos/vgraficoselectbar');
		$this->load->view('html/pie');
	}
	public function llenarDatosBarXml()
	{
		$accion = $this->input->post('accion');
		if($accion == 1)
		{
			$data['titulo'] = 'Barras Nacional';
			$data['accion'] = $accion;
			$this->load->view('graficos/vgraficobar', $data);
		}elseif ($accion==2){
			$data['departamentos'] = $this->Departamento_model->leerDepartamentos();
			$data['titulo'] = 'Barras Departamental';
			$data['accion'] = $accion;
			$this->load->view('graficos/vgraficobar', $data);
		}


	}

	public function seleccionCuerdas()
	{	
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('graficos/vgraficoselectchord');
		$this->load->view('html/pie');
	}
	public function llenarDatosChordXml()
	{
		$titulo="Cuerdas - Actor por Ambito";
		$cargado=false;
		$a=$this->input->post('accion');
		$dt['accion']=$a;
		if ($a==1)
		{
			$cargado=true;
		}
		$dt['titulo']=$titulo;
		$dt['actores'] = $this->Actor_model->leerActores();

		if ($cargado==false)
		{
			$this->load->view('graficos/vgraficosinicio');
		}
		else
		{
			$this->load->view('graficos/vgraficochord',$dt);
		}
	}
		public function seleccionRadial()
	{	
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('graficos/vgraficoselectradial');
		$this->load->view('html/pie');
	}
		public function getactores()
	{
		$fecha = json_decode($this->input->post('fecha'));
		$fecha_i =$this->fecha_unix($fecha->fecha_inicio);
        $fecha_f = $this->fecha_unix($fecha->fecha_fin);
		$respuesta = $this->Radial_model->leerMactores($fecha_i,$fecha_f);
		echo json_encode($respuesta);
	}
		public function getMedioDcomunicacion()
	{
		$fecha = json_decode($this->input->post('fecha'));
		$fecha_i =$this->fecha_unix($fecha->fecha_inicio);
        $fecha_f = $this->fecha_unix($fecha->fecha_fin);
		$respuesta = $this->Radial_model->leerMmedioDcomunicacion($fecha_i,$fecha_f);
		echo json_encode($respuesta);
	}
		public function getMCcanalDtv()
	{
		$fecha = json_decode($this->input->post('fecha'));
		$fecha_i =$this->fecha_unix($fecha->fecha_inicio);
        $fecha_f = $this->fecha_unix($fecha->fecha_fin);
		$respuesta = $this->Radial_model->leerMCcanalDtv($fecha_i,$fecha_f);
		echo json_encode($respuesta);
	}
		public function getMCemisoraRadial()
	{
//		$json = array();
		$fecha = json_decode($this->input->post('fecha'));
		$fecha_i =$this->fecha_unix($fecha->fecha_inicio);
        $fecha_f = $this->fecha_unix($fecha->fecha_fin);
		$respuesta = $this->Radial_model->leerMCemisoraRadial($fecha_i,$fecha_f);
//		header('Content-Type: application/json');
		echo json_encode($respuesta);
	}
		public function getMCprensaEscrita()
	{
//		$json = array();
		$fecha = json_decode($this->input->post('fecha'));
		$fecha_i =$this->fecha_unix($fecha->fecha_inicio);
        $fecha_f = $this->fecha_unix($fecha->fecha_fin);
		$respuesta = $this->Radial_model->leerMCprensaEscrita($fecha_i,$fecha_f);
//		header('Content-Type: application/json');
		echo json_encode($respuesta);
	}

	//Genera la matriz en el intervalo de fecha_inicial y fecha_final
	public function matrizCuerdasActorFormulario($fecha_inicial, $fecha_final, $idactor)
	{
		//fecha_minima ------- fecha_inicial ------- $fecha_final
		$fecha_minima = $this->Graficos_model->fechaMinimaNoticia();
		$datoRef_t0 = $this->Graficos_model->datoActorCuestionario($fecha_minima, $fecha_inicial, $idactor, 1);
		$datoIns_t0 = $this->Graficos_model->datoActorCuestionario($fecha_minima, $fecha_inicial, $idactor, 2);
		$datoCenso_t0 = $this->Graficos_model->datoActorCuestionario($fecha_minima, $fecha_inicial, $idactor, 3);;
		$datoRef_tf = $this->Graficos_model->datoActorCuestionario($fecha_minima, $fecha_final, $idactor, 1) - $datoRef_t0;
		$datoIns_tf = $this->Graficos_model->datoActorCuestionario($fecha_minima, $fecha_final, $idactor, 2) - $datoIns_t0;
		$datoCenso_tf = $this->Graficos_model->datoActorCuestionario($fecha_minima, $fecha_final, $idactor, 3) - $datoCenso_t0;

		/** @noinspection PhpLanguageLevelInspection */
		$matriz = [
			[0, 0, 0, $datoRef_tf, 0, 0],
			[0, 0, 0, 0, $datoIns_tf, 0],
			[0, 0, 0, 0, 0, $datoCenso_tf],
			[$datoRef_t0, 0, 0, 0, 0, 0],
			[0, $datoIns_t0, 0, 0, 0, 0],
			[0, 0, $datoCenso_t0, 0, 0, 0],
		];

		return $matriz;

	}

	//Procedimiento ajax para adquision de datos
	//Matriz de adyacencia actor-formulario en un intervalo de tiempo
	public function getmatrizactor()
	{
		$json = array();
		$datos = json_decode($this->input->post('datos')) ;
		$matriz = $this->matrizCuerdasActorFormulario($datos->fecha_inicio, $datos->fecha_fin, $datos->idactor);
		header('Content-Type: application/json');
		echo json_encode($matriz);
		//$matriz = $this->matrizCuerdasActorFormulario();
	}


	//Procedimiento ajax para generar matriz json para barras
	public function getmatrizbarras()
	{
		$datos = json_decode($this->input->post('datos'));
		$f0 = $datos->fecha_inicio;
		$ff = $datos->fecha_fin;

		//Datos principal
		$pre_mc = $this->Graficos_model->leerCantidadTemasPorCuestionario();

		foreach ($pre_mc as $pmc)
		{
			if($pmc->id != 4)
			{
				$pmc->c = $this->Graficos_model->cantidadNoticiasFormIntervaloFechas($f0, $ff, $pmc->id);
			}else{
				$pmc->c = $this->Graficos_model->cantidadLeyesPorIntervaloFecha($f0, $ff);
			}
		}
		//Cantidades
		$cnt_mayor = [];
		foreach ($pre_mc as $pmc)
		{
			$cnt_mayor[] = $pmc->c;
		}
		$mayor = max($cnt_mayor);

		foreach ($pre_mc as $pmc)
		{
			$pmc->v = round(($pmc->c/$mayor)*100, 0, PHP_ROUND_HALF_UP);
			if($pmc->v >0 && $pmc->v <= 1)
			{
				$pmc->v = 1;
			}
		}

		//Matriz de cuestionarios
		$mc = $pre_mc;

		/*
		* Matriz  MT (Matriz de Temas)
		* Matrz MST (Matriz de Subtemas)
		*/
		$mt =[];
		$mst = [];
		foreach ($mc as $m)
		{
			$tm = $this->Graficos_model->leerCantidadSubtemasPorTema($m->id);
			//Calculo de noticias referidas a un tema
			foreach ($tm as $t)
			{
				if($t->id !=4){
					$t->c = $this->Graficos_model->cantidadTemasNoticiaPorIntervaloFechas($f0, $ff, $t->idt) ;
				}else{
					$t->c = $this->Graficos_model->cantidadTemasLeyPorIntervaloFechas($f0, $ff, $t->idt);
				}
			}
			//Calculo de los porcentajes
			//Calculo del mayor
			$cnt_mayor_t = [];
			foreach ($tm as $t)
			{
				$cnt_mayor_t[] = $t->c;
			}
			$mayor_t = max($cnt_mayor_t);
			$cnt_mayor_t = [];
			//Ajuste de los porcentajes
			foreach ($tm as $t)
			{
				if($mayor_t!=0)
				{
					$t->v = round(($t->c/$mayor_t)*100, 0, PHP_ROUND_HALF_UP);
				}else{
					$t->v = 0;
				}
				if($t->v >0 && $t->v <= 1)
				{
					$t->v = 1;
				}
			}

			//Subtemas
			foreach ($tm as $t)
			{
				//Calculo de las noticias y leyes referidas a un subtema
				if($t->id != 4)
				{
					$st = $this->Graficos_model->leerSubtemasPorTema($t->idt);
					//Calculo de las noticias referidas a un subtema
					foreach ($st as $s)
					{
						$s->c = $this->Graficos_model->cantidadSubtemasNoticiaPorIntervaloFechas($f0, $ff, $s->idst);
					}
				}else{
					$st = $this->Graficos_model->leerSubtemasPorTema($t->idt);
					//Calculo de las noticias referidas a un subtema
					foreach ($st as $s)
					{
						$s->c = $this->Graficos_model->cantidadSubtemasLeyesPorIntervaloFechas($f0, $ff, $s->idst);
					}
				}
				//Calculo de la cantidad mayor
				$cnt_mayor_st = [];
				foreach ($st as $s)
				{
					$cnt_mayor_st[] =  $s->c;
				}
				$mayor_st = max($cnt_mayor_st);

				//Ajuste de los porcentajes
				foreach ($st as $s)
				{
					if($mayor_st!=0)
					{
						$s->v = round(($s->c/$mayor_st)*100, 0, PHP_ROUND_HALF_UP);
						if($s->v >0 && $s->v <= 1)
						{
							$s->v = 1;
						}
					}
					if(is_null($s->idst))
					{
						unset($s->idt);
						unset($s->idst);
						unset($s->n);
						unset($s->c);
						unset($s->v);
					}
				}
				$mst[] = $st;
			}
			$mt[] = $tm;
		}

		//Matriz de resultados
		/** @noinspection PhpLanguageLevelInspection */
		$resultados = [
			'mc' => $mc,
			'mt' => $mt,
			'mst' => $mst,
		];
		header('Content-Type: application/json');
		echo json_encode($resultados);


	}

	public function getmatrizbarrasdepartamento()
	{
		$datos = json_decode($this->input->post('datos'));
		$f0 = $datos->fecha_inicio;
		$ff = $datos->fecha_fin;
		$iddepartamento = $datos->iddepartamento;

		//Datos principal
		$pre_mc = $this->Graficos_model->leerCantidadTemasPorCuestionario();

		//calculo de noticias
		foreach ($pre_mc as $pmc)
		{
			if($pmc->id != 4)
			{
				$pmc->c = $this->Graficos_model->cantidadNoticiasFormIntervaloFechasDep($f0, $ff, $pmc->id, $iddepartamento);
			}else{
				$pmc->c = $this->Graficos_model->cantidadLeyesPorIntervaloFecha($f0, $ff);
			}
		}
		//Cantidades
		$cnt_mayor = [];
		foreach ($pre_mc as $pmc)
		{
			$cnt_mayor[] = $pmc->c;
		}
		$mayor = max($cnt_mayor);

		foreach ($pre_mc as $pmc)
		{
			if($mayor!=0)
			{
				$pmc->v = round(($pmc->c/$mayor)*100, 0, PHP_ROUND_HALF_UP);
			}
			else{
				$pmc->v = 0;
			}

			if($pmc->v >0 && $pmc->v <= 1)
			{
				$pmc->v = 1;
			}
		}

		//Matriz de cuestionarios
		$mc = $pre_mc;

		/*
		* Matriz  MT (Matriz de Temas)
		* Matrz MST (Matriz de Subtemas)
		*/
		$mt =[];
		$mst = [];
		foreach ($mc as $m)
		{
			$tm = $this->Graficos_model->leerCantidadSubtemasPorTema($m->id);
			//Calculo de noticias referidas a un tema
			foreach ($tm as $t)
			{
				if($t->id !=4){
					$t->c = $this->Graficos_model->cantidadTemasNoticiaPorIntervaloFechasDep($f0, $ff, $t->idt, $iddepartamento) ;
				}else{
					$t->c = $this->Graficos_model->cantidadTemasLeyPorIntervaloFechas($f0, $ff, $t->idt);
				}
			}
			//Calculo de los porcentajes
			//Calculo del mayor
			$cnt_mayor_t = [];
			foreach ($tm as $t)
			{
				$cnt_mayor_t[] = $t->c;
			}
			$mayor_t = max($cnt_mayor_t);
			$cnt_mayor_t = [];
			//Ajuste de los porcentajes
			foreach ($tm as $t)
			{
				if($mayor_t!=0)
				{
					$t->v = round(($t->c/$mayor_t)*100, 0, PHP_ROUND_HALF_UP);
				}
				else{
					$t->v = 0;
				}
				if($t->v >0 && $t->v <= 1)
				{
					$t->v = 1;
				}
			}

			//Subtemas
			foreach ($tm as $t)
			{
				//Calculo de las noticias y leyes referidas a un subtema
				if($t->id != 4)
				{
					$st = $this->Graficos_model->leerSubtemasPorTema($t->idt);
					//Calculo de las noticias referidas a un subtema
					foreach ($st as $s)
					{
						$s->c = $this->Graficos_model->cantidadSubtemasNoticiaPorIntervaloFechasDep($f0, $ff, $s->idst, $iddepartamento);
					}
				}else{
					$st = $this->Graficos_model->leerSubtemasPorTema($t->idt);
					//Calculo de las leyes referidas a un subtema
					foreach ($st as $s)
					{
						$s->c = $this->Graficos_model->cantidadSubtemasLeyesPorIntervaloFechas($f0, $ff, $s->idst);
					}
				}
				//Calculo de la cantidad mayor
				$cnt_mayor_st = [];
				foreach ($st as $s)
				{
					$cnt_mayor_st[] =  $s->c;
				}
				$mayor_st = max($cnt_mayor_st);

				//Ajuste de los porcentajes
				foreach ($st as $s)
				{
					if($mayor_st!=0)
					{
						$s->v = round(($s->c/$mayor_st)*100, 0, PHP_ROUND_HALF_UP);
						if($s->v >0 && $s->v <= 1)
						{
							$s->v = 1;
						}
					}
					if(is_null($s->idst))
					{
						unset($s->idt);
						unset($s->idst);
						unset($s->n);
						unset($s->c);
						unset($s->v);
					}
				}
				$mst[] = $st;
			}
			$mt[] = $tm;
		}

		//Matriz de resultados
		/** @noinspection PhpLanguageLevelInspection */
		$resultados = [
			'mc' => $mc,
			'mt' => $mt,
			'mst' => $mst,
		];
		header('Content-Type: application/json');
		echo json_encode($resultados);
	}

	public function matrices()
	{
		$f0 = $this->fecha_unix('2021-08-01');
		$ff = $this->fecha_unix('2021-08-31');

		//Datos principal
		$pre_mc = $this->Graficos_model->leerCantidadTemasPorCuestionario();

		foreach ($pre_mc as $pmc)
		{
			if($pmc->id != 4)
			{
				$pmc->c = $this->Graficos_model->cantidadNoticiasFormIntervaloFechas($f0, $ff, $pmc->id);
			}else{
				$pmc->c = $this->Graficos_model->cantidadLeyesPorIntervaloFecha($f0, $ff);
			}
		}
		//Cantidades
		$cnt_mayor = [];
		foreach ($pre_mc as $pmc)
		{
			$cnt_mayor[] = $pmc->c;
		}
		$mayor = max($cnt_mayor);

		foreach ($pre_mc as $pmc)
		{
			$pmc->y = round(($pmc->c/$mayor)*100, 0, PHP_ROUND_HALF_UP);
		}

		//Matriz de cuestionarios
		$mc = $pre_mc;
		var_dump($mc);

		echo "<br><br><br>";

		/*
		* Matriz  MT (Matriz de Temas)
		* Matrz MST (Matriz de Subtemas)
		*/
		$mt =[];
		$mst = [];
		foreach ($mc as $m)
		{
			$tm = $this->Graficos_model->leerCantidadSubtemasPorTema($m->id);
			//Calculo de noticias referidas a un tema
			foreach ($tm as $t)
			{
				if($t->id !=4){
					$t->c = $this->Graficos_model->cantidadTemasNoticiaPorIntervaloFechas($f0, $ff, $t->idt) ;
				}else{
					$t->c = $this->Graficos_model->cantidadTemasLeyPorIntervaloFechas($f0, $ff, $t->idt);
				}
			}
			//Calculo de los porcentajes
			//Calculo del mayor
			$cnt_mayor_t = [];
			foreach ($tm as $t)
			{
				$cnt_mayor_t[] = $t->c;
			}
			$mayor_t = max($cnt_mayor_t);
			$cnt_mayor_t = [];
			//Ajuste de los porcentajes
			foreach ($tm as $t)
			{
				$t->c = round(($t->c/$mayor_t)*100, 0, PHP_ROUND_HALF_UP);
			}

			//Subtemas
			foreach ($tm as $t)
			{
				//Calculo de las noticias y leyes referidas a un subtema
				if($t->id != 4)
				{
					$st = $this->Graficos_model->leerSubtemasPorTema($t->idt);

					echo "<br><br>";
					//Calculo de las noticias referidas a un subtema
					foreach ($st as $s)
					{
						$s->c = $this->Graficos_model->cantidadSubtemasNoticiaPorIntervaloFechas($f0, $ff, $s->idst);
					}
					//var_dump($st);
				}else{
					$st = $this->Graficos_model->leerSubtemasPorTema($t->idt);
					echo "<br><br>";
					//Calculo de las noticias referidas a un subtema
					foreach ($st as $s)
					{
						$s->c = $this->Graficos_model->cantidadSubtemasLeyesPorIntervaloFechas($f0, $ff, $s->idst);
					}
					//var_dump($st);

				}
				//Calculo de la cantidad mayor
				$cnt_mayor_st = [];
				foreach ($st as $s)
				{
					$cnt_mayor_st[] =  $s->c;
				}
				$mayor_st = max($cnt_mayor_st);

				//Ajuste de los porcentajes
				foreach ($st as $s)
				{
					if($mayor_st!=0)
					{
						$s->c = round(($s->c/$mayor_st)*100, 0, PHP_ROUND_HALF_UP);
					}
					if(is_null($s->idst))
					{
						unset($s->idt);
						unset($s->idst);
						unset($s->n);
						unset($s->c);
					}
				}
				//echo "<br><br>";
				//var_dump($st);
				$mst[] = $st;

			}

			$mt[] = $tm;
		}

		//Matriz de resultados
		/** @noinspection PhpLanguageLevelInspection */
		$resultados = [
			'mc' => $mc,
			'mt' => $mt,
			'mst' => $mst,
		];
	}

	private function fecha_unix($fecha)
	{
		$fecha_std = str_replace('/', '-', $fecha);
		$fecha_unix = strtotime($fecha_std);
		return $fecha_unix;
	}
	public function seleccionDistribucion()
	{
		$dt['encuestas']=$this->Graficos_model->leerTodasLasEncuestas();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('graficos/vgraficoselectdistribucion',$dt);
		$this->load->view('html/pie');
	}
	////////////211006 will////////////////////
	public function llenarDatosDistribucion()
	{
		$dt['idencuesta'] = $this->input->post('idencuesta');
		$dt['encuesta']=$this->Graficos_model->leerEncuestId($this->input->post('idencuesta'));
		$dt['preguntas']=$this->Graficos_model->leerPreguntasDencuesta($this->input->post('idencuesta'));
		$this->load->view('graficos/vgraficodistribucion',$dt);
	}

	public function seleccionSankey()
	{
		$dt['encuestas']=$this->Graficos_model->leerTodasLasEncuestas();
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('graficos/vgraficoselectsankey',$dt);
		$this->load->view('html/pie');
	}
	public function llenarDatosSankey()
	{
		$dt['idencuesta'] = $this->input->post('idencuestaSank');
		$dt['encuesta']=$this->Graficos_model->leerEncuestId($this->input->post('idencuestaSank'));
		$dt['preguntas']=$this->Graficos_model->leerPreguntasDencuesta($this->input->post('idencuestaSank'));
		$this->load->view('graficos/vgraficosankey',$dt);
	}
	public function getRespuestasHM()
	{
		$datos = json_decode($this->input->post('datos'));
		$encuesta = $datos->idencuesta;
		$pregunta = $datos->idpregunta;
		$respuestas = $this->Graficos_model->leerRespuestasDpregunta($encuesta,$pregunta);//respuestasA
		$respuestas1 = $this->Graficos_model->leerRespuestas1($encuesta,$pregunta);

		$sumpru = 0;
		$edadfinal = 19;
		for ($i = 1; $i < 11; $i++)
		{
			foreach($respuestas as $aa)
			{
				$dato[$aa->iduirespuesta] = '0';			//idrespuesta y ceros
				$tee = $aa->pregunta;						//pregunta
			}
			$sexo = 'M';
			$edadinicial = $edadfinal + 1;
			$edadfinal = $edadinicial + 5;
			$cantidad = $this->Graficos_model->leerEncuestasHM($encuesta, $pregunta, $sexo, $edadinicial, $edadfinal);//cantidad
			foreach($cantidad as $ee)						//inserta valores "cantidad" en algunas columnas de ceros
			{
				foreach($respuestas as $uu)
				{
					if($ee->iduirespuesta == $uu->iduirespuesta)
					{
						$dato[$uu->iduirespuesta] = $ee->cantidad;//idrespuesta y cantidad (objeto de objetos)
					}
				}
			}
			foreach($dato as $sip)				//convierte "objeto de matrices" en "matriz de matrices"
			{
				$pru[] = $sip;
			}
			$npru[] = $pru;
			if(array_sum($pru) > $sumpru)//filtro para determinar el valor mayor
			{
				$sumpru = array_sum($pru);
			}
			$pru = array();//limpia la matriz $pru sin elementos
		}
		foreach($npru as $lin)			//calculo de porcentajes en matriz
		{
			foreach($lin as $newlin)
			{
				$porcent[] = round(($newlin * 100) / ($sumpru + 0.001));
			}
			$npru1[] = $porcent;
			$porcent = array();
		}
		$sumpru2 = 0;
		$edadfinal2 = 19;
		for ($i = 1; $i < 11; $i++)
		{
			foreach($respuestas as $aa)
			{
				$dato2[$aa->iduirespuesta] = '0';			//idrespuesta y ceros
			}
			$sexo2 = 'F';
			$edadinicial2 = $edadfinal2 + 1;
			$edadfinal2 = $edadinicial2 + 5;
			$cantidad2 = $this->Graficos_model->leerEncuestasHM($encuesta, $pregunta, $sexo2, $edadinicial2, $edadfinal2);//cantidad
			foreach($cantidad2 as $ee2)						//inserta valores "cantidad" en algunas columnas de ceros
			{
				foreach($respuestas as $uu2)
				{
					if($ee2->iduirespuesta == $uu2->iduirespuesta)
					{
						$dato2[$uu2->iduirespuesta] = $ee2->cantidad;//idrespuesta y cantidad (objeto de objetos)
					}
				}
			}
			foreach($dato2 as $sip2)				//convierte "objeto de matrices" en "matriz de matrices"
			{
				$pru2[] = $sip2;
			}
			$npru2[] = $pru2;
			if(array_sum($pru2) > $sumpru2)//filtro para determinar el valor mayor
			{
				$sumpru2 = array_sum($pru2);
			}
			$pru2 = array();//limpia la matriz $pru sin elementos
		}
		foreach($npru2 as $lin2)			//calculo de porcentajes en matriz
		{
			foreach($lin2 as $newlin2)
			{
				$porcent2[] = round(($newlin2 * 100) / ($sumpru2 + 0.001));
			}
			$npru3[] = $porcent2;
			$porcent2 = array();
		}
		$dt['m']=$npru3;
		$dt['h'] = $npru1;
		$dt['r'] = $respuestas1;
		$dt['t'] = $tee;
		echo json_encode($dt);
	}
	public function getRespuestasHMSank()
	{
		$datos = json_decode($this->input->post('datos'));
		$encuesta = $datos->idencuesta;
		$pregunta = $datos->idpregunta;

		$respuestasPosibles = $this->Graficos_model->leerRespuestasDpreguntaS($encuesta,$pregunta);
		$respuestasPosiblesCantidad = $this->Graficos_model->leerCantidadArespuestasPosibles($encuesta,$pregunta);

		foreach($respuestasPosibles as $posicion)
		{
			$answer1['r']=$posicion->respuesta;
			$answer1['v']=0;
			$answer2[] = $answer1;//*********************************************************************************
		}

		for($depto = 1; $depto < 10; $depto++)// 9 Departamentos
		{
//		$depto  = 1;
			$sexo = 'M';
			for($mf = 1; $mf < 3; $mf++)//para M y F
			{
				$respuestasPosiblesCantidadM1=$this->Graficos_model->leerCantidadArespuestasPosiblesM1($encuesta,$pregunta,$sexo,$depto);
				foreach($respuestasPosibles as $i)//creamos obj "$paquete0" con valores ceros
				{
					$paquete0[$i->iduirespuesta] = '0';
					$tee = $i->pregunta;//****************************************************************************
				}
				foreach($respuestasPosiblesCantidadM1 as $ee)//insertamos valores en "$paquete0"
				{
					foreach($respuestasPosibles as $uu)
					{
						if($ee->iduirespuesta == $uu->iduirespuesta)
						{
							$paquete0[$uu->iduirespuesta] = $ee->cantidad;
						}
					}
				}
				foreach($paquete0 as $sip)//convierte "objeto" en "array"
				{
					if($sexo == 'M')
					{
						$paquetem[] = $sip;
						$paquetemsum = array_sum($paquetem);
					}
					if($sexo == 'F')
					{
						$paquetef[] = $sip;
						$paquetefsum = array_sum($paquetef);
					}
				}
				$sexo = 'F';
			}
//			$paquete['m'] = $paquetem;//encierra array entre llaves (obj)
//			$paquete['h'] = $paquetef;//encierra array entre llaves
//			$be[] = $paquete;//encierra obj entre corchetes (array)

//			$paquetea[]=$paquetemsum;
//			$paquetea[]=$paquetefsum;
//			$aa[]=$paquetea;

///////////////////////aumentando porcentajes 210924///////////////////////////////////////////////
			$sumatotal = $paquetemsum + $paquetefsum;
			$paquetea[]=$paquetemsum;
			$paquetea[]=$paquetefsum;
			foreach($paquetea as $cont)
			{
				$paqueteaa[]=round(($cont * 100) / ($sumatotal + 0.001));
			}
			$aa[]=$paqueteaa;//****************************************************************************************
			foreach($paquetem as $conta)
			{
				$paquetemm[] = round(($conta * 100) / ($sumatotal + 0.001));
			}
			foreach($paquetef as $conta)
			{
				$paquetehh[] = round(($conta * 100) / ($sumatotal + 0.001)); 
			}
			$paquete['m'] = $paquetemm;
			$paquete['h'] = $paquetehh;
			$be[] = $paquete;//*****************************************************************************************
/////////////////////////////////////////////////////////

			$paquetea = array();
			$paquetem = array();
			$paquetef = array();
			$paqueteaa = array();
			$paquetemm = array();
			$paquetehh = array();

		}
		
		$dt['a0']=$aa;
		$dt['a1']=$be;
		$dt['a2']=$answer2;
		$dt['a3']=$tee;
		echo json_encode($dt);
	}
}
