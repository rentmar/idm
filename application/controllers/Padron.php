<?php

class Padron extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->model('Partida_model');
		$this->load->model('Departamento_model');
		$this->load->model('Libro_model');
	}

	public function index(){

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('padron/vpadron_inicio');
		$this->load->view('html/pie');
	}

	//Datos json Comprobacion de CI
	public function getnumeroci()
	{
		$json = array();
		$numeroci = $this->input->post('numeroci');
		$json = $this->Partida_model->buscaCI($numeroci);
		header('Content-Type: application/json');
		echo json_encode($json);
	}

	//Insercion de datos json
	public function insertarci(){
		$json = array();

		$usuario = $this->ion_auth->user()->row();
		$numeroci = $this->input->post('numeroci');
		$datos = $this->partida();
		$datos->numero_documento = $numeroci;
		$datos->departamento = 1;
		$datos->usuario = $usuario->id;
		$bandera = $this->Partida_model->crearPartida($datos);

		/** @noinspection PhpLanguageLevelInspection */
		$json = [
			'bandera' => $bandera,
		];
		header('Content-Type: application/json');
		//echo json_encode($json);
		echo $json($datos);
	}

	//Crear partida
	public function crearPartida(){
		$usuario = $this->ion_auth->user()->row();

		$datos['departamentos'] = $this->Departamento_model->leerDepartamentos();
		$datos['usuario'] = $usuario;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('padron/vpadron_crearpartida', $datos);
		$this->load->view('html/pie');
	}

	//Insertar partida
	public function insertarPartida(){
		$partida = $this->partida();
		//var_dump($partida);
		//echo "<br><br><br>";
		//$inf_json = json_encode($partida);
		//var_dump($inf_json);


		$idregistro = $this->Partida_model->crearPartida($partida);
		if($idregistro !== false){
			redirect('padron/registroPartida/'.$idregistro);
		}
	}


	public function registroPartida($idregistro){
		$registro = $this->Partida_model->registroId($idregistro);
		$inform = json_decode($registro->datos_partida);
		$dep = $this->Departamento_model->leerDepartamento($inform->departamento);
		$dep_adh = $this->Departamento_model->leerDepartamento($inform->lugar_adhesion);

		$datos['registro'] = $inform;
		$datos['dep'] = $dep;
		$datos['dep_adh'] = $dep_adh;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('padron/vpadron_partida', $datos);
		$this->load->view('html/pie');
	}

	private function partida(){
		$partida = new stdClass();
		$partida->libro = $this->input->post('num_libro');
		$partida->folio = $this->input->post('num_folio');
		$partida->partida = $this->input->post('num_partida');
		$partida->nombres = $this->input->post('nombres');
		$partida->primer_apellido = $this->input->post('primer_apellido');
		$partida->segundo_apellido = $this->input->post('segundo_apellido');
		$partida->apellido_esposo = $this->input->post('apellido_esposo');
		$partida->numero_documento = $this->input->post('numero_ci');
		$partida->complemento = $this->input->post('complemento_ci');
		$partida->fecha_nacimiento = $this->input->post('fecha_nacimiento');
		$partida->sexo = $this->input->post('sexo');
		$partida->lugar_domicilio = $this->input->post('domicilio');
		$partida->zona = $this->input->post('zona');
		$partida->calle = $this->input->post('calle');
		$partida->numero = $this->input->post('num_dom');
		$partida->departamento = $this->input->post('departamento');
		$partida->provincia = $this->input->post('provincia');
		$partida->localidad = $this->input->post('localidad');
		$partida->otra_localidad = $this->input->post('localidad_otr');
		$partida->lugar_adhesion = $this->input->post('departamento_adh');
		$partida->fecha_adhesion = $this->input->post('fecha_adh');
		$partida->usuario = $this->input->post('idusuario');

		return $partida;
	}

	public function reporteReformaJudicial(){

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('padron/vpadron_reportefirmas');
		$this->load->view('html/pie');

	}

	public function procesarConsultaCI(){

		$numero_cis = $this->Partida_model->contarCIs();
		$documentos_datos = $this->Partida_model->leerCIsRegistrados();

		//echo $numero_cis;

		if($numero_cis > 0){
			$filename = "reporte-rjudicial.xlsx";
			$ruta = 'assets/info/';
			$plantilla = $ruta.'plantilla-reportes-reforma.xlsx';
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getSheet(0)->setTitle('CIs');

			$worksheet = $spreadsheet->getActiveSheet();
			$eje_y = 6;

			foreach ($documentos_datos as $n):
				$inf_extra = json_decode($n->datos_partida);
				$sheet->setCellValue('A'.$eje_y, $n->idpartida);
				$sheet->setCellValue('B'.$eje_y, $inf_extra->nombres.' '.$inf_extra->primer_apellido.' '.$inf_extra->segundo_apellido);
				$sheet->setCellValue('C'.$eje_y, ' '.$inf_extra->apellido_esposo);
				$sheet->setCellValue('D'.$eje_y, ' '.$n->numero_ci);
				$sheet->setCellValue('E'.$eje_y, $inf_extra->fecha_nacimiento);
				$sheet->setCellValue('F'.$eje_y, $inf_extra->libro);
				$sheet->setCellValue('G'.$eje_y, $inf_extra->partida);
				$sheet->setCellValue('H'.$eje_y, $n->username);
				$eje_y++;
			endforeach;


			//Primer libro por defecto
			$sheet = $spreadsheet->setActiveSheetIndex(0);

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");

		}else{
			//Si la consulta esta vacia no se genera reporte
			$this->mensaje('No existen documentos de identidad registrados', 'info');
			redirect('padron/reporteReformaJudicial');
		}
	}

	//Reporte excel de libros
	public function procesarConsultaLibros(){
		$numero_libros = $this->Libro_model->contarLibros();
		$libros = $this->Libro_model->leerLibrosRegistrado();

		if($numero_libros>0){
			$filename = "reporte-libros.xlsx";
			$ruta = 'assets/info/';
			$plantilla = $ruta.'plantilla-reportes-libros.xlsx';
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
			header('Content-Disposition: attachment; filename="' . $filename. '"');
			header('Cache-Control: max-age=0');
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
			$sheet = $spreadsheet->getSheet(0)->setTitle('CIs');

			$worksheet = $spreadsheet->getActiveSheet();
			$eje_y = 6;

			foreach ($libros as $n):
				$inf_libro = json_decode($n->libro_informacion);
				$sheet->setCellValue('A'.$eje_y, $n->idlibro);
				$sheet->setCellValue('B'.$eje_y, $inf_libro->numero_libro);
				$sheet->setCellValue('C'.$eje_y, $inf_libro->fecha_apertura);
				$sheet->setCellValue('D'.$eje_y, $inf_libro->fecha_cierre);
				$sheet->setCellValue('E'.$eje_y, $inf_libro->nombre_departamento);
				$sheet->setCellValue('F'.$eje_y, $inf_libro->municipio);
				$sheet->setCellValue('G'.$eje_y, $inf_libro->partidas_validas);
				$sheet->setCellValue('H'.$eje_y, $inf_libro->partidas_nulas);
				$sheet->setCellValue('I'.$eje_y, $inf_libro->partidas_blancas);
				$sheet->setCellValue('J'.$eje_y, $inf_libro->observaciones);
				$sheet->setCellValue('K'.$eje_y, $n->username);

				$eje_y++;
			endforeach;



			//Primer libro por defecto
			$sheet = $spreadsheet->setActiveSheetIndex(0);

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save("php://output");


		}else{
			//Si la consulta esta vacia no se genera reporte
			$this->mensaje('No existen libros registrados', 'info');
			redirect('padron/reporteReformaJudicial');
		}

	}

	//Funcion para creacion de partidas
	public function crearRegistro(){
		$usuario = $this->ion_auth->user()->row();
		$partida = $this->partida();
		$doc_ci = $this->input->post("num_docid");
		$partida->numero_documento = $doc_ci;
		$partida->departamento = 1;
		$partida->usuario = $usuario->id;
		//var_dump($partida);
		$idregistro = $this->Partida_model->crearPartida($partida);
		redirect("inicio/");

	}

	//Listar los registros del usuario actual
	public function listarRegistros(){
		$usuario = $this->ion_auth->user()->row();
		$registros = $this->Partida_model->leerRegistros($usuario->id);
		$datos['registros'] = $registros;
		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('padron/vpadron_listarregistros', $datos);
		$this->load->view('html/pie');
	}

	//Ventana de edicion de registro
	public function editarRegistro($idregistro){

		$registro = $this->Partida_model->registroId($idregistro);
		$info = json_decode($registro->datos_partida);
		//var_dump($registro);

		$datos['registro'] = $registro;
		$datos['datos'] = $info;

		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('padron/vpadron_editarregistro', $datos);
		$this->load->view('html/pie');

	}

	//Rutina para actualizar el registro
	public function actualizarRegistro(){
		$idpartida = $this->input->post('idpartida');
		$idusuario = $this->input->post('idusuario');
		$nuevos_datos_partida = $this->partida();
		$nuevos_datos_partida->numero_documento = $this->input->post('num_docid');
		$this->Partida_model->actualizarPartida($idpartida, $nuevos_datos_partida);
		redirect('padron/listarRegistros');
	}
}
