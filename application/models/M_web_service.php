<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_web_service extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }


  public function MisMateria($iduser)
  {
      $this->db->select('*');
      $this->db->from('VistaMateriaAlumnos');
      $this->db->where('Resgistro_AlumnoID', $iduser);

      return $this->db->get();


  }

  public function DocumentosDeMateria($Value){

     $this->db->select('*');
      $this->db->from('SS_Materia');
      $this->db->join('SS_Documentos', 'SS_Materia.Materia_ID = SS_Documentos.Documento_MateriaID');
      $this->db->where('Materia_ID', $Value);
       return $this->db->get();
  }

}
