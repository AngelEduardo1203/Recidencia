<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= esc($evento['title']) ?></title> <!-- Muestra el título del evento como título de la página -->
    <!-- Carga los estilos de Bootstrap 5 desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5"> <!-- Contenedor con margen superior -->

    <!-- Tarjeta que contiene todos los detalles del evento -->
    <div class="card shadow">
        <!-- Cabecera con el título del evento -->
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><?= esc($evento['title']) ?></h3> </div>
                
        <ul class="list-group list-group-flush"><!-- Lista con la información detallada del evento -->
            <li class="list-group-item"><strong>Fecha inicio:</strong> <?= esc($evento['start']) ?></li> <!-- Fecha de inicio -->
            <li class="list-group-item"><strong>Fecha fin:</strong> <?= esc($evento['end']) ?></li> <!-- Fecha de fin -->
            <li class="list-group-item"><strong>Duración:</strong> <?= esc($evento['duration']) ?></li> <!-- Duración del evento -->
            <li class="list-group-item"><strong>Ubicación:</strong> <?= esc($evento['location']) ?></li> <!-- Lugar donde se realiza -->
            <li class="list-group-item"><strong>Presentador:</strong> <?= esc($evento['presName']) ?></li> <!-- Nombre del presentador -->
            <li class="list-group-item"><strong>Máximo de asistentes:</strong> <?= esc($evento['permax']) ?></li> <!-- Capacidad máxima -->
           
            <li class="list-group-item"> <!-- Verifica si hay un documento cargado -->
                <strong>Documento:</strong>
                <?php if (!empty($evento['documento'])): ?>
                    <!-- Muestra enlace al documento si existe -->
                    <a href="<?= base_url($evento['documento']) ?>" target="_blank" class="btn btn-sm btn-outline-info ms-2">Ver documento</a>
                <?php else: ?>
                    <!-- Mensaje si no hay documento disponible -->
                    <span class="text-muted ms-2">No disponible</span>
                <?php endif; ?>

            </li>
        </ul>

        <!--botones de acción -->
        <div class="card-footer text-end">
            <a href="<?= base_url('calendario') ?>" class="btn btn-secondary">Volver al Calendario</a> <!-- Regresar -->
            <a href="<?= base_url('editar/'.$evento['id']) ?>" class="btn btn-primary">Editar Evento</a> <!-- Editar evento -->

            <a href="<?= base_url('eliminar/'.$evento['id']) ?>" class="btn btn-danger" 
            onclick="return confirm('¿Estás seguro de que deseas eliminar este evento?');">Eliminar Evento</a> <!-- Eliminar con confirmación -->

        </div>
    </div>

</div>

<!-- JS de Bootstrap para funcionalidades como modales o tooltips (opcional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
