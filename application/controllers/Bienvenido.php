	<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Bienvenido extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();

            $this->load->model('M_Sensei');
            $this->load->library('upload');
            $this->load->library('pagination');
        }

        public function index()
        {
            if (isset($_SESSION['activo']) && $_SESSION['activo']) {
                redirect(base_url('Bienvenido/Principal'));
            } else {
                $this->load->view('bienvenido');
            }
        }




        public function Principal()
        {
            if (isset($_SESSION['activo']) && $_SESSION['activo']) {
                if ($_SESSION['Tipo']==1) {
                    redirect('Maestros', 'refresh');
                } elseif ($_SESSION['Tipo']==2) {
                    //Redireccionamos a la Vista de alumnos
                    redirect('Alumnos', 'refresh');
                }
            } else {
                redirect('Bienvenido');
            }
        }


        public function InicioSesion()
        {
            $usuario=$this->input->post('Usuario');
            $contraseña=$this->input->post('Passwod');
            $respuesta=$this->M_Sensei->dato_usuarios($usuario, $contraseña)->result();



            if (!empty($respuesta)) {
                $_SESSION['Nombre']=$respuesta[0]->Usuario_Nombre;
                $_SESSION['Usuario']=$respuesta[0]->Usuario_Usr;
                $_SESSION['Tipo']=$respuesta[0]->Usuario_Tipo;
                $_SESSION['ID_Usuario']=$respuesta[0]->Usuario_ID;
                $_SESSION['Correo']=$respuesta[0]->Usuario_Correo;
                $_SESSION['Avatar']=$respuesta[0]->Usuario_Avatar;
                $_SESSION['activo']=true;
                $_SESSION['chatusername'] = $respuesta[0]->Usuario_Nombre;
                $_SESSION['username'] = $respuesta[0]->Usuario_ID;
                $_SESSION['DIR'] = $respuesta[0]->Usuario_Dir;
                $_SESSION['contactos'] = $contactos;
                $_SESSION['Usuario_Mensaje'] = $respuesta[0]->Usuario_Mensaje;


                redirect('Bienvenido/Principal');
            } else {
                $_SESSION['activo']=false;
                $_SESSION['mensaje']="Error";
                redirect('Bienvenido');
            }
        }


        public function AltaUsuarios()
        {
            $this->load->library('recaptcha');
            $this->load->view('registro');
        }




        public function Guardar_usuario()
        {
            $this->load->library('recaptcha');
            $this->load->helper('captcha');
            $captcha_answer = $this->input->post('g-recaptcha-response');
            $response = $this->recaptcha->verifyResponse($captcha_answer);
            $mensaje_user="";
            if ($response['success']) {
                $pass=$this->input->post('password');
                $pass2=$this->input->post('password2');

                if ($pass == $pass2) {

                    $carpeta = str_replace(' ', '', $this->input->post('usuario'));

                    $estructura='publico/Archivos/Usuarios/'.$carpeta.'/';
                    
                    $DIR_REAL='./publico/Archivos/Usuarios/'.$carpeta.'/';

                    $data= array(
                                             'Usuario_Nombre' => trim($this->input->post('name')),
                                             'Usuario_Usr' => trim($this->input->post('usuario')),
                                             'Usuario_Password' => trim($this->input->post('password')),
                                             'Usuario_Tipo' => trim($this->input->post('tip')),
                                             'Usuario_Correo' => trim($this->input->post('email')),
                                             'Usuario_Dir' => $estructura,
                                     );

  
                     

                    $respuesta=$this->M_Sensei->GuardarUsuario($data); 
                    if ($respuesta > 0) {
                        
                        mkdir($DIR_REAL, 0777, true);
                        
                        $mensaje_user="Usuario agregado";
                        $this->session->set_flashdata('mensaje', $mensaje_user);
                        redirect('Bienvenido', 'refresh');
                    } else {
                        $mensaje_user="Usuario ya existente";
                        $this->session->set_flashdata('mensaje', $mensaje_user);
                        redirect('Bienvenido/AltaUsuarios', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('mensaje', 'La contraseña no coinciden');
                    redirect('Bienvenido/AltaUsuarios', 'refresh');
                }
            } else {
                $this->session->set_flashdata('mensaje', 'Captcha no válido');
                redirect(base_url('Bienvenido/AltaUsuarios'));
            }
        }




        public function CerrarSesion()
        {
            session_unset();
            redirect(base_url());
        }
    }//Fin de toda la clase
