<?php namespace App\Controllers;

use App\Models\EventModel;
use CodeIgniter\Controller;

class Calendario extends Controller
{
    public function index()
    {
    // Obtener el año y mes desde la URL (por método GET)
    $year  = $this->request->getVar('year') ?? date('Y');
    $month = $this->request->getVar('month') ?? date('n');

    // Crear una instancia del modelo de eventos
    $model = new \App\Models\EventModel();

    // Obtener todos los eventos almacenados en la base de datos
    $eventos = $model->findAll();

    // Inicializar el arreglo que almacenará eventos organizados por día
    $eventsByDay = [];

    // Recorrer todos los eventos obtenidos
    foreach ($eventos as $ev) {
        // Crear objetos DateTime para el inicio y fin del evento
        $start = new \DateTime($ev['start']);
        $end = new \DateTime($ev['end']);

        // Clonar las fechas para recorrer desde el inicio hasta el fin
        $startDate = clone $start;
        $endDate = clone $end;

        // Repetir hasta cubrir todos los días entre start y end
        while ($startDate->format('Y-m-d') <= $endDate->format('Y-m-d')) {
            // Convertir la fecha actual del bucle en string (solo fecha)
            $dateStr = $startDate->format('Y-m-d');

            // Copiar los datos del evento para el día específico
            $eventoDiario = $ev;

            // Ajustar la hora de inicio del evento para ese día
            if ($dateStr === $start->format('Y-m-d')) {
                $eventoDiario['start'] = $start->format('Y-m-d H:i:s');
            } else {
                $eventoDiario['start'] = $dateStr . ' 00:00:00';
            }

            // Ajustar la hora de fin del evento para ese día
            if ($dateStr === $end->format('Y-m-d')) {
                $eventoDiario['end'] = $end->format('Y-m-d H:i:s');
            } else {
                $eventoDiario['end'] = $dateStr . ' 23:59:59';
            }

            // Añadir el evento al arreglo correspondiente a ese día
            $eventsByDay[$dateStr][] = $eventoDiario;

            // Avanzar al siguiente día
            $startDate->modify('+1 day');
        }
        }

        // Preparar los datos que se pasarán a la vista
        $data = [
            'year'         => $year,
            'month'        => $month,
            'eventsByDay'  => $eventsByDay,
        ];

        // Cargar la vista del calendario y pasarle los datos
        echo view('calendar', $data);
    }


    public function indexUsuario()
        {
    // Obtener el año y mes desde la URL (por método GET)
    $year  = $this->request->getVar('year') ?? date('Y');
    $month = $this->request->getVar('month') ?? date('n');

    // Crear una instancia del modelo de eventos
    $model = new \App\Models\EventModel();

    // Obtener todos los eventos almacenados en la base de datos
    $eventos = $model->findAll();

    // Inicializar el arreglo que almacenará eventos organizados por día
    $eventsByDay = [];

    // Recorrer todos los eventos obtenidos
    foreach ($eventos as $ev) {
        // Crear objetos DateTime para el inicio y fin del evento
        $start = new \DateTime($ev['start']);
        $end = new \DateTime($ev['end']);

        // Clonar las fechas para recorrer desde el inicio hasta el fin
        $startDate = clone $start;
        $endDate = clone $end;

        // Repetir hasta cubrir todos los días entre start y end
        while ($startDate->format('Y-m-d') <= $endDate->format('Y-m-d')) {
            // Convertir la fecha actual del bucle en string (solo fecha)
            $dateStr = $startDate->format('Y-m-d');

            // Copiar los datos del evento para el día específico
            $eventoDiario = $ev;

            // Ajustar la hora de inicio del evento para ese día
            if ($dateStr === $start->format('Y-m-d')) {
                $eventoDiario['start'] = $start->format('Y-m-d H:i:s');
            } else {
                $eventoDiario['start'] = $dateStr . ' 00:00:00';
            }

            // Ajustar la hora de fin del evento para ese día
            if ($dateStr === $end->format('Y-m-d')) {
                $eventoDiario['end'] = $end->format('Y-m-d H:i:s');
            } else {
                $eventoDiario['end'] = $dateStr . ' 23:59:59';
            }

            // Añadir el evento al arreglo correspondiente a ese día
            $eventsByDay[$dateStr][] = $eventoDiario;

            // Avanzar al siguiente día
            $startDate->modify('+1 day');
        }
        }

        // Preparar los datos que se pasarán a la vista
        $data = [
            'year'         => $year,
            'month'        => $month,
            'eventsByDay'  => $eventsByDay,
        ];

        echo view('calendarUsuario', $data);
    }

