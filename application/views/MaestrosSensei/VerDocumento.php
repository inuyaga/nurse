<script src="<?= base_url('publico/js/ckeditor/ckeditor.js') ?>" type="text/javascript"></script>
<?php 

foreach ($Tarea->result() as $key) {
    if ($key->Archi_Tipo == 1) { ?>
      
      <form action="<?= base_url('Maestros/GuardaCambios/').$ID ?>" method="POST">

      <textarea name="tarea" class="ckeditor"><?= $key->Archi_Ruta ?></textarea>      
      <input type="text" name="retorno" value="<?= uri_string() ?>">
      </form>
      
   <?php }else{
    redirect($key->Archi_Ruta,'refresh'); 
     }
    } ?>
<script type="text/javascript">
   CKEDITOR.on('instanceReady',
      function( evt )
      {
         var editor = evt.editor;
         editor.execCommand('maximize');
      });
</script>
 