<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= esc($evento['title']) ?></title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><?= esc($evento['title']) ?></h3>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Fecha inicio:</strong> <?= esc($evento['start']) ?></li>
            <li class="list-group-item"><strong>Fecha fin:</strong> <?= esc($evento['end']) ?></li>
            <li class="list-group-item"><strong>Duración:</strong> <?= esc($evento['duration']) ?></li>
            <li class="list-group-item"><strong>Ubicación:</strong> <?= esc($evento['location']) ?></li>
            <li class="list-group-item"><strong>Presentador:</strong> <?= esc($evento['presName']) ?></li>
            <li class="list-group-item"><strong>Máximo de asistentes:</strong> <?= esc($evento['permax']) ?></li>
            <li class="list-group-item">
                <strong>Documento:</strong>
                <?php if (!empty($evento['documento'])): ?>
                    <a href="<?= base_url($evento['documento']) ?>" target="_blank" class="btn btn-sm btn-outline-info ms-2">Ver documento</a>
                <?php else: ?>
                    <span class="text-muted ms-2">No disponible</span>
                <?php endif; ?>
            </li>
        </ul>

        <div class="card-footer text-end">
            <a href="<?= base_url('calendarioUsuario') ?>" class="btn btn-secondary">Volver al Calendario</a>
            <a href="<?= base_url('certificado/generar/' . $evento['id']) ?>" class="btn btn-success me-2" target="_blank">Generar Certificado</a>
        </div>
        
    </div>

</div>

<!-- Bootstrap JS (opcional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


