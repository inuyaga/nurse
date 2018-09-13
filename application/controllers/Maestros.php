<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maestros extends CI_Controller
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
            if ($_SESSION['Tipo'] == 1) {
                $dato['NumTareas'] = $this->M_Sensei->TareasCreadas();
                $dato['Usuarios'] = $this->M_Sensei->UsuariosContactos();
                $dato['NumberBlogs'] = $this->M_Sensei->NumeroDeBlogCreados();
                $dato['NumberTareas'] = $this->M_Sensei->TareasCreadas();
                $dato['NumberTareasEntregadas'] = $this->M_Sensei->NumeroTareasEntregadas();
                $dato['Calificadas'] = $this->M_Sensei->NumeroTareasEntregadasCalificadas();
                $dato['ProxTareas'] = $this->M_Sensei->ProximasTareasMaestros();

                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $indicador['active'] = 0;
                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/index', $dato);

                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function CreaGrupos()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $dato['Grupos'] = $this->M_Sensei->Grupos();
                $indicador['active'] = 1;

                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/CrearGrupos', $dato);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function EliminaGrupos($idgrupo, $nombre)
    {
        $respuesta = $this->M_Sensei->NumeroMateriasAsignada($idgrupo);

        if ($respuesta > 0) {
            $this->session->set_flashdata('error', 'Esta aula tiene una materia asignada debe eliminar la materias relacionada al aula: <strong>' . str_replace('%20', ' ', $nombre) . '</strong> Antes de eliminarla');

            redirect('Maestros/CreaGrupos', 'refresh');
        } else {
            $this->load->view('MaestrosSensei/incluir/head');
            echo '<div class="alert alert-danger" role="alert">
                This is a danger alert—check it out!
            </div>';
            $this->load->view('MaestrosSensei/incluir/script');
        }
    }

    public function CreaMaterias()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $dato['Materias'] = $this->M_Sensei->Materias();
                $dato['Grupos'] = $this->M_Sensei->GruposEnVistaCreaMaterias();
                $indicador['active'] = 3;

                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/CreaMaterias', $dato);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function InformacionEliminaMateria($idMateria)
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $this->load->view('MaestrosSensei/incluir/head');
                echo '<div class="container"><div class="alert alert-info" role="alert">
            La siguiente materia con id: <strong>' . $idMateria . '</strong> se eliminara tenga en cuenta que
            toda unidad, tareas creadas y referenciadas a esta materia se perderan y por
            lo consiguiente no se podra recuperar desea confirmar?
            <a href="' . base_url('Maestros/EliminaMateria/') . $idMateria . '" class="btn btn-danger">Si</a>
            <a href="' . base_url('Maestros/CreaMaterias') . '" class="btn btn-primary">No</a>
        </div></div>
        ';
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function EliminaMateria($idMateria)
    {
        $grupo = $this->M_Sensei->getGrupoID($idMateria);
        foreach ($grupo->result() as $key) {
            $this->M_Sensei->setStadoGrupo($key->Materia_Grupo_ID);
        }
        $this->M_Sensei->EliminarMateriaMaestro($idMateria);

        redirect('Maestros/CreaMaterias', 'refresh');
    }

    public function GuardaGrupo()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            $datos = array(
                'Grup_Nombre' => $this->input->post('GrupoNom'),
                'Grup_Usuario_ID' => $_SESSION['ID_Usuario'],

            );
            $this->M_Sensei->GuardaGrupos($datos);
            $this->session->set_flashdata('mensaje', 'Creado correctamente');
            redirect('Maestros/CreaGrupos');
        } else {
            redirect('Bienvenido');
        }
    }

    public function GuardaDocumentosPorMateria()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $ruta = 'publico/Archivos/documentos_materias/';
                $config['upload_path'] = "./publico/Archivos/documentos_materias/";
                $config['allowed_types'] = '*';
                $config['max_size'] = '102400';
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('Archivo_file')) {
                    $this->session->set_flashdata('mensaje', $this->upload->display_errors());

                    redirect('Maestros/CreaMaterias', 'refresh');
                } else {
                    $data = array(
                        'Documento_ruta' => $ruta . $this->upload->data('file_name'),
                        'Documento_descripcion' => $this->input->post('descripcioDoc'),
                        'Documento_MateriaID' => $this->input->post('IDMateria'),
                    );
                    $this->session->set_flashdata('mensaje', 'Archivo subido correctamente');
                    $this->M_Sensei->GuardaDocumentosPorMateria($data);
                    redirect('Maestros/CreaMaterias', 'refresh');
                }
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function docMaterias()
    {
        $idMat = $this->input->post('idMat');

        $respuesta = $this->M_Sensei->DocumentosDeMateria($idMat);

        echo '

            <table class="table">
        <thead>
          <tr>
              <th scope="col">Docuemto</th>
              <th scope="col">Descripcion</th>
              <th scope="col">Accion</th>
          </tr>
        </thead>

        <tbody>
			';

        foreach ($respuesta->result() as $key) {
            echo '
         <tr>
            <td><a href="' . base_url() . $key->Documento_ruta . '">Descargar</a></td>
            <td>' . $key->Documento_descripcion . '</td>
            <td>
			';
            echo "

         <button class='btn waves-effect waves-light' onclick='alerta(" . $key->Docuemnto_ID . ")'>Eliminar</button
            </td>
          </tr>
			";
        }

        echo '
      </tbody>
      </table>
			';
    }

    public function MuestaListaAlumno()
    {
        $RespuestaPost = $this->input->post('idGrupo');

        $dato = $this->M_Sensei->ListaAlumnos($RespuestaPost);

        echo "
        <table class='table'>
        <thead>
        <tr>
        <th scope='col'>Nombre alumno</th>
        <th scope='col'>Correo</th>
        <th scope='col'>Grupo</th>

        </tr>
        </thead>

        <tbody>

        ";
        foreach ($dato->result() as $lista) {
            echo "
          <tr>
          <td>" . $lista->Alumno_Nombre . "</td>
          <td>" . $lista->AlumnoCorreo . "</td>
          <td>" . $lista->Grup_Nombre . "</td>
          <td><a href='#'>Quitar</a></td>
          </tr>
          ";
        }

        echo "
        </tbody>
        </table>
        ";
    }

    public function EliminaDocuemntoMateria($idDoc)
    {
        // $idDoc=$this->input->post('ID_Documento');
        $respuesta = $this->M_Sensei->EliminaDocuemtoMateria($idDoc);
        echo $respuesta;

        if ($respuesta > 0) {
            $this->session->set_flashdata('mensaje', 'Eliminacion satisfactoria');
            redirect('Maestros/CreaMaterias', 'refresh');
        } else {
            $this->session->set_flashdata('mensaje', 'Error al eliminar');
            redirect('Maestros/CreaMaterias', 'refresh');
        }
    }

    public function Unidades()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $dato['Materias'] = $this->M_Sensei->Materias();
                $dato['Grupos'] = $this->M_Sensei->Grupos();
                $dato['Unidades'] = $this->M_Sensei->Unidades();
                $indicador['active'] = 4;

                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/unidades', $dato);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function getMateriasAulas()
    {
        $ID = $this->input->post('ID');
        echo '<option value="" disabled selected>Elija una opcion</option>';
        $query = $this->M_Sensei->getMateria($ID);
        foreach ($query->result() as $key) {
            echo '<option value="' . $key->Materia_ID . '">' . $key->Materia_Nombre . '</option>';
        }
    }

    public function getUnidades()
    {
        $ID = $this->input->post('ID');

        $query = $this->M_Sensei->getUnidades($ID);

        echo '
        <ul class="list-group">
           <li class="list-group-item active">Unidades</li>
        ';

        foreach ($query->result() as $key) {
            echo '
                <li class="list-group-item d-flex justify-content-between align-items-center">
                ' . $key->Unidad_Descripcion . '
                    <span class="badge success badge-pill"><a href="#">Eliminar</a></span>

                </li>
            ';
        }

        echo '
        </ul>
        ';
    }

    public function GuardaMaterias()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $materia = array(
                    'Materia_Nombre' => $this->input->post('NombreMateria'),
                    'Materia_Grupo_ID' => $this->input->post('IDGrupo'),

                );
                $this->M_Sensei->GuardaMaterias($materia);
                $this->session->set_flashdata('mensaje', 'Creado correctamente');
                redirect('Maestros/CreaMaterias');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function GuardaUnidades()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $ID_Materia = $this->input->post('ID');
                $descrip = $this->input->post('descrip');

                $datos = array(
                    'Unidad_Descripcion' => $descrip,
                    'Unidad_Materia_ID' => $ID_Materia,
                );
                $this->M_Sensei->GuardarUnidad($datos);
                echo 'OK';
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function GuardaTareas()
    {
        $nombre = $this->input->post('Nombre');
        $descripcion = $this->input->post('descripcion');
        $UnidadID = $this->input->post('UnidadesID');
        $FechaInicio = $this->input->post('fechaInicio');
        $FechaFinal = $this->input->post('fechaFinal');
        $valor = $this->input->post('valor');
        $entregable = $this->input->post('entregable');

        $Tareas = array(
            'Tarea_Nombre' => $nombre,
            'Tarea_Descripcion' => $descripcion,
            'Tarea_Unidad_ID' => $UnidadID,
            'Tarea_Fecha_inicio' => $FechaInicio,
            'Tarea_Fecha_fin' => $FechaFinal,
            'Tarea_valor_porcentaje' => $valor,
        );
        $porcentaje = $this->M_Sensei->getProcentajeTareas($UnidadID);
        $total = $porcentaje + $valor;
        if ($total <= 100) {
            $res = $this->M_Sensei->GuardaTareas($Tareas);

            if ($res > 0) {
                echo "Tarea creada correctamente";
                switch ($entregable) {
                    case 2:
                   $query= $this->M_Sensei->alumnosregistrosporunidad($UnidadID);
                   
                   foreach ($query->result() as $key) {
                    $datosporAlumno = array(
                        'Archi_PerteneceID' => $key->Resgistro_AlumnoID, 
                        'Archi_Status' => '1', 
                        'Archi_TareaID' => $res, 
                        'Archi_Tipo' => 0, 
                     );
                     $this->M_Sensei->crearTarea($datosporAlumno);
                   }

                        break;
                }
            } else {
                echo "No se creo esta tarea vuelve a pulsar guardar";
            }
        } else {
            echo "La suma de todas las tareas no debe sobrepasar los 100%";
        }
    }

    public function Tareas()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $dato['Grupos'] = $this->M_Sensei->Grupos();
                $indicador['active'] = 5;

                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/Tareas', $dato);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function respuestaSelect()
    {
        $RespuestaPost = $this->input->post('IDGrupo');
        $porciones = explode("-", $RespuestaPost);

        $dato = $this->M_Sensei->Slelecprueba($porciones[0], $porciones[1]);
        echo ' <option value="" disabled selected>Elija una opcion</option>';
        foreach ($dato->result() as $key) {
            echo '<option value="' . $key->Unidades_ID . '">' . $key->Unidad_Descripcion . '</option>';
        }
    }

    public function TablaEnVistaTarea()
    {
        $UnidadID = $this->input->post('UnidadID');
        $dato = $this->M_Sensei->getTareas($UnidadID);

        echo '
            <table class="table">
            <thead>
            <tr>
            <th scope="col">##</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Eliminar</th>
            <th scope="col">Editar Fecha</th>
            <th scope="col">Valor</th>
            </tr>
            </thead>
            <tbody>';

        foreach ($dato->result() as $key) {
            echo '
            <tr>
            <th scope="row">' . $key->Tarea_ID . '</th>
            <td>' . $key->Tarea_Nombre . '</td>
            <td>' . $key->Tarea_Descripcion . '</td>
            <td><button class="btn btn-danger" onclick="alerta(' . $key->Tarea_ID . ')">Eliminar</button></td>
            <td>Inicio<input type="date" value="' . $key->Tarea_Fecha_inicio . '"  id="fechaIni' . $key->Tarea_ID . '" name="FechaIni">
            Final<input type="date" value="' . $key->Tarea_Fecha_fin . '"  id="fechaFin' . $key->Tarea_ID . '"  name="FechaFin">
            <button class="btn btn-success" onclick="CambiaFecha(' . $key->Tarea_ID . ')">Editar</button>
            </td>
            <td>' . $key->Tarea_valor_porcentaje . '%</td>


            </tr>
            ';
        }

        echo '
            </tbody>
            </table>

            ';
    }

    public function eliminaTarea()
    {
        $idTarea = $this->input->post('IDTarea');
        //$nombre=$this->input->post('NombreTarea');

        $this->M_Sensei->elimanrTarea($idTarea);

        // $this->session->set_flashdata('mensaje', 'Se elimino Tarea '.$nombre);

        // redirect('Bienvenido/Tareas','refresh');
    }

    public function EditarTarea()
    {
        $idTarea = $this->input->post('idtarea');
        $fechainicio = $this->input->post('FechaIni');
        $fechafinal = $this->input->post('FechaFin');
        $nombre = $this->input->post('NombreTarea');
        $data = array(
            'Tarea_Fecha_inicio' => $fechainicio,
            'Tarea_Fecha_fin' => $fechafinal,
        );
        $this->M_Sensei->EditaTarea($idTarea, $data);
        $this->session->set_flashdata('mensaje', 'Tarea ' . $nombre . ' fue editada');
        redirect('Bienvenido/Tareas', 'refresh');
    }

    public function PerfilUsuario()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $data['ProxTareas'] = $this->M_Sensei->ProximasTareasMaestros();
                $indicador['active'] = 2;

                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/PerfilUsuario', $data);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function GuardaPerfin()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $nombre = $this->input->post('nombre');
                $correo = $this->input->post('email');
                $msn_p = $this->input->post('msn_perfil');

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

                    redirect('Maestros/PerfilUsuario', 'refresh');
                } else {
                    $data = array(
                        'Usuario_Avatar' => $ruta . $this->upload->data('file_name'),
                        'Usuario_Nombre' => $nombre,
                        'Usuario_Correo' => $correo,
                        'Usuario_Correo' => $correo,
                        'Usuario_Mensaje' => $msn_p,
                    );
                    $this->session->set_flashdata('mensaje', 'Actualizacion correcta');
                    $this->M_Sensei->ActualizaPerfilUser($data);
                    unlink($this->session->Avatar);
                    $this->session->Avatar = $ruta . $this->upload->data('file_name');
                    $this->session->Nombre = $nombre;
                    $this->session->Correo = $correo;
                    $this->session->Usuario_Mensaje = $msn_p;
                    redirect('Maestros/PerfilUsuario', 'refresh');
                }
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function Blog()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $indicador['active'] = 6;

                $config['base_url'] = base_url() . 'Maestros/Blog/';
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
                $data = array('BlogsLista' => $this->M_Sensei->BlogsListado($config['per_page']),
                    'paginacion' => $this->pagination->create_links(),
                );

                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/Blog', $data);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function RevisionTareas()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $dato['Grupos'] = $this->M_Sensei->Grupos();

                $indicador['active'] = 7;
                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/RevisionTareas', $dato);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    //VISTA DE REVISION DE TAREAS DEL ALUMNO

    public function TareasRevisadas()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $dato['Grupos'] = $this->M_Sensei->Grupos();
                $indicador['active'] = 8;

                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/TareasRevisadas', $dato);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function getMaterias()
    {
        $resultado = $this->M_Sensei->getMaterias($this->input->post('IDGrupo'));
        echo '<option value="" disabled selected>Elija una opcion</option>';
        foreach ($resultado->result() as $key) {
            echo '
              <option value="' . $key->Materia_ID . '">' . $key->Materia_Nombre . '</option>
              ';
        }
    }

    public function getUnidad()
    {
        $resultado = $this->M_Sensei->getUnidades($this->input->post('IDMateria'));
        echo '<option value="" disabled selected>Elija una opcion</option>';
        foreach ($resultado->result() as $key) {
            echo '
               <option value="' . $key->Unidades_ID . '">' . $key->Unidad_Descripcion . '</option>
               ';
        }
    }

    public function getTareas()
    {
        $resultado = $this->M_Sensei->getTareas($this->input->post('IDUnidad'));
        echo '<option value="" disabled selected>Elija una opcion</option>';
        foreach ($resultado->result() as $key) {
            echo '
            <option value="' . $key->Tarea_ID . '">' . $key->Tarea_Nombre . '</option>
            ';
        }
    }
    public function getTareasInfo()
    {
        $resultado = $this->M_Sensei->getTareaPorID($this->input->post('IDTarea'));

        foreach ($resultado->result() as $key) {
            echo '
            <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-info text-center">
                                <i class="ti-comment-alt"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                            <strong><p>Nombre</p></strong>
                                <p>' . $key->Tarea_Nombre . '</p>

                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-reload"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-info text-center">
                                <i class="ti-comment-alt"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <strong><p>Descripcion</p></strong>
                                <p>' . $key->Tarea_Descripcion . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-reload"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-info text-center">
                                <i class="ti-calendar"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <strong><p>Fecha inicio</p></strong>
                                <p>' . $key->Tarea_Fecha_inicio . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-reload"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-info text-center">
                                <i class="ti-calendar"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <strong><p>Fecha final</p></strong>
                                <p>' . $key->Tarea_Fecha_fin . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-reload"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            ';
        }
    }

    public function getTareasHechas()
    {
        $dato = $this->M_Sensei->getTareaRealizadas($this->input->post('IDTarea'));
        echo '
        <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">##</th>
            <th scope="col">Alumno</th>
            <th scope="col">Replica</th>
            <th scope="col">Maestro comentario</th>
            <th scope="col">Entrego</th>
            <th scope="col">Accion</th>
            <th scope="col">Accion</th>
            <th scope="col">Calificacion</th>
          </tr>
        </thead>
        <tbody>
        ';
        foreach ($dato->result() as $Fila) {
            echo '<tr>';
            echo '<td><img class="circle" src="' . base_url($Fila->Usuario_Avatar) . '" width="50" height="50"></td>';
            echo '<td>' . $Fila->Usuario_Nombre . '</td>';
            echo '<td>' . $Fila->Archi_Comentario_Alumno . '</td>';
            echo '<td>' . $Fila->Archi_Comentario_Maestro . '</td>';
            $date = date_create($Fila->Archi_Fecreacion);
            echo '<td>' . date_format($date, "Y/m/d H:i:s") . '</td>';

            echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#RevisarTarea" data-backdrop="false"
            onclick=pasarInfo(' . $Fila->Archi_ID . ')>Revisar</button></td>';

            echo '<td><a href="' . base_url('Maestros/VerDocumento/') . $Fila->Archi_ID . '" target="_blank" type="button" class="btn btn-primary">Ver</a></td>';
            echo '<td>' . $Fila->Archi_Calificacion . '</td>';
        }

        echo '
        </tbody>
        </table>
        ';
    }
    public function getTareasHechasPorCalificar()
    {
        $dato = $this->M_Sensei->getTareasSinCalificar($this->input->post('IDTarea'));
        echo '
        <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">##</th>
            <th scope="col">Alumno</th>
            <th scope="col">Replica</th>
            <th scope="col">Maestro comentario</th>
            <th scope="col">Entrego</th>
            <th scope="col">Accion</th>
            <th scope="col">Accion</th>
            <th scope="col">Calificacion</th>
          </tr>
        </thead>
        <tbody>
        ';
        foreach ($dato->result() as $Fila) {
            echo '<tr>';
            echo '<td><img class="circle" src="' . base_url($Fila->Usuario_Avatar) . '" width="50" height="50"></td>';
            echo '<td>' . $Fila->Usuario_Nombre . '</td>';
            echo '<td>' . $Fila->Archi_Comentario_Alumno . '</td>';
            echo '<td>' . $Fila->Archi_Comentario_Maestro . '</td>';
            $date = date_create($Fila->Archi_Fecreacion);
            echo '<td>' . date_format($date, "Y/m/d H:i:s") . '</td>';

            echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#RevisarTarea" data-backdrop="false"
            onclick=pasarInfo(' . $Fila->Archi_ID . ')>Revisar</button></td>';

            echo '<td><a href="' . base_url('Maestros/VerDocumento/') . $Fila->Archi_ID . '" target="_blank" type="button" class="btn btn-primary">Ver</a></td>';
            echo '<td>' . $Fila->Archi_Calificacion . '</td>';
        }

        echo '
        </tbody>
        </table>
        ';
    }

    public function setCalificacion()
    {
        $datos = array(
            'Archi_Comentario_Maestro' => $this->input->post('Comentario'),
            'Archi_Status' => '2',
            'Archi_Calificacion' => $this->input->post('Calificacion'),

        );

        $this->M_Sensei->CalificaTarea($datos, $this->input->post('IDArchivo'));
    }

    public function RevisionTareaUnidad($IDmateria, $IDUniad)
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $dato['TareasArchivos'] = $this->M_Sensei->TareasXUnidadesFiltrados($IDmateria, $IDUniad);
                $dato['NombreUnidad'] = $this->M_Sensei->NombreUnidadMateria($IDmateria, $IDUniad);
                $dato['NombreMateria'] = $this->M_Sensei->NombreMateria($IDmateria);
                $indicador['active'] = 7;

                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/RevisionTareaUnidad', $dato);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function VerDocumento($IDTarea)
    {
        $dato['ID'] = $IDTarea;
        $dato['Tarea'] = $this->M_Sensei->getTarea($IDTarea);
        $this->load->view('MaestrosSensei/VerDocumento', $dato);
    }

    public function TareasRevisadasUnidad($IDmateria, $IDUniad)
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $dato['TareasArchivos'] = $this->M_Sensei->TareasXUnidadesFiltrados2($IDmateria, $IDUniad);
                $dato['NombreUnidad'] = $this->M_Sensei->NombreUnidadMateria($IDmateria, $IDUniad);
                $dato['NombreMateria'] = $this->M_Sensei->NombreMateria($IDmateria);
                $indicador['active'] = 8;

                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/RevisionTareaUnidad', $dato);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function CalificarTarea()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $IdArchivo = $this->input->post('IDArchivo');
                $retorno = $this->input->post('PaginaRetorno');
                $comentario = $this->input->post('ComentaMaster');
                $calificacion = $this->input->post('CalificaMaster');

                $datos = array(
                    'Archi_Comentario_Maestro' => $comentario,
                    'Archi_Status' => '2',
                    'Archi_Calificacion' => $calificacion,

                );

                $this->M_Sensei->CalificaTarea($datos, $IdArchivo);
                $this->session->set_flashdata('mensaje', 'Se guardaron cambios');
                redirect($retorno, 'refresh');
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

    public function RevisionTareasXalumnos($idMateria)
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $dato['ListaAlumnos'] = $this->M_Sensei->ListaAlumnos($idMateria);
                $dato['NombreMateria'] = $this->M_Sensei->NombreMateria($idMateria);
                $dato['IDMateria'] = $idMateria;
                $indicador['active'] = 0;

                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/RevisionTareasXalumnos', $dato);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function RevisionTareasAlumnos($idAlumno, $idMateria)
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $dato['UnidadMateria'] = $this->M_Sensei->UnidadesFiltrada($idMateria);
                $dato['NombreMateria'] = $this->M_Sensei->NombreMateria($idMateria);

                $dato['TareasXmateria'] = $this->M_Sensei->NumeroTareasPorMateria($idMateria);
                $dato['CalificadasDelAlumno'] = $this->M_Sensei->NumeroTareasPorMateriaCalificadas($idAlumno, $idMateria);
                $dato['SumaTareasXalumno'] = $this->M_Sensei->SumaTareasPorMateriaAndAlumno($idAlumno, $idMateria);
                $dato['NumeroTareasXalumno'] = $this->M_Sensei->NumeroTareasPorMateriaAndAlumno($idAlumno, $idMateria);

                //Retorna Nombre del alumno
                $dato['Nombre_Alumno'] = $this->M_Sensei->getNombreUsuario($idAlumno);

                $dato['Calificacion'] = $dato['SumaTareasXalumno'] / $dato['TareasXmateria'];

                $dato['IDAlumno'] = $idAlumno;
                $dato['IDMareia'] = $idMateria;
                $indicador['active'] = 0;

                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/RevisionTareasAlumnos', $dato);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function UnidadesMateriasXAlumno($idAlumno, $idMateria, $unidad)
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $dato['IDAlumno'] = $idAlumno;
                $dato['IDMareia'] = $idMateria;
                $dato['EntregaronTarea'] = $this->M_Sensei->AlumnosEntregaronTareaFiltrado($idAlumno, $idMateria, $unidad);
                $dato['NombreMateria'] = $this->M_Sensei->NombreMateria($idMateria);
                //Retorna Nombre del alumno
                $dato['Nombre_Alumno'] = $this->M_Sensei->getNombreUsuario($idAlumno);
                //Retorna informacion de la materia
                $dato['Info_Materia'] = $this->M_Sensei->getInfoMateria($idMateria, $unidad);

                $indicador['active'] = 0;

                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/UnidadesMateriasXAlumno', $dato);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }
    public function RevisarDocumento($idTarea)
    {
        $dato['Tarea'] = $this->M_Sensei->getTarea($idTarea);
        $dato['ID'] = $idTarea;
        $this->load->view('MaestrosSensei/VerDocumento', $dato);
    }

    public function GuardaCambios($ID_Tarea)
    {
        $enviar = array('Archi_Ruta' => $this->input->post('tarea'));

        $this->M_Sensei->setEdicionDocumento($ID_Tarea, $enviar);
        redirect($this->input->post('retorno'), 'refresh');
    }

    public function BlogMas($idBlog)
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $data['Blogs'] = $this->M_Sensei->ConsultaBlogFiltrado($idBlog);
                $data['Comentarios'] = $this->M_Sensei->ConsultaComentariosBlog($idBlog);
                $data['IDBlog'] = $idBlog;
                $indicador['active'] = 6;

                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/BlogMas', $data);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////
    //PROCESOS REFERENTES AL PROMEDIAR LOS ALUMNOS
    public function Promediar()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $dato['Grupos'] = $this->M_Sensei->Grupos();
                $indicador['active'] = 9;
                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/Promediar', $dato);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function getAlumnosInscriptosEnMaterias()
    {
        $qery = $this->M_Sensei->getAlumnosInscritosMateria($this->input->post('IDMateria'));
        echo '<option value="" disabled selected>Elija una opcion</option>';
        foreach ($qery->result() as $key) {
            echo '<option value="' . $key->Usuario_ID . '">' . $key->Usuario_Nombre . '</option>';
        }
    }

    public function getDatosMateria(Type $var = null)
    {
        $NombreMateria = $this->M_Sensei->getNombreMateria($this->input->post('IDMateria'));
        $UnidadesMateria = $this->M_Sensei->NumeroDeunidadesPorMateria($this->input->post('IDMateria'));
        $TareasMateria = $this->M_Sensei->NumeroTareasPorMateria($this->input->post('IDMateria'));

        echo '
            <div class="col-lg-4 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-danger text-center">
                                <i class="ti-book"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Materia</p>
                                ' . $NombreMateria . '
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-reload"></i> Infromacion
                        </div>
                    </div>
                </div>
            </div>
        </div>

            ';

        echo '
            <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-danger text-center">
                                            <i class="ti-list-ol"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Unidades</p>
                                            <div id="numero_unidades">' . $UnidadesMateria . '</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Infromacion
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            ';

        echo '
            <div class="col-lg-4 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-danger text-center">
                                <i class="ti-write"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Tareas</p>
                                <div id="TotalTareas">' . $TareasMateria . '</div>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-reload"></i> Infromacion
                        </div>
                    </div>
                </div>
            </div>
        </div>

            ';
    }

    public function prueba()
    {
        $historial = $this->M_Sensei->GetHistorialareasAlumno(2, 31);
        var_dump($historial);
    }

    public function getInfoAlumno()
    {
        $IDMATERIA = $this->input->post('ID_MATERIA');
        $IDALUMNO = $this->input->post('ID_ALUMNO');

        $Alumno = $this->M_Sensei->getInformacionAlumno($IDALUMNO);
        $Entregadas = $this->M_Sensei->TareasEntregadasporAlumno($IDALUMNO, $IDMATERIA);
        $calificadas = $this->M_Sensei->TareasEntregadasporAlumnoCalificadas($IDALUMNO, $IDMATERIA);
        $historial = $this->M_Sensei->GetHistorialareasAlumno($IDALUMNO, $IDMATERIA);
        $calificacionAlumno = $this->M_Sensei->getCalificacionAlumnoenMateria($IDALUMNO, $IDMATERIA);

        foreach ($Alumno->result() as $key) {
            echo '
               <div class="col-lg-3 col-sm-6">
               <div class="card">
                   <div class="content">
                       <div class="row">
                           <div class="col-xs-5">
                               <div class="icon-big icon-success text-center">
                                   <img src="' . base_url($key->Usuario_Avatar) . '" class="img-circle" width="50" height="50" alt="...">
                               </div>
                           </div>
                           <div class="col-xs-7">
                               <div class="numbers">
                                <strong><p>Nombre</p></strong>
                                 <p id=AlumnoNombre>' . $key->Usuario_Nombre . '</p><div></div>
                               </div>
                           </div>
                       </div>
                       <div class="footer">
                           <hr />
                           <div class="stats">
                               <i class="ti-calendar"></i> Alumno tareas
                           </div>
                       </div>
                   </div>
               </div>
           </div>
               ';
        }

        echo '
            <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-success text-center">
                                <i class="ti-ruler-pencil"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                             <strong><p>Entrego</p></strong>
                              <p id="alumno_entrego">' . $Entregadas . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-calendar"></i> Alumno tareas
                        </div>
                    </div>
                </div>
            </div>
        </div>
            ';

        echo '
            <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-success text-center">
                                <i class="ti-ruler-pencil"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                             <strong><p>Calificadas</p></strong>
                              <p id="alumno_calificadas">' . $calificadas . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-calendar"></i> Alumno tareas
                        </div>
                    </div>
                </div>
            </div>
        </div>
            ';
        echo '
            <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-success text-center">
                                <i class="ti-ruler-pencil"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                             <strong><p>Promedio final</p></strong>
                              <p>' . $calificacionAlumno . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-calendar"></i> Alumno tareas
                        </div>
                    </div>
                </div>
            </div>
        </div>
            ';

        echo '
            <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Historial de tareas</h4>
                </div>
                <div class="content">
            <div class="content table-responsive table-full-width">
            <table class="table table-striped">
                <thead>
                    <th>Unidad</th>
                    <th>Tarea</th>
                    <th>Tarea descripcion</th>
                    <th>Coemntario Alumno</th>
                    <th>Coemntario Maestro</th>
                    <th>Calificacion</th>
                    <th>Porcentaje</th>
                    <th>Valor</th>

                </thead>
                <tbody>
            ';

        $suma = 0;
        $bandera = '';
        foreach ($historial->result() as $archivo) {
            if ($bandera != $archivo->Unidades_ID && $suma != 0) {
                echo '
                    <tr>
                        <td bgcolor="#00BCD4"></td>
                        <td bgcolor="#00BCD4"></td>
                        <td bgcolor="#00BCD4"></td>
                        <td bgcolor="#00BCD4"></td>
                        <td bgcolor="#00BCD4"><h5><strong>Total</strong></h5></td>
                        <td bgcolor="#00BCD4">' . $suma . '</td>

                    </tr>
                ';
                $suma = 0;
            }
            $bandera = $archivo->Unidades_ID;

            $porcentaje = $archivo->Tarea_valor_porcentaje / 10;

            echo '
                    <tr>
                        <td>' . $archivo->Unidad_Descripcion . '</td>
                        <td>' . $archivo->Tarea_Nombre . '</td>
                        <td>' . $archivo->Tarea_Descripcion . '</td>
                        <td>' . $archivo->Archi_Comentario_Alumno . '</td>
                        <td>' . $archivo->Archi_Comentario_Maestro . '</td>
                        <td>' . $archivo->Archi_Calificacion . '</td>
                        <td>' . $porcentaje * $archivo->Archi_Calificacion . '%</td>
                        <td>' . $archivo->Tarea_valor_porcentaje . '%</td>

                    </tr>
                ';
            $suma = $suma + $archivo->Archi_Calificacion;
        }

        echo '
                <tr>
                        <td bgcolor="#00BCD4"></td>
                        <td bgcolor="#00BCD4"></td>
                        <td bgcolor="#00BCD4"></td>
                        <td bgcolor="#00BCD4"></td>
                        <td bgcolor="#00BCD4"><h5><strong>Total</strong></h5></td>
                        <td bgcolor="#00BCD4">' . $suma . '</td>

                </tr>
            ';

        echo '
            </tbody>
            </table>

             </div>
           </div>
            <div class="clearfix"></div>
        </div>
    </div>
            ';
    }

    public function Calificacion_final_alumno()
    {
        $total_tareas = $this->input->post('total_tareas');

        $id_alumno = $this->input->post('id_alumno');
        $id_materia = $this->input->post('id_materia');

        $suma_tareas_alumno = $this->M_Sensei->getSumaTareasAlumno($id_alumno, $id_materia);

        $resultado = $suma_tareas_alumno / $total_tareas;

        $this->M_Sensei->CalificacionMateriaAlumno($id_alumno, $resultado, $id_materia);

        echo $resultado;
    }

    public function imp_materia()
    {
        $this->load->library('Pdf');
        $this->load->view('MaestrosSensei/impresionPDF');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////

    public function chat()
    {
        $this->load->view('MaestrosSensei/incluir/head');
        $this->load->view('chat');
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

    public function BlogEditar($idBlog)
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $data['Blogs'] = $this->M_Sensei->ConsultaBlogFiltrado($idBlog);
                $data['Materias'] = $this->M_Sensei->Materias();
                $data['IdBlog'] = $idBlog;
                $indicador['active'] = 6;

                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/BlogEditar', $data);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function BlogActualiza()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $nombre = $this->input->post('Nombre');
                $idateria = $this->input->post('IDMateria');
                $contenido = $this->input->post('blog');
                $idPertenece = $this->session->ID_Usuario;
                $URLimage = $this->input->post('ImagenUrl');
                $descripcion = $this->input->post('Descripcion');
                $IDBlog = $this->input->post('IDBlog');

                $data = array(
                    'Blog_Nombre' => $nombre,
                    'Blog_Contenido' => $contenido,
                    'Blog_Pertenece_ID' => $idPertenece,
                    'Blog_ID_Materia' => $idateria,
                    'Blog_ImagenUrl' => $URLimage,
                    'Blog_Descripcion' => $descripcion,
                );

                $this->M_Sensei->ActualizaBlog($data, $IDBlog);

                redirect('Maestros/BlogEditar/' . $IDBlog, 'refresh');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function BlogEntradas()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $data['Materias'] = $this->M_Sensei->Materias();
                $indicador['active'] = 6;

                $datoNab['NumberComentarioAlum'] = $this->M_Sensei->NumeroComentarios();
                $datoNab['ComentarioAlum'] = $this->M_Sensei->CoemntariosBlogdeAlumnosRealizados();

                $this->load->view('MaestrosSensei/incluir/head');
                $this->load->view('MaestrosSensei/incluir/Navegacion', $indicador);
                $this->load->view('MaestrosSensei/incluir/Nab', $datoNab);
                $this->load->view('MaestrosSensei/BlogEntradas', $data);
                $this->load->view('MaestrosSensei/incluir/script');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function GuardaBlogEntradas()
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $nombre = $this->input->post('Nombre');
                $idateria = $this->input->post('IDMateria');
                $contenido = $this->input->post('blog');
                $idPertenece = $this->session->ID_Usuario;
                $URLimage = $this->input->post('ImagenUrl');
                $descripcion = $this->input->post('Descripcion');

                $data = array(
                    'Blog_Nombre' => $nombre,
                    'Blog_Contenido' => $contenido,
                    'Blog_Pertenece_ID' => $idPertenece,
                    'Blog_ID_Materia' => $idateria,
                    'Blog_ImagenUrl' => $URLimage,
                    'Blog_Descripcion' => $descripcion,
                    'Blog_UsuarioID' => $this->session->ID_Usuario,
                );

                $this->M_Sensei->GuardaBlog($data);

                redirect('Maestros/Blog', 'refresh');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function EliminaBlog($IDBlogEliminar)
    {
        if (isset($_SESSION['activo']) && $_SESSION['activo']) {
            if ($_SESSION['Tipo'] == 1) {
                $this->M_Sensei->EliminaBlog($IDBlogEliminar);
                redirect('Maestros/Blog', 'refresh');
            } else {
                redirect('Bienvenido');
            }
        } else {
            redirect('Bienvenido');
        }
    }

    public function Leercomentario($idBlog)
    {
        $this->M_Sensei->ActualizarLecturaComentario($idBlog);
        redirect('Maestros/BlogMas/' . $idBlog . '#Comentarios', 'refresh');
    }

    public function Documentos()
    {
        $this->load->view('Documentos');
    }
} //fin del controlador
