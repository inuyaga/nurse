<?php 

foreach ($Tarea->result() as $key) {
    if ($key->Archi_Tipo == 1) {
      echo $key->Archi_Ruta;
    }else{
        echo '
        <iframe src="'.$key->Archi_Ruta.'" width="100%" height="100%">

        </iframe> 
        ';
    }
}


?>