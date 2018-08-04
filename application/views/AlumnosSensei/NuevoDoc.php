<script src="<?= base_url('publico/js/ckeditor/ckeditor.js') ?>" type="text/javascript"></script>

<form action="<?= base_url('Alumnos/GuardarTarea') ?>" method="POST">

    <textarea name="ContenidoTarea" class="ckeditor"></textarea>


    <div class="form-group">

        <div class="input-field col s2 hidden">
            <input type="text" class="validate" name="TareaID" value="<?= $TareaID ?>">
            <label for="first_name">TareaID</label>
        </div>

        <input type="text" class="validate" name="TIPO" value="1">

</form>

<script type="text/javascript">
    CKEDITOR.on('instanceReady',
        function (evt) {
            var editor = evt.editor;
            editor.execCommand('maximize');
        });
</script>