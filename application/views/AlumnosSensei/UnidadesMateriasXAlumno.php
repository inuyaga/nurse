<?php
$compara = array(
    '1' => 'Entregado',
    '2' => 'Calificado',
);
?>
<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="header">
      <h4 class="title">Tareas entregadas</h4>
    </div>
    <div class="content">

      <div class="content table-responsive table-full-width">
   <table class="table table-striped">
       <thead>
         <th>Materia</th>
           <th>Unidad</th>
           <th>Tarea</th>
           <th>Estado</th>
           <th>Calificación</th>
           <th>Comentario Maestro</th>
           <th>Acción</th>
       </thead>
       <tbody>
           <?php foreach ($TareaEntregadas->result() as $key): ?>
             <tr>
            <td><?=$key->Materia_Nombre?></td>
            <td><?=$key->Unidad_Descripcion?></td>
            <td><?=$key->Tarea_Descripcion?></td>
            <td><?=$compara[$key->Archi_Status]?></td>
            <td><?=$key->Archi_Calificacion?></td>
            <td><?=$key->Archi_Comentario_Maestro?></td>
            <?php if ($key->Archi_Calificacion > 0): ?>
              <?php else: ?>
                <td>
                  <button class="btn btn-danger btn-sm" onclick="alerta(<?=$key->Archi_ID?>, '<?=$key->Archi_ID?>')">Eliminar</button>

              </td>
            <?php endif;?>
            <td>
            <a href="<?=base_url('Alumnos/VerDocumento/') . $key->Archi_ID?>" class="btn btn-success btn-sm">Ver</a>
            </td>
             </tr>
           <?php endforeach;?>

       </tbody>
   </table>

</div>

      <div class="clearfix"></div>

    </div>
  </div>
</div>



<script>
   function alerta(id, ruta){

  alertify.confirm('Eliminar','Esta seguro de elimar ',
    function(){
      alertify.success('Si');

     $.post("<?=base_url('Alumnos/EliminaTareaAlumno')?>",
      {
        IDTarea: id,
        RUTA: ruta,
      },
      function (data, status) {
       setTimeout('document.location.reload()',1000);

      });


     // window.location.href = "EliminaTareaAlumno/"+id+"/"+ruta;
    },
    function(){
      alertify.error('Cancelar')
    });
}
 </script>
