<?php

class Graficos_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->dbutil();
	}
	public function xmlDepartamento()
	{
		$sql = "SELECT * FROM departamento";
		$config = array(
				'root'=>'root',
				'element'=>'element',
				'newline'=>"\n",
				'tab'=>"\t");
		$q = $this->db->query($sql);
		
		return $this->dbutil->xml_from_result($q,$config);
	}
	public function leerDepartamentos()
	{
		$q=$this->db->get("departamento");
		return $q->result();
	}
	public function leerCuestionarios()
	{
		$q=$this->db->get("cuestionario");
		return $q->result();
	}
	public function leerTemasIdCuestionaro($idc)
	{	
		$this->db->where('rel_idcuestionario',$idc);
		$q=$this->db->get("tema");
		return $q->result();
	}
	public function leerActores()
	{
		$q=$this->db->get("actor");
		return $q->result();
	}
	public function leerActorId($ida)
	{
		$this->db->where('idactor',$ida);
		$q=$this->db->get("actor");
		return $q->row();
	}
	public function leerTipoMedioId($idtm)
	{
		$this->db->where('idtipomedio',$idtm);
		$q=$this->db->get("tipo_medio");
		return $q->row();
	}
	public function leerCuestionarioId($idc)
	{
		$this->db->where('idcuestionario',$idc);
		$q=$this->db->get("cuestionario");
		return $q->row();
	}
	public function leerTiposMedio()
	{
		$q=$this->db->get("tipo_medio");
		return $q->result();
	}
	public function leerNumLeyes()
	{
		$q=$this->db->get("leyes");
		return count($q->result());
	}
	public function leerNumLeyesDpto($idd)
	{$sql="SELECT leyes.idleyes
			FROM leyes
			INNER JOIN cuestionario ON leyes.rel_idcuestionario=cuestionario.idcuestionario 
			INNER JOIN users ON leyes.rel_idusuario = users.id "
			."WHERE users.rel_iddepartamento = ".$idd;
		$q = $this->db->query($sql);
		return count($q->result());
	}
	public function leerNumCuestionarioDepartamento($fi,$ff,$idd,$idc)
	{
		$sql="SELECT departamento.iddepartamento,departamento.nombre_departamento,cuestionario.nombre_cuestionario
			FROM noticia
			INNER JOIN users ON noticia.rel_idusuario = users.id
			INNER JOIN cuestionario ON noticia.rel_idcuestionario = cuestionario.idcuestionario
			INNER JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento "
			."WHERE noticia.fecha_registro BETWEEN ".$fi." AND ".$ff
			." AND departamento.iddepartamento=".$idd
			." AND cuestionario.idcuestionario=".$idc
			." AND noticia.esta_activa = 1";
		$q = $this->db->query($sql);
		return count($q->result());
	}
	public function leerNumTemaDepartamento($fi,$ff,$idd,$idt)
	{
		$sql="SELECT departamento.iddepartamento,departamento.nombre_departamento,tema.idtema,tema.nombre_tema
			FROM noticia_subtema
			INNER JOIN subtema ON noticia_subtema.rel_idsubtema=subtema.idsubtema
			INNER JOIN tema ON subtema.rel_idtema=tema.idtema
			INNER JOIN noticia ON noticia_subtema.rel_idnoticia=noticia.idnoticia
			INNER JOIN users ON noticia.rel_idusuario = users.id
			INNER JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento "
			."WHERE noticia.fecha_registro BETWEEN ".$fi." AND ".$ff
			." AND departamento.iddepartamento=".$idd
			." AND tema.idtema=".$idt
			." AND noticia.esta_activa = 1";
		$q = $this->db->query($sql);
		return count($q->result());
	}
	public function leerNumLeyDepartamento($fi,$ff,$idd,$idc)
	{
		$sql="SELECT departamento.iddepartamento,departamento.nombre_departamento,cuestionario.nombre_cuestionario
			FROM leyes
			INNER JOIN users ON leyes.rel_idusuario = users.id
			INNER JOIN cuestionario ON leyes.rel_idcuestionario = cuestionario.idcuestionario
			INNER JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento "
			." WHERE leyes.fecha_registro BETWEEN ".$fi." AND ".$ff
			." AND departamento.iddepartamento=".$idd
			." AND cuestionario.idcuestionario=".$idc;//------activo?
		$q = $this->db->query($sql);
		return count($q->result());
	}
	public function leerNumActorDepartamento($fi,$ff,$idd,$ida)
	{
		$sql="SELECT departamento.iddepartamento,departamento.nombre_departamento,actor.idactor,actor.nombre_actor
			FROM noticia_actor
			INNER JOIN actor on noticia_actor.rel_idactor=actor.idactor
			INNER JOIN noticia ON noticia_actor.rel_idnoticia=noticia.idnoticia
			INNER JOIN users ON noticia.rel_idusuario = users.id
			INNER JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento "
			." WHERE leyes.fecha_registro BETWEEN ".$fi." AND ".$ff
			." AND departamento.iddepartamento=".$idd
			." AND actor.idactor=".$ida;
		$q = $this->db->query($sql);
		return count($q->result());
	}
	public function leerNumTipoMedioDepartamento($idd,$idtm)
	{
		$sql="SELECT departamento.iddepartamento,departamento.nombre_departamento,tipo_medio.idtipomedio,tipo_medio.nombre_tipo
			FROM noticia
			INNER JOIN medio_comunicacion ON noticia.rel_idmedio=medio_comunicacion.idmedio
			INNER JOIN tipo_medio ON medio_comunicacion.rel_idtipomedio=tipo_medio.idtipomedio
			INNER JOIN users ON noticia.rel_idusuario = users.id
			INNER JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento "
			."WHERE departamento.iddepartamento=".$idd
			." AND tipo_medio.idtipomedio=".$idtm;
		$q = $this->db->query($sql);
		return count($q->result());
	}
	public function leerNumCuestionarioNoticia($idc)
	{
		$sql="SELECT cuestionario.idcuestionario,cuestionario.nombre_cuestionario
			FROM noticia
			INNER JOIN cuestionario on noticia.rel_idcuestionario=cuestionario.idcuestionario "
			."WHERE cuestionario.idcuestionario=".$idc;
		$q = $this->db->query($sql);
		return count($q->result());
	}
	public function leerNumCuestionarioNoticiaDepto($idc,$idd)
	{
		$sql="SELECT cuestionario.idcuestionario,cuestionario.nombre_cuestionario
			FROM noticia
			INNER JOIN cuestionario ON noticia.rel_idcuestionario=cuestionario.idcuestionario 
			INNER JOIN users ON noticia.rel_idusuario = users.id "
			."WHERE cuestionario.idcuestionario=".$idc
			." AND users.rel_iddepartamento = ".$idd;
		$q = $this->db->query($sql);
		return count($q->result());
	}
	public function leerNumTemaNoticia($idt)
	{
		$sql="SELECT DISTINCT noticia_subtema.rel_idnoticia,tema.idtema 
			FROM noticia_subtema
			INNER JOIN subtema ON noticia_subtema.rel_idsubtema=subtema.idsubtema
			INNER JOIN tema ON subtema.rel_idtema=tema.idtema "
			."WHERE tema.idtema=".$idt;
		$q = $this->db->query($sql);
		return count($q->result());
	}
	public function leerNumTemaNoticiaDepto($idt,$idd)
	{
		$sql="SELECT DISTINCT noticia_subtema.rel_idnoticia,tema.idtema 
			FROM noticia_subtema
			INNER JOIN noticia ON noticia_subtema.rel_idnoticia=noticia.idnoticia
			INNER JOIN users ON noticia.rel_idusuario=users.id
			INNER JOIN subtema ON noticia_subtema.rel_idsubtema=subtema.idsubtema
			INNER JOIN tema ON subtema.rel_idtema=tema.idtema "
			."WHERE tema.idtema=".$idt
			." AND users.rel_iddepartamento=".$idd;
		$q = $this->db->query($sql);
		return count($q->result());
	}
	public function leerNumTemaLey($idt)
	{
		$sql="SELECT DISTINCT ley_subtema.rel_idleyes,tema.idtema 
			FROM ley_subtema
			INNER JOIN subtema ON ley_subtema.rel_idsubtema=subtema.idsubtema
			INNER JOIN tema ON subtema.rel_idtema=tema.idtema "
			."WHERE tema.idtema=".$idt;
		$q = $this->db->query($sql);
		return count($q->result());
	}
	public function leerNumTemaLeyDpto($idt,$idd)
	{
		$sql="SELECT DISTINCT ley_subtema.rel_idleyes,tema.idtema 
			FROM ley_subtema
			INNER JOIN leyes ON ley_subtema.rel_idleyes=leyes.idleyes
			INNER JOIN users ON leyes.rel_idusuario=users.id
			INNER JOIN subtema ON ley_subtema.rel_idsubtema=subtema.idsubtema
			INNER JOIN tema ON subtema.rel_idtema=tema.idtema "
			."WHERE tema.idtema=".$idt
			." AND users.rel_iddepartamento=".$idd;
		$q = $this->db->query($sql);
		return count($q->result());
	}
	public function leerSubTemasIdTema($idt)
	{	
		$this->db->where('rel_idtema',$idt);
		$q=$this->db->get("subtema");
		return $q->result();
	}
	public function leerCantSubTemasIdTema($idt)
	{	
		$this->db->where('rel_idtema',$idt);
		$q=$this->db->get("subtema");
		return count($q->result());
	}
	public function leerNumSubTemaNoticia($idst)
	{
		$sql="SELECT DISTINCT noticia_subtema.rel_idnoticia,subtema.idsubtema,subtema.nombre_subtema,subtema.rel_idtema 
			FROM noticia_subtema
			INNER JOIN subtema ON noticia_subtema.rel_idsubtema=subtema.idsubtema "
			."WHERE subtema.idsubtema=".$idst;
		$q = $this->db->query($sql);
		return count($q->result());
	}
	public function leerNumSubTemaNoticiaDpto($idst,$idd)
	{
		$sql="SELECT DISTINCT noticia_subtema.rel_idnoticia,subtema.idsubtema,subtema.nombre_subtema,subtema.rel_idtema 
			FROM noticia_subtema
			INNER JOIN noticia ON noticia_subtema.rel_idnoticia=noticia.idnoticia
			INNER JOIN users ON noticia.rel_idusuario=users.id
			INNER JOIN subtema ON noticia_subtema.rel_idsubtema=subtema.idsubtema "
			."WHERE subtema.idsubtema=".$idst
			." AND users.rel_iddepartamento=".$idd;
		$q = $this->db->query($sql);
		return count($q->result());
	}
	public function leerNumSubTemaLey($idst)
	{
		$sql="SELECT DISTINCT ley_subtema.rel_idleyes,subtema.idsubtema,subtema.nombre_subtema,subtema.rel_idtema 
			FROM ley_subtema
			INNER JOIN subtema ON ley_subtema.rel_idsubtema=subtema.idsubtema "
			."WHERE subtema.idsubtema=".$idst;
		$q = $this->db->query($sql);
		return count($q->result());
	}
	public function leerNumSubTemaLeyDepto($idst,$idd)
	{
		$sql="SELECT DISTINCT ley_subtema.rel_idleyes,subtema.idsubtema,subtema.nombre_subtema,subtema.rel_idtema 
			FROM ley_subtema
			INNER JOIN leyes ON ley_subtema.rel_idleyes=leyes.idleyes
			INNER JOIN users ON leyes.rel_idusuario=users.id
			INNER JOIN subtema ON ley_subtema.rel_idsubtema=subtema.idsubtema "
			."WHERE subtema.idsubtema=".$idst
			." AND users.rel_iddepartamento=".$idd;
		$q = $this->db->query($sql);
		return count($q->result());
	}


	//Grafico cuerdas - Dato Reforma electoral inicial
	public function datoRef0($fecha, $idactor)
	{
		$sql = "SELECT *"
			."FROM leyes AS l "
			."LEFT JOIN leyes_estadoley ON leyes_estadoley.rel_idleyes = l.idleyes "
			."LEFT JOIN estadoley ON estadoley.idestadoley = leyes_estadoley.rel_idestadoley "
			."WHERE l.rel_idusuario = ? "
			."ORDER BY estadoley.porcentaje_estadoley ASC";
		$qry = $this->db->query($sql);
		return $qry->result();

	}

	/**
	 * GRAFICO DE CUERDAS
	 **/



	//Grafico cuerdas - Dato Reforma electoral final
	public function datoActorCuestionario($fecha0, $fechaf, $actor, $formulario)
	{
		$fecha_minima = $this->fecha_unix($fecha0) ;
		$fecha_maxima = $this->fecha_unix($fechaf) ;
		$idactor = $actor;
		$idformulario = $formulario;

		$sql = "SELECT COUNT(*) AS cuenta "
			."FROM noticia AS n "
			."LEFT JOIN noticia_actor ON n.idnoticia =  noticia_actor.rel_idnoticia  "
			."LEFT JOIN actor ON noticia_actor.rel_idactor = actor.idactor  "
			."WHERE n.esta_activa = 1  "
			."AND actor.idactor = ?  "
			."AND n.rel_idcuestionario = ?  "
			."AND (n.fecha_noticia BETWEEN ? AND ?)   "
			." ";
		$qry = $this->db->query($sql, [$idactor, $idformulario, $fecha_minima, $fecha_maxima, ]);
		$result = $qry->row();
		return (int)$result->cuenta;
	}



	//Numero total de noticias activas
	//Devuelve un entero no signado
	public function numeroNoticiasActivas()
	{
		$this->db->select('idnoticia');
		$this->db->from('noticia');
		$this->db->where('esta_activa', true);
		$resultado = $this->db->count_all_results();
		return $resultado;
	}

	//Numero de noticias por id de formulario
	public function numeroNoticiasPorFormulario($idformulario)
	{
		$sql = "SELECT COUNT(*) AS cuenta "
			."FROM noticia AS n "
			."LEFT JOIN cuestionario ON n.rel_idcuestionario = cuestionario.idcuestionario "
			."WHERE n.esta_activa = 1  "
			."AND cuestionario.idcuestionario = ? "
			." ";
		$qry = $this->db->query($sql, [$idformulario ]);
		$result = $qry->row();
		return (int)$result->cuenta;
	}

	//Fecha minima
	public function fechaMinimaNoticia()
	{
		$sql = "SELECT MIN(n.fecha_noticia) AS fecha  "
			."FROM noticia AS n  "
			."WHERE n.esta_activa = 1  "
			."  "
			."  "
			." ";
		$qry = $this->db->query($sql);
		$result = $qry->row();
		return (int)$result->fecha;
	}

	//Fecha maxima
	public function fechaMaximaNoticia()
	{
		$sql = "SELECT MAX(n.fecha_noticia) AS fecha  "
			."FROM noticia AS n  "
			."WHERE n.esta_activa = 1  "
			."  "
			."  "
			." ";
		$qry = $this->db->query($sql);
		$result = $qry->row();
		return (int)$result->fecha;
	}

	//Fecha minima
	public function fechaMinimaRegistroNoticia()
	{
		$sql = "SELECT MIN(n.fecha_registro) AS fecha  "
			."FROM noticia AS n  "
			."WHERE n.esta_activa = 1  "
			."  "
			."  "
			." ";
		$qry = $this->db->query($sql);
		$result = $qry->row();
		return (int)$result->fecha;
	}

	//Fecha maxima
	public function fechaMaximaRegistroNoticia()
	{
		$sql = "SELECT MAX(n.fecha_registro) AS fecha  "
			."FROM noticia AS n  "
			."WHERE n.esta_activa = 1  "
			."  "
			."  "
			." ";
		$qry = $this->db->query($sql);
		$result = $qry->row();
		return (int)$result->fecha;
	}

	//Cantidad de noticias totales activas
	public function numeroTotalDeNoticiasActivas()
	{
		$sql = "SELECT COUNT(*) AS cantidad  "
			."FROM noticia AS n   "
			."WHERE n.esta_activa = 1  "
			."  "
			."  "
			." ";
		$qry = $this->db->query($sql);
		$result = $qry->row();
		return (int)$result->cantidad;
	}

	//Rutina de dd/mm/AA a unix timestamp
	private function fecha_unix($fecha)
	{
		$fecha_std = str_replace('/', '-', $fecha);
		$fecha_unix = strtotime($fecha_std);
		return $fecha_unix;
	}


	/**
	 * FIN GRAFICO DE CUERDAS
	 **/

	/**
	 * GRAFICO DE Barras
	 **/

	//Cantidad de temas por cuestionario
	public function leerCantidadTemasPorCuestionario()
	{
		$sql = "SELECT cuestionario.idcuestionario AS id, cuestionario.nombre_cuestionario AS n, COUNT(*) AS nt  "
			."FROM tema as t   "
			."LEFT JOIN cuestionario ON t.rel_idcuestionario = cuestionario.idcuestionario  "
			."GROUP BY cuestionario.idcuestionario  "
			."  "
			."  "
			."  "
			."  ";

		$qry = $this->db->query($sql);
		return $qry->result();
	}

	//Leer cantidad de subtemas por tema


	//temas por cuestionario
	public function leerCantidadSubtemasPorTema($idcuestionario)
	{
		$sql = "SELECT tema.rel_idcuestionario AS id, tema.idtema AS idt, tema.nombre_tema AS n, COUNT(subtema.idsubtema) AS cst  "
			."FROM subtema     "
			."RIGHT JOIN tema ON subtema.rel_idtema = tema.idtema   "
			."WHERE tema.rel_idcuestionario = ?  "
			."GROUP BY tema.idtema  "
			."  "
			."  "
			."  "
			."  ";

		$qry = $this->db->query($sql, [$idcuestionario,]);
		return $qry->result();
	}

	//Temas por subtemas
	public function leerSubtemasPorTema($idtema)
	{
		$sql = "SELECT tema.idtema AS idt, subtema.idsubtema AS idst, subtema.nombre_subtema AS n  "
			."FROM subtema    "
			."RIGHT JOIN tema ON subtema.rel_idtema = tema.idtema    "
			."WHERE tema.idtema = ?  "
			."  "
			."  "
			."  "
			."  "
			."  ";

		$qry = $this->db->query($sql, [$idtema,]);
		return $qry->result();
	}

	//Cantidad de noticias dentro de un intervalo
	public function cantidadNoticiasIntervaloFechas($fecha0, $fechaf)
	{
		$fecha_minima = $this->fecha_unix($fecha0) ;
		$fecha_maxima = $this->fecha_unix($fechaf) ;

		$sql = "SELECT COUNT(*) AS cantidad  "
			."FROM noticia AS n   "
			."WHERE n.esta_activa = 1  "
			."AND (n.fecha_noticia BETWEEN ? AND ?) "
			."  "
			." ";
		$qry = $this->db->query($sql, [$fecha_minima, $fecha_maxima, ]);
		$result = $qry->row();
		return (int)$result->cantidad;
	}

	//Cantidad total de noticias

	//Cantidad de noticias por cuestionario dentro de un intervalo
	public function cantidadNoticiasFormIntervaloFechas($fecha0, $fechaf, $idcuestionario)
	{
		$fecha_minima = $this->fecha_unix($fecha0) ;
		$fecha_maxima = $this->fecha_unix($fechaf) ;

		$sql = "SELECT  COUNT(*) AS cantidad "
			."FROM noticia_subtema    "
			."INNER JOIN noticia ON noticia.idnoticia = noticia_subtema.rel_idnoticia "
			."INNER JOIN subtema ON subtema.idsubtema = noticia_subtema.rel_idsubtema "
			."INNER JOIN tema ON tema.idtema = subtema.rel_idtema "
			."WHERE noticia.esta_activa = 1  "
			."AND noticia.rel_idcuestionario = ? "
			."AND (noticia.fecha_noticia BETWEEN ? AND ?) "
			."  "
			." ";
		$qry = $this->db->query($sql, [$idcuestionario, $fecha_minima, $fecha_maxima, ]);
		$result = $qry->row();
		return (int)$result->cantidad;
	}

	public function cantidadLeyesPorIntervaloFecha($fecha0, $fechaf)
	{
		$fecha_minima = $this->fecha_unix($fecha0) ;
		$fecha_maxima = $this->fecha_unix($fechaf) ;

		$sql = "SELECT COUNT(*) AS cantidad  "
			."FROM ley_subtema   "
			."INNER JOIN leyes ON ley_subtema.rel_idleyes = leyes.idleyes  "
			."INNER JOIN subtema ON subtema.idsubtema = ley_subtema.rel_idsubtema  "
			."INNER JOIN tema ON tema.idtema = subtema.rel_idtema "
			."WHERE leyes.esta_activa = 1  "
			."AND (leyes.fecha_registro BETWEEN ? AND ?) "
			."  "
			." ";
		$qry = $this->db->query($sql, [$fecha_minima, $fecha_maxima, ]);
		$result = $qry->row();
		return (int)$result->cantidad;

	}

	//Cantidad de noticias referidas a un tema
	public function cantidadTemasNoticiaPorIntervaloFechas($fecha0, $fechaf, $idtema)
	{
		$fecha_minima = $this->fecha_unix($fecha0) ;
		$fecha_maxima = $this->fecha_unix($fechaf) ;

		$sql = "SELECT  COUNT(*) AS cantidad  "
			."FROM noticia_subtema    "
			."INNER JOIN noticia ON noticia.idnoticia = noticia_subtema.rel_idnoticia "
			."INNER JOIN subtema ON subtema.idsubtema = noticia_subtema.rel_idsubtema "
			."INNER JOIN tema ON tema.idtema = subtema.rel_idtema "
			."WHERE noticia.esta_activa = 1  "
			."AND tema.idtema = ? "
			."AND (noticia.fecha_noticia BETWEEN ? AND ?) "
			."  "
			." ";
		$qry = $this->db->query($sql, [$idtema, $fecha_minima, $fecha_maxima, ]);
		$result = $qry->row();
		return (int)$result->cantidad;
	}
	//Cantidad de leyes referidas a un tema
	public function cantidadTemasLeyPorIntervaloFechas($fecha0, $fechaf, $idtema)
	{
		$fecha_minima = $this->fecha_unix($fecha0) ;
		$fecha_maxima = $this->fecha_unix($fechaf) ;

		$sql = "SELECT COUNT(*) AS cantidad  "
			." FROM ley_subtema    "
			."INNER JOIN leyes ON ley_subtema.rel_idleyes = leyes.idleyes  "
			."INNER JOIN subtema ON subtema.idsubtema = ley_subtema.rel_idsubtema "
			."INNER JOIN tema ON tema.idtema = subtema.rel_idtema "
			."WHERE leyes.esta_activa = 1  "
			."AND tema.idtema = ? "
			."AND (leyes.fecha_registro BETWEEN ? AND ?) "
			."  "
			." ";
		$qry = $this->db->query($sql, [$idtema, $fecha_minima, $fecha_maxima, ]);
		$result = $qry->row();
		return (int)$result->cantidad;
	}

	//Cantidad de noticias referidas a un subtema
	public function cantidadSubtemasNoticiaPorIntervaloFechas($fecha0, $fechaf, $idsubtema)
	{
		$fecha_minima = $this->fecha_unix($fecha0) ;
		$fecha_maxima = $this->fecha_unix($fechaf) ;

		$sql = "SELECT  COUNT(*) AS cantidad "
			."FROM noticia_subtema    "
			."INNER JOIN noticia ON noticia.idnoticia = noticia_subtema.rel_idnoticia "
			."INNER JOIN subtema ON subtema.idsubtema = noticia_subtema.rel_idsubtema "
			."INNER JOIN tema ON tema.idtema = subtema.rel_idtema "
			."WHERE noticia.esta_activa = 1  "
			."AND subtema.idsubtema = ? "
			."AND (noticia.fecha_noticia BETWEEN ? AND ?) "
			."  "
			." ";

		$qry = $this->db->query($sql, [$idsubtema, $fecha_minima, $fecha_maxima, ]);
		$result = $qry->row();
		return (int)$result->cantidad;
	}

	//Cantidad de noticias referidas a un subtema
	public function cantidadSubtemasLeyesPorIntervaloFechas($fecha0, $fechaf, $idsubtema)
	{
		$fecha_minima = $this->fecha_unix($fecha0) ;
		$fecha_maxima = $this->fecha_unix($fechaf) ;

		$sql = "SELECT COUNT(*) AS cantidad  "
			."FROM ley_subtema    "
			."INNER JOIN leyes ON ley_subtema.rel_idleyes = leyes.idleyes "
			."INNER JOIN subtema ON subtema.idsubtema = ley_subtema.rel_idsubtema "
			."INNER JOIN tema ON tema.idtema = subtema.rel_idtema "
			."WHERE leyes.esta_activa = 1 "
			."AND subtema.idsubtema = ?  "
			."AND (leyes.fecha_registro BETWEEN ? AND ?)  "
			."  "
			." "
			."  "
			." ";
		$qry = $this->db->query($sql, [$idsubtema, $fecha_minima, $fecha_maxima, ]);
		$result = $qry->row();
		return (int)$result->cantidad;
	}




	/**
	 * FIN GRAFICO DE Barras
	 **/

	/**
	 * GRAFICO DE Barras Departamento
	 **/
	//Cantidad de noticias por cuestionario dentro de un intervalo
	public function cantidadNoticiasFormIntervaloFechasDep($fecha0, $fechaf, $idcuestionario, $iddepartamento)
	{
		$fecha_minima = $this->fecha_unix($fecha0) ;
		$fecha_maxima = $this->fecha_unix($fechaf) ;

		$sql = "SELECT  COUNT(*) AS cantidad   "
			."FROM noticia_subtema       "
			."INNER JOIN noticia ON noticia.idnoticia = noticia_subtema.rel_idnoticia   "
			."INNER JOIN users ON users.id = noticia.rel_idusuario  "
			."INNER JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento  "
			."INNER JOIN subtema ON subtema.idsubtema = noticia_subtema.rel_idsubtema  "
			."INNER JOIN tema ON tema.idtema = subtema.rel_idtema   "
			."WHERE noticia.esta_activa = 1   "
			."AND noticia.rel_idcuestionario = ? "
			."AND departamento.iddepartamento = ?  "
			."AND (noticia.fecha_noticia BETWEEN ? AND ?) "
			."  "
			." ";
		$qry = $this->db->query($sql, [$idcuestionario, $iddepartamento, $fecha_minima, $fecha_maxima, ]);
		$result = $qry->row();
		return (int)$result->cantidad;
	}

	//Cantidad de noticias referidas a un tema
	public function cantidadTemasNoticiaPorIntervaloFechasDep($fecha0, $fechaf, $idtema, $iddepartamento)
	{
		$fecha_minima = $this->fecha_unix($fecha0) ;
		$fecha_maxima = $this->fecha_unix($fechaf) ;

		$sql = "SELECT  COUNT(*) AS cantidad   "
			."FROM noticia_subtema       "
			."INNER JOIN noticia ON noticia.idnoticia = noticia_subtema.rel_idnoticia      "
			."INNER JOIN users ON users.id = noticia.rel_idusuario    "
			."INNER JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento    "
			."INNER JOIN subtema ON subtema.idsubtema = noticia_subtema.rel_idsubtema    "
			."INNER JOIN tema ON tema.idtema = subtema.rel_idtema      "
			."   "
			."WHERE noticia.esta_activa = 1  "
			."AND tema.idtema = ? "
			."AND departamento.iddepartamento = ?  "
			."AND (noticia.fecha_noticia BETWEEN ? AND ?) "
			." "
			." ";


		$qry = $this->db->query($sql, [$idtema, $iddepartamento, $fecha_minima, $fecha_maxima, ]);
		$result = $qry->row();
		return (int)$result->cantidad;
	}
	//Cantidad de noticias referidas a un subtema
	public function cantidadSubtemasNoticiaPorIntervaloFechasDep($fecha0, $fechaf, $idsubtema, $iddepartamento)
	{
		$fecha_minima = $this->fecha_unix($fecha0) ;
		$fecha_maxima = $this->fecha_unix($fechaf) ;

		$sql = "SELECT  COUNT(*) AS cantidad   "
			."FROM noticia_subtema       "
			."INNER JOIN noticia ON noticia.idnoticia = noticia_subtema.rel_idnoticia   "
			."INNER JOIN users ON users.id = noticia.rel_idusuario  "
			."INNER JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento  "
			."INNER JOIN subtema ON subtema.idsubtema = noticia_subtema.rel_idsubtema  "
			."INNER JOIN tema ON tema.idtema = subtema.rel_idtema   "
			."WHERE noticia.esta_activa = 1  "
			."AND subtema.idsubtema = ?  "
			."AND departamento.iddepartamento = ?  "
			."AND (noticia.fecha_noticia BETWEEN ? AND ?) "
			."  "
			." ";

		$qry = $this->db->query($sql, [$idsubtema, $iddepartamento, $fecha_minima, $fecha_maxima, ]);
		$result = $qry->row();
		return (int)$result->cantidad;
	}
	public function leerTodasLasEncuestas()
	{
		$q=$this->db->get('uiencuesta');
		return $q->result();
	}
	public function leerEncuestId($ide)
	{
		$this->db->where('iduiencuesta',$ide);
		$q=$this->db->get('uiencuesta');
		return $q->row();
	}
	/**
	 * Fin GRAFICO DE Barras Departamento
	 **/
