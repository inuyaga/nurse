<div class="sidebar" data-background-color="white" data-active-color="danger">

<!--
Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
-->



  <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text">
                Nurse Class
                <img src="<?=base_url('publico/img/logo.png')?>" alt="" height="80" width="80">
            </a>
        </div>

        <ul class="nav">
            <li class="<?php if ($active == -1) {echo 'active';}?>">
                <a href="<?=base_url('Alumnos')?>">
                    <i class="ti-layers"></i>
                    <p>Dash</p>
                </a>
            </li>
            <li class="<?php if ($active == 0) {echo 'active';}?>">
                <a href="<?=base_url('Alumnos/blog')?>">
                    <i class="ti-bookmark-alt"></i>
                    <p>Blogs</p>
                </a>
            </li>
            <li class="<?php if ($active == 1) {echo 'active';}?>">
                <a href="<?=base_url('Alumnos/Perfil')?>">
                    <i class="ti-user"></i>
                    <p>Perfil Usuario</p>
                </a>
            </li>
            <li class="<?php if ($active == 2) {echo 'active';}?>">
                <a href="<?=base_url('Alumnos/MisMaterias')?>">
                    <i class="fa fa-university"></i>
                    <p>Mis Materias</p>
                </a>
            </li>
            <li class="<?php if ($active == 3) {echo 'active';}?>">
                <a href="<?=base_url('Alumnos/Tareas')?>">
                    <i class="ti-book"></i>
                    <p>Tareas</p>
                </a>
            </li>
            <li class="<?php if ($active == 4) {echo 'active';}?>">
                <a href="<?=base_url('Alumnos/TareasEntregadas')?>">
                    <i class="ti-pencil-alt"></i>
                    <p>Tareas Entregadas</p>
                </a>
            </li>

             <li class="<?php if ($active == 9) {echo 'active';}?>">
                <a href="<?=base_url('Alumnos/Blibioteca')?>">
                    <i class="ti-bookmark-alt"></i>
                    <p>Biblioteca</p>
                </a>
            </li>



        </ul>
  </div>
</div>
