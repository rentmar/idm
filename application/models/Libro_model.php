<?php

class Libro_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Extrae todos los libros que un usuario registra
	public function leerLibros($idusuario){
		$sql ="SELECT libros_registro.idlibro, libros_registro.libro_informacion  "
			."FROM libros_registro  "
			."WHERE libros_registro.rel_idusr = ? "
			." "
			." "
			." ";
		$qry = $this->db->query($sql, [$idusuario,]);
		return $qry->result();
	}

	//Crea un nuevo registro
	public function crearLibro($datos){
		/*
		 *
		 * INICIAR LA TRANSACCION
		 */
		$this->db->trans_begin();

		$libro = $datos;
		$idusuario = $libro->idusuario;
		$libro_datos = json_encode($libro);

		//Insertar el libro
		/** @noinspection PhpLanguageLevelInspection */
		$registro_libro = [
			'libro_informacion' => $libro_datos,
			'rel_idusr' => $idusuario,
		];
		$this->db->insert('libros_registro', $registro_libro);
		$libro_id = $this->db->insert_id();

		if ($this->db->trans_status() === FALSE){
			//Hubo errores en la consulta, entonces se cancela la transacción.
			$this->db->trans_rollback();
			return false;
		}else{
			//Todas las consultas se hicieron correctamente.
			$this->db->trans_commit();
			return $libro_id;
		}

	}

	//Leer un libro por identificador
	public function leerLibro($idlibro){
		$sql = "SELECT libros_registro.idlibro, libros_registro.libro_informacion, libros_registro.rel_idusr   "
			."FROM libros_registro "
			."WHERE libros_registro.idlibro = ?  "
			." "
			." "
			." ";
		$qry = $this->db->query($sql, $idlibro);
		return $qry->row();
	}

	public function actualizarLibro($idlibro, $datos_libro){
		/** @noinspection PhpLanguageLevelInspection */
		$datos_actualizar = [
			'datos_partida' =>json_encode($datos_partida),
		];

		$this->db->where('idpartida', $idpartida);
		$this->db->update('partida', $datos_actualizar);
	}

	//Actualiza los datos de un registro
	public function updateLibro($idlibro, $datos_libro){
		/** @noinspection PhpLanguageLevelInspection */
		$datos_actualizar = [
			'libro_informacion' =>json_encode($datos_libro),
		];

		$this->db->where('idlibro', $idlibro);
		$this->db->update('libros_registro', $datos_actualizar);
	}
	//Contar los libros registrados
	public function contarLibros(){
		$this->db->select('libro_informacion');
		$this->db->from('libros_registro');
		return $this->db->count_all_results();
	}

	//Leer un libro por identificador
	public function leerLibrosRegistrado(){
		$sql = "SELECT libros_registro.idlibro, libros_registro.libro_informacion, users.username   "
			."FROM libros_registro "
			."LEFT JOIN users ON libros_registro.rel_idusr = users.id  "
			." "
			." "
			." ";
		$qry = $this->db->query($sql);
		return $qry->result();
	}
}