/////////////////////GRAFICO BARRAS WILL////////////////////////////
	public function leerPreguntasDencuesta($idencuesta)
	{
		$que = $idencuesta;
		$sql = "SELECT iduiencuesta, uinombre_encuesta, iduipregunta, uipregunta_nombre "
			."FROM uiencuesta "
			."LEFT JOIN uimodulo ON uimodulo.rel_iduiencuesta = uiencuesta.iduiencuesta "
			."LEFT JOIN uiseccion ON uiseccion.rel_iduimodulo = uimodulo.iduimodulo "
			."LEFT JOIN uipregunta ON uipregunta.rel_iduiseccion = uiseccion.iduiseccion "
			."WHERE iduiencuesta = ?";
		$qry = $this->db->query($sql,[$que]);
		return $qry->result();
	}
	public function leerRespuestasDpregunta($encuesta,$pregunta)
	{
		$sql = "SELECT iduiencuesta, uinombre_encuesta encuesta, iduipregunta, uipregunta_nombre pregunta, iduirespuesta, uinombre_respuesta respuesta "
			."FROM uiencuesta "
			."LEFT JOIN uimodulo ON uimodulo.rel_iduiencuesta = uiencuesta.iduiencuesta "
			."LEFT JOIN uiseccion ON uiseccion.rel_iduimodulo = uimodulo.iduimodulo "
			."LEFT JOIN uipregunta ON uipregunta.rel_iduiseccion = uiseccion.iduiseccion "
			."LEFT JOIN uirespuesta_pregunta ON uirespuesta_pregunta.rel_iduipregunta = uipregunta.iduipregunta "
			."LEFT JOIN uirespuesta ON uirespuesta.iduirespuesta = uirespuesta_pregunta.rel_iduirespuesta "
			."WHERE iduiencuesta = ? AND iduipregunta = ? ";
		$qry = $this->db->query($sql,[$encuesta, $pregunta]);
		return $qry->result();
	}
	public function leerRespuestas1($encuesta,$pregunta)
	{
		$sql = "SELECT uinombre_respuesta r "
			."FROM uiencuesta "
			."LEFT JOIN uimodulo ON uimodulo.rel_iduiencuesta = uiencuesta.iduiencuesta "
			."LEFT JOIN uiseccion ON uiseccion.rel_iduimodulo = uimodulo.iduimodulo "
			."LEFT JOIN uipregunta ON uipregunta.rel_iduiseccion = uiseccion.iduiseccion "
			."LEFT JOIN uirespuesta_pregunta ON uirespuesta_pregunta.rel_iduipregunta = uipregunta.iduipregunta "
			."LEFT JOIN uirespuesta ON uirespuesta.iduirespuesta = uirespuesta_pregunta.rel_iduirespuesta "
			."WHERE iduiencuesta = ? AND iduipregunta = ? ";
		$qry = $this->db->query($sql,[$encuesta, $pregunta]);
		return $qry->result();
	}
	public function leerEncuestasHM($encuesta, $pregunta, $sexo, $edadinicial, $edadfinal)
	{
		$sql = "SELECT iduiencuesta, uinombre_encuesta encuesta, iduipregunta, uipregunta_nombre pregunta, iduirespuesta, uinombre_respuesta respuesta, COUNT(*) cantidad "
			."FROM uiencuesta "
			."LEFT JOIN uimodulo ON uimodulo.rel_iduiencuesta = uiencuesta.iduiencuesta "
			."LEFT JOIN uiseccion ON uiseccion.rel_iduimodulo = uimodulo.iduimodulo "
			."LEFT JOIN uipregunta ON uipregunta.rel_iduiseccion = uiseccion.iduiseccion "
			."LEFT JOIN formulariocomp_respuestas ON formulariocomp_respuestas.rel_idpregunta = uipregunta.iduipregunta "
			."LEFT JOIN formulariocompletado ON formulariocompletado.idformcomp = formulariocomp_respuestas.rel_idformcomp "
			."LEFT JOIN uirespuesta ON uirespuesta.iduirespuesta = formulariocomp_respuestas.rel_idrespuesta "
			."WHERE iduiencuesta = ? AND iduipregunta = ? AND sexo = ? AND (edad BETWEEN ? AND ?) "
			."GROUP BY respuesta "
			."ORDER BY iduirespuesta ";
        $qry = $this->db->query($sql,[$encuesta, $pregunta, $sexo, $edadinicial, $edadfinal]);
        return $qry->result();
	}