    public function formulario(){
        // Cargar el formulario para crear un evento
        return view('addEvent');
    }
     public function guardar()
    {
        $model = new \App\Models\EventModel();

        // Obtener fechas y calcular duración
        $startTime = new \DateTime($this->request->getPost('start'));
        $endTime   = new \DateTime($this->request->getPost('end'));

        $interval = $startTime->diff($endTime);
        $duration = $interval->format('%H:%I:%S');

        // Manejar archivo subido
        $file = $this->request->getFile('documento');
        $rutaDocumento = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/eventos', $newName);
            $rutaDocumento = 'uploads/eventos/' . $newName;
        }

        // Obtener fechas y calcular duración
        $startTime = new \DateTime($this->request->getPost('start'));
        $endTime = new \DateTime($this->request->getPost('end'));
        $startHour = \DateTime::createFromFormat('H:i:s', $startTime->format('H:i:s'));
        $endHour = \DateTime::createFromFormat('H:i:s', $endTime->format('H:i:s'));
        $interval = $startHour->diff($endHour);
        $duration = $interval->format('%H:%I:%S');

        // Preparar datos para insertar, con nombres coincidentes con la tabla `eventos`
        $data = [
            'title'        => $this->request->getPost('title'),
            'slug'         => url_title($this->request->getPost('title'), '-', true),
            'descripcion'  => $this->request->getPost('descripcion'),
            'start'        => $startTime->format('Y-m-d H:i:s'),
            'end'          => $endTime->format('Y-m-d H:i:s'),
            'location'     => $this->request->getPost('location'),
            'modalidad'    => $this->request->getPost('modalidad'),
            'tipo'         => $this->request->getPost('tipo'),
            'estado'       => 'por_comenzar', // o $this->request->getPost('estado') si quieres que venga del form
            'creado_por'   => session('user_id') ?? 1, // Por defecto 1 si no hay sesión
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
            'documento'    => $rutaDocumento,
            'permax'       => $this->request->getPost('permax'),
            'duration'     => $duration,
            'presName'     => $this->request->getPost('presName'),
        ];

        $insertado = $model->insert($data);

        if ($insertado === false) {
            echo "Error al insertar:<br>";
            print_r($model->errors());
            return;
        }

