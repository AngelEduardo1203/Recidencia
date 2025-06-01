<?php
function fechaEnEspanol($fechaISO) {
    $timestamp = strtotime($fechaISO);

    $dias = ['domingo','lunes','martes','miércoles','jueves','viernes','sábado'];
    $meses = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];

    $dia_semana = $dias[date('w', $timestamp)];
    $dia = date('d', $timestamp);
    $mes = $meses[date('n', $timestamp) - 1];
    $anio = date('Y', $timestamp);
    $hora = date('g:i A', $timestamp); // 12h con AM/PM

    return ucfirst($dia_semana)." $dia de $mes del $anio a las $hora";
}

function formatoDuracion($duration) {
    $partes = explode(':', $duration);

    // Verifica que haya al menos dos partes
    if (count($partes) < 2) {
        return 'Duración inválida';
    }

    $horas = ltrim($partes[0], '0');
    if ($horas === '') {
        $horas = '0';
    }

    $minutos = $partes[1];

    return $horas . ':' . $minutos . ' horas';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= esc($evento['title']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><?= esc($evento['title']) ?></h3>
        </div>

        <ul class="list-group list-group-flush">
            <input type="hidden" name="event_id" value="<?= $evento['id'] ?>">
            <li class="list-group-item">
                <strong>Slug:</strong> <?= esc($evento['slug']) ?>
            </li>
            <li class="list-group-item">
                <strong>Descripción:</strong> <?= esc($evento['descripcion']) ?>
            </li>
            <li class="list-group-item">
                <strong>Fecha de inicio:</strong> <?= fechaEnEspanol($evento['start']) ?>
            </li>
            <li class="list-group-item">
                <strong>Fecha de fin:</strong> <?= fechaEnEspanol($evento['end']) ?>
            </li>
            <li class="list-group-item">
                <strong>Duración:</strong> <?= formatoDuracion($evento['duration']) ?>
            </li>
            <li class="list-group-item">
                <strong>Modalidad:</strong> <?= esc(ucfirst($evento['modalidad'])) ?>
            </li>
            <li class="list-group-item">
                <strong>Tipo:</strong> <?= esc(ucfirst($evento['tipo'])) ?>
            </li>
            <li class="list-group-item">
                <strong>Estado:</strong> <?= esc(ucfirst(str_replace('_', ' ', $evento['estado']))) ?>
            </li>
            <li class="list-group-item">
                <strong>Presentador:</strong> <?= esc($evento['presName']) ?>
            </li>
            <li class="list-group-item">
                <strong>Máximo de asistentes:</strong> <?= esc($evento['permax']) ?>
            </li>
            <li class="list-group-item">
                <strong>Documento:</strong>
                <?php if (!empty($evento['documento'])): ?>
                    <a href="<?= base_url($evento['documento']) ?>" target="_blank" class="btn btn-sm btn-outline-info ms-2">Ver documento</a>
                <?php else: ?>
                    <span class="text-muted ms-2">No disponible</span>
                <?php endif; ?>
            </li>
            <li class="list-group-item">
                <strong>Fecha de creación:</strong> <?= $evento['created_at'] ? fechaEnEspanol($evento['created_at']) : 'No disponible' ?>
            </li>
            <li class="list-group-item">
                <strong>Última actualización:</strong> <?= $evento['updated_at'] ? fechaEnEspanol($evento['updated_at']) : 'No disponible' ?>
            </li>
        </ul>
        <div>
                            <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('info')): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('info') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-footer text-end">
            <a href="<?= base_url('usuario/') ?>" class="btn btn-secondary">Volver al Calendario</a>
            <a href="<?= base_url('usuario/certificado/generar/' . $evento['id']) ?>" class="btn btn-success me-2" target="_blank">Generar Certificado</a>
            <a href="<?= base_url('usuario/evento/suscribirse/' . $evento['id']) ?>" class="btn btn-primary">Suscribirme</a>
        </div>
    </div>

</div>

<!-- Bootstrap JS (opcional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


