<?php
class Radial_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function leerMactores($fechai,$fechaf)
    {
        $fecha_inicio = $fechai;
        $fecha_fin = $fechaf;
        		$sql = "SELECT idactor, nombre_actor, idcuestionario, nombre_cuestionario, COUNT(*) ncuestionario "
                                . "FROM actor "
                                . "LEFT JOIN noticia_actor ON noticia_actor.rel_idactor = actor.idactor "
                                . "LEFT JOIN noticia ON noticia.idnoticia = noticia_actor.rel_idnoticia "
                                . "LEFT JOIN cuestionario ON cuestionario.idcuestionario = noticia.rel_idcuestionario "
                                . "WHERE (noticia.fecha_registro BETWEEN ? AND ?) "
                                . "GROUP BY idactor, idcuestionario";
                $qry = $this->db->query($sql, [$fecha_inicio, $fecha_fin ]);
		return $qry->result();
    }
    public function leerMmedioDcomunicacion($fechai,$fechaf)
    {
        $fecha_inicio = $fechai;
        $fecha_fin = $fechaf;
                $sql = "SELECT idmedio, nombre_medio, idcuestionario, nombre_cuestionario, rel_idtipomedio, COUNT(*) ncuestionario "
                . "FROM noticia "
                . "LEFT JOIN medio_comunicacion ON medio_comunicacion.idmedio = noticia.rel_idmedio "
                . "LEFT JOIN cuestionario ON cuestionario.idcuestionario = noticia.rel_idcuestionario "
                . "WHERE (noticia.fecha_registro BETWEEN ? AND ?) "
                . "GROUP BY idmedio, idcuestionario";
                $qry = $this->db->query($sql,[$fecha_inicio, $fecha_fin]);
        return $qry->result();
    }
    public function leerMCcanalDtv($fechai,$fechaf)
    {
        $fecha_inicio = $fechai;
        $fecha_fin = $fechaf;
                $sql = "SELECT idmedio, nombre_medio, idcuestionario, nombre_cuestionario, COUNT(*) ncuestionario "
                . "FROM noticia "
                . "LEFT JOIN medio_comunicacion ON medio_comunicacion.idmedio = noticia.rel_idmedio "
                . "LEFT JOIN cuestionario ON cuestionario.idcuestionario = noticia.rel_idcuestionario "
                . "WHERE medio_comunicacion.rel_idtipomedio = 2 AND (noticia.fecha_registro BETWEEN ? AND ?) "
                . "GROUP BY idmedio, idcuestionario";
                $qry = $this->db->query($sql,[$fecha_inicio, $fecha_fin]);
        return $qry->result();
    }
    public function leerMCemisoraRadial($fechai,$fechaf)
    {
        $fecha_inicio = $fechai;
        $fecha_fin = $fechaf;
                $sql = "SELECT idmedio, nombre_medio, idcuestionario, nombre_cuestionario, COUNT(*) ncuestionario "
                . "FROM noticia "
                . "LEFT JOIN medio_comunicacion ON medio_comunicacion.idmedio = noticia.rel_idmedio "
                . "LEFT JOIN cuestionario ON cuestionario.idcuestionario = noticia.rel_idcuestionario "
                . "WHERE medio_comunicacion.rel_idtipomedio = 3 AND (noticia.fecha_registro BETWEEN ? AND ?) "
                . "GROUP BY idmedio, idcuestionario";
                $qry = $this->db->query($sql,[$fecha_inicio, $fecha_fin]);
        return $qry->result();
    }
    public function leerMCprensaEscrita($fechai,$fechaf)
    {
        $fecha_inicio = $fechai;
        $fecha_fin = $fechaf;
                $sql = "SELECT idmedio, nombre_medio, idcuestionario, nombre_cuestionario, COUNT(*) ncuestionario "
                . "FROM noticia "
                . "LEFT JOIN medio_comunicacion ON medio_comunicacion.idmedio = noticia.rel_idmedio "
                . "LEFT JOIN cuestionario ON cuestionario.idcuestionario = noticia.rel_idcuestionario "
                . "WHERE medio_comunicacion.rel_idtipomedio = 4 AND (noticia.fecha_registro BETWEEN ? AND ?) "
                . "GROUP BY idmedio, idcuestionario";
                $qry = $this->db->query($sql,[$fecha_inicio, $fecha_fin]);
        return $qry->result();
    }
}