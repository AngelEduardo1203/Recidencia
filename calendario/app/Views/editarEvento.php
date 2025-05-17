<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Evento - Calendario</title>

    <!-- Enlace al CSS de Bootstrap para estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">

    <!-- Tarjeta principal con sombra -->

    <div class="card shadow">
        <!-- Encabezado de la tarjeta con color de advertencia -->
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Editar Evento</h4> 
        </div>

        <div class="card-body">
            <!-- Formulario para actualizar el evento -->
            
            <!-- Se envía a la ruta /actualizar/{id} con método POST y permite archivos -->
            <form action="<?= base_url('actualizar/'.$evento['id']) ?>" method="post" enctype="multipart/form-data">

                
                <div class="mb-3">  <!-- Campo: Título del evento -->
                    <label for="title" class="form-label">Título del Evento:</label>
                    <input type="text" class="form-control" name="title" id="title" value="<?= esc($evento['title']) ?>" required> </div>
                <div class="mb-3">  <!-- Campo: Fecha y hora de inicio -->
                    <label for="start" class="form-label">Fecha y Hora de Inicio:</label>
                    <input type="datetime-local" class="form-control" name="start" id="start" value="<?= date('Y-m-d\TH:i', strtotime($evento['start'])) ?>"
                     required> </div>
                <div class="mb-3">  <!-- Campo: Fecha y hora de fin -->
                    <label for="end" class="form-label">Fecha y Hora de Fin:</label>
                    <input type="datetime-local" class="form-control" name="end" id="end" value="<?= date('Y-m-d\TH:i', strtotime($evento['end'])) ?>" required></div>
                <div class="mb-3">  <!-- Nota informativa: duración calculada automáticamente -->
                    <label class="form-text text-muted">La duración del evento se calcula automáticamente.</label></div>
                <div class="mb-3">  <!-- Campo: Ubicación del evento -->
                    <label for="location" class="form-label">Ubicación:</label>
                    <input type="text" class="form-control" name="location" id="location" value="<?= esc($evento['location']) ?>"></div>
                <div class="mb-3">  <!-- Campo: Nombre del presentador -->
                    <label for="presName" class="form-label">Nombre del Presentador:</label>
                    <input type="text" class="form-control" name="presName" id="presName" value="<?= esc($evento['presName']) ?>" required> </div>
                <div class="mb-3"> <!-- Campo: Máximo de asistentes -->
                    <label for="permax" class="form-label">Máximo de Asistentes:</label>
                    <input type="number" class="form-control" name="permax" id="permax" value="<?= esc($evento['permax']) ?>" required> </div>
                <div class="mb-3">  <!-- Campo: Cargar nuevo documento (opcional) -->
                    <label for="documento" class="form-label">Documento (opcional):</label>
                    <input type="file" class="form-control" name="documento" id="documento"></div>
                

                <!-- Muestra el documento actual si existe -->
                <?php if (!empty($evento['documento'])): ?>
                    <div class="mb-3">
                        <strong>Documento actual:</strong> 
                        <a href="<?= base_url($evento['documento']) ?>" target="_blank" class="btn btn-sm btn-outline-info ms-2">Ver archivo</a>
                    </div>
                <?php endif; ?>

                <!-- Botones: Guardar cambios o volver al calendario -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a href="<?= base_url('calendario') ?>" class="btn btn-secondary ms-2">Volver al Calendario</a>
                </div>

            </form>
        </div>
    </div>
</div>
</body>
</html>
