<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calendario <?= $month ?>/<?= $year ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .calendar td {
            height: 120px;
            vertical-align: top;
            padding: 5px;
            border: 1px solid #dee2e6;
        }
        .calendar th {
            background-color: #f0f0f0;
            text-align: center;
        }
        .day-number {
            font-weight: bold;
        }
        .event {
            margin: 2px 0;
            padding: 2px 4px;
            border-radius: 4px;
            font-size: 0.9em;
            color: #000;
        }
        <?php for ($i = 0; $i < 10; $i++): ?>
        .event-color-<?= $i ?> { background: hsl(<?= $i * 36 ?>, 70%, 70%); }
        <?php endfor; ?>
    </style>
</head>
<body class="bg-light">
<div class="container mt-4">

    <!-- Navegación -->
    <?php
    $prev = strtotime("$year-$month-01 -1 month");
    $next = strtotime("$year-$month-01 +1 month");

    $prevYear = date('Y', $prev);
    $prevMonth = date('n', $prev);

    $nextYear = date('Y', $next);
    $nextMonth = date('n', $next);
    ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= base_url("/calendario?year=$prevYear&month=$prevMonth") ?>" class="btn btn-primary">&laquo; Mes anterior</a>
        <h4 class="text-center m-0"><?= date('F Y', strtotime("$year-$month-01")) ?></h4>
        <a href="<?= base_url("/calendario?year=$nextYear&month=$nextMonth") ?>" class="btn btn-primary">Mes siguiente &raquo;</a>
    </div>

    <!-- Tabla Calendario -->
    <div class="table-responsive">
        <table class="table table-bordered calendar">
            <thead class="table-light">
                <tr>
                    <?php foreach (['Lun','Mar','Mié','Jue','Vie','Sáb','Dom'] as $dow): ?>
                        <th><?= $dow ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
            <?php
                $firstWday = date('N', strtotime("$year-$month-01"));
                $daysInMonth = date('t', strtotime("$year-$month-01"));

                $day = 1;
                for ($week = 0; $week < 6; $week++): ?>
                    <tr>
                    <?php for ($dow = 1; $dow <= 7; $dow++): ?>
                        <td>
                        <?php
                            if ($week === 0 && $dow < $firstWday) {
                                echo '';
                            } elseif ($day > $daysInMonth) {
                                echo '';
                            } else {
                                $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                                echo "<div class='day-number'>{$day}</div>";
                                if (isset($eventsByDay[$dateStr])) {
                                    foreach ($eventsByDay[$dateStr] as $ev) {
                                        $title = esc($ev['title']); // Nuevo nombre de campo
                                        $id = esc($ev['id']);
                                        $url = base_url("usuario/evento/{$id}");
                                        $class = "event-color-" . ($id % 10);

                                        // Mostrar la hora de inicio y duración si deseas
                                        $hora = (new \DateTime($ev['start']))->format('H:i');
                                        $duracion = esc($ev['duration']);

                                        echo "<div class='event {$class}'>
                                                <a href='{$url}' class='text-decoration-none text-dark'>
                                                    <strong>{$title}</strong><br>
                                                    <small> Duración: {$duracion}</small>
                                                </a>
                                            </div>";
                                    }
                                }
                                $day++;
                            }
                        ?>
                        </td>
                    <?php endfor; ?>
                    </tr>
                    <?php if ($day > $daysInMonth) break; ?>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

