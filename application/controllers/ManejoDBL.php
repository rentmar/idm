<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ManejoDBL extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->model('Departamento_model');
        $this->load->model('MedioComunicacion_model');
        $this->load->model('Cuestionario_model');
        $this->load->model('Actor_model');
        $this->load->model('Universidad_model');
        $this->load->model('Tema_model');
        $this->load->model('SubTema_model');
        $this->load->model('Noticia_model');
        $this->load->model('Formulario_model');
        $this->load->model('Leyy_model');
        $this->load->model('Ley_model');
//Comprobacion de session
	if($this->session->sesion_activa === null)
        {
            $this->session->sess_destroy();
            redirect('/');
        }
    }
    public function index()
    {
        $this->load->view('html/encabezado');
        $this->load->view('html/navbar');
        $this->load->view('manejodb/viniciodb');
        $this->load->view('html/pie');
    }
    public function reportesLeyes()
    {
        $usuario = $this->ion_auth->user()->row();
        	//Poblar el formulario
        $estadosley = $this->Leyy_model->leerEstadosLey();
        $universidad = $this->Universidad_model->leerUniversidades();
        $tema = $this->Tema_model->leerTemasLeyes();
        $stema = $this->SubTema_model->leerSubtemasLeyes();
        $un = $this->Universidad_model->leerUniversidadId($usuario->rel_iduniversidad);
        
        $data['estadosley'] = $estadosley;
        $data['universidad'] = $universidad;
        $data['tema'] = $tema;
        $data['stema'] = $stema;
        $data['un'] = $un;
        
        $this->load->view('html/encabezado');
        $this->load->view('html/navbar');
        $this->load->view('manejodb/vmanejodb_repsimplesley', $data);
        $this->load->view('html/pie');
    }

    public function reportesLeyescomp()
	{
		$usuario = $this->ion_auth->user()->row();
		//Poblar el formulario
		$estadosley = $this->Leyy_model->leerEstadosLey();
		$universidad = $this->Universidad_model->leerUniversidades();
		$tema = $this->Tema_model->leerTemasLeyes();
		$stema = $this->SubTema_model->leerSubtemasLeyes();
		$un = $this->Universidad_model->leerUniversidadId($usuario->rel_iduniversidad);


		$data['estadosley'] = $estadosley;
		$data['universidad'] = $universidad;
		$data['tema'] = $tema;
		$data['stema'] = $stema;
		$data['un'] = $un;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('manejodb/vmanejodb_repcompley', $data);
		$this->load->view('html/pie');

	}


    public function procesarConsultasimpleley()
    {
		/*
		 *
		 * Redireccion a reportes simples
		 *
		 */
        $consulta = $this->objetoConsultaley();
//                echo "<pre>";var_dump($consulta);echo "</pre>";

        if($consulta->fecha_inicio > $consulta->fecha_fin) //Comprobacion del intervalo de fechas
        {
            $this->mensaje('Intervalo de fechas incorrecto', 'warning');
            redirect('ManejoDBL/reportesLeyes');
        }
        else
        {
            /** @noinspection PhpLanguageLevelInspection */
            if(!empty($this->input->post('estadol'))) //Reporte por estado de ley
            {
                if($consulta->idestadoley == 0)
                {
                    $this->mensaje('Sin seleccion', 'warning');
                    redirect('ManejoDBL/reportesLeyes');
                }
                else
                {
                    $estadoley = $this->Leyy_model->leyPorEstado($consulta);
                    if(empty($estadoley))
                    {
                        	//Si la consulta esta vacia no se genera reporte
                        $this->mensaje('No existen resultados', 'info');
                        redirect('ManejoDBL/reportesLeyes');
                    }
                    else
                    {
                        	//Cargar los datos a las session
                        $this->session->set_userdata('consulta_estadoley', []);
                        $this->session->set_userdata('consulta_estadoley', $consulta);
                        redirect('ManejoDBL/downloadEstadoLey');
                    }
                }
            }
            elseif (!empty($this->input->post('universidad'))) //Reporte por universidad
            {
                if($consulta->iduniversidad == 0)
                {
                    $this->mensaje('Sin seleccion', 'warning');
                    redirect('ManejoDBL/reportesLeyes');
                }
                else
                {
                    //Redireccion a rutina de reporte
                    $universidadl = $this->Leyy_model->leyPorUniversidad($consulta);
                    if(empty($universidadl))
                    {
                        	//Si la consulta esta vacia no se genera reporte
                        $this->mensaje('No existen resultados', 'info');
                        redirect('ManejoDBL/reportesLeyes');
                    }
                    else
                    {
                        //Cargar los datos a las session
                        $this->session->set_userdata('consulta_universidadl', []);
                        $this->session->set_userdata('consulta_universidadl', $consulta);
                        redirect('ManejoDBL/downloadUniversidadLey');
                    }
                }
            }
            elseif (!empty($this->input->post('tema'))) //Reporte por tema
            {
                if($consulta->idtema == 0)
                {
                    $this->mensaje('Sin seleccion', 'warning');
                    redirect('ManejoDBL/reportesLeyes');
                }
                else
                {
                    //Redireccion a rutina de reporte
                    $temal = $this->Leyy_model->leyPorTema($consulta);
                    if(empty($temal))
                    {
                        	//Si la consulta esta vacia no se genera reporte
                        $this->mensaje('No existen resultados', 'info');
                        redirect('ManejoDBL/reportesLeyes');
                    }
                    else
                    {
                        	//Cargar los datos a las session
                        $this->session->set_userdata('consulta_temal', []);
                        $this->session->set_userdata('consulta_temal', $consulta);
                        redirect('ManejoDBL/downloadTemaLey');
                    }
		}
            }
            elseif (!empty($this->input->post('subtema'))) //Reporte por subtema
            {
                if($consulta->idsubtema == 0)
                {
                    $this->mensaje('Sin seleccion', 'warning');
                    redirect('ManejoDBL/reportesLeyes');
                    }
                    else
                    {
                        	//Redireccion a rutina de reporte
                        $subtemal = $this->Leyy_model->leyPorSubtema($consulta);
                        if(empty($subtemal))
                        {
                            //Si la consulta esta vacia no se genera reporte
                            $this->mensaje('No existen resultados', 'info');
                            redirect('ManejoDBL/reportesLeyes');
                        }
                        else
                        {
                            //Cargar los datos a las session
                            $this->session->set_userdata('consulta_subtemal', []);
                            $this->session->set_userdata('consulta_subtemal', $consulta);
                            redirect('ManejoDBL/downloadSubtemaLey');
                        }
                     }
            }
            else
            {
                $this->mensaje('Error', 'danger');
                redirect('ManejoDBL/reportesLeyes');
            }
        }
    }
    public function mensaje($mensaje, $clase)
    {
        		/** @noinspection PhpLanguageLevelInspection */
        $this->session->set_flashdata([
			'mensaje' => $mensaje,
			'clase' => $clase,
		]);
    }
    private function objetoConsultaley()
    {
        $ids = new stdClass();
        $ids->fecha_inicio = '';
        $ids->fecha_fin = '';
        $ids->idestadoley ='';
        $ids->iduniversidad = '';
        $ids->idtema = '';
        $ids->idsubtema = '';
        
        //Capturar datos
        $ids->fecha_inicio = $this->fecha_unix($this->input->post('fecha_inicio'));
        $ids->fecha_fin = $this->fecha_unix($this->input->post('fecha_fin'));
        $ids->idestadoley = $this->input->post('idestadol');
        $ids->iduniversidad = $this->input->post('iduniversidad');
        $ids->idtema = $this->input->post('idtema');
        $ids->idsubtema = $this->input->post('idsubtema');
        
        return $ids;
    }
    public function downloadEstadoLey()
    {
        $consulta = $this->session->consulta_estadoley;
        $this->session->unset_userdata("consulta_estadoley");
        $leyestado = $this->Leyy_model->leyPorEstado($consulta);
        
        if(!empty($consulta))
        {
            $filename = "reporte-estadoley.xlsx";
            $ruta = 'assets/info/';
            $plantilla = $ruta.'plantilla-estadoley.xlsx';
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
            header('Content-Disposition: attachment; filename="' . $filename. '"');
            header('Cache-Control: max-age=0');
            
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
            $sheet = $spreadsheet->getActiveSheet();
            $worksheet = $spreadsheet->getActiveSheet();
            $eje_y = 6;
            
            //Colocar el tipo de medio
            $estadoley = $this->Leyy_model->leerestadoleyId($consulta->idestadoley);
            $sheet->setCellValue('E3', $estadoley->nombre_estadoley);
            
            foreach ($leyestado as $n):
                $sheet->setCellValue('A'.$eje_y, $n->idleyes);
                $sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_registro));
                $sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $n->fecha_estadoley));
                $sheet->setCellValue('D'.$eje_y, $n->nombre_fuente);
                $sheet->setCellValue('E'.$eje_y, $n->nombre_estadoley);
                $sheet->setCellValue('F'.$eje_y, $n->codigo_ley);
                $sheet->setCellValue('G'.$eje_y, $n->nombre_ley);
                $sheet->setCellValue('H'.$eje_y, $n->resumen);
                $sheet->setCellValue('I'.$eje_y, $n->url_ley);
                $sheet->setCellValue('J'.$eje_y, $n->nombre_tema);
				$sheet->setCellValue('K'.$eje_y, $n->username);
                $sheet->setCellValue('L'.$eje_y, $n->first_name);
                $sheet->setCellValue('M'.$eje_y, $n->last_name);
                $eje_y++;
            endforeach;
            
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save("php://output");
        }else{
            $this->mensaje('No existen datos', 'warning');
            redirect('ManejoDBL/reportesLeyes');
            }
    }
    public function downloadUniversidadLey()
    {
        $consulta = $this->session->consulta_universidadl;
        $this->session->unset_userdata("consulta_universidadl");
        $universidadl = $this->Leyy_model->leyPorUniversidad($consulta);
        
        if(!empty($consulta))
        {
            $filename = "reporte-universidadl.xlsx";
            $ruta = 'assets/info/';
            $plantilla = $ruta.'plantilla-universidadl.xlsx';
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
            header('Content-Disposition: attachment; filename="' . $filename. '"');
            header('Cache-Control: max-age=0');
            
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
            $sheet = $spreadsheet->getActiveSheet();
            $worksheet = $spreadsheet->getActiveSheet();
            $eje_y = 6;
            
            //Colocar el tipo de medio
            $universidadley = $this->Leyy_model->leeruniversidadlId($consulta->iduniversidad);
            $sheet->setCellValue('E3', $universidadley->nombre_universidad);
            
            foreach ($universidadl as $n):
                $sheet->setCellValue('A'.$eje_y, $n->idleyes);
                $sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_registro));
                $sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $n->fecha_estadoley));
                $sheet->setCellValue('D'.$eje_y, $n->nombre_fuente);
                $sheet->setCellValue('E'.$eje_y, $n->nombre_estadoley);
                $sheet->setCellValue('F'.$eje_y, $n->codigo_ley);
                $sheet->setCellValue('G'.$eje_y, $n->nombre_ley);
                $sheet->setCellValue('H'.$eje_y, $n->resumen);
                $sheet->setCellValue('I'.$eje_y, $n->url_ley);
                $sheet->setCellValue('J'.$eje_y, $n->nombre_tema);
				$sheet->setCellValue('K'.$eje_y, $n->username);
                $sheet->setCellValue('L'.$eje_y, $n->first_name);
                $sheet->setCellValue('M'.$eje_y, $n->last_name);
                $eje_y++;
            endforeach;
            
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save("php://output");
        }else{
            $this->mensaje('No existen datos', 'warning');
            redirect('ManejoDBL/reportesLeyes');
        }
    }
    public function downloadTemaLey()
    {
		$consulta = $this->session->consulta_temal;
		$this->session->unset_userdata("consulta_temal");
		$temal = $this->Leyy_model->leyPorTema($consulta);

		if(!empty($consulta))
		{
			$filename = "reporte-temal.xlsx";
			$ruta = 'assets/info/';
			$plantilla = $ruta.'plantilla-temal.xlsx';
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');

			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getActiveSheet();
			$worksheet = $spreadsheet->getActiveSheet();
			$eje_y = 6;

			//Colocar el tipo de medio
			$temaley = $this->Leyy_model->leertemaleyId($consulta->idtema);
			$sheet->setCellValue('E3', $temaley->nombre_tema);

			foreach ($temal as $n):
				$sheet->setCellValue('A'.$eje_y, $n->idleyes);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_registro));
				$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $n->fecha_estadoley));
				$sheet->setCellValue('D'.$eje_y, $n->nombre_fuente);
				$sheet->setCellValue('E'.$eje_y, $n->nombre_estadoley);
				$sheet->setCellValue('F'.$eje_y, $n->codigo_ley);
				$sheet->setCellValue('G'.$eje_y, $n->nombre_ley);
				$sheet->setCellValue('H'.$eje_y, $n->resumen);
				$sheet->setCellValue('I'.$eje_y, $n->url_ley);
				$sheet->setCellValue('J'.$eje_y, $n->nombre_tema);
				$sheet->setCellValue('K'.$eje_y, $n->username);
				$sheet->setCellValue('L'.$eje_y, $n->first_name);
				$sheet->setCellValue('M'.$eje_y, $n->last_name);

				$eje_y++;
			endforeach;

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");
		}else{
			$this->mensaje('No existen datos', 'warning');
			redirect('ManejoDBL/reportesLeyes');
		}
    }
    public function downloadSubtemaLey()
    {
		$consulta = $this->session->consulta_subtemal;
		$this->session->unset_userdata("consulta_subtemal");
		$subtemal = $this->Leyy_model->leyPorSubtema($consulta);

		if(!empty($consulta))
		{
			$filename = "reporte-subtemal.xlsx";
			$ruta = 'assets/info/';
			$plantilla = $ruta.'plantilla-subtemal.xlsx';
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');

			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getActiveSheet();
			$worksheet = $spreadsheet->getActiveSheet();
			$eje_y = 6;

			//Colocar el tipo de medio
			$subtemaley = $this->Leyy_model->leersubtemaleyId($consulta->idsubtema);
			$sheet->setCellValue('E3', $subtemaley->nombre_subtema);

			foreach ($subtemal as $n):
				$sheet->setCellValue('A'.$eje_y, $n->idleyes);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_registro));
				$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $n->fecha_estadoley));
				$sheet->setCellValue('D'.$eje_y, $n->nombre_fuente);
				$sheet->setCellValue('E'.$eje_y, $n->nombre_estadoley);
				$sheet->setCellValue('F'.$eje_y, $n->codigo_ley);
				$sheet->setCellValue('G'.$eje_y, $n->nombre_ley);
				$sheet->setCellValue('H'.$eje_y, $n->resumen);
				$sheet->setCellValue('I'.$eje_y, $n->url_ley);
				$sheet->setCellValue('J'.$eje_y, $n->nombre_tema);
				$sheet->setCellValue('K'.$eje_y, $n->username);
				$sheet->setCellValue('L'.$eje_y, $n->first_name);
				$sheet->setCellValue('M'.$eje_y, $n->last_name);
				$eje_y++;
			endforeach;

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");
		}else{
			$this->mensaje('No existen datos', 'warning');
			redirect('ManejoDBL/reportesLeyes');
		}
    }
    private function fecha_unix($fecha)
    {
        $fecha_std = str_replace('/', '-', $fecha);
        $fecha_unix = strtotime($fecha_std);
        return $fecha_unix;
    }

    public function procesarConsulta()
	{
		//Primer validador
		$consulta = $this->objetoConsultaley();


		if ($consulta->fecha_inicio > $consulta->fecha_fin) {
			$this->mensaje('Intervalo de fechas incorrecto', 'warning');
			redirect('ManejoDB');
		} else {
			//var_dump($consulta);
			$leyes_datos = $this->Ley_model->leerLeyesReporte($consulta);
			if (empty($leyes_datos)) {
				//Si la consulta esta vacia no se genera reporte
				$this->mensaje('No existen resultados', 'info');
				redirect('ManejoDBL/reportesLeyescomp');
			} else {
				//Cargar los datos a las session
				$this->session->set_userdata('consulta_leyes', []);
				$this->session->set_userdata('consulta_leyes', $consulta);


				redirect('ManejoDBL/download');
			}
		}
	}
	public function download()
	{
		$consulta = $this->session->consulta_leyes;

		$leyes_datos = $this->Ley_model->leerLeyesReporte($consulta);
		if(!empty($consulta))
		{
			$filename = "reporte-leyes.xlsx";
			$ruta = 'assets/info/';
			$plantilla = $ruta.'plantilla-repcompuestos-leyes.xlsx';
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getSheet(0)->setTitle('Leyes');

			$worksheet = $spreadsheet->getActiveSheet();
			$eje_y = 6;

			foreach ($leyes_datos as $l):
				$sheet->setCellValue('A'.$eje_y, $l->idleyes);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $l->fecha_registro));
				$sheet->setCellValue('C'.$eje_y, $l->nombre_fuente);
				$sheet->setCellValue('D'.$eje_y, $l->resumen);
				$sheet->setCellValue('E'.$eje_y, mdate('%m-%d-%Y', $l->fecha_estadoley));
				$sheet->setCellValue('F'.$eje_y, $l->nombre_estadoley);
				$sheet->setCellValue('G'.$eje_y, $l->porcentaje_estadoley );
				$sheet->setCellValue('H'.$eje_y, $l->codigo_ley );
				$sheet->setCellValue('I'.$eje_y, $l->nombre_ley );
				$sheet->setCellValue('J'.$eje_y, $l->url_ley );
				$sheet->setCellValue('K'.$eje_y, $l->username);
				$sheet->setCellValue('L'.$eje_y, $l->nombre_universidad);
				$sheet->setCellValue('M'.$eje_y, $l->nombre_departamento);
				$sheet->setCellValue('N'.$eje_y, $l->nombre_tema);
				$sheet->setCellValue('O'.$eje_y, $l->nombre_subtema);
				$eje_y++;
			endforeach;

			//Llenar Otros Temas
			$sheet = $spreadsheet->getSheet(1)->setTitle('OtrosTemas');
			$eje_y = 6;
			$ley_otrotema = $this->Ley_model->leerLeyesReporteOtrosTemas($consulta);
			foreach ($ley_otrotema as $lo):
				$sheet->setCellValue('A'.$eje_y, $lo->idleyes);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $lo->fecha_registro));
				$sheet->setCellValue('C'.$eje_y, $lo->resumen);
				$sheet->setCellValue('D'.$eje_y, mdate('%m-%d-%Y', $lo->fecha_estadoley));
				$sheet->setCellValue('E'.$eje_y, $lo->nombre_estadoley);
				$sheet->setCellValue('F'.$eje_y, $lo->porcentaje_estadoley );
				$sheet->setCellValue('G'.$eje_y, $lo->nombre_ley );
				$sheet->setCellValue('H'.$eje_y, $lo->url_ley );
				$sheet->setCellValue('I'.$eje_y, $lo->username);
				$sheet->setCellValue('J'.$eje_y, $lo->nombre_universidad);
				$sheet->setCellValue('K'.$eje_y, $lo->nombre_departamento);
				$sheet->setCellValue('L'.$eje_y, $lo->nombre_otrotema);
				$eje_y++;
			endforeach;


			//Llenar Subtemas
			//Llenar Otros Temas
			$sheet = $spreadsheet->getSheet(2)->setTitle('OtrosSubtemas');
			$eje_y = 6;
			$ley_otrosubtema = $this->Ley_model->leerLeyesReporteOtrosSubtemas($consulta);
			foreach ($ley_otrosubtema as $los):
				$sheet->setCellValue('A'.$eje_y, $los->idleyes);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $los->fecha_registro));
				$sheet->setCellValue('C'.$eje_y, $los->resumen);
				$sheet->setCellValue('D'.$eje_y, mdate('%m-%d-%Y', $los->fecha_estadoley));
				$sheet->setCellValue('E'.$eje_y, $los->nombre_estadoley);
				$sheet->setCellValue('F'.$eje_y, $los->porcentaje_estadoley );
				$sheet->setCellValue('G'.$eje_y, $los->nombre_ley );
				$sheet->setCellValue('H'.$eje_y, $los->url_ley );
				$sheet->setCellValue('I'.$eje_y, $los->username);
				$sheet->setCellValue('J'.$eje_y, $los->nombre_universidad);
				$sheet->setCellValue('K'.$eje_y, $los->nombre_departamento);
				$sheet->setCellValue('L'.$eje_y, $los->nombre_tema);
				$sheet->setCellValue('M'.$eje_y, $los->nombre_otrosubtema);
				$eje_y++;
			endforeach;


			//Primer libro por defecto
			$sheet = $spreadsheet->setActiveSheetIndex(0);

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");

		}else{
			$this->mensaje('No existen datos', 'warning');
			redirect('ManejoDBL/reportesLeyescomp');

		}
	}
}
