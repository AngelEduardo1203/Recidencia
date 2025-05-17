<?php

namespace App\Controllers;
use App\Models\EventModel;

class Test extends BaseController
{
    public function insert()
    {
        $model = new EventModel();

        $data = [
            'title' => 'Evento de prueba',
            'start' => '2025-04-28 10:00:00',
            'end'   => '2025-04-28 12:00:00',
        ];

        if ($model->insert($data)) {
            return '✅ Evento insertado con éxito';
        } else {
            return '❌ Error al insertar evento';
        }
    }
}
