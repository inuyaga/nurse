<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_serv extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
      $this->load->model('M_Sensei');
      $this->load->model('M_web_service');
  }

  public function index()
  {
      $dato = array(
        'mensaje' =>   $this->input->post('Usuario'),
        'otro' =>   $this->input->post('Passwod')
      );

        echo json_encode($dato);
  }

  public function Login()
  {
    $usuario=$this->input->post('Usuario');
    $contraseña=$this->input->post('Passwod');
    $respuesta=$this->M_Sensei->dato_usuarios($usuario, $contraseña)->result();

    if (!empty($respuesta)) {


        $datos = array(
          'Nombre' => $respuesta[0]->Usuario_Nombre,
          'Usuario' => $respuesta[0]->Usuario_Usr,
          'Tipo' => $respuesta[0]->Usuario_Tipo,
          'ID_Usuario' => $respuesta[0]->Usuario_ID,
          'Correo' => $respuesta[0]->Usuario_Correo,
          'Avatar' => base_url($respuesta[0]->Usuario_Avatar),
          'Activo' => true,
          'chatusername' => $respuesta[0]->Usuario_Nombre,
          'username' => $respuesta[0]->Usuario_ID
        );

      //  json_encode($datos, JSON_FORCE_OBJECT);
        // echo json_encode($datos);
           $this->output->set_content_type('application/json')->set_output(json_encode($datos));


    } else {

        $datos = array(
          'Activo' => false,
           'mensaje' => "Error de inicio de sesion");
              $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }
  }


  public function BlogAlumno()
  {
      $ID_Usuario=$this->input->post('ID_Usuario');
     $data['envio']=$this->M_Sensei->AppConsultaBlogAlumnos($ID_Usuario)->result_array();
$this->output->set_content_type('application/json')->set_output(json_encode($data));


  }

  public function MisMaterias()
  {
      $ID_Usuario=$this->input->post('ID_Usuario');
      $dato['MisMaterias']=$this->M_web_service->MisMateria(14)->result_array();
      $this->output->set_content_type('application/json')->set_output(json_encode($dato));
  }

  public function DocMaterias()
  {
      $idMat=$this->input->post('idMat');
        $dato['Documentos']=$this->M_web_service->DocumentosDeMateria($idMat)->result_array();
      $this->output->set_content_type('application/json')->set_output(json_encode($dato));
  }




}//Fin de la clase