        return redirect()->to('calendario')->with('success', 'Evento guardado con éxito.');
    }
    
    public function detalle($id)
       {
        require_once ROOTPATH . 'vendor/autoload.php';
            // Crear una instancia del modelo EventModel
            $eventModel = new \App\Models\EventModel();
            // Buscar el evento por su ID
            $evento = $eventModel->find($id);
            // Si no se encuentra el evento, lanzar un error 404
            if (!$evento) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Evento no encontrado");
            }
            // Si el evento fue encontrado, cargar la vista 'eventoDetalle' y pasarle los datos del evento
            return view('eventoDetalle', ['evento' => $evento]);
        }

    public function detalleUsuario($id)
       {
        require_once ROOTPATH . 'vendor/autoload.php';
        // Crear una instancia del modelo EventModel
        $eventModel = new \App\Models\EventModel();
        // Buscar el evento por su ID
        $evento = $eventModel->find($id);
        // Si no se encuentra el evento, lanzar un error 404
        if (!$evento) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Evento no encontrado");
        }
        // Si el evento fue encontrado, cargar la vista 'eventoDetalleUsuario' y pasarle los datos del evento
        return view('eventoDetalleUsuario', ['evento' => $evento]);
    }

    public function editar($id)
    {
        $eventModel = new \App\Models\EventModel();
        // Buscar el evento por ID
        $evento = $eventModel->find($id);
        // Si no existe, mostrar error 404
        if (!$evento) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Evento no encontrado");
        }
        // Mostrar la vista 'editarEvento' y pasarle los datos del evento
        return view('editarEvento', ['evento' => $evento]);
    }

    public function actualizar($id)
    {
        $eventModel = new \App\Models\EventModel();

        // Buscar el evento por ID
        $evento = $eventModel->find($id);
        if (!$evento) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Evento no encontrado");
        }

        // Procesar archivo subido, si hay uno nuevo
        $file = $this->request->getFile('documento');
        $rutaDocumento = $evento['documento']; // Mantener ruta anterior por defecto

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/eventos', $newName);
            $rutaDocumento = 'uploads/eventos/' . $newName;
        }

        // Convertir fechas
        $startTime = new \DateTime($this->request->getPost('start'));
        $endTime = new \DateTime($this->request->getPost('end'));
        $startHour = \DateTime::createFromFormat('H:i:s', $startTime->format('H:i:s'));
        $endHour = \DateTime::createFromFormat('H:i:s', $endTime->format('H:i:s'));
        $interval = $startHour->diff($endHour);
        $duration = $interval->format('%H:%I:%S');

        // Preparar los datos actualizados (nombres según tabla)
        $data = [
            'title'        => $this->request->getPost('title'),
            'slug'         => url_title($this->request->getPost('title'), '-', true),
            'descripcion'  => $this->request->getPost('descripcion'),
            'start'        => $startTime->format('Y-m-d H:i:s'),
            'end'          => $endTime->format('Y-m-d H:i:s'),
            'location'     => $this->request->getPost('location'),
            'modalidad'    => $this->request->getPost('modalidad'),
            'tipo'         => $this->request->getPost('tipo'),
            'estado'       => $this->request->getPost('estado'),
            'updated_at'   => date('Y-m-d H:i:s'),
            'documento'    => $rutaDocumento,
            'permax'       => $this->request->getPost('permax'),
            'duration'     => $duration,
            'presName'     => $this->request->getPost('presName'),
        ];

        // Actualizar evento
        $eventModel->update($id, $data);

        // Redirigir con mensaje de éxito
        return redirect()->to('calendario')->with('success', 'Evento actualizado correctamente.');
    }


    public function eliminar($id)
    {
        $eventModel = new \App\Models\EventModel();
        // Buscar el evento por ID
        $evento = $eventModel->find($id);
        // Si no existe, lanzar error 404
        if (!$evento) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Evento no encontrado");
        }
        // Eliminar el evento de la base de datos
        $eventModel->delete($id);
        // Redirigir al calendario
        return redirect()->to('calendario');
    }


    public function ver($filename)
    {
        // Construye la ruta absoluta del archivo en la carpeta 'writable/uploads/eventos'
        $path = WRITEPATH . 'uploads/eventos/' . $filename;

        // Verifica si el archivo realmente existe
        if (file_exists($path)) {
            // Obtiene el tipo MIME del archivo (por ejemplo, 'application/pdf')
            $fileMimeType = mime_content_type($path);

            // Devuelve el archivo al navegador para verlo en línea (no descargar)
            return $this->response
                        ->setHeader('Content-Type', $fileMimeType) // Tipo del archivo
                        ->setHeader('Content-Disposition', 'inline; filename="' . basename($path) . '"') // Mostrar en línea
                        ->setBody(file_get_contents($path)); // Carga el contenido del archivo
        } else {
            // Si el archivo no existe, lanza un error 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
}
