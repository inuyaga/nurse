<?php 

foreach ($Tarea->result() as $key) {
    if ($key->Archi_Tipo == 1) {
      echo $key->Archi_Ruta;
    }else{
        
        redirect($key->Archi_Ruta,'refresh'); 
    }
}


?>