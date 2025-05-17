<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    
    <!-- Estilos en línea para el diseño del certificado -->
    
    <style>
        body {
            font-family: DejaVu Sans, sans-serif; /* Fuente compatible con generación de PDF */
            text-align: center;                  /* Centra el texto */
            padding: 50px;                       /* Espaciado alrededor del contenido */
        }

        .certificado {
            border: 10px solid #ccc;             /* Borde alrededor del certificado */
            padding: 30px;                       /* Espaciado interno */
        }

        h1 {
            font-size: 2.5em;                    /* Tamaño grande para el título principal */
            margin-bottom: 0.5em;
        }

        h2 {
            font-size: 1.5em;                    /* Tamaño medio para el nombre del asistente */
            margin-top: 0;
        }
    </style>

</head>
<body>
    <div class="certificado">
        
        <h1>Certificado de Asistencia</h1>  <!-- Título del certificado -->
        <p>Se certifica que</p>  <!-- Texto introductorio -->        
        <h2><?= esc($asistente) ?></h2>  <!-- Nombre del asistente -->        
        <p>asistió al evento:</p> <!-- Texto antes del título del evento -->        
        <h3><?= esc($evento['title']) ?></h3>  <!-- Nombre del evento -->       
        <p>Realizado del <?= esc($evento['start']) ?> al <?= esc($evento['end']) ?>.</p>  <!-- Fechas de inicio y fin del evento -->
        <p>Ubicación: <?= esc($evento['location']) ?></p> <!-- Ubicación del evento -->
        <br><br><br><!-- Espacio para la firma -->
        <p>Firma autorizada</p>
        <hr style="width: 200px; margin: auto;"> <!-- Línea para firma -->

    </div>
</body>
</html>

