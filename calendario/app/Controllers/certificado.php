<?php

namespace App\Controllers;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\EventModel;
use App\Models\UserModel;
use CodeIgniter\Email\Email;
use App\Models\EventSubscriptionModel;

class Certificado extends BaseController
{
     public function generar($id)
        {
            $eventoModel = new \App\Models\EventModel();
            $evento = $eventoModel->find($id);

            if (!$evento) {
                return redirect()->to('/calendario')->with('error', 'Evento no encontrado.');
            }

            $session = session();
            $userId = $session->get('user_id');
            $nombreAsistente = $session->get('user_name');

            if (!$userId) {
                return redirect()->to('/login')->with('error', 'Debes iniciar sesión para generar el certificado.');
            }

            // Verificar si el usuario está suscrito
            $suscripcionModel = new \App\Models\EventSubscriptionModel();
            $suscripcion = $suscripcionModel
                            ->where('user_id', $userId)
                            ->where('event_id', $id)
                            ->first();

            if (!$suscripcion) {
                return redirect()->back()->with('error', 'devesaverte suscrito al evento para generar el certificado.');
            }

            // Generar el HTML del certificado
            $html = view('certificadopdf', [
                'evento'    => $evento,
                'asistente' => $nombreAsistente
            ]);

            $options = new \Dompdf\Options();
            $options->set('isHtml5ParserEnabled', true);
            $dompdf = new \Dompdf\Dompdf($options);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

            $dompdf->stream("certificado_{$evento['id']}.pdf", ["Attachment" => false]);
            exit;
        }

    public function suscribirse($evento_id)
    {
        $session = session();
        $userId = $session->get('user_id'); 
        $eventId = $this->request->getPost('event_id');

        $UserModel = new \App\Models\UserModel();
        $model = new \App\Models\EventSubscriptionModel();
        $EventModel = new \App\Models\EventModel();

        $evento = $EventModel->find($evento_id);
        if (!$evento) {
            return redirect()->back()->with('error', 'El evento no existe.');
        }
        // Usa la variable $UserModel correctamente aquí
        if ($UserModel->find($userId) === null) {
            return redirect()->back()->with('error', 'Usuario no válido');
        }
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión.');
        }
        if ($evento['estado'] !== 'por_comenzar') {
        return redirect()->back()->with('error', 'No puedes suscribirte a un evento que ya ha comenzado o ha finalizado.');
        }
        // Verifica si ya está suscrito
        if ($model->where('user_id', $userId)->where('event_id', $evento_id)->first()) {
            return redirect()->back()->with('info', 'Ustede ya estás suscrito a este evento.');
        }
        // Guardar la suscripción
        $model->insert([
            'user_id' => $userId,
            'event_id' => $evento_id,
            'registered_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success','Se ha suscrito correctamente al evento.');
    }

        public function enviarAviso($evento)
    {
        $email = \Config\Services::email();

        $email->setTo($evento['correo_usuario']);
        $email->setSubject('Recordatorio de evento');
        $email->setMessage("Hola, te recordamos que el evento <strong>{$evento['title']}</strong> comienza el <strong>{$evento['start']}</strong>.");

        if ($email->send()) {
            echo 'Correo enviado correctamente';
        } else {
            echo $email->printDebugger();
        }
    }

    public function verificarEventos()
    {
        $subs = (new EventSubscriptionModel())
    ->where('event_id', $evento['id'])
    ->findAll();

    foreach ($subs as $sub) {
        $user = (new \App\Models\UserModel())->find($sub['user_id']);
        if ($user) {
            // Lógica para enviar correo al $user['email']
            $this->enviarAviso([
                'title' => $evento['title'],
                'start' => $evento['start'],
                'correo_usuario' => $user['email']
            ]);
    }}}

}