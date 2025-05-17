<<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calendario <?= $month ?>/<?= $year ?></title> <!-- Título dinámico con el mes y año actual -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Carga Bootstrap -->

    <style>
        /* Estilo para las celdas del calendario */
        .calendar td {
            height: 120px;
            vertical-align: top;
            padding: 5px;
            border: 1px solidrgb(192, 212, 233);
        }
        /* Estilo para los encabezados del calendario */
        .calendar th {
            background-color: #f0f0f0;
            text-align: center;
        }
        .day-number {
            font-weight: bold; 
            /* Número del día con negrita */
        }
        .event {
            margin: 2px 0;
            padding: 2px 4px;
            border-radius: 4px;
            font-size: 0.9em;
            color: #000;
        }

        /* Genera clases con diferentes colores para eventos */
        <?php for ($i = 0; $i < 10; $i++): ?>
        .event-color-<?= $i ?> { background: hsl(<?= $i * 36 ?>, 70%, 70%); }
        <?php endfor; ?>
    </style>

</head>
<body class="bg-light">
<div class="container mt-4">

    <!-- ======================== Navegación ======================== -->

    <?php
    // Calcula el mes anterior y siguiente
    $prev = strtotime("$year-$month-01 -1 month");
    $next = strtotime("$year-$month-01 +1 month");
    // Extrae año y mes del mes anterior y siguiente
    $prevYear = date('Y', $prev);
    $prevMonth = date('n', $prev);
    $nextYear = date('Y', $next);
    $nextMonth = date('n', $next);
    ?>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Botón para ir al mes anterior -->
        <a href="<?= base_url("/calendario?year=$prevYear&month=$prevMonth") ?>" class="btn btn-primary">&laquo; Mes anterior</a>

        <!-- Título con el mes y año actual -->
        <h4 class="text-center m-0"><?= date('F Y', strtotime("$year-$month-01")) ?></h4>

        <!-- Botón para ir al mes siguiente -->
        <a href="<?= base_url("/calendario?year=$nextYear&month=$nextMonth") ?>" class="btn btn-primary">Mes siguiente &raquo;</a>
    </div>

    <!-- ======================== Botones de Acción ======================== -->

    <div class="text-center mb-4">
        <!-- Enlace para añadir nuevo evento -->
        <a href="<?= base_url("/formulario") ?>" class="btn btn-success">Añadir Evento</a>

        <!-- Enlace para ver el calendario del usuario -->
        <a href="<?= base_url("/calendarioUsuario") ?>" class="btn btn-secondary">Ver Calendario</a>
    </div>

    <!-- ======================== Tabla del Calendario ======================== -->

    <div class="table-responsive">
        <table class="table table-bordered calendar">
            <thead class="table-light">
                <tr>
                    <!-- Encabezado de los días de la semana -->
                    <?php foreach (['Lun','Mar','Mié','Jue','Vie','Sáb','Dom'] as $dow): ?>
                        <th><?= $dow ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>

            <tbody>
            <?php
                // Día de la semana en que inicia el mes (1=Lunes, ..., 7=Domingo)
                $firstWday = date('N', strtotime("$year-$month-01"));
                // Total de días del mes
                $daysInMonth = date('t', strtotime("$year-$month-01"));
                $day = 1; // Día actual a mostrar en la tabla
                // Itera por semanas (hasta 6 semanas en un mes calendario)
                for ($week = 0; $week < 6; $week++): ?>
                    <tr>  <?php
                    // Itera por días de la semana (Lun a Dom)
                    for ($dow = 1; $dow <= 7; $dow++): ?>
                        <td>
                        <?php  // Deja celdas vacías antes del primer día del mes
                            if ($week === 0 && $dow < $firstWday) {
                                echo '';
                            }  // Detiene al pasar el último día del mes
                            elseif ($day > $daysInMonth) {
                                echo '';
                            }  else {  // Formato de fecha YYYY-MM-DD
                                $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);                                
                                echo "<div class='day-number'>{$day}</div>";// Muestra número del día

                                // Muestra eventos del día si existen
                                if (isset($eventsByDay[$dateStr])) {
                                    foreach ($eventsByDay[$dateStr] as $ev) {
                                        $title = esc($ev['title']); // Título del evento
                                        $id = esc($ev['id']);       // ID del evento
                                        $url = base_url("/evento/{$id}"); // URL al detalle
                                        $class = "event-color-" . ($id % 10); // Clase de color                                       
                                        // Muestra el evento como enlace
                                        echo "<div class='event {$class}'><a href='{$url}' class='text-decoration-none text-dark'>{$title}</a></div>";
                                    }
                                }  $day++; // Avanza al siguiente día

                            }
                            
                        ?>    </td>
                    <?php endfor; ?>
                    </tr>  <?php
                    // Detiene el bucle si ya se mostraron todos los días del mes
                    if ($day > $daysInMonth) break;  ?>
                <?php endfor; ?>

            </tbody>
        </table>
    </div>
</div>

</body>
</html>
