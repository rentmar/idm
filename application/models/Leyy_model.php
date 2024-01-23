<?php
class Leyy_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

        public function leerEstadosLey()
        {
            $sql="SELECT * "
                    . "FROM estadoley "
                    . " ";
            $qry=$this->db->query($sql);
            return $qry->result();
        }
        public function leyPorEstado($consulta)
        {
            		$fecha_inicio = $consulta->fecha_inicio;
		$fecha_fin = $consulta->fecha_fin;
		$idestadosley = $consulta->idestadoley;

		$sql = "SELECT * "
                        . "FROM leyes AS l  "
                        . "LEFT JOIN leyes_fuente ON leyes_fuente.rel_idleyes = l.idleyes "
                        . "LEFT JOIN fuente ON fuente.idfuente = leyes_fuente.rel_idfuente "
                        . "LEFT JOIN leyes_estadoley ON leyes_estadoley.rel_idleyes = l.idleyes "
                        . "LEFT JOIN estadoley ON estadoley.idestadoley = leyes_estadoley.rel_idestadoley "
                        . "LEFT JOIN nombreley ON nombreley.rel_idestadoley = estadoley.idestadoley AND nombreley.rel_idley = l.idleyes "
                        . "LEFT JOIN codigoley ON codigoley.rel_idley = l.idleyes AND codigoley.rel_idestadoley = estadoley.idestadoley "
						. "LEFT JOIN urlley ON urlley.rel_idestadoley = estadoley.idestadoley AND urlley.rel_idley = l.idleyes "
                        . "LEFT JOIN users ON l.rel_idusuario = users.id "
                        . "LEFT JOIN universidad ON users.rel_iduniversidad = universidad.iduniversidad "
                        . "LEFT JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento "
                        . "LEFT JOIN ley_subtema ON ley_subtema.rel_idleyes = l.idleyes "
                        . "LEFT JOIN subtema ON subtema.idsubtema = ley_subtema.rel_idsubtema "
                        . "LEFT JOIN tema ON subtema.rel_idtema = tema.idtema "
						. "WHERE (l.fecha_registro BETWEEN ? AND ?)  "
						. "AND l.esta_activa = 1  "
						. "AND  estadoley.idestadoley = ? ";
		$qry = $this->db->query($sql, [$fecha_inicio, $fecha_fin, $idestadosley  ]);
		return $qry->result();
        }
        	public function leerestadoleyId($ide)
	{
		$this->db->where('idestadoley',$ide);
		$q= $this->db->get('estadoley');
		return $q->row();
	}
