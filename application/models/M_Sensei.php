<?php
class M_Sensei extends CI_Model
{

//=======================================================================================================================
    public function dato_usuarios($usuario, $pass)
    {
        $this->db->select('*');
        $this->db->from('SS_Usuarios');
        $this->db->where('Usuario_Usr', $usuario);
        $this->db->where('Usuario_Password', $pass);
        return $this->db->get();
    }

    public function UsuariosContactos()
    {
        $this->db->select('*');
        $this->db->from('SS_Usuarios');
        return $this->db->get();
    }

    //======================================================================================================================

    public function Materias()
    {
        /*$this->db->select('*');
        $this->db->from('VistaMaterias');
        $this->db->where('Materia_Usuario_ID',$_SESSION['ID_Usuario']);
        $this->db->order_by("Materia_ID", "asc");*/

        $this->db->select('*');
        $this->db->from('SS_Usuarios');
        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_Usuario_ID = SS_Usuarios.Usuario_ID');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_Grupo_ID = SS_Grupo.Grup_ID');
        $this->db->where('Usuario_ID', $_SESSION['ID_Usuario']);
        $this->db->order_by("Materia_ID", "asc");

        return $this->db->get();
    }

    public function getProcentajeTareas($IDUnidad)
    {
        $this->db->select('SUM(Tarea_valor_porcentaje) AS total');
        $this->db->from('SS_Tareas');
        $this->db->where('Tarea_Unidad_ID', $IDUnidad);
        return $this->db->get()->result()[0]->total;
    }

    public function getMaterias($idGrupo)
    {
        $this->db->select('*');
        $this->db->from('SS_Materia');
        $this->db->where('Materia_Grupo_ID', $idGrupo);
        return $this->db->get();
    }

    public function getUnidades($IDMaterias)
    {
        $this->db->select('*');
        $this->db->from('SS_Unidades');
        $this->db->where('Unidad_Materia_ID', $IDMaterias);
        return $this->db->get();
    }
    public function getTareas($IDUnidad)
    {
        $this->db->select('*');
        $this->db->from('SS_Tareas');
        $this->db->where('Tarea_Unidad_ID', $IDUnidad);
        return $this->db->get();
    }
    public function getTareasDeMateria($idMateria)
    {
        $this->db->select('*');
        $this->db->from('SS_Materia');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidad_Materia_ID = SS_Materia.Materia_ID');
        $this->db->join('SS_Tareas', 'SS_Tareas.Tarea_Unidad_ID = SS_Unidades.Unidades_ID');
        $this->db->where('Materia_ID', $idMateria);
        return $this->db->get();
    }
    public function getTareasParaAlumno($IDUnidad)
    {
        $this->db->select('*');
        $this->db->from('SS_Alumnos_Registrados');
        $this->db->join('SS_Materia', 'SS_Alumnos_Registrados.Resgistro_MateriaID = SS_Materia.Materia_ID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidad_Materia_ID = SS_Materia.Materia_ID');
        $this->db->join('SS_Tareas', 'SS_Tareas.Tarea_Unidad_ID = SS_Unidades.Unidades_ID');
        $this->db->where('Unidades_ID', $IDUnidad);
        $this->db->where('Resgistro_AlumnoID', $this->session->ID_Usuario);

        return $this->db->get();
    }

    public function Grupos()
    {
        $this->db->select('*');
        $this->db->from('SS_Grupo');
        $this->db->where('Grup_Usuario_ID', $_SESSION['ID_Usuario']);
        return $this->db->get();
    }

    //Selecciona el grupo de una materia
    public function getGrupoID($idmateria)
    {
        $this->db->select('*');
        $this->db->from('SS_Materia');
        $this->db->where('Materia_ID', $idmateria);

        return $this->db->get();
    }

    public function getMateria($idAula)
    {
        $this->db->select('*');
        $this->db->from('SS_Materia');
        $this->db->where('Materia_Grupo_ID', $idAula);

        return $this->db->get();
    }

    //Actualiza el estado de un grupo especifico
    public function setStadoGrupo($idGrupo)
    {
        $this->db->where('Grup_ID', $idGrupo);
        $this->db->update('SS_Grupo', array('Grup_Asignado' => 0));
    }

    public function GruposEnVistaCreaMaterias()
    {
        $this->db->select('*');
        $this->db->from('SS_Grupo');
        $this->db->where('Grup_Usuario_ID', $_SESSION['ID_Usuario']);
        $this->db->where('Grup_Asignado', 0);
        return $this->db->get();
    }

    //Revisar este query no se esta seguro
    public function ListaAlumnos($grupo)
    {
        $this->db->select('Maestro.Usuario_ID AS ID_Maestro');
        $this->db->select('Maestro.Usuario_Nombre AS Maestro_Nombre');
        $this->db->select('SS_Usuarios.Usuario_ID AS Alumno_ID');
        $this->db->select('SS_Usuarios.Usuario_Nombre AS Alumno_Nombre');
        $this->db->select('SS_Grupo.Grup_Nombre');
        $this->db->select('SS_Grupo.Grup_ID');
        $this->db->select('SS_Usuarios.Usuario_Correo AS AlumnoCorreo');

        $this->db->from('SS_Alumnos_Registrados');

        $this->db->join('SS_Materia', 'SS_Alumnos_Registrados.Resgistro_MateriaID = SS_Materia.Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_ID = SS_Materia.Materia_Grupo_ID');
        $this->db->join('SS_Usuarios AS Maestro', 'Maestro ON Maestro.Usuario_ID = SS_Grupo.Grup_Usuario_ID');
        $this->db->join('SS_Usuarios', 'SS_Usuarios.Usuario_ID = SS_Alumnos_Registrados.Resgistro_AlumnoID');

        // $this->db->where('Maestro_ID',$_SESSION['ID_Usuario']);
        $this->db->where('Materia_ID', $grupo);

        return $this->db->get();
    }

    public function getAlumnosInscritosMateria($IDMateria)
    {
        $this->db->select('*');
        $this->db->from('SS_Alumnos_Registrados');
        $this->db->join('SS_Usuarios', 'SS_Usuarios.Usuario_ID = SS_Alumnos_Registrados.Resgistro_AlumnoID');
        $this->db->join('SS_Materia', 'SS_Alumnos_Registrados.Resgistro_MateriaID = SS_Materia.Materia_ID');
        $this->db->where('Materia_ID', $IDMateria);
        return $this->db->get();
    }

    public function AlumnosEntregaronTarea()
    {
        //$this->db->from('VistaTareasEntregadas');
        $this->db->select('*');
        $this->db->from('SS_Archivos');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_ID = SS_Archivos.Archi_Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_ID = SS_Archivos.Archi_Grupo_ID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidades_ID = SS_Archivos.Archi_Unidad_ID');
        $this->db->join('SS_Usuarios', 'SS_Usuarios.Usuario_ID = SS_Archivos.Archi_To_Maestro_ID');
        $this->db->join('SS_Tareas', 'SS_Tareas.Tarea_ID = SS_Archivos.Archi_TareaID');
        $this->db->join('SS_Usuarios AS Alumno', 'Alumno.Usuario_ID = SS_Archivos.Archi_PerteneceID');

        $this->db->where('Archi_To_Maestro_ID', $_SESSION['ID_Usuario']);
        $this->db->where('Archi_Status', '1');
        $this->db->order_by("Archi_Fecreacion", "asc");

        return $this->db->get();
    }

    public function AlumnosEntregaronTareaFiltrado($idAlumno, $IDMateria, $idUnidad)
    {
        $this->db->select('*');
        //$this->db->from('VistaTareasEntregadas');
        $this->db->from('SS_Archivos');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_ID = SS_Archivos.Archi_Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_ID = SS_Archivos.Archi_Grupo_ID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidades_ID = SS_Archivos.Archi_Unidad_ID');
        $this->db->join('SS_Usuarios', 'SS_Usuarios.Usuario_ID = SS_Archivos.Archi_To_Maestro_ID');
        $this->db->join('SS_Tareas', 'SS_Tareas.Tarea_ID = SS_Archivos.Archi_TareaID');
        $this->db->join('SS_Usuarios AS Alumno', 'Alumno.Usuario_ID = SS_Archivos.Archi_PerteneceID');
        $this->db->where('Archi_To_Maestro_ID', $_SESSION['ID_Usuario']);
        $this->db->where('Archi_PerteneceID', $idAlumno);
        $this->db->where('Archi_Materia_ID', $IDMateria);
        $this->db->where('Archi_Unidad_ID', $idUnidad);
        // $this->db->where('Archi_Status','1');
        $this->db->order_by("Archi_Fecreacion", "asc");

        return $this->db->get();
    }

    public function NombreMateria($idMateria)
    {
        $this->db->select('*');
        $this->db->from('SS_Materia');
        $this->db->where('Materia_ID', $idMateria);
        $data = $this->db->get();
        foreach ($data->result() as $key) {
            return $key->Materia_Nombre;
        }
    }

    public function NombreUnidadMateria($idMateria, $IdUnidad)
    {
        $this->db->select('*');
        $this->db->from('SS_Unidades');
        $this->db->where('Unidad_Materia_ID', $idMateria);
        $this->db->where('Unidades_ID', $IdUnidad);
        $data = $this->db->get();
        foreach ($data->result() as $key) {
            return $key->Unidad_Descripcion;
        }
    }

    //Filtrado de archivos de tareas entregadas por los alumnos
    public function TareasXUnidadesFiltrados($IdMateria, $IDUnidad)
    {
        $this->db->select('*');
        //$this->db->from('VistaTareasEntregadas');

        $this->db->from('SS_Archivos');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_ID = SS_Archivos.Archi_Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_ID = SS_Archivos.Archi_Grupo_ID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidades_ID = SS_Archivos.Archi_Unidad_ID');
        $this->db->join('SS_Usuarios', 'SS_Usuarios.Usuario_ID = SS_Archivos.Archi_To_Maestro_ID');
        $this->db->join('SS_Tareas', 'SS_Tareas.Tarea_ID = SS_Archivos.Archi_TareaID');
        $this->db->join('SS_Usuarios AS Alumno', 'Alumno.Usuario_ID = SS_Archivos.Archi_PerteneceID');
        $this->db->where('Archi_Materia_ID', $IdMateria);
        $this->db->where('Archi_Unidad_ID', $IDUnidad);
        $this->db->where('Archi_Status', '1');

        return $this->db->get();
    }

    public function TareasXUnidadesFiltrados2($IdMateria, $IDUnidad)
    {
        $this->db->select('*');
        // $this->db->from('VistaTareasEntregadas');
        $this->db->from('SS_Archivos');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_ID = SS_Archivos.Archi_Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_ID = SS_Archivos.Archi_Grupo_ID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidades_ID = SS_Archivos.Archi_Unidad_ID');
        $this->db->join('SS_Usuarios', 'SS_Usuarios.Usuario_ID = SS_Archivos.Archi_To_Maestro_ID');
        $this->db->join('SS_Tareas', 'SS_Tareas.Tarea_ID = SS_Archivos.Archi_TareaID');
        $this->db->join('SS_Usuarios AS Alumno', 'Alumno.Usuario_ID = SS_Archivos.Archi_PerteneceID');
        $this->db->where('Archi_Materia_ID', $IdMateria);
        $this->db->where('Archi_Unidad_ID', $IDUnidad);
        $this->db->where('Archi_Status', '2');

        return $this->db->get();
    }

    public function getTareaRealizadas($idTarea)
    {
        $this->db->select('*');
        // $this->db->from('VistaTareasEntregadas');
        $this->db->from('SS_Archivos');

        $this->db->join('SS_Tareas', 'SS_Tareas.Tarea_ID = SS_Archivos.Archi_TareaID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidades_ID = SS_Tareas.Tarea_Unidad_ID');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_ID = SS_Unidades.Unidad_Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_ID = SS_Materia.Materia_Grupo_ID');
        $this->db->join('SS_Usuarios', 'SS_Usuarios.Usuario_ID = SS_Archivos.Archi_PerteneceID', 'left');

        $this->db->where('Archi_TareaID', $idTarea);
        $this->db->where('Archi_Status', '2');

        return $this->db->get();
    }
    public function getTareasSinCalificar($idTarea)
    {
        $this->db->select('*');
        // $this->db->from('VistaTareasEntregadas');
        $this->db->from('SS_Archivos');

        $this->db->join('SS_Tareas', 'SS_Tareas.Tarea_ID = SS_Archivos.Archi_TareaID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidades_ID = SS_Tareas.Tarea_Unidad_ID');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_ID = SS_Unidades.Unidad_Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_ID = SS_Materia.Materia_Grupo_ID');
        $this->db->join('SS_Usuarios', 'SS_Usuarios.Usuario_ID = SS_Archivos.Archi_PerteneceID', 'left');

        $this->db->where('Archi_TareaID', $idTarea);
        $this->db->where('Archi_Status', '1');

        return $this->db->get();
    }

    public function getTareaPorID($ID)
    {
        $this->db->select('*');
        $this->db->from('SS_Tareas');
        $this->db->where('Tarea_ID', $ID);
        return $this->db->get();
    }

    public function TareasXUnidadesFiltradosCompletos($IdMateria, $IDUnidad)
    {
        $this->db->select('*');
        //$this->db->from('VistaTareasEntregadas');
        $this->db->from('SS_Archivos');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_ID = SS_Archivos.Archi_Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_ID = SS_Archivos.Archi_Grupo_ID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidades_ID = SS_Archivos.Archi_Unidad_ID');
        $this->db->join('SS_Usuarios', 'SS_Usuarios.Usuario_ID = SS_Archivos.Archi_To_Maestro_ID');
        $this->db->join('SS_Tareas', 'SS_Tareas.Tarea_ID = SS_Archivos.Archi_TareaID');
        $this->db->join('SS_Usuarios AS Alumno', 'Alumno.Usuario_ID = SS_Archivos.Archi_PerteneceID');
        $this->db->where('Archi_Materia_ID', $IdMateria);
        $this->db->where('Archi_Unidad_ID', $IDUnidad);
        $this->db->where('Archi_Status', '2');

        return $this->db->get();
    }

    public function TareasCalificadas()
    {
        $this->db->select('*');
        //$this->db->from('VistaTareasEntregadas');
        $this->db->from('SS_Archivos');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_ID = SS_Archivos.Archi_Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_ID = SS_Archivos.Archi_Grupo_ID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidades_ID = SS_Archivos.Archi_Unidad_ID');
        $this->db->join('SS_Usuarios', 'SS_Usuarios.Usuario_ID = SS_Archivos.Archi_To_Maestro_ID');
        $this->db->join('SS_Tareas', 'SS_Tareas.Tarea_ID = SS_Archivos.Archi_TareaID');
        $this->db->join('SS_Usuarios AS Alumno', 'Alumno.Usuario_ID = SS_Archivos.Archi_PerteneceID');
        $this->db->where('Archi_To_Maestro_ID', $_SESSION['ID_Usuario']);
        $this->db->where('Archi_Status', '2');
        $this->db->order_by("Archi_Fecreacion", "asc");

        return $this->db->get();
    }

    //Fin

    public function CalificaTarea($dato, $idArchivo)
    {
        $this->db->where('Archi_ID', $idArchivo);
        $this->db->update('SS_Archivos', $dato);
    }

    public function ActualizaPerfilUser($data)
    {
        $this->db->where('Usuario_ID', $this->session->ID_Usuario);
        $this->db->update('SS_Usuarios', $data);
    }

    public function Slelecprueba($materiaID, $GrupoID)
    {
        $this->db->select('*');
        $this->db->from('SS_Unidades');
        $this->db->where('Unidad_Materia_ID', $materiaID);
        $this->db->where('Unidad_Grupo_ID', $GrupoID);
        $this->db->where('Unidad_Usuario_ID', $_SESSION['ID_Usuario']);

        return $this->db->get();
    }

    public function FiltradoRevisionTareas($materiaID, $GrupoID, $UnidadID)
    {
        $this->db->select('*');
        //$this->db->from('VistaFiltradoTareas');
        $this->db->from('SS_Archivos');
        $this->db->join('SS_Usuarios', 'SS_Usuarios.Usuario_ID = SS_Archivos.Archi_PerteneceID');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_ID = SS_Archivos.Archi_Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_ID = SS_Archivos.Archi_Grupo_ID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidades_ID = SS_Archivos.Archi_Unidad_ID');
        $this->db->join('SS_Tareas', 'SS_Tareas.Tarea_ID = SS_Archivos.Archi_TareaID', 'left');

        $this->db->where('Archi_Materia_ID', $materiaID);
        $this->db->where('Archi_Grupo_ID', $GrupoID);
        $this->db->where('Archi_Unidad_ID', $UnidadID);
        $this->db->where('Archi_Status', '1');
        $this->db->where('Archi_To_Maestro_ID', $this->session->ID_Usuario);

        return $this->db->get();
    }

    public function Unidades()
    {
        $this->db->select('*');
        $this->db->from('SS_Usuarios');

        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_Usuario_ID = SS_Usuarios.Usuario_ID');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_Grupo_ID = SS_Grupo.Grup_ID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidad_Materia_ID = SS_Materia.Materia_ID');
        $this->db->where('Usuario_ID', $this->session->ID_Usuario);

        return $this->db->get();
    }

    //SUMA DE TAREAS DEL ALUMNO PARA PROMEDIAR
    public function getSumaTareasAlumno($id_alumno, $id_materia)
    {
        $this->db->select('SUM(Archi_Calificacion) AS total_alumno');

        $this->db->from('SS_Archivos');
        $this->db->join('SS_Tareas', 'SS_Tareas.Tarea_ID = SS_Archivos.Archi_TareaID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidades_ID = SS_Tareas.Tarea_Unidad_ID');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_ID = SS_Unidades.Unidad_Materia_ID');
        $this->db->where('Archi_PerteneceID', $id_alumno);
        $this->db->where('Materia_ID', $id_materia);

        return $this->db->get()->result()[0]->total_alumno;
    }

    public function CalificacionMateriaAlumno($id_alumno, $calificacion, $id_materia)
    {
        $this->db->where('Resgistro_AlumnoID', $id_alumno);
        $this->db->where('Resgistro_MateriaID', $id_materia);
        $this->db->update('SS_Alumnos_Registrados', array('Resgistro_Calificacion_Final' => $calificacion));
    }

    public function UnidadesFiltrada($idMateria)
    {
        $this->db->select('*');
        $this->db->from('SS_Unidades');

        $this->db->join('SS_Materia', 'SS_Unidades.Unidad_Materia_ID = SS_Materia.Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Materia.Materia_Grupo_ID = SS_Grupo.Grup_ID');
        $this->db->where('Materia_ID', $idMateria);

        return $this->db->get();
    }
    //TAREAS CREADAS POR EL MAESTRO RETORNA EL TOTAL CREADOS
    public function TareasCreadas()
    {
        $this->db->select('*');
        $this->db->from('SS_Usuarios');

        $this->db->join('SS_Grupo', ' SS_Grupo.Grup_Usuario_ID = SS_Usuarios.Usuario_ID');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_Grupo_ID = SS_Grupo.Grup_ID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidad_Materia_ID = SS_Materia.Materia_ID');
        $this->db->join('SS_Tareas', 'SS_Tareas.Tarea_Unidad_ID = SS_Unidades.Unidades_ID');
        $this->db->where('Usuario_ID', $this->session->ID_Usuario);

        $variable = $this->db->get();

        return $variable->num_rows();
    }

    public function DocumentosDeMateria($Value)
    {
        $this->db->select('*');
        $this->db->from('SS_Materia');
        $this->db->join('SS_Documentos', 'SS_Materia.Materia_ID = SS_Documentos.Documento_MateriaID');
        $this->db->where('Materia_ID', $Value);
        return $this->db->get();
    }

    public function ConsultaBlog()
    {
        $this->db->select('*');
        $this->db->from('VistaBlog');
        $this->db->where('Blog_Pertenece_ID', $this->session->ID_Usuario);
        return $this->db->get();
    }
    public function EliminaBlog($IdBlog)
    {
        $this->db->where('Blog_ID', $IdBlog);
        $this->db->delete('SS_Blog');
    }

    public function NumerosDBlogs()
    {
        return $this->db->get('SS_Blog')->num_rows();
    }

    public function BlogsListado($per_page)
    {
        $this->db->select('*');
        $this->db->from('SS_Blog');
        $this->db->join('SS_Usuarios', 'SS_Usuarios.Usuario_ID = SS_Blog.Blog_Pertenece_ID');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_ID = SS_Blog.Blog_ID_Materia', 'left');

        $this->db->where('Blog_Pertenece_ID', $this->session->ID_Usuario);
        $this->db->order_by('Blog_Fecha_Creacion', 'desc');
        $this->db->limit($per_page, $this->uri->segment(3));
        //$data=$this->db->get('VistaBlog',$per_page,$this->uri->segment(3));
        return $this->db->get();
    }

    public function ConsultaBlogAlumnos($per_page)
    {
        $this->db->select('*');
        $this->db->from('SS_Alumnos_Registrados');

        $this->db->join('SS_Materia', 'SS_Alumnos_Registrados.Resgistro_MateriaID = SS_Materia.Materia_ID');
        $this->db->join('SS_Blog', 'SS_Blog.Blog_ID_Materia = SS_Materia.Materia_ID');
        $this->db->join('SS_Usuarios', 'SS_Usuarios.Usuario_ID = SS_Blog.Blog_UsuarioID');

        $this->db->where('Resgistro_AlumnoID', $this->session->ID_Usuario);
        $this->db->order_by('Blog_Fecha_Creacion', 'desc');
        $this->db->limit($per_page, $this->uri->segment(3));
        return $this->db->get();
    }

    //Consulta de tarea
    public function getTarea($id)
    {
        $this->db->select('*');
        $this->db->from('SS_Archivos');
        $this->db->where('Archi_ID', $id);
        return $this->db->get();
    }

    public function setEdicionDocumento($idTarea, $contenido)
    {
        $this->db->where('Archi_ID', $idTarea);

        $this->db->update('SS_Archivos', $contenido);
    }

    public function AppConsultaBlogAlumnos($IdAlumno)
    {
        $this->db->select('*');
        //$this->db->from('VistaBlogAlumnos');
        $this->db->from('SS_Alumnos_Registrados');
        $this->db->join('SS_Usuarios AS Alumnos', 'SS_Alumnos_Registrados.Resgistro_AlumnoID = Alumnos.Usuario_ID');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_Grupo_ID = SS_Alumnos_Registrados.Resgistro_GrupoID');
        $this->db->join('SS_Grupo', 'SS_Alumnos_Registrados.Resgistro_GrupoID = SS_Grupo.Grup_ID');
        $this->db->join('SS_Blog', 'SS_Blog.Blog_ID_Materia = SS_Materia.Materia_ID');
        $this->db->join('SS_Usuarios', 'SS_Usuarios.Usuario_ID = SS_Blog.Blog_Pertenece_ID');

        $this->db->where('Usuario_ID', $IdAlumno);
        $this->db->order_by('Blog_Fecha_Creacion', 'desc');
        return $this->db->get();
    }
    public function ConsultaBlogFiltrado($idBlog)
    {
        $this->db->select('*');
        $this->db->from('SS_Blog');
        $this->db->where('Blog_Pertenece_ID', $this->session->ID_Usuario);
        $this->db->where('Blog_ID', $idBlog);
        return $this->db->get();
    }
    public function ConsultaBlogFiltradoAlumno($idBlog)
    {
        $this->db->select('*');
        $this->db->from('SS_Blog');
        $this->db->where('Blog_ID', $idBlog);
        return $this->db->get();
    }
    public function ConsultaComentariosBlog($idBlog)
    {
        $this->db->select('*');
        $this->db->from('SS_ComentariosBlog');
        $this->db->where('Comentario_Blog_ID', $idBlog);
        $this->db->order_by('Comentario_FechaCrea', 'desc');
        return $this->db->get();
    }

    public function EliminaDocuemtoMateria($idDocumento)
    {
        $this->db->select('Documento_ruta');
        $this->db->from('SS_Documentos');
        $this->db->where('Docuemnto_ID', $idDocumento);
        $resultado = $this->db->get();

        if (!empty($resultado->result())) {
            $dta = $resultado->result()[0]->Documento_ruta;

            unlink($dta);

            $this->db->where('Docuemnto_ID', $idDocumento);

            $this->db->delete('SS_Documentos');
            return $this->db->affected_rows();
        } else {
            return 0;
        }
    }

    //ELIMINA MATERIA DE MAESTRO
    public function EliminarMateriaMaestro($id)
    {
        $this->db->where('Materia_ID', $id);
        $this->db->delete('SS_Materia');

        $this->db->trans_begin();

        $this->db->query('DELETE FROM SS_Materia
            WHERE Materia_ID =' . $id);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }
    // RETORNA LA CANTIDA DE BLOG CREADAS POR EL MAESTRO
    public function NumeroDeBlogCreados()
    {
        // $this->db->select('*');
        // $this->db->from('SS_Blog');
        // $this->db->where('Blog_UsuarioID', $this->session->ID_Usuario);
        return $this->db->where('Blog_UsuarioID', $this->session->ID_Usuario)->count_all_results('SS_Blog');
    }
    /* RETORNA EL NUMERO DE TAREAS CREADAS POR EL MAESTRO
    public function NumeroTareasCreadas()
    {
    
    return $this->db->where('Tarea_UsuarioM_ID', $this->session->ID_Usuario)->count_all_results('SS_Tareas');
    }*/

    public function NumeroTareasPorMateria($idMateria)
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('SS_Tareas');
        $this->db->join('SS_Unidades', 'SS_Tareas.Tarea_Unidad_ID = SS_Unidades.Unidades_ID');
        $this->db->join('SS_Materia', 'SS_Unidades.Unidad_Materia_ID = SS_Materia.Materia_ID');
        $this->db->where('Materia_ID', $idMateria);
        return $this->db->get()->result()[0]->total;
    }

    public function NumeroDeunidadesPorMateria($idMateria)
    {
        $this->db->select('COUNT(*) AS TotalUnidades');
        $this->db->from('SS_Materia');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidad_Materia_ID = SS_Materia.Materia_ID');
        $this->db->where('Materia_ID', $idMateria);
        return $this->db->get()->result()[0]->TotalUnidades;
    }

    public function getNombreMateria($idMateria)
    {
        $this->db->select('*');
        $this->db->from('SS_Materia');
        $this->db->where('Materia_ID', $idMateria);
        return $this->db->get()->result()[0]->Materia_Nombre;
    }

    public function NumeroTareasPorMateriaCalificadas($idAlumno, $idMateria)
    {
        $condicion = array('Archi_Materia_ID' => $idMateria, 'Archi_PerteneceID' => $idAlumno, 'Archi_Status' => 2);
        return $this->db->where($condicion)->count_all_results('SS_Archivos');
    }
    public function NumeroMateriasAsignada($idGrupo)
    {
        return $this->db->where('Materia_Grupo_ID', $idGrupo)->count_all_results('SS_Materia');
    }

    public function getNombreUsuario($idUsuario)
    {
        $this->db->select('Usuario_Nombre');
        $this->db->from('SS_Usuarios');
        $this->db->where('Usuario_ID', $idUsuario);

        $query = $this->db->get();
        foreach ($query->result() as $key) {
            return $key->Usuario_Nombre;
        }
    }
    /////////////////////////////////////////////////////////////
    //DATOS DEL ALUMNO

    public function getInformacionAlumno($id_alumno)
    {
        $this->db->select('*');
        $this->db->from('SS_Usuarios');
        $this->db->where('Usuario_ID', $id_alumno);
        return $this->db->get();
    }

    public function getCalificacionAlumnoenMateria($id_alumno, $id_materia)
    {
        $this->db->select('Resgistro_Calificacion_Final');
        $this->db->from('SS_Alumnos_Registrados');
        $this->db->where('Resgistro_AlumnoID', $id_alumno);
        $this->db->where('Resgistro_MateriaID', $id_materia);

        return $this->db->get()->result()[0]->Resgistro_Calificacion_Final;
    }

    public function TareasEntregadasporAlumno($idalumno, $idMateria)
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('SS_Archivos');
        $this->db->join('SS_Tareas', 'SS_Archivos.Archi_TareaID = SS_Tareas.Tarea_ID');
        $this->db->join('SS_Unidades', 'SS_Tareas.Tarea_Unidad_ID = SS_Unidades.Unidades_ID');
        $this->db->join('SS_Materia', 'SS_Unidades.Unidad_Materia_ID = SS_Materia.Materia_ID');
        $condicion = array('Materia_ID' => $idMateria, 'Archi_PerteneceID' => $idalumno);
        $this->db->where($condicion);
        return $this->db->get()->result()[0]->total;
    }

    public function TareasEntregadasporAlumnoCalificadas($idalumno, $idMateria)
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('SS_Archivos');

        $this->db->join('SS_Tareas', 'SS_Archivos.Archi_TareaID = SS_Tareas.Tarea_ID');
        $this->db->join('SS_Unidades', 'SS_Tareas.Tarea_Unidad_ID = SS_Unidades.Unidades_ID');
        $this->db->join('SS_Materia', 'SS_Unidades.Unidad_Materia_ID = SS_Materia.Materia_ID');

        $condicion = array('Materia_ID' => $idMateria, 'Archi_PerteneceID' => $idalumno, 'Archi_Status' => 2);
        $this->db->where($condicion);
        return $this->db->get()->result()[0]->total;
    }

    public function GetHistorialareasAlumno($IDALUMON, $IDMATERIA)
    {
        $this->db->select('*');
        $this->db->from('SS_Archivos');

        $this->db->join('SS_Tareas', 'SS_Archivos.Archi_TareaID = SS_Tareas.Tarea_ID');
        $this->db->join('SS_Unidades', 'SS_Tareas.Tarea_Unidad_ID = SS_Unidades.Unidades_ID');
        $this->db->join('SS_Materia', 'SS_Unidades.Unidad_Materia_ID = SS_Materia.Materia_ID');

        $this->db->where('Archi_PerteneceID', $IDALUMON);
        $this->db->where('Materia_ID', $IDMATERIA);

        $this->db->order_by('Unidades_ID', 'ASC');
        return $this->db->get();
    }

    public function getInfoMateria($ID_Materia, $unidad)
    {
        $this->db->select('SS_Materia.Materia_Nombre');
        $this->db->select('SS_Unidades.Unidades_ID');
        $this->db->select('SS_Unidades.Unidad_Descripcion');
        $this->db->select('SS_Materia.Materia_ID');
        $this->db->select('SS_Grupo.Grup_ID');
        $this->db->select('SS_Grupo.Grup_Nombre');
        $this->db->from('SS_Materia');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidad_Materia_ID = SS_Materia.Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_ID = SS_Unidades.Unidad_Grupo_ID');
        $this->db->where('Unidades_ID', $unidad);

        return $this->db->get();
    }

    public function SumaTareasPorMateriaAndAlumno($idalumno, $idMateria)
    {
        $this->db->select('SUM(Archi_Calificacion) AS Total');
        $this->db->from('SS_Archivos');
        $this->db->where('Archi_Materia_ID', $idMateria);
        $this->db->where('Archi_PerteneceID', $idalumno);
        $dato = $this->db->get();

        foreach ($dato->result() as $key) {
            return $key->Total;
        }
    }

    public function NumeroTareasPorMateriaAndAlumno($idalumno, $idMateria)
    {
        return $this->db->where(array('Archi_Materia_ID' => $idMateria, 'Archi_PerteneceID' => $idalumno))->count_all_results('SS_Archivos');
    }

    // RETORNA EL NUMERO DE TAREAS ENTREGADAS POR LOS ALUMNOS

    public function NumeroTareasEntregadas()
    {
        $this->db->select('*');
        $this->db->from('SS_Archivos');
        $this->db->join('SS_Tareas', 'SS_Tareas.Tarea_ID = SS_Archivos.Archi_TareaID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidades_ID = SS_Tareas.Tarea_Unidad_ID');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_ID = SS_Unidades.Unidad_Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_ID = SS_Materia.Materia_Grupo_ID');
        $this->db->join('SS_Usuarios', 'SS_Usuarios.Usuario_ID = SS_Grupo.Grup_Usuario_ID');
        $this->db->where('Usuario_ID', $this->session->ID_Usuario);
        $this->db->where('Archi_Status', 1);
        return $this->db->get()->num_rows();
    }

    public function NumeroTareasEntregadasCalificadas()
    {
        $this->db->select('*');
        $this->db->from('SS_Archivos');
        $this->db->join('SS_Tareas', 'SS_Tareas.Tarea_ID = SS_Archivos.Archi_TareaID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidades_ID = SS_Tareas.Tarea_Unidad_ID');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_ID = SS_Unidades.Unidad_Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_ID = SS_Materia.Materia_Grupo_ID');
        $this->db->join('SS_Usuarios', 'SS_Usuarios.Usuario_ID = SS_Grupo.Grup_Usuario_ID');
        $this->db->where('Usuario_ID', $this->session->ID_Usuario);
        $this->db->where('Archi_Status', 2);
        return $this->db->get()->num_rows();
    }
    public function getCalificacionAlumno($idMateria, $idalumno)
    {
        $this->db->select('*');
        $this->db->from('SS_Alumnos_Registrados');
        $this->db->where('Resgistro_AlumnoID', $idalumno);
        $this->db->where('Resgistro_MateriaID', $idMateria);
        return $this->db->get()->result()[0]->Resgistro_Calificacion_Final;
    }
    // RETORNA NUMERO DE COMENTARIOS DE ALUMNOS EN LOS BLOG
    public function NumeroComentarios()
    {
        $query = $this->db->query("SELECT
                              COUNT(*) AS total
                              FROM
                              SS_Blog
                              INNER JOIN SS_ComentariosBlog ON SS_ComentariosBlog.Comentario_Blog_ID = SS_Blog.Blog_ID
                              WHERE
                              SS_ComentariosBlog.Comentario_Stado_comentario = 0 AND Blog_UsuarioID = " . $this->session->ID_Usuario . "  ");

        foreach ($query->result() as $key) {
            return $key->total;
        }
    }

    // COMENTARIOS DE ALUMNOS EN BLOG
    public function CoemntariosBlogdeAlumnosRealizados()
    {
        $this->db->select('*');
        $this->db->from('SS_Blog');
        $this->db->join('SS_ComentariosBlog', 'SS_ComentariosBlog.Comentario_Blog_ID = SS_Blog.Blog_ID');
        $this->db->where('Comentario_Stado_comentario', 0);
        $this->db->where('Blog_UsuarioID', $this->session->ID_Usuario);
        return $this->db->get();
    }

    public function ActualizarLecturaComentario($idBlog)
    {
        $this->db->where('Comentario_Blog_ID', $idBlog);
        $this->db->update('SS_ComentariosBlog', array('Comentario_Stado_comentario' => 1));
    }

    public function GuardaMaterias($datos)
    {

        /* $this->db->trans_begin();

        $this->db->query('INSERT INTO SS_Materia (Materia_Nombre, Materia_Usuario_ID, Materia_Grupo_ID)
        VALUES ("'.$datos['Materia_Nombre'].'", '.$datos['Materia_Usuario_ID'].', '.$datos['Materia_Grupo_ID'].')');

        $this->db->query('UPDATE SS_Grupo
        SET Grup_Asignado=1
        WHERE Grup_ID='.$datos['Materia_Grupo_ID'].' ');

        if ($this->db->trans_status() === FALSE)
        {
        $this->db->trans_rollback();
        }
        else
        {
        $this->db->trans_commit();
        }*/

        $this->db->insert('SS_Materia', $datos);
    }

    public function GuardaBlog($dato)
    {
        $this->db->insert('SS_Blog', $dato);
    }

    public function GuardaComentario($data)
    {
        $this->db->insert('SS_ComentariosBlog', $data);
    }

    public function ActualizaBlog($data, $idBlog)
    {
        $this->db->where('Blog_ID', $idBlog);
        $this->db->update('SS_Blog', $data);
    }

    public function GuardaGrupos($datos)
    {
        $this->db->insert('SS_Grupo', $datos);
    }

    public function elimanrTarea($value)
    {
        $this->db->where('Tarea_ID', $value);
        $this->db->delete('SS_Tareas');
    }

    public function EditaTarea($idTarea, $data)
    {
        $this->db->where('Tarea_ID', $idTarea);
        $this->db->update('SS_Tareas', $data);
    }

    public function ProximasTareasMaestros()
    {
        /*$this->db->select('*');
        $this->db->from('VistaTareasCreadas');
        $this->db->where('Tarea_UsuarioM_ID', $_SESSION['ID_Usuario']);
        $this->db->order_by('Tarea_Fecha_fin', 'asc'); */

        $this->db->select('*');
        $this->db->from('SS_Usuarios');

        $this->db->join('SS_Grupo', ' SS_Grupo.Grup_Usuario_ID = SS_Usuarios.Usuario_ID');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_Grupo_ID = SS_Grupo.Grup_ID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidad_Materia_ID = SS_Materia.Materia_ID');
        $this->db->join('SS_Tareas', 'SS_Tareas.Tarea_Unidad_ID = SS_Unidades.Unidades_ID');
        $this->db->where('Usuario_ID', $_SESSION['ID_Usuario']);

        return $this->db->get();
    }

    // public function GuardarUsuario($data)
    // {
    //     $this->db->insert('SS_Usuarios',$data);
    // }

    public function GuardarUsuario($data)
    {
        $this->db->query("INSERT INTO SS_Usuarios(Usuario_Nombre,Usuario_Usr,Usuario_Password,Usuario_Tipo,Usuario_Correo,Usuario_Dir)
        SELECT '" . $data['Usuario_Nombre'] . "','" . $data['Usuario_Usr'] . "','" . $data['Usuario_Password'] . "'," . $data['Usuario_Tipo'] . ",'" . $data['Usuario_Correo'] . "','" . $data['Usuario_Dir'] . "'
        FROM dual
        WHERE NOT EXISTS (SELECT Usuario_Usr FROM SS_Usuarios WHERE Usuario_Usr='" . $data['Usuario_Usr'] . "' LIMIT 1)");
        return $this->db->affected_rows();
    }

    public function GuardarUnidad($data)
    {
        $this->db->insert('SS_Unidades', $data);
    }

    public function GuardaTareas($data)
    {
        $this->db->insert('SS_Tareas', $data);
        return $this->db->insert_id();
    }
    public function alumnosregistrosporunidad($UnidadID)
    {
       $this->db->select('*');
       $this->db->from('ss_alumnos_registrados');
       $this->db->join('ss_materia', 'ss_alumnos_registrados.Resgistro_MateriaID = ss_materia.Materia_ID');
       $this->db->join('ss_unidades', 'ss_unidades.Unidad_Materia_ID = ss_materia.Materia_ID');
       $this->db->where('Unidades_ID', $UnidadID);
       return $this->db->get();
       
    }
  
    public function crearTarea($datos)
    {
     $this->db->insert('ss_archivos', $datos);
       
    }

    public function GuardaDocumentosPorMateria($data)
    {
        $this->db->insert('SS_Documentos', $data);
    }

    public function PromedioAlumno()
    {
        $this->db->select_sum('Archi_Calificacion');
        $this->db->from('SS_Archivos');
        $this->db->where('Archi_Status', 2);
        $this->db->where('Archi_Grupo_ID', 237);
        $this->db->where('Archi_Materia_ID', 11);
        $this->db->where('Archi_PerteneceID', 14);
        $this->db->where('Archi_To_Maestro_ID', 1);
        $data = $this->db->get();
        return $data->result_array();
    }

    //Solo para alumnos
    //============================================================================================================

    public function GuardaRegistroGrupo($data)
    {
        $msn = $this->db->insert('SS_Alumnos_Registrados', $data);

        if (!$msn) {
            $this->session->set_flashdata('error', 'Codigo de materia incorrecto, favor de verificar');
        } else {
            $this->session->set_flashdata('mensaje', 'Usuario registrado correctamente!');
        }
    }

    public function IfExistRegistro($user, $grupo)
    {
        $this->db->select('*');
        $this->db->from('SS_Alumnos_Registrados');
        $this->db->where('Resgistro_AlumnoID', $user);
        $this->db->where('Resgistro_MateriaID', $grupo);

        $var = $this->db->get();

        return $var->num_rows();
    }

    //Materias de alumnos registrado

    public function MisMateria()
    {
        $this->db->select('
        SS_Materia.Materia_ID,
        SS_Materia.Materia_Nombre,
        SS_Grupo.Grup_Nombre,
        Maestros.Usuario_Nombre AS NombreMaestro,
        Alumno.Usuario_Nombre AS A_Nombre,
        Alumno.Usuario_ID AS ID_Alumno,
        SS_Alumnos_Registrados.Resgistro_AlumnoID
        ');
        $this->db->from('SS_Alumnos_Registrados');

        $this->db->join('SS_Materia', 'SS_Alumnos_Registrados.Resgistro_MateriaID = SS_Materia.Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Materia.Materia_Grupo_ID = SS_Grupo.Grup_ID');
        $this->db->join('SS_Usuarios AS Maestros', 'Maestros.Usuario_ID = SS_Grupo.Grup_Usuario_ID');
        $this->db->join('SS_Usuarios AS Alumno', 'Alumno.Usuario_ID = SS_Alumnos_Registrados.Resgistro_AlumnoID');
        $this->db->where('Resgistro_AlumnoID', $_SESSION['ID_Usuario']);

        return $this->db->get();
    }

    public function MisTareas()
    {
        $this->db->select('*');
        //$this->db->from('VistaAlumnoMiTareas');
        $this->db->from('SS_Alumnos_Registrados');

        $this->db->join('SS_Tareas', 'SS_Alumnos_Registrados.Resgistro_GrupoID = SS_Tareas.Tarea_Grupo_ID');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_ID = SS_Tareas.Tarea_Materia_ID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidades_ID = SS_Tareas.Tarea_Unidad_ID');
        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_ID = SS_Tareas.Tarea_Grupo_ID');
        $this->db->join('SS_Archivos', 'SS_Archivos.Archi_TareaID = SS_Tareas.Tarea_ID');

        $this->db->where('Resgistro_AlumnoID', $_SESSION['ID_Usuario']);
        $this->db->order_by("Tarea_ID", "asc");

        return $this->db->get();
    }

    public function TareasEntregadas()
    {
        $this->db->select('*');
        //$this->db->from('VistaGeneralTareasAlumnos');
        $this->db->from('SS_Tareas');
        $this->db->join('SS_Archivos', 'SS_Tareas.Tarea_ID = SS_Archivos.Archi_TareaID', 'left');
        $this->db->join('SS_Materia', 'SS_Materia.Materia_ID = SS_Tareas.Tarea_Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Grupo.Grup_ID = SS_Tareas.Tarea_Grupo_ID');
        $this->db->join('SS_Unidades', 'SS_Unidades.Unidades_ID = SS_Tareas.Tarea_Unidad_ID');

        $this->db->where('Archi_PerteneceID', $_SESSION['ID_Usuario']);

        return $this->db->get();
    }
    public function TareasEntregadasFiltradas($idAlumno, $IDMateria, $IdUnidad)
    {
        $this->db->select('*');
        //$this->db->from('VistaGeneralTareasAlumnos');
        $this->db->from('SS_Archivos');

        $this->db->join('SS_Tareas', 'SS_Archivos.Archi_TareaID = SS_Tareas.Tarea_ID');
        $this->db->join('SS_Unidades', 'SS_Tareas.Tarea_Unidad_ID = SS_Unidades.Unidades_ID');
        $this->db->join('SS_Materia', 'SS_Unidades.Unidad_Materia_ID = SS_Materia.Materia_ID');
        $this->db->join('SS_Grupo', 'SS_Materia.Materia_Grupo_ID = SS_Grupo.Grup_ID');

        $this->db->where('Archi_PerteneceID', $idAlumno);
        $this->db->where('Materia_ID', $IDMateria);
        $this->db->where('Unidades_ID', $IdUnidad);

        return $this->db->get();
    }

    public function EliminarTareaAlumno($data)
    {
        $this->db->where('Archi_ID', $data);
        $this->db->delete('SS_Archivos');
    }

    public function TareasPorHacer()
    {
        //  $this->db->select('*');
        //  $this->db->from('VistaTareasPorHacer');
        //  $this->db->where('Resgistro_AlumnoID', $this->session->ID_Usuario);
        // $this->db->order_by("Tarea_fecha_fin", "asc");
        //  return $this->db->get();

        return $this->db->query('SELECT *
          FROM VistaTareasPorHacer
          WHERE VistaTareasPorHacer.Resgistro_AlumnoID = ' . $this->session->ID_Usuario . '
          AND NOT EXISTS(SELECT * FROM SS_Archivos WHERE VistaTareasPorHacer.Tarea_ID = SS_Archivos.Archi_TareaID
          AND SS_Archivos.Archi_PerteneceID = ' . $this->session->ID_Usuario . ')
          ORDER BY
          VistaTareasPorHacer.Tarea_Fecha_fin ASC');
    }

    public function getTareaHechaPorElAlumno($idTarea)
    {
        return $this->db->where(array('Archi_PerteneceID' => $this->session->ID_Usuario, 'Archi_TareaID' => $idTarea))->count_all_results('SS_Archivos');
    }
    public function getStatusTarea($idTarea)
    {
        $this->db->select('*');
        $this->db->from('SS_Archivos');
        $this->db->where('Archi_PerteneceID', $this->session->ID_Usuario);
        $this->db->where('Archi_TareaID', $idTarea);

        return $this->db->get()->result()[0]->Archi_Status;
    }
    public function getCalificacionTarea($idTarea)
    {
        $this->db->select('*');
        $this->db->from('SS_Archivos');
        $this->db->where('Archi_PerteneceID', $this->session->ID_Usuario);
        $this->db->where('Archi_TareaID', $idTarea);

        $query = $this->db->get();
        foreach ($query->result() as $key) {
            return $key->Archi_Calificacion;
        }
    }

    public function GuardaArchivosTareas($data)
    {
        $this->db->insert('SS_Archivos', $data);
    }
}
