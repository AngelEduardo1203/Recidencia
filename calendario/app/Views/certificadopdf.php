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
    $partes = explode(':', $duracion);
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
            <h1>Certificado de Asistencia</h1>
            <p>Se certifica que</p>
            <h2><?= esc($asistente) ?></h2>
            <p>asistió al evento:</p>
            <h3><?= esc($evento['title']) ?></h3>
            <p>
                Realizado del 
                <?= fechaEnEspanol($evento['start']) ?> 
                al 
                <?= fechaEnEspanol($evento['end']) ?>.
            </p>
            <p>Ubicación: <?= esc($evento['location']) ?></p>
            <br><br><br>
            <p>Firma autorizada</p>
            <hr style="width: 200px; margin: auto;">
        </div>
</body>
</html>