//////////////////////////////////////////////////////////////////////
	public function leerRespuestasDpreguntaS($encuesta,$pregunta)
	{
		$sql = "SELECT iduiencuesta, uinombre_encuesta encuesta, iduipregunta, uipregunta_nombre pregunta, iduirespuesta, uinombre_respuesta respuesta "
			."FROM uiencuesta "
			."LEFT JOIN uimodulo ON uimodulo.rel_iduiencuesta = uiencuesta.iduiencuesta "
			."LEFT JOIN uiseccion ON uiseccion.rel_iduimodulo = uimodulo.iduimodulo "
			."LEFT JOIN uipregunta ON uipregunta.rel_iduiseccion = uiseccion.iduiseccion "
			."LEFT JOIN uirespuesta_pregunta ON uirespuesta_pregunta.rel_iduipregunta = uipregunta.iduipregunta "
			."LEFT JOIN uirespuesta ON uirespuesta.iduirespuesta = uirespuesta_pregunta.rel_iduirespuesta "
			."WHERE iduiencuesta = ? AND iduipregunta = ? ";
		$qry = $this->db->query($sql,[$encuesta, $pregunta]);
		return $qry->result();
	}
	public function leerCantidadArespuestasPosibles($encuesta,$pregunta)
	{
		$sql = "SELECT iduiencuesta, uinombre_encuesta encuesta, iduipregunta, uipregunta_nombre pregunta, iduirespuesta, uinombre_respuesta respuesta, rel_iddepartamento departamento, sexo, COUNT(*) cantidad "
			."FROM uiencuesta "
			."LEFT JOIN uimodulo ON uimodulo.rel_iduiencuesta = uiencuesta.iduiencuesta "
			."LEFT JOIN uiseccion ON uiseccion.rel_iduimodulo = uimodulo.iduimodulo "
			."LEFT JOIN uipregunta ON uipregunta.rel_iduiseccion = uiseccion.iduiseccion "
			."LEFT JOIN formulariocomp_respuestas ON formulariocomp_respuestas.rel_idpregunta = uipregunta.iduipregunta "
			."LEFT JOIN formulariocompletado ON formulariocompletado.idformcomp = formulariocomp_respuestas.rel_idformcomp "
			."LEFT JOIN uirespuesta ON uirespuesta.iduirespuesta = formulariocomp_respuestas.rel_idrespuesta "
			."LEFT JOIN users ON users.id = formulariocompletado.rel_idusuario "
			."WHERE iduiencuesta = ? AND iduipregunta = ? "
			."GROUP BY departamento, respuesta "
			."ORDER BY departamento, iduirespuesta ";
		$qry = $this->db->query($sql,[$encuesta, $pregunta]);
		return $qry->result();
	}
	public function leerCantidadArespuestasPosiblesM1($encuesta,$pregunta,$sexo,$depto)
	{
		$sql = "SELECT iduiencuesta, uinombre_encuesta encuesta, iduipregunta, uipregunta_nombre pregunta, iduirespuesta, uinombre_respuesta respuesta, rel_iddepartamento departamento, sexo, COUNT(*) cantidad "
			."FROM uiencuesta "
			."LEFT JOIN uimodulo ON uimodulo.rel_iduiencuesta = uiencuesta.iduiencuesta "
			."LEFT JOIN uiseccion ON uiseccion.rel_iduimodulo = uimodulo.iduimodulo "
			."LEFT JOIN uipregunta ON uipregunta.rel_iduiseccion = uiseccion.iduiseccion "
			."LEFT JOIN formulariocomp_respuestas ON formulariocomp_respuestas.rel_idpregunta = uipregunta.iduipregunta "
			."LEFT JOIN formulariocompletado ON formulariocompletado.idformcomp = formulariocomp_respuestas.rel_idformcomp "
			."LEFT JOIN uirespuesta ON uirespuesta.iduirespuesta = formulariocomp_respuestas.rel_idrespuesta "
			."LEFT JOIN users ON users.id = formulariocompletado.rel_idusuario "
			."WHERE iduiencuesta = ? AND iduipregunta = ? AND sexo = ? AND rel_iddepartamento = ? "
			."GROUP BY departamento, respuesta "
			."ORDER BY departamento, iduirespuesta ";
		$qry = $this->db->query($sql,[$encuesta, $pregunta, $sexo, $depto]);
		return $qry->result();
	}
}