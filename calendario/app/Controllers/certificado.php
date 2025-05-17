<?php

namespace App\Controllers;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\EventModel;

class Certificado extends BaseController
{
    public function generar($id)
    {
        // Instancia el modelo para acceder a los eventos en la base de datos
        $eventoModel = new EventModel();
        $evento = $eventoModel->find($id); // Busca el evento por ID
        // Si no se encuentra el evento, redirige con un mensaje de error
        if (!$evento) {
            return redirect()->to('/calendario')->with('error', 'Evento no encontrado.');
        }
        // Aquí puedes obtener el nombre del asistente dinámicamente si usas sesiones o autenticación
        $nombreAsistente = 'Juan Pérez'; // Nombre del asistente fijo (deberías cambiarlo por una variable real)
        // Genera el HTML del certificado desde una vista llamada 'certificado_pdf'
        $html = view('certificadopdf', [
            'evento'    => $evento,
            'asistente' => $nombreAsistente
        ]);

        // Configuración de Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true); // Permitir HTML5 en el renderizador
        $dompdf = new Dompdf($options); // Crea una instancia de Dompdf
        // Carga el HTML en el objeto Dompdf
        $dompdf->loadHtml($html);
        // Define el tamaño del papel y orientación del PDF
        $dompdf->setPaper('A4', 'landscape'); // Horizontal
        // Renderiza el HTML como PDF
        $dompdf->render();
        
        // Envía el PDF al navegador para visualizar (Attachment => false = mostrar en navegador)
        $dompdf->stream("certificado_{$evento['id']}.pdf", ["Attachment" => false]);
        exit; // Finaliza la ejecución para evitar contenido adicional
    }

}