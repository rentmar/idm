<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ManejoDB extends CI_Controller{
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
		$this->load->model('Plenaria_model');
		$this->load->model('Norma_model');
		$this->load->model('Instanciaseguimiento_model');
		$this->load->model('Veeduria_model');
		//Comprobacion de session
		if($this->session->sesion_activa ===  null){
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




	public function reportesSimples()
	{
		$usuario = $this->ion_auth->user()->row();
		//Poblar el formulario
		$forms = $this->Formulario_model->leerCuestionarios();
		$depas = $this->Departamento_model->leerDepartamentos();
		$tipo_medio = $this->MedioComunicacion_model->leerTipoMedio();
		$medio = $this->MedioComunicacion_model->leerMedioComunicacion();
		$actor = $this->Actor_model->leerActores();
		$universidad = $this->Universidad_model->leerUniversidades();
		$tema = $this->Tema_model->leerTemasForms();
		$stema = $this->SubTema_model->leerSubtemasForms();
		$un = $this->Universidad_model->leerUniversidadId($usuario->rel_iduniversidad);


		$data['dep'] = $depas;
		$data['forms'] = $forms;
		$data['tipo_medio'] = $tipo_medio;
		$data['medio'] = $medio;
		$data['actor'] = $actor;
		$data['universidad'] = $universidad;
		$data['tema'] = $tema;
		$data['stema'] = $stema;
		$data['un'] = $un;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('manejodb/vmanejodb_repsimples', $data);
		$this->load->view('html/pie');
	}


	public function reportesCompuestos()
	{
		$usuario = $this->ion_auth->user()->row();
		//Poblar el formulario
		$forms = $this->Formulario_model->leerCuestionarios();
		$depas = $this->Departamento_model->leerDepartamentos();
		$tipo_medio = $this->MedioComunicacion_model->leerTipoMedio();
		$medio = $this->MedioComunicacion_model->leerMedioComunicacion();
		$actor = $this->Actor_model->leerActores();
		$universidad = $this->Universidad_model->leerUniversidades();
		$tema = $this->Tema_model->leerTemasForms();
		$stema = $this->SubTema_model->leerSubtemasForms();
		$un = $this->Universidad_model->leerUniversidadId($usuario->rel_iduniversidad);



		$data['dep'] = $depas;
		$data['forms'] = $forms;
		$data['tipo_medio'] = $tipo_medio;
		$data['medio'] = $medio;
		$data['actor'] = $actor;
		$data['universidad'] = $universidad;
		$data['tema'] = $tema;
		$data['stema'] = $stema;
		$data['un'] = $un;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('manejodb/vmanejodb_repcomp', $data);
		$this->load->view('html/pie');

	}




	public function download()
	{
		$consulta = $this->session->consulta;
		$noticia = $this->Noticia_model->reporteNoticias($consulta);
		$noticia_datos = $this->Noticia_model->reportesNoticiasDatos($consulta);
		$noticia_datos_ids = $this->Noticia_model->reportesNoticiasDatosID($consulta);
		if(!empty($consulta))
		{
			$filename = "reporte.xlsx";
			$ruta = 'assets/info/';
			$plantilla = $ruta.'plantilla-reportes.xlsx';
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getSheet(0)->setTitle('Noticias');

			$worksheet = $spreadsheet->getActiveSheet();
			$eje_y = 6;

			foreach ($noticia_datos as $n):
				$sheet->setCellValue('A'.$eje_y, $n->idnoticia);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_registro));
				$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $n->fecha_noticia));
				$sheet->setCellValue('D'.$eje_y, $n->titular);
				$sheet->setCellValue('E'.$eje_y, $n->resumen);
				$sheet->setCellValue('F'.$eje_y, $n->url_noticia);
				$sheet->setCellValue('G'.$eje_y, $n->nombre_cuestionario );
				$sheet->setCellValue('H'.$eje_y, $n->nombre_medio );
				$sheet->setCellValue('I'.$eje_y, $n->nombre_tipo );
				$sheet->setCellValue('J'.$eje_y, $n->username);
				$sheet->setCellValue('K'.$eje_y, $n->nombre_universidad);
				$sheet->setCellValue('L'.$eje_y, $n->nombre_departamento);
				$sheet->setCellValue('M'.$eje_y, $n->nombre_actor);
				$sheet->setCellValue('N'.$eje_y, $n->nombre_tema);
				$sheet->setCellValue('O'.$eje_y, $n->nombre_subtema);
				$eje_y++;
			endforeach;

			//Llenar Otros Temas
			$sheet = $spreadsheet->getSheet(1)->setTitle('OtrosTemas');
			$eje_y = 6;
			foreach ($noticia_datos_ids as $n):
				$notot = $this->Noticia_model->otroTemaNoticiaPorId($n->idnoticia);
				$sheet->setCellValue('A'.$eje_y, $notot->idnoticia);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $notot->fecha_registro));
				$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $notot->fecha_noticia));
				$sheet->setCellValue('D'.$eje_y, $notot->titular);
				$sheet->setCellValue('E'.$eje_y, $notot->resumen);
				$sheet->setCellValue('F'.$eje_y, $notot->url_noticia);
				$sheet->setCellValue('G'.$eje_y, $notot->nombre_cuestionario );
				$sheet->setCellValue('H'.$eje_y, $notot->nombre_otrotema );

				$eje_y++;

			endforeach;


			//Llenar Subtemas
			//Llenar Otros Temas
			$sheet = $spreadsheet->getSheet(2)->setTitle('OtrosSubtemas');
			$eje_y = 6;
			foreach ($noticia_datos_ids as $n):
				$nototsub = $this->Noticia_model->otroSubtemaNoticiaPorId($n->idnoticia);
				foreach ($nototsub as $nots):
				$sheet->setCellValue('A'.$eje_y, $nots->idnoticia);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $nots->fecha_registro));
				$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $nots->fecha_noticia));
				$sheet->setCellValue('D'.$eje_y, $nots->titular);
				$sheet->setCellValue('E'.$eje_y, $nots->resumen);
				$sheet->setCellValue('F'.$eje_y, $nots->url_noticia);
				$sheet->setCellValue('G'.$eje_y, $nots->nombre_cuestionario );
				$sheet->setCellValue('H'.$eje_y, $nots->nombre_tema );
				$sheet->setCellValue('I'.$eje_y, $nots->nombre_otrosubtema );
				$eje_y++;
				endforeach;

			endforeach;

			//Primer libro por defecto
			$sheet = $spreadsheet->setActiveSheetIndex(0);

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");

		}else{
			$this->mensaje('No existen datos', 'warning');
			redirect('ManejoDB/reportesCompuestos');

		}

	}

	public function downloadUniversidad()
	{
		$consulta = $this->session->consulta_universidad;
		$this->session->unset_userdata("consulta_universidad");
		$noticias = $this->Noticia_model->noticiaPorUniversidad($consulta);

		if(!empty($consulta))
		{
			$filename = "reporte-universidad.xlsx";
			$ruta = 'assets/info/';
			$plantilla = $ruta.'plantilla-universidad.xlsx';
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');

			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getActiveSheet();
			$worksheet = $spreadsheet->getActiveSheet();
			$eje_y = 6;

			//Colocar el tipo de medio
			$universidad = $this->Universidad_model->leerUniversidadId($consulta->iduniversidad);
			$sheet->setCellValue('E3', $universidad->nombre_universidad);

			foreach ($noticias as $n):
				$sheet->setCellValue('A'.$eje_y, $n->idnoticia);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_registro));
				$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $n->fecha_noticia));
				$sheet->setCellValue('D'.$eje_y, $n->titular);
				$sheet->setCellValue('E'.$eje_y, $n->resumen);
				$sheet->setCellValue('F'.$eje_y, $n->url_noticia);
				$sheet->setCellValue('G'.$eje_y, $n->nombre_medio );
				$sheet->setCellValue('H'.$eje_y, $n->nombre_tipo );
				$sheet->setCellValue('I'.$eje_y, $n->nombre_cuestionario );
				$sheet->setCellValue('J'.$eje_y, $n->username);
				$sheet->setCellValue('K'.$eje_y, $n->nombre_universidad);
				$sheet->setCellValue('L'.$eje_y, $n->nombre_departamento);

				$eje_y++;
			endforeach;

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");
		}else{
			$this->mensaje('No existen datos', 'warning');
			redirect('ManejoDB/reportesSimples');
		}
	}

	public function downloadTema()
	{

		$consulta = $this->session->consulta_tema;
		$this->session->unset_userdata("consulta_tema");
		$noticias = $this->Noticia_model->noticiaPorTemas($consulta);

		if(!empty($consulta)){
			$filename = "reporte-tema.xlsx";
			$ruta = 'assets/info/';
			$plantilla = $ruta.'plantilla-tema.xlsx';
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getActiveSheet();
			$worksheet = $spreadsheet->getActiveSheet();
			$eje_y = 6;

			//Colocar el tipo de medio
			$tema = $this->Cuestionario_model->leerTemaPorId($consulta->idtema);
			$sheet->setCellValue('E3', $tema->nombre_tema);

			foreach ($noticias as $n):

				$nt = $this->Noticia_model->noticiaPorId($n->idnoticia);
				$sheet->setCellValue('A'.$eje_y, $nt->idnoticia);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $nt->fecha_registro));
				$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $nt->fecha_noticia));
				$sheet->setCellValue('D'.$eje_y, $nt->titular);
				$sheet->setCellValue('E'.$eje_y, $nt->resumen);
				$sheet->setCellValue('F'.$eje_y, $nt->url_noticia);
				$sheet->setCellValue('G'.$eje_y, $nt->nombre_medio );
				$sheet->setCellValue('H'.$eje_y, $nt->nombre_tipo );
				$sheet->setCellValue('I'.$eje_y, $nt->nombre_cuestionario );
				$sheet->setCellValue('J'.$eje_y, $nt->username);
				$sheet->setCellValue('K'.$eje_y, $nt->nombre_universidad);
				$sheet->setCellValue('L'.$eje_y, $nt->nombre_departamento);

				$eje_y++;
			endforeach;



			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");
		}else{
			$this->mensaje('No existen datos', 'warning');
			redirect('ManejoDB/reportesSimples');
		}

		/*if(!empty($consulta))
		{
			$filename = "reporte-tema.xlsx";
			$ruta = 'assets/info/';
			$plantilla = $ruta.'plantilla-universidad.xlsx';
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');

			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getActiveSheet();
			$worksheet = $spreadsheet->getActiveSheet();
			$eje_y = 6;

			//Colocar el tipo de medio
			$tema = $this->Universidad_model->leerTemaPorId($consulta->idtema);
			$sheet->setCellValue('E3', $tema->nombre_tema);

			foreach ($noticias as $n):

				$nt = $this->Noticia_model->noticiaPorId($n->idnoticia);

				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $nt->fecha_registro));
				$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $nt->fecha_noticia));
				$sheet->setCellValue('D'.$eje_y, $nt->titular);
				$sheet->setCellValue('E'.$eje_y, $nt->resumen);
				$sheet->setCellValue('F'.$eje_y, $nt->url_noticia);
				$sheet->setCellValue('G'.$eje_y, $nt->nombre_medio );
				$sheet->setCellValue('H'.$eje_y, $nt->nombre_tipo );
				$sheet->setCellValue('I'.$eje_y, $nt->nombre_cuestionario );
				$sheet->setCellValue('J'.$eje_y, $nt->username);
				$sheet->setCellValue('K'.$eje_y, $nt->nombre_universidad);
				$sheet->setCellValue('L'.$eje_y, $nt->nombre_departamento);

				$eje_y++;
			endforeach;

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");
		}else{
			$this->mensaje('No existen datos', 'warning');
			redirect('ManejoDB/reportesSimples');
		}*/
	}

	public function downloadTipomedio()
	{
		$consulta = $this->session->consulta_tipomedio;
		$this->session->unset_userdata("consulta_tipomedio");
		$noticias = $this->Noticia_model->noticiaPorTipomedio($consulta);

		if(!empty($consulta))
		{
			$filename = "reporte-tipo-medio.xlsx";
			$ruta = 'assets/info/';
			$plantilla = $ruta.'plantilla-tipomedio.xlsx';
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');

			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getActiveSheet();
			$worksheet = $spreadsheet->getActiveSheet();
			$eje_y = 6;

			//Colocar el tipo de medio
			$tipo_medio = $this->Cuestionario_model->leerTipoMedioPorId($consulta->idtipomedio);
			$sheet->setCellValue('E3', $tipo_medio->nombre_tipo);

			foreach ($noticias as $n):
				$sheet->setCellValue('A'.$eje_y, $n->idnoticia);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_registro));
				$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $n->fecha_noticia));
				$sheet->setCellValue('D'.$eje_y, $n->titular);
				$sheet->setCellValue('E'.$eje_y, $n->resumen);
				$sheet->setCellValue('F'.$eje_y, $n->url_noticia);
				$sheet->setCellValue('G'.$eje_y, $n->nombre_medio );
				$sheet->setCellValue('H'.$eje_y, $n->nombre_tipo );
				$sheet->setCellValue('I'.$eje_y, $n->nombre_cuestionario );
				$sheet->setCellValue('J'.$eje_y, $n->username);
				$sheet->setCellValue('K'.$eje_y, $n->nombre_universidad);
				$sheet->setCellValue('L'.$eje_y, $n->nombre_departamento);

				$eje_y++;
			endforeach;

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");
		}else{
			$this->mensaje('No existen datos', 'warning');
			redirect('ManejoDB/reportesSimples');
		}
	}

	public function downloadCuestionario()
	{
		$consulta = $this->session->consulta_cuestionario;
		$this->session->unset_userdata("consulta_cuestionario");
		$noticias = $this->Noticia_model->noticiaPorCuestionario($consulta);
		$cuestionario = $this->Cuestionario_model->leerCuestionario($consulta->idcuestionario);

		if(!empty($consulta))
		{
			$filename = "reporte-cuestionario.xlsx";
			$ruta = 'assets/info/';

			$plantilla = $ruta.'plantilla-formulario.xlsx';

			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');

			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getActiveSheet();
			$worksheet = $spreadsheet->getActiveSheet();
			$sheet->setCellValue('E3', $cuestionario->nombre_cuestionario);
			$eje_y = 6;
			foreach ($noticias as $n):
				$sheet->setCellValue('A'.$eje_y, $n->idnoticia);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_registro));
				$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $n->fecha_noticia));
				$sheet->setCellValue('D'.$eje_y, $n->titular);
				$sheet->setCellValue('E'.$eje_y, $n->resumen);
				$sheet->setCellValue('F'.$eje_y, $n->url_noticia);
				$sheet->setCellValue('G'.$eje_y, $n->nombre_medio );
				$sheet->setCellValue('H'.$eje_y, $n->nombre_tipo );
				$sheet->setCellValue('I'.$eje_y, $n->nombre_cuestionario );
				$sheet->setCellValue('J'.$eje_y, $n->username);
				$sheet->setCellValue('K'.$eje_y, $n->nombre_universidad);
				$sheet->setCellValue('L'.$eje_y, $n->nombre_departamento);

				$eje_y++;
			endforeach;

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");
		}else{
			$this->mensaje('No existen datos', 'warning');
			redirect('ManejoDB/reportesSimples');
		}
	}
	public function downloadDepartamento()
	{
		$consulta = $this->session->consulta_departamento;
		$this->session->unset_userdata("consulta_departamento");
		$noticias = $this->Noticia_model->noticiaPorDepartamento($consulta);
		$departamento = $this->Departamento_model->leerDepartamento($consulta->iddepartamento);

		if(!empty($consulta))
		{
			$filename = "reporte-departamento.xlsx";
			$ruta = 'assets/info/';
			$plantilla = $ruta.'plantilla-departamento.xlsx';
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');

			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getActiveSheet();
			$worksheet = $spreadsheet->getActiveSheet();
			$eje_y = 6;
			$sheet->setCellValue('E3', $departamento->nombre_departamento);
			foreach ($noticias as $n):
				$sheet->setCellValue('A'.$eje_y, $n->idnoticia);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_registro));
				$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $n->fecha_noticia));
				$sheet->setCellValue('D'.$eje_y, $n->titular);
				$sheet->setCellValue('E'.$eje_y, $n->resumen);
				$sheet->setCellValue('F'.$eje_y, $n->url_noticia);
				$sheet->setCellValue('G'.$eje_y, $n->nombre_medio );
				$sheet->setCellValue('H'.$eje_y, $n->nombre_tipo );
				$sheet->setCellValue('I'.$eje_y, $n->nombre_cuestionario );
				$sheet->setCellValue('J'.$eje_y, $n->username);
				$sheet->setCellValue('K'.$eje_y, $n->nombre_universidad);
				$sheet->setCellValue('L'.$eje_y, $n->nombre_departamento);

				$eje_y++;
			endforeach;

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");
		}else{
			$this->mensaje('No existen datos', 'warning');
			redirect('ManejoDB/reportesSimples');
		}
	}
	public function downloadActor()
	{
		$consulta = $this->session->consulta_actor;
		$this->session->unset_userdata("consulta_actor");
		$noticias = $this->Noticia_model->noticiaPorActor($consulta);
		$actor = $this->Actor_model->leerActorID($consulta->idactor);

		if(!empty($consulta))
		{
			$filename = "reporte-actor.xlsx";
			$ruta = 'assets/info/';
			$plantilla = $ruta.'plantilla-actor.xlsx';
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');

			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getActiveSheet();
			$worksheet = $spreadsheet->getActiveSheet();
			$sheet->setCellValue('E3', $actor->nombre_actor );
			$eje_y = 6;
			foreach ($noticias as $n):
				$sheet->setCellValue('A'.$eje_y, $n->idnoticia);
				$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_registro));
				$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $n->fecha_noticia));
				$sheet->setCellValue('D'.$eje_y, $n->titular);
				$sheet->setCellValue('E'.$eje_y, $n->resumen);
				$sheet->setCellValue('F'.$eje_y, $n->url_noticia);
				$sheet->setCellValue('G'.$eje_y, $n->nombre_medio );
				$sheet->setCellValue('H'.$eje_y, $n->nombre_tipo );
				$sheet->setCellValue('I'.$eje_y, $n->nombre_cuestionario );
				$sheet->setCellValue('J'.$eje_y, $n->username);
				$sheet->setCellValue('K'.$eje_y, $n->nombre_universidad);
				$sheet->setCellValue('L'.$eje_y, $n->nombre_departamento);

				$eje_y++;
			endforeach;

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");
		}else{
			$this->mensaje('No existen datos', 'warning');
			redirect('ManejoDB/reportesSimples');
		}
	}
	public function procesarConsultasimple()
	{
		/*
		 *
		 * Redireccion a reportes simples
		 *
		 */
		$consulta = $this->objetoConsulta();
//                echo "<pre>";var_dump($consulta);echo "</pre>";
		if($consulta->fecha_inicio > $consulta->fecha_fin) //Comprobacion del intervalo de fechas
		{
			$this->mensaje('Intervalo de fechas incorrecto', 'warning');
			redirect('ManejoDB/reportesSimples');
		}
		else{
			/** @noinspection PhpLanguageLevelInspection */
			//Reporte por cuestionario
			if(!empty($this->input->post('cuestionario')))
			{
				if($consulta->idcuestionario == 0)
				{
					$this->mensaje('Sin seleccion', 'warning');
					redirect('ManejoDB/reportesSimples');
				}else{
                                    $cuestionario = $this->Noticia_model->noticiaPorCuestionario($consulta);
					if(empty($cuestionario))
					{
						//Si la consulta esta vacia no se genera reporte
						$this->mensaje('No existen resultados', 'info');
						redirect('ManejoDB/reportesSimples');
					}
					else{
						//Cargar los datos a las session
						$this->session->set_userdata('consulta_cuestionario', []);
						$this->session->set_userdata('consulta_cuestionario', $consulta);
						redirect('ManejoDB/downloadCuestionario');
					}
                                    //Redireccion a rutina de reporte
//					echo "cuestionario";
				}
			}
			elseif (!empty($this->input->post('departamento')))  //Reporte por departamento
			{
				if($consulta->iddepartamento == 0)
				{
					$this->mensaje('Sin seleccion', 'warning');
					redirect('ManejoDB/reportesSimples');
				}else{
                                    $departamento = $this->Noticia_model->noticiaPorDepartamento($consulta);
					if(empty($departamento))
					{
						//Si la consulta esta vacia no se genera reporte
						$this->mensaje('No existen resultados', 'info');
						redirect('ManejoDB/reportesSimples');
					}
					else{
						//Cargar los datos a las session
						$this->session->set_userdata('consulta_departamento', []);
						$this->session->set_userdata('consulta_departamento', $consulta);
						redirect('ManejoDB/downloadDepartamento');
					}
					//Redireccion a rutina de reporte
				}
			}
			elseif (!empty($this->input->post('tipomedio'))) //Reporte por tipo de medio
			{
				if($consulta->idtipomedio == 0)
				{
					$this->mensaje('Sin seleccion', 'warning');
					redirect('ManejoDB/reportesSimples');
				}else{
					//Rutina de reporte
					$noticias = $this->Noticia_model->noticiaPorTipomedio($consulta);
					if(empty($noticias))
					{
						//Si la consulta esta vacia no se genera reporte
						$this->mensaje('No existen resultados', 'info');
						redirect('ManejoDB/reportesSimples');
					}
					else{
						//Cargar los datos a las session
						$this->session->set_userdata('consulta_tipomedio', []);
						$this->session->set_userdata('consulta_tipomedio', $consulta);
						redirect('ManejoDB/downloadTipomedio');
					}
				}
			}
			elseif (!empty($this->input->post('medio'))) //Reporte por medio
			{
				if($consulta->idmedio == 0)
				{
					$this->mensaje('Sin seleccion', 'warning');
					redirect('ManejoDB/reportesSimples');
				}else{
					//Redireccion a rutina de reporte

				}
			}
			elseif (!empty($this->input->post('actor'))) //Reporte por actor
			{
				if($consulta->idactor == 0)
				{
					$this->mensaje('Sin seleccion', 'warning');
					redirect('ManejoDB/reportesSimples');
				}else{
                                    $actor = $this->Noticia_model->noticiaPorActor($consulta);
					if(empty($actor))
					{
						//Si la consulta esta vacia no se genera reporte
						$this->mensaje('No existen resultados', 'info');
						redirect('ManejoDB/reportesSimples');
					}
					else{
						//Cargar los datos a las session
						$this->session->set_userdata('consulta_actor', []);
						$this->session->set_userdata('consulta_actor', $consulta);
						redirect('ManejoDB/downloadActor');
					}
					//Redireccion a rutina de reporte
				}
			}
			elseif (!empty($this->input->post('universidad'))) //Reporte por universidad
			{
				if($consulta->iduniversidad == 0)
				{
					$this->mensaje('Sin seleccion', 'warning');
					redirect('ManejoDB/reportesSimples');
				}else{
					//Redireccion a rutina de reporte
					$noticias = $this->Noticia_model->noticiaPorUniversidad($consulta);
					if(empty($noticias))
					{
						//Si la consulta esta vacia no se genera reporte
						$this->mensaje('No existen resultados', 'info');
						redirect('ManejoDB/reportesSimples');
					}
					else{
						//Cargar los datos a las session
						$this->session->set_userdata('consulta_universidad', []);
						$this->session->set_userdata('consulta_universidad', $consulta);
						redirect('ManejoDB/downloadUniversidad');
					}
				}
			}
			elseif (!empty($this->input->post('tema'))) //Reporte por tema
			{
				if($consulta->idtema == 0)
				{
					$this->mensaje('Sin seleccion', 'warning');
					redirect('ManejoDB/reportesSimples');
				}else{
					//Redireccion a rutina de reporte
					$noticias = $this->Noticia_model->noticiaPorTemas($consulta);
					if(empty($noticias))
					{
						//Si la consulta esta vacia no se genera reporte
						$this->mensaje('No existen resultados', 'info');
						redirect('ManejoDB/reportesSimples');
					}
					else{
						//Cargar los datos a las session
						$this->session->set_userdata('consulta_tema', []);
						$this->session->set_userdata('consulta_tema', $consulta);
						redirect('ManejoDB/downloadTema');
					}
				}
			}
			elseif (!empty($this->input->post('subtema'))) //Reporte por subtema
			{
				if($consulta->idsubtema == 0)
				{
					$this->mensaje('Sin seleccion', 'warning');
					redirect('ManejoDB/reportesSimples');
				}else{
					//Redireccion a rutina de reporte
				}
			}
			else{
				$this->mensaje('Error', 'danger');
				redirect('ManejoDB/reportesSimples');
			}

		}
	}

	public function prueba($consulta)
	{
		echo $consulta->fecha_inicio;
		echo $consulta->fecha_fin;
	}


	public function procesarConsulta()
	{
		//Primer validador
		$consulta = $this->objetoConsulta();

		if($consulta->fecha_inicio > $consulta->fecha_fin)
		{
			$this->mensaje('Intervalo de fechas incorrecto', 'warning');
			redirect('ManejoDB');
		}else{
			//var_dump($consulta);
			$noticias = $this->Noticia_model->reporteNoticias($consulta);
			$noticias_datos = $this->Noticia_model->reportesNoticiasDatos($consulta);
			if(empty($noticias_datos))
			{
				//Si la consulta esta vacia no se genera reporte
				$this->mensaje('No existen resultados', 'info');
				redirect('ManejoDB/reportesCompuestos');
			}
			else{
				//Cargar los datos a las session
				$this->session->set_userdata('consulta', []);
				$this->session->set_userdata('consulta', $consulta);


				redirect('ManejoDB/download');
			}







			/*$noticias = $this->Noticia_model->reporteNoticias($consulta);
			$noticias_datos = $this->Noticia_model->reportesNoticiasDatos($consulta);

			//var_dump($idnoticias);

			$data['idnoticias'] = $noticias;
			$data['noticias'] = $noticias_datos;



			$this->load->view('html/encabezado');
			$this->load->view('html/navbar');
			$this->load->view('manejodb/vexportar_fecha', $data);
			$this->load->view('html/pie');*/

		}
	}



	private function objetoConsulta()
	{
		$ids = new stdClass();
		$ids->fecha_inicio = '';
		$ids->fecha_fin = '';
		$ids->idcuestionario = '';
		$ids->iddepartamento = '';
		$ids->idtipomedio = '';
		$ids->idmedio = '';
		$ids->idactor = '';
		$ids->iduniversidad = '';
		$ids->idtema = '';
		$ids->idsubtema = '';

		//Capturar datos
		$ids->fecha_inicio = $this->fecha_unix($this->input->post('fecha_inicio'));
		$ids->fecha_fin = $this->fecha_unix($this->input->post('fecha_fin')) ;
		$ids->idcuestionario = $this->input->post('idcuestionario');
		$ids->iddepartamento = $this->input->post('iddepartamento');
		$ids->idtipomedio = $this->input->post('idtipomedio');
		$ids->idmedio = $this->input->post('idmedio');
		$ids->idactor = $this->input->post('idactor');
		$ids->iduniversidad = $this->input->post('iduniversidad');
		$ids->idtema = $this->input->post('idtema');
		$ids->idsubtema = $this->input->post('idsubtema');


		return $ids;
	}

	//Despliegue de mensaje
	public function mensaje($mensaje, $clase){
		/** @noinspection PhpLanguageLevelInspection */
		$this->session->set_flashdata([
			'mensaje' => $mensaje,
			'clase' => $clase,
		]);
	}

	private function fecha_unix($fecha)
	{
		$fecha_std = str_replace('/', '-', $fecha);
		$fecha_unix = strtotime($fecha_std);
		return $fecha_unix;
	}

	//Metodos de respuestas json
	public function getMedios()
	{
		$json = array();
		$this->Cuestionario_model->setTipoMedioID($this->input->post('tipomedioID'));
		$this->Cuestionario_model->setDepartamentoID($this->session->iddepartamento);
		$json = $this->Cuestionario_model->leerMedios();
		header('Content-Type: application/json');
		echo json_encode($json);
	}

	//Metodo de respuestas json
	public function getsubtema()
	{
		$json = array();
		$this->Cuestionario_model->setTemaID($this->input->post('temaID'));
		$this->Cuestionario_model->setDepartamentoID(1);
		$json = $this->Cuestionario_model->leerSubtema();
		header('Content-Type: application/json');
		echo json_encode($json);
	}

	//
	public function noticiasAdministrador()
	{
		//$usuario = $this->ion_auth->user()->row();
		//$cantidad_noticia = $this->session->noticia_editable;

		if(is_null($this->session->datos_formulario))
		{
			$dt['hay_cambio_pendiente'] = false;
		}
		else{
			$dt['hay_cambio_pendiente'] = true;
		}




		$dt['noticias'] =$this->Noticia_model->leerTodasLasNoticias();
		//$dt['cuestionario'] = $this->Cuestionario_model->leerCuestionario($this->_idformulario);
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('manejodb/vmanejodb_listanot', $dt);
		$this->load->view('html/pie');

	}

	public function cambiarEstado($identificador)
	{
		$idnoticia = $identificador;
		$noticia = $this->Noticia_model->noticiaPorId($idnoticia);
		if($noticia->esta_activa)
		{
			//Esta activa, funcion complementaria
			$estado = 0;
		}else{
			//No esta activa, funcion complementaria
			$estado = 1;
		}
		$this->Noticia_model->cambiarEstado($idnoticia, $estado);
		redirect('manejoDB/noticiasAdministrador');
	}

	//Crear las variables de session para el proceso
	public function iniciarCambioFormulario($identificador)
	{
		//Crear las variables de session
		$noticia = $this->Noticia_model->leerNoticiaPorId($identificador);
		$cambio_iniciado = true;
		$formulario_cambiado = false;

		/** @noinspection PhpLanguageLevelInspection */
		$datos_formulario = [
			'noticia' => $noticia,
			'cambio_iniciado' => $cambio_iniciado,
			'formulario_cambiado' => $formulario_cambiado,
			'temas_ajustados' => false,
			'otros_temas_ajustados' => false,
			'subtemas_ajustados' => false,
			'otros_subtemas_ajustados' => false,
			'nuevo_idcuestionario' => 0,
		];

		//Crear la variable de session
		$this->session->set_userdata('datos_formulario', []);
		$this->session->set_userdata('datos_formulario', $datos_formulario);
		redirect('manejoDB/cambiarFormulario/');
	}
	public function cancelarCambioFormulario()
	{
		//Destruir las variables de session para el cambio de formulario
		$this->session->unset_userdata('datos_formulario');
		$this->mensaje('Cambio de Ambito cancelado', 'info');
		redirect('inicio');
	}

	//Rutina para el cambio de formulario
	public function cambiarFormulario()
	{
		//Extraer las variables de session
		//var_dump($this->session->userdata());
		$datos_formulario = $this->session->datos_formulario;
		$noticia = $datos_formulario['noticia'];
		$cuestionario = $this->Cuestionario_model->leerCuestionario($noticia->rel_idcuestionario);
		$medio = $this->MedioComunicacion_model->leerMedioPorId($noticia->rel_idmedio);
		$tipo_medio = $this->MedioComunicacion_model->leerTipoMedioPorId($medio->rel_idtipomedio);
		$actores = $this->Actor_model->leerActoresNoticia($noticia->idnoticia);
		$temas = $this->Tema_model->leerTemasDeUnaNoticia($noticia->idnoticia);
		$subtemas = $this->SubTema_model->leerSubtemasDeUnaNoticia($noticia->idnoticia);
		$otrotema = $this->Tema_model->leerOtrotemaDeUnaNoticia($noticia->idnoticia);
		$otrossubtemas = $this->SubTema_model->leerOtrossubtemasDeUnaNoticia($noticia->idnoticia);
		$cambio_iniciado = $datos_formulario['cambio_iniciado'];
		$formulario_cambiado = $datos_formulario['formulario_cambiado'];
		$temas_ajustados = $datos_formulario['temas_ajustados'];
		$otros_temas_ajustados = $datos_formulario['otros_temas_ajustados'];
		$subtemas_ajustados = $datos_formulario['subtemas_ajustados'];
		$otros_subtemas_ajustados = $datos_formulario['otros_subtemas_ajustados'];
		$nuevo_idcuestionario = $datos_formulario['nuevo_idcuestionario'];
		$nuevo_cuestionario = $this->Cuestionario_model->leerCuestionario($nuevo_idcuestionario);

		$datos['noticia'] = $noticia;
		$datos['cuestionario'] = $cuestionario;
		$datos['medio'] = $medio;
		$datos['tipo_medio'] = $tipo_medio;
		$datos['actores'] = $actores;
		$datos['temas'] = $temas;
		$datos['subtemas'] = $subtemas;
		$datos['otrotema'] = $otrotema;
		$datos['otrossubtemas'] = $otrossubtemas;
		$datos['cambio_inciado'] = $cambio_iniciado;
		$datos['formulario_cambiado'] = $formulario_cambiado;
		$datos['temas_ajustados'] = $temas_ajustados;
		$datos['otros_temas_ajustados'] = $otros_temas_ajustados;
		$datos['subtemas_ajustados'] = $subtemas_ajustados;
		$datos['otros_subtemas_ajustados'] = $otros_subtemas_ajustados;
		$datos['nuevo_idcuestionario'] = $nuevo_idcuestionario;
		$datos['nuevo_cuestionario'] = $nuevo_cuestionario;
		$datos['forms'] = $this->Formulario_model->leerCuestionarios();

		//Temas seleccionados
		if(isset($datos_formulario['temas_nuevos']) && !empty($datos_formulario['temas_nuevos']) )
		{
			$this->Cuestionario_model->setTemaIDs($datos_formulario['temas_nuevos']);
			$temas_sel = $this->Cuestionario_model->leerTemasPorIDs();
			$subtemas_sel = $this->Cuestionario_model->leerSubtemasPorIDs();
			$datos['temas_n'] = $temas_sel;
			$datos['subtemas_sel'] = $subtemas_sel;
		}

		//Otro tema
		if(isset($datos_formulario['otrotema_nuevo']))
		{
			$datos['otrotema_n'] = $datos_formulario['otrotema_nuevo'];
		}

		//Subtemas seleccionados
		$subtemas_elegidos = [];

		if(isset($datos_formulario['subtemas_nuevos']) && !empty($datos_formulario['subtemas_nuevos']) )
		{
			$temas = $datos_formulario['temas_nuevos'];
			$subtemas = $datos_formulario['subtemas_nuevos'];
			//var_dump($subtemas);
			//echo "<br>";
			foreach ($temas as $t)
			{
				//echo "tema: ".$t."<br>";
				$stemas = $subtemas[$t];
				foreach ($stemas as $st)
				{
					//echo "subtema:  ".$st."<br>";
					$subtemas_elegidos[] = $this->SubTema_model->leerSubtemaPorIDs($st);
				}
			}
			$datos['subtemas_n'] = $subtemas_elegidos;
		}



		
		//Otros subtemas
		$otrossubtemas_despliegue = [];
		if($datos_formulario['otros_subtemas_ajustados'])
		{
			if(!empty($datos_formulario['otrossubtemas_nuevos']))
			{
				$temas = $datos_formulario['temas_nuevos'];
				$otrossubtemas = $datos_formulario['otrossubtemas_nuevos'];
				foreach ($temas as $t)
				{
					$tema = $this->Tema_model->leerTemaPorId($t);
					$otrosubtema = $otrossubtemas[$t];
					if($otrosubtema != ''){
						$otrossubtemas_despliegue[] = $otrosubtema." (".$tema->nombre_tema.")";
					}
				}
			}
			$datos['otrossubtemas_n'] = $otrossubtemas_despliegue;
		}


		//Temas para rellenado
		$this->Cuestionario_model->setCuestionarioID($nuevo_idcuestionario);
		$datos['temas_nuevos'] = $this->Cuestionario_model->leerTema();


		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('manejodb/vmanejodb_cambioform', $datos);
		$this->load->view('html/pie');
	}
	//Cambiar Ambito
	public function cambiarAmbito()
	{
		//Define el nuevo formulario
		$datos_formulario = $this->session->datos_formulario;
		$datos_formulario['formulario_cambiado']= true;
		$datos_formulario['nuevo_idcuestionario'] = $this->input->post('idcuestionario');
		//Actualizar la variable de estado
		$this->session->set_userdata('datos_formulario', []);
		$this->session->set_userdata('datos_formulario', $datos_formulario);
		$this->mensaje('Cambio de Ambito exitoso', 'info');
		redirect('manejoDB/cambiarFormulario/');
	}


	//Capturar nuevos temas
	public function cambiarTemas()
	{
		//Capturar los nuevos temas
		$datos_formulario = $this->session->datos_formulario;
		$datos_formulario['temas_ajustados']= true;
		//Capturar temas
		$datos_formulario['temas_nuevos'] = $this->input->post('idtema[]');
		//Actualizar la variable de estado
		$this->session->set_userdata('datos_formulario', []);
		$this->session->set_userdata('datos_formulario', $datos_formulario);
		$this->mensaje('Nuevos Temas Definidos', 'info');
		redirect('manejoDB/cambiarFormulario/');
	}

	//Capturar Otro tema
	public function cambiarOtroTema()
	{
		//Capturar los nuevos temas
		$datos_formulario = $this->session->datos_formulario;
		$datos_formulario['otros_temas_ajustados']= true;
		//Capturar temas
		$datos_formulario['otrotema_nuevo'] = $this->input->post('otrotema');
		//Actualizar la variable de estado
		$this->session->set_userdata('datos_formulario', []);
		$this->session->set_userdata('datos_formulario', $datos_formulario);
		$this->mensaje('Otro Tema Definidos', 'info');
		redirect('manejoDB/cambiarFormulario/');
	}

	//Cambiar subtemas
	public function cambiarSubtemas()
	{
		//Capturar los nuevos temas
		$datos_formulario = $this->session->datos_formulario;
		$datos_formulario['subtemas_ajustados']= true;


		$idtemas = $datos_formulario['temas_nuevos'];

		//Comprobar si hay subtemas nulos
		foreach ($idtemas as $t)
		{
			if(is_null($this->input->post('tema'.$t)))
			{
				$this->mensaje('Seleccione un subtema por tema', 'warning');
				redirect('manejoDB/cambiarFormulario/');
			}
		}

		//Capturar subtemas
		$subtemas = [];
		foreach ($idtemas as $t)
		{
			$subtemas[$t] = $this->input->post('tema'.$t);
		}
		$datos_formulario['subtemas_nuevos'] = $subtemas;
		//Actualizar la variable de estado
		$this->session->set_userdata('datos_formulario', []);
		$this->session->set_userdata('datos_formulario', $datos_formulario);
		$this->mensaje('Nuevos subtemas Definidos', 'info');
		redirect('manejoDB/cambiarFormulario/');
	}

	public function cambiarOtroSubtema()
	{
		//Capturar los nuevos temas
		$datos_formulario = $this->session->datos_formulario;
		$datos_formulario['otros_subtemas_ajustados']= true;

		$idtemas = $datos_formulario['temas_nuevos'];


		//Capturar otros subtemas
		$otros_subtemas = [];
		foreach ($idtemas as $t)
		{
			$otros_subtemas[$t] = $this->input->post('otrosubtema'.$t);
		}

		$otros_subtemas = $otros_subtemas;



		$datos_formulario['otrossubtemas_nuevos'] = $otros_subtemas;
		//Actualizar la variable de estado
		$this->session->set_userdata('datos_formulario', []);
		$this->session->set_userdata('datos_formulario', $datos_formulario);
		$this->mensaje('Otros subtemas Definidos', 'info');
		redirect('manejoDB/cambiarFormulario/');
	}

	public function aplicarCambios()
	{
		$datos_formulario = $this->session->datos_formulario;
		if($this->Noticia_model->cambioCuestionario($datos_formulario))
		{
			//Destruir variable de session datos_formulario
			$this->session->set_userdata('datos_formulario', []);
			$this->session->unset_userdata('datos_formulario');
			//Mensaje de confirmacion
			$this->mensaje('Cambio de ambito exitoso', 'success');
			redirect('inicio/');
		}else{
			$this->mensaje('Error en el cambio de ambito', 'alert');
			redirect('manejoDB/cambiarFormulario/');
		}
	}

	public function plenariaAdministrador(){

		$plenarias = $this->Plenaria_model->leerTodasLasPlenarias();


		$data['plenarias'] = $plenarias;
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('manejodb/vmanejodb_listaplenarias', $data);
		$this->load->view('html/pie');


	}

	public function normativaAdministrador(){
		$normas = $this->Norma_model->leerNormasRegistradas();


		$data['normas'] = $normas;
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('manejodb/vmanejodb_listanormas', $data);
		$this->load->view('html/pie');

	}

	public function cambiarEstadoPlenaria($identificador)
	{
		$idplenaria = $identificador;
		$plenaria = $this->Plenaria_model->leerPlenariaPorId($idplenaria);
		if($plenaria->activo)
		{
			//Esta activa, funcion complementaria
			$estado = 0;
		}else{
			//No esta activa, funcion complementaria
			$estado = 1;
		}
		$this->Plenaria_model->cambiarEstado($idplenaria, $estado);
		redirect('manejoDB/plenariaAdministrador');
	}

	public function cambiarEstadoNorma($identificador){
		$idnorma = $identificador;
		$norma = $this->Norma_model->leerNormaPlurinacionalPorId($idnorma);
		if($norma->activo)
		{
			//Esta activa, funcion complementaria
			$estado = 0;
		}else{
			//No esta activa, funcion complementaria
			$estado = 1;
		}
		$this->Norma_model->cambiarEstado($idnorma, $estado);
		redirect('manejoDB/plenariaAdministrador');
	}

	public function reportePlenarias(){
		$usuario = $this->ion_auth->user()->row();
		$instancia = $this->Instanciaseguimiento_model->leerInstancias();
		$departamentos = $this->Departamento_model->leerDepartamentos();

		$data['usuario'] = $usuario;
		$data['instancia'] = $instancia;
		$data['departamentos'] = $departamentos;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('manejodb/vmanejodb_repplenaria', $data);
		$this->load->view('html/pie');
	}

	public function normativaReportes(){
		$usuario = $this->ion_auth->user()->row();
		$instancia = $this->Instanciaseguimiento_model->leerInstancias();
		$departamentos = $this->Departamento_model->leerDepartamentos();

		$data['usuario'] = $usuario;
		$data['instancia'] = $instancia;
		$data['departamentos'] = $departamentos;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('manejodb/vmanejodb_repnormativa', $data);
		$this->load->view('html/pie');
	}

	public function procesarReportePlenaria()
	{
		//Primer validador
		//$consulta = $this->objetoConsulta();
		if($this->session->has_userdata('consultaplenaria')){
			$this->session->unset_userdata('consultaplenaria');
		}

		$consulta = $this->objetoReporteConsulta();
		if($consulta->fecha_inicio > $consulta->fecha_fin){
			$this->mensaje('Intervalo de fechas incorrecto', 'warning');
			redirect('ManejoDB/reportePlenarias');
		}else{
			//var_dump($consulta);
			//vaciar la variable de session
			$this->session->set_userdata('consultaplenaria', $consulta);
			//print_r($this->session->userdata());
			redirect('ManejoDB/downloadreporteplenaria');
		}

	}
	public function procesarReporteNormativa(){
		if($this->session->has_userdata('consultanormativa')){
			$this->session->unset_userdata('consultanormativa');
		}
		$consulta = $this->objetoReporteConsulta();
		$consulta = $this->objetoReporteConsulta();
		if($consulta->fecha_inicio > $consulta->fecha_fin){
			$this->mensaje('Intervalo de fechas incorrecto', 'warning');
			redirect('ManejoDB/normativaReportes');
		}else{
			//var_dump($consulta);
			//vaciar la variable de session
			$this->session->set_userdata('consultanormativa', $consulta);
			//print_r($this->session->userdata());
			redirect('ManejoDB/downloadreportenormativa');
		}
	}

	public function objetoReporteConsulta()
	{
		$ids = new stdClass();
		$ids->fecha_inicio = '';
		$ids->fecha_fin = '';

		$ids->idinstancia = '';
		$ids->iddepartamento = '';
		$ids->idmunicipio = '';

		//Capturar datos
		$ids->fecha_inicio = $this->fecha_unix($this->input->post('fecha_inicio'));
		$ids->fecha_fin = $this->fecha_unix($this->input->post('fecha_fin')) ;
		$ids->idinstancia = $this->input->post('idinstanciaple');
		$ids->iddepartamento = $this->input->post('iddepple');
		$ids->idmunicipio = $this->input->post('idmunple');

		return $ids;
	}

	public function downloadreportenormativa(){
		$consulta = $this->session->consultanormativa;
		$this->session->unset_userdata('consultanormativa');
		$normativas = '';
		if(!empty($consulta)){
			$filename = "reporte-normativas.xlsx";
			$ruta = 'assets/info/';
			if($consulta->idinstancia == 1){
				$plantilla = $ruta.'plantilla-reportes-normativa-plurinacional.xlsx';
				header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
				header('Content-Disposition: attachment; filename="' . $filename. '"');
				header('Cache-Control: max-age=0');
				$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
				$sheet = $spreadsheet->getSheet(0)->setTitle('Normativas');
				$sheet->setCellValue('D3', 'INSTANCIA:');
				//Instancia Plurinacional
				$sheet->setCellValue('E3', 'Asamblea Legislativa Plurinacional');
				$normas = $this->Norma_model->reporteNormaPlurinacional($consulta);
				$eje_y = 7;
				foreach ($normas as $n):
					$sheet->setCellValue('A'.$eje_y, $n->idnormag);
					$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_registro));
					$sheet->setCellValue('C'.$eje_y, $n->username);
					$sheet->setCellValue('D'.$eje_y, $n->obs_metodologicas );
					$sheet->setCellValue('E'.$eje_y, $n->norma_codigo );
					$sheet->setCellValue('F'.$eje_y, $n->norma_nombre );
					$sheet->setCellValue('G'.$eje_y, $n->norma_objeto );
					$tema1 = $this->Norma_model->leerTemaNorma($n->idnormag, 1);
					if( $tema1 == false){
						//Es otro tema 1
						$otrotema1 = $this->Norma_model->otroTemaNorma($n->idnormag, 1);
						if(isset($otrotema1)){
							$sheet->setCellValue('H'.$eje_y, $otrotema1->descripcion_otrotema );
						}
					}else{
						//Tema 1
						$sheet->setCellValue('H'.$eje_y, $tema1->nombre_tema );
					}
					$tema2 = $this->Norma_model->leerTemaNorma($n->idnormag, 2);
					if($tema2 == false){
						//Es otro tema 2
						$otrotema2 = $this->Norma_model->otroTemaNorma($n->idnormag, 2);
						if(isset($otrotema2)){
							$sheet->setCellValue('I'.$eje_y, $otrotema2->descripcion_otrotema);
						}
					}else{
						//Tema 2
						$sheet->setCellValue('I'.$eje_y, $tema2->nombre_tema );
					}
					$otroProponente = $this->Norma_model->leerNormaOtroPropID($n->idnormag);
					if($n->proponente == 'Otros'){
						if($otroProponente != false){
							$sheet->setCellValue('J'.$eje_y, 'Otros - '.$otroProponente->otro_descripcion );
						}
					}else{
						$sheet->setCellValue('J'.$eje_y, $n->proponente );
					}
					$sheet->setCellValue('K'.$eje_y, $n->norma_remitente);
					$sheet->setCellValue('L'.$eje_y, $n->norma_destinatario);
					if( isset($n->fecha_norma)){
						if($n->fecha_norma != 0){
							$sheet->setCellValue('M'.$eje_y, mdate('%m-%d-%Y', $n->fecha_norma));
						}
					}else{
						$sheet->setCellValue('M'.$eje_y, '');
					}
					$sheet->setCellValue('N'.$eje_y, $n->proponente_solrepo);
					$sheet->setCellValue('O'.$eje_y, $n->destinatario_solrepo);
					if( isset($n->fecha_sol_repo)){
						if($n->fecha_sol_repo != 0){
							$sheet->setCellValue('P'.$eje_y, mdate('%m-%d-%Y', $n->fecha_sol_repo));
						}
					}else{
						$sheet->setCellValue('P'.$eje_y, '');
					}
					$sheet->setCellValue('Q'.$eje_y, $n->norma_observaciones);
					$sheet->setCellValue('R'.$eje_y, $n->enlace);

					$eje_y++;
				endforeach;

			}
			elseif ($consulta->idinstancia == 2){
				$plantilla = $ruta.'plantilla-reportes-normativa.xlsx';
				header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
				header('Content-Disposition: attachment; filename="' . $filename. '"');
				header('Cache-Control: max-age=0');
				$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
				$sheet = $spreadsheet->getSheet(0)->setTitle('Normativas');
				$sheet->setCellValue('D3', 'INSTANCIA:');
				//Departamental
				$sheet->setCellValue('E3', 'Asamblea Legislativa Departamental');
				$normas = $this->Norma_model->reporteNormaDepartamental($consulta);
				$eje_y = 6;

				foreach ($normas as $n):
					$sheet->setCellValue('A'.$eje_y, $n->idnormag);
					$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_registro));
					if($n->fecha_norma != 0){
						$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $n->fecha_norma));
					}else{
						$sheet->setCellValue('C'.$eje_y, 'Sin Fecha');
					}
					$sheet->setCellValue('D'.$eje_y, $n->instancia);
					$sheet->setCellValue('E'.$eje_y, $n->nombre_departamento);
					$sheet->setCellValue('F'.$eje_y, $n->municipio_nombre.' - '.$n->departamento_municipio );
					$sheet->setCellValue('G'.$eje_y, $n->estado_norma);
					$sheet->setCellValue('H'.$eje_y, $n->norma_codigo );
					$sheet->setCellValue('I'.$eje_y, $n->norma_nombre );
					$sheet->setCellValue('J'.$eje_y, $n->norma_objeto );
					$tema1 = $this->Norma_model->leerTemaNorma($n->idnormag, 1);
					if( $tema1 == false){
						//Es otro tema 1
						$otrotema1 = $this->Norma_model->otroTemaNorma($n->idnormag, 1);
						if(isset($otrotema1)){
							$sheet->setCellValue('K'.$eje_y, $otrotema1->descripcion_otrotema );
						}

					}else{
						//Tema 1
						$sheet->setCellValue('K'.$eje_y, $tema1->nombre_tema );
					}

					$tema2 = $this->Norma_model->leerTemaNorma($n->idnormag, 2);
					if($tema2 == false){
						//Es otro tema 2
						$otrotema2 = $this->Norma_model->otroTemaNorma($n->idnormag, 2);
						if(isset($otrotema2)){
							$sheet->setCellValue('L'.$eje_y, $otrotema2->descripcion_otrotema);
						}
					}else{
						//Tema 2
						$sheet->setCellValue('L'.$eje_y, $tema2->nombre_tema );
					}
					$sheet->setCellValue('M'.$eje_y, $n->norma_observaciones );
					$sheet->setCellValue('N'.$eje_y, $n->username );
					$eje_y++;
				endforeach;

			}
			elseif ($consulta->idinstancia == 3){
				$plantilla = $ruta.'plantilla-reportes-normativa.xlsx';
				header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
				header('Content-Disposition: attachment; filename="' . $filename. '"');
				header('Cache-Control: max-age=0');
				$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
				$sheet = $spreadsheet->getSheet(0)->setTitle('Normativas');
				$sheet->setCellValue('D3', 'INSTANCIA:');
				//Municipal
				$sheet->setCellValue('E3', 'Consejo Municipal');
				$eje_y = 6;
				$normas = $this->Norma_model->reporteNormaMunicipal($consulta);
				foreach ($normas as $n):
					$sheet->setCellValue('A'.$eje_y, $n->idnormag);
					$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_registro));
					if($n->fecha_norma != 0){
						$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $n->fecha_norma));
					}else{
						$sheet->setCellValue('C'.$eje_y, 'Sin Fecha');
					}
					$sheet->setCellValue('D'.$eje_y, $n->instancia);
					$sheet->setCellValue('E'.$eje_y, $n->nombre_departamento);
					$sheet->setCellValue('F'.$eje_y, $n->municipio_nombre.' - '.$n->departamento_municipio );
					$sheet->setCellValue('G'.$eje_y, $n->estado_norma);
					$sheet->setCellValue('H'.$eje_y, $n->norma_codigo );
					$sheet->setCellValue('I'.$eje_y, $n->norma_nombre );
					$sheet->setCellValue('J'.$eje_y, $n->norma_objeto );
					$tema1 = $this->Norma_model->leerTemaNorma($n->idnormag, 1);
					if( $tema1 == false){
						//Es otro tema 1
						$otrotema1 = $this->Norma_model->otroTemaNorma($n->idnormag, 1);
						if(isset($otrotema1)){
							$sheet->setCellValue('K'.$eje_y, $otrotema1->descripcion_otrotema );
						}

					}else{
						//Tema 1
						$sheet->setCellValue('K'.$eje_y, $tema1->nombre_tema );
					}

					$tema2 = $this->Norma_model->leerTemaNorma($n->idnormag, 2);
					if($tema2 == false){
						//Es otro tema 2
						$otrotema2 = $this->Norma_model->otroTemaNorma($n->idnormag, 2);
						if(isset($otrotema2)){
							$sheet->setCellValue('L'.$eje_y, $otrotema2->descripcion_otrotema);
						}
					}else{
						//Tema 2
						$sheet->setCellValue('L'.$eje_y, $tema2->nombre_tema );
					}
					$sheet->setCellValue('M'.$eje_y, $n->norma_observaciones );
					$sheet->setCellValue('N'.$eje_y, $n->username );
					$eje_y++;
				endforeach;


			}
			elseif ($consulta->idinstancia == 0){

				$plantilla = $ruta.'plantilla-reportes-normativa.xlsx';
				header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
				header('Content-Disposition: attachment; filename="' . $filename. '"');
				header('Cache-Control: max-age=0');
				$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
				$sheet = $spreadsheet->getSheet(0)->setTitle('Normativas');
				$sheet->setCellValue('D3', 'INSTANCIA:');
				$eje_y = 6;
				$normas = $this->Norma_model->reporteNormaGeneral($consulta);
				foreach ($normas as $n):
					$sheet->setCellValue('A'.$eje_y, $n->idnormag);
					$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_registro));
					if($n->fecha_norma != 0){
						if($n->idinsseg == 1):
							$sheet->setCellValue('C'.$eje_y, $n->fecha_norma_lit);
						elseif ($n->idinsseg == 4):
							$sheet->setCellValue('C'.$eje_y, $n->fecha_norma_lit);
						else:
							$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $n->fecha_norma));
						endif;
					}else{
						$sheet->setCellValue('C'.$eje_y, 'Sin Fecha');
					}
					$sheet->setCellValue('A'.$eje_y, $n->idnormag);
					$sheet->setCellValue('D'.$eje_y, $n->instancia);
					$sheet->setCellValue('E'.$eje_y, $n->nombre_departamento);
					$sheet->setCellValue('F'.$eje_y, $n->municipio_nombre.' - '.$n->departamento_municipio );
					$sheet->setCellValue('G'.$eje_y, $n->estado_norma);
					$sheet->setCellValue('H'.$eje_y, $n->norma_codigo );
					$sheet->setCellValue('I'.$eje_y, $n->norma_nombre );
					$sheet->setCellValue('J'.$eje_y, $n->norma_objeto );
					$datos =json_decode($n->datos_adicionales) ;
					//Si la instancia de segumiento es 1 o 4
					if($n->idinsseg == 1):
						$tema1 = $datos->tema1;
						$subtema1 = $datos->subtema1;
						$tema2 = $datos->tema2;
						$subtema2 = $datos->subtema2;
						$sheet->setCellValue('K'.$eje_y, $tema1->tema );
						$sheet->setCellValue('L'.$eje_y, $subtema1->subtema );
						$sheet->setCellValue('M'.$eje_y, $tema2->tema );
						$sheet->setCellValue('N'.$eje_y, $subtema2->subtema );

					elseif ($n->idinsseg == 4):
						$tema1 = $datos->tema1;
						$subtema1 = $datos->subtema1;
						$tema2 = $datos->tema2;
						$subtema2 = $datos->subtema2;
						$sheet->setCellValue('K'.$eje_y, $tema1->tema );
						$sheet->setCellValue('L'.$eje_y, $subtema1->subtema );
						$sheet->setCellValue('M'.$eje_y, $tema2->tema );
						$sheet->setCellValue('N'.$eje_y, $subtema2->subtema );

					else:
						$tema1 = $this->Norma_model->leerTemaNorma($n->idnormag, 1);
						if( $tema1 == false){
							//Es otro tema 1
							$otrotema1 = $this->Norma_model->otroTemaNorma($n->idnormag, 1);
							if(isset($otrotema1)){
								$sheet->setCellValue('K'.$eje_y, $otrotema1->descripcion_otrotema );
							}

						}else{
							//Tema 1
							$sheet->setCellValue('K'.$eje_y, $tema1->nombre_tema );
						}

						$tema2 = $this->Norma_model->leerTemaNorma($n->idnormag, 2);
						if($tema2 == false){
							//Es otro tema 2
							$otrotema2 = $this->Norma_model->otroTemaNorma($n->idnormag, 2);
							if(isset($otrotema2)){
								$sheet->setCellValue('M'.$eje_y, $otrotema2->descripcion_otrotema);
							}
						}else{
							//Tema 2
							$sheet->setCellValue('M'.$eje_y, $tema2->nombre_tema );
						}
					endif;
					$sheet->setCellValue('O'.$eje_y, $n->norma_observaciones );
					$sheet->setCellValue('P'.$eje_y, $n->username );
					$eje_y++;
				endforeach;
			}
			elseif ($consulta->idinstancia == 4){
				$plantilla = $ruta.'plantilla-reportes-normativa-lp.xlsx';
				header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
				header('Content-Disposition: attachment; filename="' . $filename. '"');
				header('Cache-Control: max-age=0');
				$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
				$sheet = $spreadsheet->getSheet(0)->setTitle('Normativas');
				$sheet->setCellValue('D3', 'INSTANCIA:');
				$eje_y = 6;
				$normas = $this->Norma_model->reporteNormaPlurinacionalLP($consulta);
				foreach ($normas as $n):
					$sheet->setCellValue('A'.$eje_y, $n->idnormag);
					$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $n->fecha_registro));
					$sheet->setCellValue('C'.$eje_y, $n->fecha_norma_lit);
					/*if($n->fecha_norma != 0){
						if($n->idinsseg == 1):
							$sheet->setCellValue('C'.$eje_y, $n->fecha_norma_lit);
						elseif ($n->idinsseg == 4):
							$sheet->setCellValue('C'.$eje_y, $n->fecha_norma_lit);
						else:
							$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $n->fecha_norma));
						endif;
					}else{
						$sheet->setCellValue('C'.$eje_y, 'Sin Fecha');
					}*/
					//$sheet->setCellValue('A'.$eje_y, $n->idnormag);
					$sheet->setCellValue('D'.$eje_y, $n->instancia);
					//$sheet->setCellValue('E'.$eje_y, $n->estado_norma);
					$sheet->setCellValue('E'.$eje_y, $n->norma_codigo );
					$sheet->setCellValue('F'.$eje_y, $n->norma_nombre );
					//$sheet->setCellValue('G'.$eje_y, $n->norma_objeto );
					$datos =json_decode($n->datos_adicionales) ;
					//Si la instancia de segumiento es 1 o 4
					if($n->idinsseg == 1):
						$tema1 = $datos->tema1;
						$subtema1 = $datos->subtema1;
						$tema2 = $datos->tema2;
						$subtema2 = $datos->subtema2;
						$sheet->setCellValue('K'.$eje_y, $tema1->tema );
						$sheet->setCellValue('L'.$eje_y, $subtema1->subtema );
						$sheet->setCellValue('M'.$eje_y, $tema2->tema );
						$sheet->setCellValue('N'.$eje_y, $subtema2->subtema );

					elseif ($n->idinsseg == 4):
						$tema1 = $datos->tema1;
						$subtema1 = $datos->subtema1;
						$tema2 = $datos->tema2;
						$subtema2 = $datos->subtema2;
						$codigo_proyecto_ley = $datos->codigo_proy_ley;
						$sheet->setCellValue('G'.$eje_y, $tema1->tema );
						$sheet->setCellValue('H'.$eje_y, $subtema1->subtema );
						$sheet->setCellValue('I'.$eje_y, $tema2->tema );
						$sheet->setCellValue('J'.$eje_y, $subtema2->subtema );
						$sheet->setCellValue('K'.$eje_y, $codigo_proyecto_ley );
						$sheet->setCellValue('L'.$eje_y, $datos->comentarios );
						$sheet->setCellValue('M'.$eje_y, $datos->observaciones );
						$sheet->setCellValue('N'.$eje_y, $datos->enlace );
						$sheet->setCellValue('O'.$eje_y, $datos->obs_metodologicas );




					else:
						$tema1 = $this->Norma_model->leerTemaNorma($n->idnormag, 1);
						if( $tema1 == false){
							//Es otro tema 1
							$otrotema1 = $this->Norma_model->otroTemaNorma($n->idnormag, 1);
							if(isset($otrotema1)){
								$sheet->setCellValue('K'.$eje_y, $otrotema1->descripcion_otrotema );
							}

						}else{
							//Tema 1
							$sheet->setCellValue('K'.$eje_y, $tema1->nombre_tema );
						}

						$tema2 = $this->Norma_model->leerTemaNorma($n->idnormag, 2);
						if($tema2 == false){
							//Es otro tema 2
							$otrotema2 = $this->Norma_model->otroTemaNorma($n->idnormag, 2);
							if(isset($otrotema2)){
								$sheet->setCellValue('M'.$eje_y, $otrotema2->descripcion_otrotema);
							}
						}else{
							//Tema 2
							$sheet->setCellValue('M'.$eje_y, $tema2->nombre_tema );
						}
					endif;
					$sheet->setCellValue('O'.$eje_y, $n->norma_observaciones );
					$sheet->setCellValue('P'.$eje_y, $n->username );
					$eje_y++;
				endforeach;

			}
			//Primer libro por defecto
			$sheet = $spreadsheet->setActiveSheetIndex(0);

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");
		}else{
			$this->mensaje('No existen datos', 'warning');
			redirect('manejoDB/normativaReportes');
		}
	}


	public function downloadreporteplenaria()
	{
		$consulta = $this->session->consultaplenaria;
		$this->session->unset_userdata('consultaplenaria');
		$plenarias = $this->Plenaria_model->reportePlenaria($consulta);

		if(!empty($consulta)){
			$filename = "reporte-plenarias.xlsx";
			$ruta = 'assets/info/';
			$plantilla = $ruta.'plantilla-reportes-plenarias.xlsx';
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getSheet(0)->setTitle('Plenarias');
			$sheet->setCellValue('D3', 'INSTANCIA:');

			$eje_y = 6;
			if($consulta->idinstancia == 1){
				//Instancia Plurinacional
				$sheet->setCellValue('E3', 'Asamblea Legislativa Plurinacional');
				$plenarias = $this->Plenaria_model->reportePlenariaPlurinacional($consulta);
				foreach ($plenarias as $p):
					$sheet->setCellValue('A'.$eje_y, $p->idplenaria);
					$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $p->fecha_registro));
					$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $p->fecha_plenaria));
					$sheet->setCellValue('D'.$eje_y, $p->instancia);
					$sheet->setCellValue('G'.$eje_y, $p->plenaria_puntos_agenda );
					$sheet->setCellValue('H'.$eje_y, $p->plenaria_agenda_cumplida );
					$sheet->setCellValue('I'.$eje_y, $p->plenaria_puntos_pendientes );
					$sheet->setCellValue('J'.$eje_y, $p->plenaria_puntos_varios);
					$plenaria_ne = $this->Plenaria_model->plenariaNormaExtraordinaria($p->idplenaria);
					if($plenaria_ne == false){
						$sheet->setCellValue('K'.$eje_y, '');
					}else{
						$sheet->setCellValue('K'.$eje_y, $plenaria_ne->plne_datos);
					}
					$sheet->setCellValue('L'.$eje_y, $p->tipo_plenaria_nombre);
					$sheet->setCellValue('M'.$eje_y, $p->monitores_seguimiento);
					$sheet->setCellValue('N'.$eje_y, $p->monitor);

					$eje_y++;
				endforeach;

			}elseif ($consulta->idinstancia == 2){
				//Departamental
				$sheet->setCellValue('E3', 'Asamblea Legislativa Departamental');
				$plenarias = $this->Plenaria_model->reportePlenariaDepartamental($consulta);
				foreach ($plenarias as $p):
					$sheet->setCellValue('A'.$eje_y, $p->idplenaria);
					$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $p->fecha_registro));
					$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $p->fecha_plenaria));
					$sheet->setCellValue('D'.$eje_y, $p->instancia);
					$sheet->setCellValue('E'.$eje_y, $p->nombre_departamento);
					$sheet->setCellValue('G'.$eje_y, $p->plenaria_puntos_agenda );
					$sheet->setCellValue('H'.$eje_y, $p->plenaria_agenda_cumplida );
					$sheet->setCellValue('I'.$eje_y, $p->plenaria_puntos_pendientes );
					$sheet->setCellValue('J'.$eje_y, $p->plenaria_puntos_varios);
					$plenaria_ne = $this->Plenaria_model->plenariaNormaExtraordinaria($p->idplenaria);
					if($plenaria_ne == false){
						$sheet->setCellValue('K'.$eje_y, '');
					}else{
						$sheet->setCellValue('K'.$eje_y, $plenaria_ne->plne_datos);
					}
					$sheet->setCellValue('L'.$eje_y, $p->tipo_plenaria_nombre);
					$sheet->setCellValue('M'.$eje_y, $p->monitores_seguimiento);
					$sheet->setCellValue('N'.$eje_y, $p->username);

					$eje_y++;
				endforeach;
			}elseif ($consulta->idinstancia == 3){
				//Municipal
				$sheet->setCellValue('E3', 'Consejo Municipal');
				$plenarias = $this->Plenaria_model->reportePlenariaMunicipal($consulta);
				foreach ($plenarias as $p):
					$sheet->setCellValue('A'.$eje_y, $p->idplenaria);
					$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $p->fecha_registro));
					$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $p->fecha_plenaria));
					$sheet->setCellValue('D'.$eje_y, $p->instancia);
					$sheet->setCellValue('E'.$eje_y, $p->nombre_departamento);
					$sheet->setCellValue('F'.$eje_y, $p->municipio_nombre );
					$sheet->setCellValue('G'.$eje_y, $p->plenaria_puntos_agenda );
					$sheet->setCellValue('H'.$eje_y, $p->plenaria_agenda_cumplida );
					$sheet->setCellValue('I'.$eje_y, $p->plenaria_puntos_pendientes );
					$sheet->setCellValue('J'.$eje_y, $p->plenaria_puntos_varios);
					$plenaria_ne = $this->Plenaria_model->plenariaNormaExtraordinaria($p->idplenaria);
					if($plenaria_ne == false){
						$sheet->setCellValue('K'.$eje_y, '');
					}else{
						$sheet->setCellValue('K'.$eje_y, $plenaria_ne->plne_datos);
					}
					$sheet->setCellValue('L'.$eje_y, $p->tipo_plenaria_nombre);
					$sheet->setCellValue('M'.$eje_y, $p->monitores_seguimiento);
					$sheet->setCellValue('N'.$eje_y, $p->monitor);

					$eje_y++;
				endforeach;
			}elseif ($consulta->idinstancia == 0){
				//Todas las instancias
				$sheet->setCellValue('E3', 'Todas las instancias');
				$plenarias = $this->Plenaria_model->reportePlenaria($consulta);
				foreach ($plenarias as $p):
					$sheet->setCellValue('A'.$eje_y, $p->idplenaria);
					$sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $p->fecha_registro));
					$sheet->setCellValue('C'.$eje_y, mdate('%m-%d-%Y', $p->fecha_plenaria));
					$sheet->setCellValue('D'.$eje_y, $p->instancia);
					$sheet->setCellValue('E'.$eje_y, $p->nombre_departamento);
					$sheet->setCellValue('F'.$eje_y, $p->municipio_nombre );
					$sheet->setCellValue('G'.$eje_y, $p->plenaria_puntos_agenda );
					$sheet->setCellValue('H'.$eje_y, $p->plenaria_agenda_cumplida );
					$sheet->setCellValue('I'.$eje_y, $p->plenaria_puntos_pendientes );
					$sheet->setCellValue('J'.$eje_y, $p->plenaria_puntos_varios);
					$plenaria_ne = $this->Plenaria_model->plenariaNormaExtraordinaria($p->idplenaria);
					if($plenaria_ne == false){
						$sheet->setCellValue('K'.$eje_y, '');
					}else{
						$sheet->setCellValue('K'.$eje_y, $plenaria_ne->plne_datos);
					}
					$sheet->setCellValue('L'.$eje_y, $p->tipo_plenaria_nombre);
					$sheet->setCellValue('M'.$eje_y, $p->monitores_seguimiento);
					$sheet->setCellValue('N'.$eje_y, $p->monitor);

					$eje_y++;
				endforeach;
			}

			//Primer libro por defecto
			$sheet = $spreadsheet->setActiveSheetIndex(0);

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");

		}else{
			$this->mensaje('No existen datos', 'warning');
			redirect('manejoDB/reportePlenarias');
		}
	}


	public function veeduriaAdministrador(){
		$veedurias = $this->Veeduria_model->leerFormResp();

		//var_dump($veedurias);

		$data['veedurias'] = $veedurias;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('manejodb/vmanejodb_listaveeduria', $data);
		//$this->load->view('manejodb/vmanejodb_listanormas', $data);
		$this->load->view('html/pie');
	}

	public function cambiarEstadoVeeduria($identificador)
	{
		$idfresp = $identificador;
		$fv = $this->Veeduria_model->leerFormulario($idfresp);
		if($fv->es_valido)
		{
			//Esta activa, funcion complementaria
			$estado = 0;
		}else{
			//No esta activa, funcion complementaria
			$estado = 1;
		}
		$this->Veeduria_model->cambiarEstado($idfresp, $estado);
		redirect('manejoDB/veeduriaAdministrador');
	}





}
