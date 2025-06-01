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
function formatoDuracion($duracion) {
    // Si duración es null, vacío o no es string, devolver 0:00 horas
    if (empty($duracion) || !is_string($duracion)) {
        return '0:00 horas';
    }
    // Verifica si contiene ':' para poder hacer explode
    if (strpos($duracion, ':') === false) {
        return '0:00 horas';
    }
    $partes = explode(':', $duracion);
    $horas = isset($partes[0]) ? ltrim($partes[0], '0') : '0';
    $minutos = isset($partes[1]) ? $partes[1] : '00';
    if ($horas === '') {
        $horas = '0';  }
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
                <strong>Ubicación:</strong> <?= esc($evento['location']) ?>
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

        <div class="card-footer text-end">
            <a href="<?= base_url('calendario/') ?>" class="btn btn-secondary">Volver al Calendario</a>
            <a href="<?= base_url('calendario/editar/'.$evento['id']) ?>" class="btn btn-primary">Editar Evento</a>
            <a href="<?= base_url('calendario/eliminar/'.$evento['id']) ?>" class="btn btn-danger"
               onclick="return confirm('¿Estás seguro de que deseas eliminar este evento?');">
               Eliminar Evento
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
-