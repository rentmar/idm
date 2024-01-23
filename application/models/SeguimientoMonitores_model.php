<?php
class SeguimientoMonitores_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function leerSeguimientoMonitores()
    {
        $qry=$this->db->query("SELECT U.first_name, U.last_name, D.nombre_departamento, MAX(L.fecha_registro) fecha_registro, C.nombre_cuestionario, count(*) ncuestionario "
                . "FROM leyes L "
                . "LEFT JOIN cuestionario C ON C.idcuestionario = L.rel_idcuestionario "
                . "LEFT JOIN users U ON U.id = L.rel_idusuario "
                . "LEFT JOIN departamento D ON D.iddepartamento = U.rel_iddepartamento "
                . "GROUP BY U.first_name, C.nombre_cuestionario "
                . "UNION "
                . "SELECT first_name,last_name,nombre_departamento,MAX(fecha_registro) fecha_registro,nombre_cuestionario,count(*) ncuestionario "
                . "FROM noticia "
                . "LEFT JOIN users ON users.id = noticia.rel_idusuario "
                . "LEFT JOIN cuestionario ON noticia.rel_idcuestionario = cuestionario.idcuestionario "
                . "LEFT JOIN departamento ON departamento.iddepartamento = users.rel_iddepartamento "
                . "GROUP BY first_name, nombre_cuestionario "
                . "ORDER BY first_name");
        return $qry->result();
    }
    public function leerSeguimientoMonitoresxUniversidad($l_user)
    {
        $idUsuario=$l_user->rel_iduniversidad;
        $qry=$this->db->query("SELECT first_name, last_name, nombre_departamento, nombre_cuestionario, count(*) ncuestionario "
                . "FROM leyes L "
                . "LEFT JOIN cuestionario C ON C.idcuestionario = L.rel_idcuestionario "
                . "LEFT JOIN users U ON U.id = L.rel_idusuario "
                . "LEFT JOIN departamento D ON D.iddepartamento = U.rel_iddepartamento "
                . "WHERE rel_iduniversidad = $idUsuario "
                . "GROUP BY U.first_name, C.nombre_cuestionario "
                . "UNION "
                . "SELECT first_name, last_name, nombre_departamento, nombre_cuestionario, count(*) ncuestionario "
                . "FROM noticia "
                . "LEFT JOIN users ON users.id = noticia.rel_idusuario "
                . "LEFT JOIN cuestionario ON noticia.rel_idcuestionario = cuestionario.idcuestionario "
                . "LEFT JOIN departamento ON departamento.iddepartamento = users.rel_iddepartamento "
                . "WHERE rel_iduniversidad = $idUsuario "
                . "GROUP BY first_name, nombre_cuestionario "
                . "ORDER BY first_name");
        return $qry->result();
    }
    public function leerCuestionarios()
    {
        $qry=$this->db->query("SELECT * "
                . "FROM cuestionario "
                . "GROUP BY nombre_cuestionario");
        return $qry->result();
    }
    public function leerDepartamentos()
    {
        $qry=$this->db->query("SELECT nombre_departamento first_name, nombre_cuestionario, count(*) ncuestionario "
                . "FROM leyes L "
                . "LEFT JOIN cuestionario C ON C.idcuestionario = L.rel_idcuestionario "
                . "LEFT JOIN users U ON U.id = L.rel_idusuario "
                . "LEFT JOIN departamento D ON D.iddepartamento = U.rel_iddepartamento "
                . "GROUP BY nombre_departamento, nombre_cuestionario "
                . "UNION "
                . "SELECT nombre_departamento first_name, nombre_cuestionario, count(*) ncuestionario "
                . "FROM noticia "
                . "LEFT JOIN users ON users.id = noticia.rel_idusuario "
                . "LEFT JOIN cuestionario ON noticia.rel_idcuestionario = cuestionario.idcuestionario "
                . "LEFT JOIN departamento ON departamento.iddepartamento = users.rel_iddepartamento "
                . "GROUP BY nombre_departamento, nombre_cuestionario "
                . "ORDER BY first_name");
        return $qry->result();
    }
    public function leerLey($idm)
    {
        $qry=$this->db->query("SELECT idleyes, fecha_registro, fecha_estadoley, nombre_ley, nombre_estadoley, codigo_ley, resumen "
                . "FROM leyes "
                . "LEFT JOIN leyes_estadoley ON leyes_estadoley.rel_idleyes = leyes.idleyes "
                . "LEFT JOIN codigoley ON codigoley.rel_idley = leyes.idleyes "
                . "LEFT JOIN nombreley On nombreley.rel_idley = leyes.idleyes "
                . "LEFT JOIN estadoley ON codigoley.rel_idestadoley = estadoley.idestadoley "
                . "WHERE $idm = leyes.idleyes "
                . "GROUP BY idleyes ");
        return $qry->result();
    }
}