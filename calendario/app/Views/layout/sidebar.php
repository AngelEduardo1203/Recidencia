<?php
$uri = service('uri');
$current = $uri->getSegment(1);
$isAdmin = session('role') === 'admin';
?>
<div class="text-white border-end position-fixed d-flex flex-column h-100 bg-dark" id="sidebar-wrapper">
    <div class="list-group list-group-flush flex-grow-1">

        <?php if (!$isAdmin): // INVESTIGADOR ?>
            <!-- Home propio -->
            <a href="<?= base_url('/home') ?>"
                class="list-group-item list-group-item-action bg-dark text-white border-0 <?= $current === 'home' ? 'active' : '' ?>">
                <i class="bi bi-house-door-fill"></i> Home</a>

            <!-- Eventos propios -->
            <a href="<?= base_url('/eventos') ?>"
                class="list-group-item list-group-item-action bg-dark text-white border-0 <?= strpos($current, 'eventos') === 0 ? 'active' : '' ?>">
                <i class="fas fa-calendar-alt"></i> Mis Eventos</a>

            <!-- Ponentes propios -->
            <a href="<?= base_url('/ponentes') ?>"
                class="list-group-item list-group-item-action bg-dark text-white border-0 <?= $current === 'ponentes' ? 'active' : '' ?>">
                <i class="fas fa-user-tie"></i> Ponentes</a>

            <!-- Asistentes de eventos propios -->
            <a href="<?= base_url('/asistentes') ?>"
                class="list-group-item list-group-item-action bg-dark text-white border-0 <?= $current === 'asistentes' ? 'active' : '' ?>">
                <i class="bi bi-people-fill"></i> Asistentes</a>

            <!-- Material propio -->
            <a href="<?= base_url('/materiales') ?>"
                class="list-group-item list-group-item-action bg-dark text-white border-0 <?= $current === 'materiales' ? 'active' : '' ?>">
                <i class="fas fa-file-alt"></i> Material</a>

        <?php else: // ADMINISTRADOR ?>
            <!-- Home propio -->
            <a href="<?= base_url('/home') ?>"
                class="list-group-item list-group-item-action bg-dark text-white border-0 <?= $current === 'home' ? 'active' : '' ?>">
                <i class="bi bi-house-door-fill"></i> Home</a>
                
            <!-- Eventos globales -->
            <a href="<?= base_url('/admin/eventos') ?>"
                class="list-group-item list-group-item-action bg-dark text-white border-0 <?= strpos($current, 'admin/eventos') === 0 ? 'active' : '' ?>">
                <i class="fas fa-calendar-alt"></i> Todos los Eventos</a>

            <!-- Ponentes globales -->
            <a href="<?= base_url('/admin/ponentes') ?>"
                class="list-group-item list-group-item-action bg-dark text-white border-0 <?= strpos($current, 'admin/ponentes') === 0 ? 'active' : '' ?>">
                <i class="fas fa-user-tie"></i> Todos los Ponentes</a>

            <!-- Asistentes globales -->
            <a href="<?= base_url('/admin/asistentes') ?>"
                class="list-group-item list-group-item-action bg-dark text-white border-0 <?= strpos($current, 'admin/asistentes') === 0 ? 'active' : '' ?>">
                <i class="bi bi-people-fill"></i> Asistentes</a>

            <!-- Material global -->
            <a href="<?= base_url('/admin/materiales') ?>"
                class="list-group-item list-group-item-action bg-dark text-white border-0 <?= strpos($current, 'admin/materiales') === 0 ? 'active' : '' ?>">
                <i class="fas fa-file-alt"></i> Materiales</a>

            <!-- Usuarios globales -->
            <a href="<?= base_url('/admin/usuarios') ?>"
                class="list-group-item list-group-item-action bg-dark text-white border-0 <?= strpos($current, 'admin/usuarios') === 0 ? 'active' : '' ?>">
                <i class="fas fa-users-cog"></i> Usuarios</a>

            
        <?php endif; ?>

    </div>
</div>
