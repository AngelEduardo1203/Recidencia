<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Evento - Calendario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Agregar Evento</h4>
            </div>

            <div class="card-body">
                <form action="<?= base_url('calendario/formulario/guardar') ?>" method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="title" class="form-label">Nombre del Evento:</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="start" class="form-label">Fecha y Hora de Inicio:</label>
                        <input type="datetime-local" class="form-control" name="start" id="start" required>
                    </div>

                    <div class="mb-3">
                        <label for="end" class="form-label">Fecha y Hora de Fin:</label>
                        <input type="datetime-local" class="form-control" name="end" id="end" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-text text-muted">La duración del evento se calcula automáticamente.</label>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Ubicación:</label>
                        <input type="text" class="form-control" name="location" id="location">
                    </div>

                    <div class="mb-3">
                        <label for="modalidad" class="form-label">Modalidad:</label>
                        <select class="form-select" name="modalidad" id="modalidad" required>
                            <option value="presencial" selected>Presencial</option>
                            <option value="virtual">Virtual</option>
                            <option value="híbrido">Híbrido</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Evento:</label>
                        <select class="form-select" name="tipo" id="tipo" required>
                            <option value="conferencia" selected>Conferencia</option>
                            <option value="congreso">Congreso</option>
                            <option value="seminario">Seminario</option>
                            <option value="taller">Taller</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado:</label>
                        <select class="form-select" name="estado" id="estado" required>
                            <option value="por_comenzar" selected>Por Comenzar</option>
                            <option value="en_curso">En Curso</option>
                            <option value="culminado">Culminado</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="permax" class="form-label">Máximo de Asistentes:</label>
                        <input type="number" class="form-control" name="permax" id="permax" required>
                    </div>

                    <div class="mb-3">
                        <label for="presName" class="form-label">Nombre del Presentador:</label>
                        <input type="text" class="form-control" name="presName" id="presName" required>
                    </div>

                    <div class="mb-3">
                        <label for="documento" class="form-label">Documento:</label>
                        <input type="file" class="form-control" name="documento" id="documento" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Guardar Evento</button>
                        <a href="<?= base_url('calendario/') ?>" class="btn btn-secondary">Volver al Calendario</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>

