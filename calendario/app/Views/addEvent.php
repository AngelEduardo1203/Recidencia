<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Evento - Calendario</title> <!-- Título de la página -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Importa estilos de Bootstrap -->
</head>

<body class="bg-light">
    <div class="container mt-5"> <!-- Contenedor principal con margen superior -->
        <div class="card shadow"> <!-- Tarjeta con sombra para el formulario -->
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Agregar Evento</h4> <!-- Encabezado del formulario -->
            </div>

            <div class="card-body">
                <!-- Formulario para agregar evento -->
                <form action="<?= base_url('formulario/guardar') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3"> <!-- Campo: Nombre del evento -->
                        <label for="title" class="form-label">Nombre del Evento:</label>
                        <input type="text" class="form-control" name="title" id="title" required> </div>
                    
                    <div class="mb-3"><!-- Campo: Fecha y hora de inicio del evento -->
                        <label for="start" class="form-label">Fecha y Hora de Inicio:</label>
                        <input type="datetime-local" class="form-control" name="start" id="start" required> </div>
                                       
                    <div class="mb-3"><!-- Campo: Fecha y hora de fin del evento -->
                        <label for="end" class="form-label">Fecha y Hora de Fin:</label>
                        <input type="datetime-local" class="form-control" name="end" id="end" required> </div>
                                      
                    <div class="mb-3"><!-- Mensaje informativo -->
                        <label class="form-text text-muted">La duración del evento se calcula automáticamente.</label> </div>  
                                      
                    <div class="mb-3"><!-- Campo: Ubicación del evento -->
                        <label for="location" class="form-label">Ubicación:</label>
                        <input type="text" class="form-control" name="location" id="location"> </div>

                    <div class="mb-3">
                        <label for="permax" class="form-label">Máximo de Asistentes:</label>
                        <input type="number" class="form-control" name="permax" id="permax" required> </div>
                    
                    <div class="mb-3"> <!-- Campo: Número máximo de asistentes -->
                        <label for="presName" class="form-label">Nombre del Presentador:</label>
                        <input type="text" class="form-control" name="presName" id="presName" required> </div>                   
                    
                    <div class="mb-3"><!-- Campo: Carga de documento relacionado al evento -->
                        <label for="documento" class="form-label">Documento:</label>
                        <input type="file" class="form-control btn-success " name="documento" id="documento" required> </div>
                    

                    
                    <div class="d-flex justify-content-between"> <!-- Botones para guardar o volver al calendario -->
                        <button type="submit" class="btn btn-success">Guardar Evento</button> <!-- Botón para enviar formulario -->
                        <a href="<?= base_url('calendario') ?>" class="btn btn-secondary">Volver al Calendario</a> <!-- Enlace para regresar -->
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>
