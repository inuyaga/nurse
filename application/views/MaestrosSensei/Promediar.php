<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Promediar alumnos</h4>
        </div>
        <div class="content">

            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Seleccione un Aula</label>
                    <select class="form-control" id="ID_Aula">
                        <option value="" disabled selected>Elija una opcion</option>
                        <?php foreach ($Grupos->result() as $key) {?>
                        <option value="<?=$key->Grup_ID?>">
                            <?=$key->Grup_Nombre?>
                        </option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Seleccione una Materia</label>
                    <select class="form-control" id="ID_Materia">
                        <option value="" disabled selected>Elija una opcion</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Unidad</label>
                    <select class="form-control" id="Unidad_ID">
                        <option value="" disabled selected>Elija una opcion</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Seleccione un Alumn@</label>
                    <select class="form-control" id="IDAlumno">
                        <option value="" disabled selected>Elija una opcion</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <button type="button" onclick="promediar_unidad_completa()" class="btn btn-info btn-fill btn-wd" id="boton_final_calificacion"
                    disabled>Promediar unidad</button>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <button disabled="disabled" class="btn btn-info btn-fill btn-wd" id="btn_report_materia_unidad"
                        onclick="report_materia_total_unidad()">Reporte
                        completo de unidad</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <button disabled="disabled" class="btn btn-info btn-fill btn-wd" id="btn_report_materia" onclick="report_materia_total()">Reporte
                        completo de materia</button>
                </div>
            </div>


            <div class="clearfix"></div>
            </form>
        </div>
    </div>



    <div id="InformacionMateria" class="row"></div>

    <div id="InformacionAlumno" class="row"></div>




















    <script>
        function pasarInfo(IDArchivo, descripcion) {
            $("#archivoID").val(IDArchivo);
            // $("#ComentaMaster").val(comentario);
            //$("#CalificaMaster").val(calificacion);
            //$("#TMasterID").val(TMasterID);
            //$("#TareaID").val(TareaID);

            //document.getElementById("descripcionTarea").innerHTML = '<b>Descripcion tarea: </b>'+descripcion;
            //document.getElementById("comentarioAlumno").innerHTML = '<b>Comentario alumno:</b> '+comentarioAlumno;
            //$("#ArchivoDescarga").attr("href",ArchivoDow);
            //document.getElementById("unidadTexto").innerHTML = unidad;
            //document.getElementById("grupoTexto").innerHTML = grupo;
            // $("#ok2").val(nombre);
            //  $("#ok").val(ID);
            // $("#ok2").val(nombre);

            //$("#NombreTarea").focus();
        }


        function Calificar() {

            $.post("<?=base_url('Maestros/setCalificacion')?>",
                {
                    IDArchivo: $("#archivoID").val(),
                    Calificacion: $("#CalificaMaster").val(),
                    Comentario: $("#ComentaMaster").val(),
                },
                function (data, status) {
                    alert('Tarea calificada');

                    $.post("<?=base_url('Maestros/getTareasHechasPorCalificar')?>",
                        {
                            IDTarea: $("#ID_Tarea").val()
                        },
                        function (data, status) {
                            $('#Tabla').html(data);
                            $("#CalificaMaster").val('');
                            $("#ComentaMaster").val('');
                        });



                });

        }







        $('#ID_Aula').change(function () {
            $('#ID_Materia').html('');
            $('#IDAlumno').html('');
            $('#Unidad_ID').html('');

            $('#InformacionMateria').html('');
            $('#InformacionAlumno').html('');

            $('#boton_final_calificacion').attr("disabled", true);
            $('#btn_report_materia_unidad').attr("disabled", true);
            $('#btn_report_materia').attr("disabled", true);

            $('#InformacionTarea').html('');
            $('#Tabla').html('');
            $.post("<?=base_url('Maestros/getMaterias')?>",
                {
                    IDGrupo: $(this).val()
                },
                function (data, status) {
                    $('#ID_Materia').html(data);
                });
        });



        $('#ID_Materia').change(function () {
            $('#ID_Unidad').html('');
            $('#ID_Tarea').html('');
            $('#InformacionAlumno').html('');

            $('#InformacionTarea').html('');
            $('#Tabla').html('');

            $('#btn_report_materia').attr("disabled", false);
            $('#btn_report_materia_unidad').attr("disabled", true);


            $.post("<?=base_url('Maestros/getAlumnosInscriptosEnMaterias')?>",
                {
                    IDMateria: $(this).val()
                },
                function (data, status) {
                    $('#IDAlumno').html(data);
                });


            $.post("<?=base_url('Maestros/getUnidadesMateria')?>",
                {
                    ID_MATERIA: $(this).val()
                },
                function (data, status) {
                    $('#Unidad_ID').html(data);
                });


        });


        $('#IDAlumno').change(function () {


            $.post("<?=base_url('Maestros/getInfoAlumno')?>",
                {
                    ID_ALUMNO: $(this).val(),
                    ID_MATERIA: $('#ID_Materia').val(),
                    ID_UNIDAD: $('#Unidad_ID').val(),

                },
                function (data, status) {
                    $('#InformacionAlumno').html(data);
                });

        });


        $('#Unidad_ID').change(function () {
            $('#InformacionAlumno').html('');
            $('#boton_final_calificacion').attr("disabled", false);
            $('#btn_report_materia_unidad').attr("disabled", false);

            $.post("<?=base_url('Maestros/getDatosMateria')?>",
                {
                    Unidad_ID: $(this).val(),
                    ID_MATERIA: $('#ID_Materia').val(),
                },
                function (data, status) {
                    $('#InformacionMateria').html(data);
                });
        });





        function getInfoalumno() {
            $.post("<?=base_url('Maestros/getInfoAlumno')?>",
                {
                    ID_ALUMNO: $('#IDAlumno').val(),
                    ID_MATERIA: $('#ID_Materia').val(),
                    ID_UNIDAD: $('#Unidad_ID').val(),

                },
                function (data, status) {
                    $('#InformacionAlumno').html(data);
                });
        }





        function promediar_alumno() {

            alertify.confirm('¿Promediar alumno?', 'Esta accion calificara al alumno ' + $('#AlumnoNombre').html() + ' en la materia de esta unidad',
                function () {
                    alertify.success('Si');


                    $.post("<?=base_url('Maestros/Calificacion_final_alumno')?>",
                        {
                            total_tareas: $('#TotalTareas').html(),
                            id_alumno: $('#IDAlumno').val(),
                            id_materia: $('#ID_Materia').val(),
                            ID_UNIDAD: $('#Unidad_ID').val(),

                        },
                        function (data, status) {
                            alertify.alert('Calificado', 'Calificacion final: ' + data, function () { alertify.success('Ok'); });
                            getInfoalumno();
                        });

                    // window.location.href = "EliminaTareaAlumno/"+id+"/"+ruta;
                },
                function () {
                    alertify.error('Cancelar')
                }).set('labels', { ok: 'Si!', cancel: 'No!' });

        }
        function promediar_unidad_completa() {

            alertify.confirm('¿Promediar Unidad?', 'Esta accion calificara a todos los alumnos en la materia ' + $('#ID_Materia option:selected').text() + ' Unidad: ' + $('#Unidad_ID option:selected').text() + ' Completamente esta accion se asume que ya fueron calificadas todas las tareas entregadas de no ser asi califique y posteriormente prosiga con este paso',
                function () {
                    alertify.success('Si');


                    $.post("<?=base_url('Maestros/promediar_alumnos_en_unidad')?>",
                        {
                            id_materia: $('#ID_Materia').val(),
                            ID_UNIDAD: $('#Unidad_ID').val(),

                        },
                        function (data, status) {
                            alertify.alert('Calificado', 'Calificacion final: ' + data, function () { alertify.success('Ok'); });

                        });

                    // window.location.href = "EliminaTareaAlumno/"+id+"/"+ruta;
                },
                function () {
                    alertify.error('Cancelar')
                }).set('labels', { ok: 'Si!', cancel: 'No!' });

        }

        function report_materia_total() {
            var id_materia = $('#ID_Materia').val();
            window.open("<?=base_url('Maestros/imp_materia/')?>" + id_materia, 'reporte materia');
            return false;
        }
        function report_materia_total_unidad() {
            var id_materia = $('#ID_Materia').val();
            var ID_UNIDAD = $('#Unidad_ID').val();
            window.open("<?=base_url('Maestros/imp_materia_unidad/')?>" + id_materia + "/" + ID_UNIDAD, 'reporte materia');
            return false;
        }


    </script>