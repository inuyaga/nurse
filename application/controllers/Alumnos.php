<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alumnos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
        $this->load->model('M_Sensei');
        $this->load->library('upload');
        $this->load->library('pagination');
    }

    public function index()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 2) {
                $indicador['active'] = -1;
                $dato['MisMaterias'] = $this->M_Sensei->MisMateria();
                $dato['TareasPorHacer'] = $this->M_Sensei->TareasPorHacer();

                $this->load->view('AlumnosSensei/incluir/head');
                $this->load->view('AlumnosSensei/incluir/Navegacion', $indicador);
                $this->load->view('AlumnosSensei/incluir/Nab');
                $this->load->view('AlumnosSensei/dash', $dato);
                $this->load->view('AlumnosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function blog()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 2) {
                $indicador['active'] = 0;

                $config['base_url'] = base_url() . 'Alumnos/';
                $config['total_rows'] = $this->M_Sensei->NumerosDBlogs();
                $config['per_page'] = 8;
                $config['num_links'] = 5;

                $config['first_link'] = "Primero &nbsp";

                $config['last_link'] = "Ultimo";

                $config['next_link'] = '» &nbsp;';
                $config['prev_link'] = '«';

                $config['cur_tag_open'] = "<strong>";
                $config['cur_tag_close'] = "</strong>";

                $config['full_tag_open'] = '<div class="pagination clearfix">';
                $config['full_tag_close'] = "</div>";

                $config['num_tag_open'] = "<li class='pagination-item'>";
                $config['num_tag_close'] = "</li>";

                $config['prev_tag_open'] = '<li class="pagination-item">';
                $config['prev_tag_close'] = '</li>';

                $config['next_tag_open'] = '<li class="pagination-item">';
                $config['next_tag_close'] = '</li>';

                $config['last_tag_open'] = '<li class="pagination-item">';
                $config['last_tag_close'] = '</li>';

                $config['first_tag_open'] = '<li>';
                $config['first_tag_close'] = '</li>';
                $this->pagination->initialize($config);
                $data = array('BlogsLista' => $this->M_Sensei->ConsultaBlogAlumnos($config['per_page']),
                    'paginacion' => $this->pagination->create_links(),
                );

                $this->load->view('AlumnosSensei/incluir/head');
                $this->load->view('AlumnosSensei/incluir/Navegacion', $indicador);
                $this->load->view('AlumnosSensei/incluir/Nab');
                $this->load->view('AlumnosSensei/index', $data);
                $this->load->view('AlumnosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function CerrarSesion()
    {
        session_unset();
        redirect(base_url());
    }

    public function BlogMasAlumno($idBlog)
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 2) {
                $indicador['active'] = 0;

                $data['Blogs'] = $this->M_Sensei->ConsultaBlogFiltradoAlumno($idBlog);
                $data['Comentarios'] = $this->M_Sensei->ConsultaComentariosBlog($idBlog);
                $data['IDBlog'] = $idBlog;

                $this->load->view('AlumnosSensei/incluir/head');
                $this->load->view('AlumnosSensei/incluir/Navegacion', $indicador);
                $this->load->view('AlumnosSensei/incluir/Nab');
                $this->load->view('AlumnosSensei/BlogMasAlumno', $data);
                $this->load->view('AlumnosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }
    //////////////////////////////////////////////////////////////////////////////////
    public function Tareas()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 2) {
                $indicador['active'] = 3;

                $dato['TareasPorHacer'] = $this->M_Sensei->TareasPorHacer();
                $dato['MisMaterias'] = $this->M_Sensei->MisMateria();

                $this->load->view('AlumnosSensei/incluir/head');
                $this->load->view('AlumnosSensei/incluir/Navegacion', $indicador);
                $this->load->view('AlumnosSensei/incluir/Nab');
                $this->load->view('AlumnosSensei/Tareas', $dato);
                $this->load->view('AlumnosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function getUnidades()
    {
        $query = $this->M_Sensei->getUnidades($this->input->post('IDMateria'));
        echo '<option value="" disabled selected>Elija una opcion</option>';
        foreach ($query->result() as $key) {
            echo '
           <option value="' . $key->Unidades_ID . '" >' . $key->Unidad_Descripcion . '</option>
           ';
        }
    }

    public function getTareasPorHacer()
    {
        $status = array('1' => 'Entregado', '2' => 'Calificado');
        $query = $this->M_Sensei->getTareasParaAlumno($this->input->post('IDUnidad'));
        echo '
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="header">
                <h4 class="title">Tareas</h4>
                </div>
                <div class="content">



                <div class="content table-responsive table-full-width">
                <table class="table table-striped">
                    <thead>



                        <th>Tarea</th>
                        <th>Descripción</th>
                        <th>Entrega</th>
                        <th>Acción</th>
                        <th>Faltan</th>
                    </thead>
                    <tbody> ';

        foreach ($query->result() as $key) {
            echo '
                <tr>
                  <td>' . $key->Tarea_Nombre . '</td>
                  <td>' . $key->Tarea_Descripcion . '</td>
                  <td>' . $key->Tarea_Fecha_fin . '</td>
                  <td>';

            if ($this->M_Sensei->getTareaHechaPorElAlumno($key->Tarea_ID) == 0) {
                if ($this->dateDiff(date("y-m-d"), $key->Tarea_Fecha_fin) >= -0) {
                    echo '
                    <button type="button" class="btn btn-success btn-fill btn-wd" data-toggle="modal" data-target="#EntregarTarea" data-backdrop="false"
                    onclick="pasarInfo(' . $key->Tarea_ID . ')">
                    <i class="ti-google"></i>
                    Google Drive
                    </button>

                    <a class="btn btn-success" type="button" class="btn btn-primary" href="' . base_url('Alumnos/NuevoDoc/' . $key->Tarea_ID) . '"><i class="ti-file"></i> Crear documento</a>
                    ';
                }
            } else {
                if ($this->dateDiff(date("y-m-d"), $key->Tarea_Fecha_fin) >= -0) {
                    echo 'No entregado';
                }
                echo '<h5>' . $status[$this->M_Sensei->getStatusTarea($key->Tarea_ID)] . '</h5>';
            }

            echo '</td><td>';

            if ($this->dateDiff(date("y-m-d"), $key->Tarea_Fecha_fin) >= -0) {
                echo $this->dateDiff(date('y-m-d'), $key->Tarea_Fecha_fin) . ' Días';
            }
            echo '</td>';

            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>

        </table>

       </div>


      <div class="clearfix"></div>

    </div>
  </div>
</div>
        ';
    }

    public function dateDiff($start, $end)
    {
        $start_ts = strtotime($start);

        $end_ts = strtotime($end);

        $diff = $end_ts - $start_ts;

        return round($diff / 86400);
    }

    /////////////////////////////////////////////////////////////////////////////////////

    public function NuevoDoc($TareaID)
    {
        $data['TareaID'] = $TareaID;
        $this->load->view('AlumnosSensei/incluir/head');
        $this->load->view('AlumnosSensei/NuevoDoc', $data);
    }

    /*public function GuardarTarea()
    {

    if (isset($_SESSION['activo']) && $_SESSION['activo']) {
    if ($_SESSION['Tipo']==2) {
    //$ruta='publico/Archivos/';
    $ruta=$this->session->DIR;
    $config['upload_path']          = "./".$ruta;
    $config['allowed_types']        = '*';
    $config['max_size']             = "0";
    // $config['max_width']            = 1024;
    //$config['max_height']           = 768;

    $UserID=$this->session->ID_Usuario;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('Archivo_file')) {
    $this->session->set_flashdata('error', $this->upload->display_errors());

    redirect('Alumnos/Tareas', 'refresh');
    } else {

    $data = array(
    'Archi_Ruta' => $ruta.$this->upload->data('file_name'),
    'Archi_Comentario_Alumno' => $this->input->post('ComentarioAlumno'),
    'Archi_Materia_ID' => $this->input->post('MateriaID'),
    'Archi_Grupo_ID' => $this->input->post('GrupoID'),
    'Archi_Unidad_ID' => $this->input->post('UnidadID'),
    'Archi_To_Maestro_ID' => $this->input->post('TMasterID'),
    'Archi_Status' => '1',
    'Archi_TareaID' => $this->input->post('TareaID'),
    'Archi_PerteneceID' => $UserID,
    );
    $this->session->set_flashdata('mensaje', 'Tarea entregada');
    $this->M_Sensei->GuardaArchivosTareas($data);
    redirect('Alumnos/Tareas', 'refresh');
    }

    } else {
    redirect('Bienvenido');
    }
    } else {
    redirect('Bienvenido');
    }
    }*/
    public function GuardarTarea()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 2) {
                $UserID = $this->session->ID_Usuario;
                $data = array(
                    'Archi_Ruta' => $this->input->post('ContenidoTarea'),
                    //'Archi_Comentario_Alumno' => $this->input->post('ComentarioAlumno'),
                    'Archi_Status' => '1',
                    'Archi_TareaID' => $this->input->post('TareaID'),
                    'Archi_PerteneceID' => $UserID,
                    'Archi_Tipo' => $this->input->post('TIPO'),
                );
                $this->session->set_flashdata('mensaje', 'Tarea entregada');
                $this->M_Sensei->GuardaArchivosTareas($data);
                redirect('Alumnos/Tareas', 'refresh');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function VerDocumento($idTarea)
    {
        $data['Tarea'] = $this->M_Sensei->getTarea($idTarea);

        $this->load->view('VerDocumento', $data);
    }

    public function MisMaterias()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 2) {
                $indicador['active'] = 2;
                $dato['MisMaterias'] = $this->M_Sensei->MisMateria();

                $this->load->view('AlumnosSensei/incluir/head');
                $this->load->view('AlumnosSensei/incluir/Navegacion', $indicador);
                $this->load->view('AlumnosSensei/incluir/Nab');
                $this->load->view('AlumnosSensei/MisMaterias', $dato);
                $this->load->view('AlumnosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function calificacion_unidad()
    {
        $idMat = $this->input->post('idMat');
        $query = $this->M_Sensei->getCalificacion_unidad($idMat);

        echo '
        <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Unidad</th>
                    <th scope="col">Calificación</th>
                    </tr>
                </thead>
                <tbody>
        ';
        foreach ($query->result() as $key) {

            echo '
                    <tr>
                    <th scope="row">' . $key->Unidad_Descripcion . '</th>
                    <th scope="row">' . $key->Calificacion_Calificacion . '</th>
                    </tr>
            ';

        }

        echo '</tbody>
            </table>
        ';

    }
    public function Perfil()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 2) {
                $indicador['active'] = 1;
                $dato['MisMaterias'] = $this->M_Sensei->MisMateria();

                $this->load->view('AlumnosSensei/incluir/head');
                $this->load->view('AlumnosSensei/incluir/Navegacion', $indicador);
                $this->load->view('AlumnosSensei/incluir/Nab');
                $this->load->view('AlumnosSensei/Perfil', $dato);
                $this->load->view('AlumnosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function TareasEntregadas()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 2) {
                $indicador['active'] = 4;
                //  $dato['TareaEntregadas']=$this->M_Sensei->TareasEntregadas();
                $dato['MisMaterias'] = $this->M_Sensei->MisMateria();

                $this->load->view('AlumnosSensei/incluir/head');
                $this->load->view('AlumnosSensei/incluir/Navegacion', $indicador);
                $this->load->view('AlumnosSensei/incluir/Nab');
                $this->load->view('AlumnosSensei/TareasEntregadas', $dato);
                $this->load->view('AlumnosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function TareasEntregadasMateriaUnidad($IDMateria)
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 2) {
                $indicador['active'] = 4;
                $dato['UnidadMateria'] = $this->M_Sensei->UnidadesFiltrada($IDMateria);
                $dato['NombreMateria'] = $this->M_Sensei->NombreMateria($IDMateria);
                $dato['IDMareia'] = $IDMateria;

                $this->load->view('AlumnosSensei/incluir/head');
                $this->load->view('AlumnosSensei/incluir/Navegacion', $indicador);
                $this->load->view('AlumnosSensei/incluir/Nab');
                $this->load->view('AlumnosSensei/TareasEntregadasMateriaUnidad', $dato);
                $this->load->view('AlumnosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function EliminaTareaAlumno()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 2) {
                $idTarea = $this->input->post('IDTarea');
                $ruta_archivo = $this->input->post('RUTA');

                $this->M_Sensei->EliminarTareaAlumno(($idTarea));

                unlink($ruta_archivo);
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function GuardaUnionAgrupo()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 2) {
                $dato = array(
                    'Resgistro_AlumnoID' => $_SESSION['ID_Usuario'],
                    'Resgistro_MateriaID' => $this->input->post('IDGrupoRegistrar'),

                );
                $resp = $this->M_Sensei->IfExistRegistro($_SESSION['ID_Usuario'], $this->input->post('IDGrupoRegistrar'));
                if ($resp == 0) {
                    $this->M_Sensei->GuardaRegistroGrupo($dato);
                    //$this->session->set_flashdata('mensaje', 'Registro exitoso');
                    redirect('Alumnos/MisMaterias');
                } else {
                    $this->session->set_flashdata('error', 'Usuario ya esta inscrito');
                    redirect('Alumnos/MisMaterias');
                }
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function TareasEntregadasAlumno($IdAlumno, $IdMateria, $IdUnidad)
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 2) {
                $indicador['active'] = 4;

                $dato['TareaEntregadas'] = $this->M_Sensei->TareasEntregadasFiltradas($IdAlumno, $IdMateria, $IdUnidad);
                $dato['MisMaterias'] = $this->M_Sensei->MisMateria();

                $this->load->view('AlumnosSensei/incluir/head');
                $this->load->view('AlumnosSensei/incluir/Navegacion', $indicador);
                $this->load->view('AlumnosSensei/incluir/Nab');
                $this->load->view('AlumnosSensei/UnidadesMateriasXAlumno', $dato);
                $this->load->view('AlumnosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function GuardaPerfil()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 2) {
                $nombre = $this->input->post('nombre');
                $correo = $this->input->post('email');

                $ruta = 'publico/Archivos/Perfiles/';
                $config['upload_path'] = "./publico/Archivos/Perfiles/";
                $config['allowed_types'] = '*';
                $config['max_size'] = "0";
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('avatar')) {
                    $this->session->set_flashdata('mensaje', $this->upload->display_errors());

                    redirect('Alumnos/Perfil', 'refresh');
                } else {
                    $data = array(
                        'Usuario_Avatar' => $ruta . $this->upload->data('file_name'),
                        'Usuario_Nombre' => $nombre,
                        'Usuario_Correo' => $correo,
                    );
                    $this->session->set_flashdata('mensaje', 'Actualizacion correcta');
                    $this->M_Sensei->ActualizaPerfilUser($data);
                    unlink($this->session->Avatar);
                    $this->session->Avatar = $ruta . $this->upload->data('file_name');
                    $this->session->Nombre = $nombre;
                    $this->session->Correo = $correo;
                    redirect('Alumnos/Perfil', 'refresh');
                }
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function GuardaComentarioBlog()
    {
        $retorno = $this->input->post('PaginaRetorno');
        $idBlog = $this->input->post('idBlod');
        $nombre = $this->input->post('Nombre');
        $perfil = $this->input->post('imagenPerfil');
        $comentario = $this->input->post('Comentario');

        $data = array(
            'Comentario_Comentario' => $comentario,
            'Comentario_Nombre' => $nombre,
            'Comentario_foto' => $perfil,
            'Comentario_Blog_ID' => $idBlog,
        );
        $this->M_Sensei->GuardaComentario($data);

        redirect($retorno, 'refresh');
    }

    public function docMateriasAlumno()
    {
        $idMat = $this->input->post('idMat');

        $respuesta = $this->M_Sensei->DocumentosDeMateria($idMat);

        echo '

        <table class="table">
        <thead>
        <tr>
        <th>Docuemto</th>
        <th>Descripción</th>
        </tr>
        </thead>

        <tbody>
        ';

        foreach ($respuesta->result() as $key) {
            echo '
          <tr>
          <td><a href="' . base_url() . $key->Documento_ruta . '">Descargar</a></td>
          <td>' . $key->Documento_descripcion . '</td>
          </tr>
          ';
        }

        echo '
        </tbody>
        </table>
        ';
    }
} //Fin de la clase principal
