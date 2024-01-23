<?php

class Seguimientomonitores extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('ion_auth');
        $this->load->helper('date');
        $this->load->model('SeguimientoMonitores_model');
        $this->load->model('Cuestionario_model');
        $this->load->model('Ley_model');
        $this->load->library('session');
    }
    public function index()
    {
        $this->load->view('html/encabezado');
        $this->load->view('html/navbar');
        $this->load->view('seguimientom/vseguimientoMonitores');
        $this->load->view('html/pie');
    }
    public function EstadoObservacionElectoral()
    {
        $DatosSeguimientoM['SeguimientoMonitores']=$this->SeguimientoMonitores_model->leerSeguimientoMonitores();
        $DatosSeguimientoM['NumeroDeCuestionarios']=$this->SeguimientoMonitores_model->leerCuestionarios();

        $TablaAuxiliarSm=new stdClass();
        $TablaAuxiliarSm->nombre=0;
        foreach ($DatosSeguimientoM['SeguimientoMonitores'] as $f)
        {
            if($f->first_name === $TablaAuxiliarSm->nombre)
            {
                foreach($DatosSeguimientoM['NumeroDeCuestionarios'] as $nDc0)
                {
                    $cuestionarioA=$nDc0->nombre_cuestionario;
                    $feechaa='fecha '.$cuestionarioA;
                    if($f->nombre_cuestionario == $nDc0->nombre_cuestionario)
                    {
                        $TablaAuxiliarSm->$feechaa=date('d-m-Y',$f->fecha_registro);
                        $TablaAuxiliarSm->$cuestionarioA=$f->ncuestionario;
                    }
                    else
                    {
                        //var_dump($TablaAuxiliarSm->$feechaa);
                        if(/*$TablaAuxiliarSm->$feechaa == 0 &&*/ $TablaAuxiliarSm->$cuestionarioA == 0)
                        {
                            $TablaAuxiliarSm->$feechaa=0;
                            $TablaAuxiliarSm->$cuestionarioA=0;
                        }
                    }
                }
            }
            else
            {
                $TablaAuxiliarSm=new stdClass();
                $TablaAuxiliarSm->nombre=$f->first_name;
                $TablaAuxiliarSm->apellido=$f->last_name;
                $TablaAuxiliarSm->departamento=$f->nombre_departamento;
                foreach($DatosSeguimientoM['NumeroDeCuestionarios'] as $ndc1)
                {
                    $cuestionario1=$ndc1->nombre_cuestionario;
                    $TablaAuxiliarSm->$cuestionario1=0;
                }
                foreach($DatosSeguimientoM['NumeroDeCuestionarios'] as $nDc)
                {
                    $cuestionarioA=$nDc->nombre_cuestionario;
                    $feecha='fecha '.$cuestionarioA;
                    if($f->nombre_cuestionario == $nDc->nombre_cuestionario)
                    {
                        $TablaAuxiliarSm->$feecha=date('d-m-Y',$f->fecha_registro);
                        $TablaAuxiliarSm->$cuestionarioA=$f->ncuestionario;
                    }
                    else
                    {
                        //var_dump($TablaAuxiliarSm->$feechaa);
                        if(/*$TablaAuxiliarSm->$feecha == 0 &&*/ $TablaAuxiliarSm->$cuestionarioA == 0)
                        {
                            $TablaAuxiliarSm->$feecha=0;
                            $TablaAuxiliarSm->$cuestionarioA=0;
                        }
                    }
                }
                $SeguimientoM[]=$TablaAuxiliarSm;//se guarda cada vez que se crea un fila "stdClass"
            }
        }
        if(isset($SeguimientoM)){
        $tablaSm['SeguimientoM1']=$SeguimientoM;
        }
        $tablaSm['NumeroDeCuestionarios']=$DatosSeguimientoM['NumeroDeCuestionarios'];
/*        echo "<pre>";
        var_dump($tablaSm);
        echo "</pre>";*/
 /*       echo "<pre>";
        var_dump($DatosSeguimientoM['SeguimientoMonitores']);
        echo "</pre>";*/
        if(empty($tablaSm))
        {
        redirect('Seguimientomonitores');
        }
         else
         {
        //var_dump($DatosSeguimientoM);
        $this->load->view('html/encabezado');
        $this->load->view('html/navbar');
        $this->load->view('seguimientom/vseguimientoMonitoresTabla',$tablaSm);
        $this->load->view('html/pie');
        }
    }
    public function CuestionariosPorDepartamentoUsuario()
    {
        $DatosSeguimientoM['SeguimientoMonitores']=$this->SeguimientoMonitores_model->leerDepartamentos();
        $DatosSeguimientoM['NumeroDeCuestionarios']=$this->SeguimientoMonitores_model->leerCuestionarios();

        $TablaAuxiliarSm=new stdClass();
        $TablaAuxiliarSm->nombre=0;
        foreach ($DatosSeguimientoM['SeguimientoMonitores'] as $f)
        {
            if($f->first_name === $TablaAuxiliarSm->nombre)
            {
                foreach($DatosSeguimientoM['NumeroDeCuestionarios'] as $nDc0)
                {
                    $cuestionarioA=$nDc0->nombre_cuestionario;
                    if($f->nombre_cuestionario == $nDc0->nombre_cuestionario)
                    {
                        $TablaAuxiliarSm->$cuestionarioA=$f->ncuestionario;
                    }
                    else
                    {
                        if($TablaAuxiliarSm->$cuestionarioA == 0)
                        {
                            $TablaAuxiliarSm->$cuestionarioA=0;
                        }
                    }
                }
            }
            else
            {
                $TablaAuxiliarSm=new stdClass();
                $TablaAuxiliarSm->nombre=$f->first_name;
                foreach($DatosSeguimientoM['NumeroDeCuestionarios'] as $ndc1)
                {
                    $cuestionario1=$ndc1->nombre_cuestionario;
                    $TablaAuxiliarSm->$cuestionario1=0;
                }
                foreach($DatosSeguimientoM['NumeroDeCuestionarios'] as $nDc)
                {
                    $cuestionarioA=$nDc->nombre_cuestionario;
                    if($f->nombre_cuestionario == $nDc->nombre_cuestionario)
                    {
                        $TablaAuxiliarSm->$cuestionarioA=$f->ncuestionario;
                    }
                    else
                    {
                        if($TablaAuxiliarSm->$cuestionarioA == 0)
                        {
                            $TablaAuxiliarSm->$cuestionarioA=0;
                        }
                    }
                }
                $SeguimientoM[]=$TablaAuxiliarSm;
            }
        }
        if(isset($SeguimientoM)){
        $tablaSm['SeguimientoM1']=$SeguimientoM;
        }
        $tablaSm['NumeroDeCuestionarios']=$DatosSeguimientoM['NumeroDeCuestionarios'];
/*        echo "<pre>"; var_dump($tablaSm); echo "</pre>";*/
        if(empty($tablaSm))
        {
        redirect('Seguimientomonitores');
        }
         else
         {
        $this->load->view('html/encabezado');
        $this->load->view('html/navbar');
        $this->load->view('seguimientom/vseguimientoMonitoresTabla1',$tablaSm);
        $this->load->view('html/pie');
        }
    }

    public function EstadoObservacionElectoralXuniversidad()
    {
        $log_user=$this->ion_auth->user()->row();
//        echo "<pre>";var_dump($prueba);echo "</pre>";
        $DatosSeguimientoM['SeguimientoMonitores']=$this->SeguimientoMonitores_model->leerSeguimientoMonitoresxUniversidad($log_user);
        $DatosSeguimientoM['NumeroDeCuestionarios']=$this->SeguimientoMonitores_model->leerCuestionarios();

        $TablaAuxiliarSm=new stdClass();
        $TablaAuxiliarSm->nombre=0;
        foreach ($DatosSeguimientoM['SeguimientoMonitores'] as $f)
        {
            if($f->first_name === $TablaAuxiliarSm->nombre)
            {
                foreach($DatosSeguimientoM['NumeroDeCuestionarios'] as $nDc0)
                {
                    $cuestionarioA=$nDc0->nombre_cuestionario;
//                    $feechaa='fecha '.$cuestionarioA;
                    if($f->nombre_cuestionario == $nDc0->nombre_cuestionario)
                    {
//                        $TablaAuxiliarSm->$feechaa=date('d-m-Y',$f->fecha_registro);
                        $TablaAuxiliarSm->$cuestionarioA=$f->ncuestionario;
                    }
                    else
                    {
                        //var_dump($TablaAuxiliarSm->$feechaa);
                        if(/*$TablaAuxiliarSm->$feechaa == 0 &&*/ $TablaAuxiliarSm->$cuestionarioA == 0)
                        {
//                            $TablaAuxiliarSm->$feechaa=0;
                            $TablaAuxiliarSm->$cuestionarioA=0;
                        }
                    }
                }
            }
            else
            {
                $TablaAuxiliarSm=new stdClass();
                $TablaAuxiliarSm->nombre=$f->first_name;
                $TablaAuxiliarSm->apellido=$f->last_name;
                $TablaAuxiliarSm->departamento=$f->nombre_departamento;
                foreach($DatosSeguimientoM['NumeroDeCuestionarios'] as $ndc1)
                {
                    $cuestionario1=$ndc1->nombre_cuestionario;
                    $TablaAuxiliarSm->$cuestionario1=0;
                }
                foreach($DatosSeguimientoM['NumeroDeCuestionarios'] as $nDc)
                {
                    $cuestionarioA=$nDc->nombre_cuestionario;
//                    $feecha='fecha '.$cuestionarioA;
                    if($f->nombre_cuestionario == $nDc->nombre_cuestionario)
                    {
//                        $TablaAuxiliarSm->$feecha=date('d-m-Y',$f->fecha_registro);
                        $TablaAuxiliarSm->$cuestionarioA=$f->ncuestionario;
                    }
                    else
                    {
                        //var_dump($TablaAuxiliarSm->$feechaa);
                        if(/*$TablaAuxiliarSm->$feecha == 0 &&*/ $TablaAuxiliarSm->$cuestionarioA == 0)
                        {
//                            $TablaAuxiliarSm->$feecha=0;
                            $TablaAuxiliarSm->$cuestionarioA=0;
                        }
                    }
                }
                $SeguimientoM[]=$TablaAuxiliarSm;
            }
        }
         if(isset($SeguimientoM)){
        $tablaSm['SeguimientoM1']=$SeguimientoM;
         }
        $tablaSm['NumeroDeCuestionarios']=$DatosSeguimientoM['NumeroDeCuestionarios'];
/*        echo "<pre>";
        var_dump($tablaSm);
        echo "</pre>";*/
 /*       echo "<pre>";
        var_dump($DatosSeguimientoM['SeguimientoMonitores']);
        echo "</pre>";*/
        if(empty($tablaSm))
        {
        redirect('Seguimientomonitores');
        }
         else
         {
        //var_dump($DatosSeguimientoM);
        $this->load->view('html/encabezado');
        $this->load->view('html/navbar');
        $this->load->view('seguimientom/vseguimientoMonitoresXuniversidad',$tablaSm);
        $this->load->view('html/pie');
        }
    }

    public function leyesTabla()
	{
		$usuario = $this->ion_auth->user()->row();
		$leyes = $this->Ley_model->leerTodasLasLeyesEstado();
		$dt['leyes'] = $leyes;


		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('seguimientom/vseguimientoMonitores_leyes',$dt);
		$this->load->view('html/pie');
	}
    public function editarl($idm)
    {
        $dat['leyes']=$this->SeguimientoMonitores_model->leerLey($idm);
        $this->session->set_userdata($dat);
//        echo "<pre>";var_dump($dat);echo "</pre>";
        
        $this->load->view('html/encabezado');
        $this->load->view('html/navbar');
        $this->load->view('seguimientom/vley',$dat);
        $this->load->view('html/pie');
    }
    public function actualizarLey($w1)
    {
        $prueba=date('d/m/Y',$this->input->post('fechaReg'));
        
        echo "<pre>";var_dump($prueba,$w1);echo "</pre>";
//        $this->SeguimientoMonitores_model->escribirFechReg($fR);
    }

    public function leyInformacion($identificador)
	{
		$idley = $identificador;
		/*
		 * INFORMACION GENERAL DE LA LEY
		 * - Fecha de Registro
		 * - Resumen de la ley
		 * - Usuario q la registro
		 * - Fuente
		 */
		$ley = $this->Ley_model->leerInfoLeyPorId($idley);
		$ley_fuente = $this->Ley_model->leerFuentePorIdLey($idley);

		/*
		 * Estado de la ley actual 20$ 40% 80% 100%
		 *	- Avance en porcentaje
		 *  - Mostrar los codigos en cada estado
		 *  - Mostrar la descripcion en cada estado
		 *  - Mostrar los links en cada estado
		 */
		$ley_porcentaje = $this->Ley_model->leerEstadoPorcentajePorIdLey($idley);
		$ley_estados = $this->Ley_model->leerEstadosPorLeyID($idley);
		//var_dump($ley_estados);
		//var_dump($ley_porcentaje);

		$data['tratamiento_descripcion'] = $this->Ley_model->leerUltimaDescripcion($idley, 1);
		$data['sancionada_descripcion'] = $this->Ley_model->leerUltimaDescripcion($idley, 2);
		$data['aprobado_descripcion'] = $this->Ley_model->leerUltimaDescripcion($idley, 3);
		$data['modificacion_descripcion'] = $this->Ley_model->leerUltimaDescripcion($idley, 4);
		$data['promulgada_descripcion'] = $this->Ley_model->leerUltimaDescripcion($idley, 5);

		$data['tratamiento_url'] = $this->Ley_model->leerEstadoDeLeyURL($idley, 1);
		$data['sancionada_url'] = $this->Ley_model->leerEstadoDeLeyURL($idley, 2);
		$data['aprobado_url'] = $this->Ley_model->leerEstadoDeLeyURL($idley, 3);
		$data['modificacion_url'] = $this->Ley_model->leerEstadoDeLeyURL($idley, 4);
		$data['promulgada_url'] = $this->Ley_model->leerEstadoDeLeyURL($idley, 5);

		/*
		 * Mostrar Temas y subtemas
		 */
		$leyes_temas = $this->Ley_model->leerTemasDeLeyPorID($idley);
		$leyes_stemas = $this->Ley_model->leerSubtemasDeLeyPorID($idley);

		$leyes_otema = $this->Ley_model->leerOtrosTemasDeLeyPorID($idley);
		$leyes_ostema = $this->Ley_model->leerOtrosSubTemasDeLeyPorID($idley);




		$data['ley'] = $ley;
		$data['ley_fuente'] = $ley_fuente;
		$data['ley_porcentaje'] = $ley_porcentaje;
		$data['ley_estados'] = $ley_estados;
		$data['ley_porcentaje'] = $ley_porcentaje;
		$data['leyes_temas'] = $leyes_temas;
		$data['leyes_stemas'] = $leyes_stemas;
		$data['otema'] = $leyes_otema;
		$data['ostema'] = $leyes_ostema;



		$this->load->view('html/encabezado');
		$this->load->view('html/navbar');
		$this->load->view('seguimientom/vley_informacion',$data);
		$this->load->view('html/pie');

	}
	public function cambiarEstadoLey($identificador)
	{
		$idleyes = $identificador;
		$ley = $this->Ley_model->leerLeyPorId($idleyes);
		var_dump($ley);
		if($ley->esta_activa)
		{
			//Esta activa, funcion complementaria
			$estado = 0;
		}else{
			//No esta activa, funcion complementaria
			$estado = 1;
		}
		$this->Ley_model->cambiarEstadoLey($idleyes, $estado);
		redirect('Seguimientomonitores/leyesTabla/');
	}
}
