</body>




	<script type="text/javascript">
    	$(document).ready(function(){



            <?php
            if ($this->session->flashdata('mensaje')) { ?>
              $.notify({
                	icon: 'ti-gift',
                	message: "<?= $this->session->mensaje ?>"

                },{
                    type: 'success',
                    timer: 4000
                });
            <?php }

             ?>


             <?php
             if ($this->session->flashdata('error')) { ?>
               $.notify({
                  icon: 'ti-close',
                  message: "<?= $this->session->error ?>"

                 },{
                     type: 'danger',
                     timer: 4000
                 });
             <?php }

              ?>

    	});
	</script>

</html>
