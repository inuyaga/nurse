<div class="sidebar" data-background-color="white" data-active-color="danger">

<!--
Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
-->



  <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text">
                Nurse Class
            </a>
        </div>

        <ul class="nav">
            <li class="<?php if ($active == 2) {echo 'active';}?>">
                <a href="<?=base_url('Maestros/PerfilUsuario')?>">
                    <i class="ti-user"></i>
                    <p>Perfil Usuario</p>
                </a>
            </li>
            <li class="<?php if ($active == 1) {echo 'active';}?>">
                <a href="<?=base_url('Maestros/CreaGrupos')?>">
                    <i class="fa fa-university"></i>
                    <p>Crear Aula</p>
                </a>
            </li>
            <li class="<?php if ($active == 3) {echo 'active';}?>">
                <a href="<?=base_url('Maestros/CreaMaterias')?>">
                    <i class="ti-book"></i>
                    <p>Crear Materias</p>
                </a>
            </li>
            <li class="<?php if ($active == 4) {echo 'active';}?>">
                <a href="<?=base_url('Maestros/unidades')?>">
                    <i class="ti-list-ol"></i>
                    <p>Unidades</p>
                </a>
            </li>
            <li class="<?php if ($active == 5) {echo 'active';}?>">
                <a href="<?=base_url('Maestros/Tareas')?>">

                       <i class="ti-write"></i>

                    <p>Tareas</p>
                </a>
            </li>
            <li class="<?php if ($active == 6) {echo 'active';}?>">
                <a href="<?=base_url('Maestros/Blog')?>">
                    <i class="ti-receipt"></i>
                    <p>Blog</p>
                </a>
            </li>
            <li class="<?php if ($active == 7) {echo 'active';}?>">
                <a href="<?=base_url('Maestros/RevisionTareas')?>">
                    <i class="ti-files"></i>
                    <p>Tareas entregadas</p>
                </a>
            </li>
            <li class="<?php if ($active == 8) {echo 'active';}?>">
                <a href="<?=base_url('Maestros/TareasRevisadas')?>">
                    <i class="ti-eraser"></i>
                    <p>Tareas calificadas</p>
                </a>
            </li>
            <li class="<?php if ($active == 9) {echo 'active';}?>">
                <a href="<?=base_url('Maestros/Promediar')?>">
                    <i class="ti-bolt-alt"></i>
                    <p>Promediar</p>
                </a>
            </li>



        </ul>
  </div>
</div>