/*        	public function leerCuestionario($idcuestionario)
	{
		$qry = $this->db->get_where('cuestionario', [ 'idcuestionario' => $idcuestionario ]);
		return $qry->row();
	}*/
        public function leyPorUniversidad($consulta)
        {
            $fecha_inicio = $consulta->fecha_inicio;
            $fecha_fin = $consulta->fecha_fin;
            $iduniversidad = $consulta->iduniversidad;
            
            $sql = "SELECT le.idleyes, le.fecha_registro, leyes_estadoley.fecha_estadoley, fuente.nombre_fuente, estadoley.nombre_estadoley, codigoley.codigo_ley, nombreley.nombre_ley, le.resumen, urlley.url_ley, tema.nombre_tema, users.username,  users.first_name, users.last_name "
                        . "FROM leyes AS le "
                        . "LEFT JOIN leyes_estadoley ON leyes_estadoley.rel_idleyes = le.idleyes "
                        . "LEFT JOIN estadoley ON estadoley.idestadoley = leyes_estadoley.rel_idestadoley "
                        . "LEFT JOIN codigoley ON codigoley.rel_idley = le.idleyes "
                        . "LEFT JOIN leyes_fuente ON leyes_fuente.rel_idleyes = le.idleyes "
                        . "LEFT JOIN fuente ON fuente.idfuente = leyes_fuente.rel_idfuente "
                        . "LEFT JOIN nombreley ON nombreley.rel_idley = le.idleyes "
                        . "LEFT JOIN cuestionario ON cuestionario.idcuestionario = le.rel_idcuestionario "
                        . "LEFT JOIN users ON users.id = le.rel_idusuario "
                        . "LEFT JOIN urlley ON urlley.rel_idley = le.idleyes "
                        . "LEFT JOIN tema ON tema.rel_idcuestionario = le.rel_idcuestionario "
                   		. "LEFT JOIN universidad ON universidad.iduniversidad = users.rel_iduniversidad "
                        . "WHERE universidad.iduniversidad = ?  AND (le.fecha_registro BETWEEN ? AND ?) "
						. "AND le.esta_activa = 1  "
                        . "GROUP BY le.idleyes ASC ";
		$qry = $this->db->query($sql, [$iduniversidad, $fecha_inicio, $fecha_fin,  ]);
		return $qry->result();
        }
        	public function leeruniversidadlId($idul)
	{
		$this->db->where('iduniversidad',$idul);
		$q= $this->db->get('universidad');
		return $q->row();
	}
        public function leyPorTema($consulta)
        {
            $fecha_inicio = $consulta->fecha_inicio;
            $fecha_fin = $consulta->fecha_fin;
            $idtema = $consulta->idtema;
            
            $sql = "SELECT le.idleyes, le.fecha_registro, leyes_estadoley.fecha_estadoley, fuente.nombre_fuente, estadoley.nombre_estadoley, codigoley.codigo_ley, nombreley.nombre_ley, le.resumen, urlley.url_ley, tema.nombre_tema, users.username, users.first_name, users.last_name "
                        . "FROM leyes AS le "
                        . "LEFT JOIN leyes_estadoley ON leyes_estadoley.rel_idleyes = le.idleyes "
                        . "LEFT JOIN estadoley ON estadoley.idestadoley = leyes_estadoley.rel_idestadoley "
                        . "LEFT JOIN codigoley ON codigoley.rel_idley = le.idleyes "
                        . "LEFT JOIN leyes_fuente ON leyes_fuente.rel_idleyes = le.idleyes "
                        . "LEFT JOIN fuente ON fuente.idfuente = leyes_fuente.rel_idfuente "
                        . "LEFT JOIN nombreley ON nombreley.rel_idley = le.idleyes "
                        . "LEFT JOIN cuestionario ON cuestionario.idcuestionario = le.rel_idcuestionario "
                        . "LEFT JOIN users ON users.id = le.rel_idusuario "
                        . "LEFT JOIN urlley ON urlley.rel_idley = le.idleyes "
                        . "LEFT JOIN tema ON tema.rel_idcuestionario = le.rel_idcuestionario "
//                    . "LEFT JOIN universidad ON universidad.iduniversidad = users.rel_iduniversidad "
                        . "WHERE tema.idtema = ?  AND (le.fecha_registro BETWEEN ? AND ?) "
						. "AND le.esta_activa = 1 "
                        . "GROUP BY fuente.nombre_fuente ";
		$qry = $this->db->query($sql, [$idtema, $fecha_inicio, $fecha_fin,  ]);
		return $qry->result();
        }
        	public function leertemaleyId($idtl)
	{
		$this->db->where('idtema',$idtl);
		$q= $this->db->get('tema');
		return $q->row();
	}
        public function leyPorSubtema($consulta)
        {
            $fecha_inicio = $consulta->fecha_inicio;
            $fecha_fin = $consulta->fecha_fin;
            $idsubtema = $consulta->idsubtema;

			$sql = "SELECT * "
				. "FROM leyes AS l  "
				. "LEFT JOIN leyes_fuente ON leyes_fuente.rel_idleyes = l.idleyes "
				. "LEFT JOIN fuente ON fuente.idfuente = leyes_fuente.rel_idfuente "
				. "LEFT JOIN leyes_estadoley ON leyes_estadoley.rel_idleyes = l.idleyes "
				. "LEFT JOIN estadoley ON estadoley.idestadoley = leyes_estadoley.rel_idestadoley "
				. "LEFT JOIN nombreley ON nombreley.rel_idestadoley = estadoley.idestadoley AND nombreley.rel_idley = l.idleyes "
				. "LEFT JOIN codigoley ON codigoley.rel_idley = l.idleyes AND codigoley.rel_idestadoley = estadoley.idestadoley "
				. "LEFT JOIN urlley ON urlley.rel_idestadoley = estadoley.idestadoley AND urlley.rel_idley = l.idleyes "
				. "LEFT JOIN users ON l.rel_idusuario = users.id "
				. "LEFT JOIN universidad ON users.rel_iduniversidad = universidad.iduniversidad "
				. "LEFT JOIN departamento ON users.rel_iddepartamento = departamento.iddepartamento "
				. "LEFT JOIN ley_subtema ON ley_subtema.rel_idleyes = l.idleyes "
				. "LEFT JOIN subtema ON subtema.idsubtema = ley_subtema.rel_idsubtema "
				. "LEFT JOIN tema ON subtema.rel_idtema = tema.idtema "
				. "WHERE (l.fecha_registro BETWEEN ? AND ?)  "
				. "AND l.esta_activa = 1   "
				. "AND subtema.idsubtema = ? ";

		$qry = $this->db->query($sql, [$fecha_inicio, $fecha_fin, $idsubtema  ]);
		return $qry->result();
        }
        	public function leersubtemaleyId($idsl)
	{
		$this->db->where('idsubtema',$idsl);
		$q= $this->db->get('subtema');
		return $q->row();
	}
}
