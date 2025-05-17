<?php
// Iniciar CodeIgniter para usar base de datos
require_once '../app/Config/Paths.php';
$paths = new Config\Paths();

// Cargar autoload de Composer y CodeIgniter
require_once rtrim($paths->systemDirectory, '\\/ ') . '/bootstrap.php';

$db = \Config\Database::connect();

// Datos a insertar
$data = [
    'title' => 'Evento de prueba',
    'start' => '2025-04-30 10:00:00',
    'end'   => '2025-04-30 12:00:00',
];

// Intentar insertarlo
$builder = $db->table('events');
$insert = $builder->insert($data);

if ($insert) {
    echo "✅ Evento insertado correctamente.";
} else {
    echo "❌ Error al insertar evento.";
}
?>
