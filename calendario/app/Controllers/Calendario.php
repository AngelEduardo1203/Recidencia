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
                    // Si es el primer día del evento, conservar la hora real de inicio
                    $eventoDiario['start'] = $start->format('Y-m-d H:i:s');
                } else {
                    // Si no, establecer el inicio como comienzo del día
                    $eventoDiario['start'] = $dateStr . ' 00:00:00';
                }
                // Ajustar la hora de fin del evento para ese día
                if ($dateStr === $end->format('Y-m-d')) {
                    // Si es el último día del evento, conservar la hora real de fin
                    $eventoDiario['end'] = $end->format('Y-m-d H:i:s');
                } else {
                    // Si no, establecer el fin como final del día
                    $eventoDiario['end'] = $dateStr . ' 23:59:59';
                }
                // Añadir el evento al arreglo correspondiente a ese día
                $eventsByDay[$dateStr][] = $eventoDiario;
                // Avanzar al siguiente día
                $startDate->modify('+1 day');
            }        }
            
        // Preparar los datos que se pasarán a la vista
        $data = [
            'year'         => $year,        // Año actual o recibido por GET
            'month'        => $month,       // Mes actual o recibido por GET
            'eventsByDay'  => $eventsByDay, // Eventos organizados por día
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
                    // Si es el primer día del evento, conservar la hora real de inicio
                    $eventoDiario['start'] = $start->format('Y-m-d H:i:s');
                } else {
                    // Si no, establecer el inicio como comienzo del día
                    $eventoDiario['start'] = $dateStr . ' 00:00:00';
                }

                // Ajustar la hora de fin del evento para ese día
                if ($dateStr === $end->format('Y-m-d')) {
                    // Si es el último día del evento, conservar la hora real de fin
                    $eventoDiario['end'] = $end->format('Y-m-d H:i:s');
                } else {
                    // Si no, establecer el fin como final del día
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
            'year'         => $year,        // Año actual o recibido por GET
            'month'        => $month,       // Mes actual o recibido por GET
            'eventsByDay'  => $eventsByDay, // Eventos organizados por día
        ];

        // Cargar la vista del calendario y pasarle los datos
        echo view('calendarUsuario', $data);
    }

    public function formulario(){
        // Cargar el formulario para crear un evento
        return view('addEvent');
    }
     public function guardar()
    {
        // Crear una instancia del modelo de eventos
        $model = new \App\Models\EventModel();
        // Obtener el archivo subido desde el formulario (input name="documento")
        $file = $this->request->getFile('documento');
        $rutaDocumento = null; // Inicializa la variable para la ruta del documento
        // Verificar si el archivo fue subido correctamente
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Generar un nombre aleatorio para evitar conflictos de nombre
            $newName = $file->getRandomName();
            // Mover el archivo a la carpeta 'writable/uploads/eventos'
            $file->move(WRITEPATH . 'uploads/eventos', $newName);
            // Guardar la ruta relativa del archivo para almacenarla en la base de datos
            $rutaDocumento = 'uploads/eventos/' . $newName;
        }

        // Convertir las fechas y horas de inicio y fin a objetos DateTime
        $startTime = new \DateTime($this->request->getPost('start'));
        $endTime = new \DateTime($this->request->getPost('end'));
        // Extraer solo la hora para calcular la duración
        $startHour = \DateTime::createFromFormat('H:i:s', $startTime->format('H:i:s'));
        $endHour = \DateTime::createFromFormat('H:i:s', $endTime->format('H:i:s'));
        // Calcular la diferencia de tiempo entre el inicio y el fin
        $interval = $startHour->diff($endHour);
        $duration = $interval->format('%H:%I:%S'); // Resultado en formato horas:minutos:
            
        // Preparar los datos para insertar en la base de datos
        $data = [
            'title'     => $this->request->getPost('title'),                       // Título del evento
            'start'     => $startTime->format('Y-m-d H:i:s'),                      // Fecha y hora de inicio
            'end'       => $endTime->format('Y-m-d H:i:s'),                        // Fecha y hora de fin
            'location'  => $this->request->getPost('location'),                   // Lugar del evento
            'permax'    => $this->request->getPost('permax'),                     // Número máximo de personas
            'duration'  => $duration,                                             // Duración calculada
            'presName'  => $this->request->getPost('presName'),                  // Nombre del ponente
            'documento' => $rutaDocumento,                                       // Ruta del archivo subido
        ];
        // Insertar los datos en la base de datos
        $insertado = $model->insert($data);
        // Si hubo error en la inserción, mostrar detalles
        if ($insertado === false) {
            echo "Error al insertar<br>";
            print_r($model->errors()); // Muestra los errores de validación del modelo
        }
        // Redirigir al calendario con un mensaje de éxito
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
        // Si no existe, mostrar error 404
        if (!$evento) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Evento no encontrado");
        }


        // Procesar archivo subido, si hay uno nuevo
        $file = $this->request->getFile('documento');
        $rutaDocumento = $evento['documento']; // Mantener la ruta anterior por defecto
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Generar un nuevo nombre aleatorio y mover el archivo
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/eventos', $newName);
            $rutaDocumento = 'uploads/eventos/' . $newName;
        }

        // Convertir fechas de inicio y fin a objetos DateTime
        $startTime = new \DateTime($this->request->getPost('start'));
        $endTime = new \DateTime($this->request->getPost('end'));
        // Calcular la duración en formato horas:minutos:segundos
        $startHour = \DateTime::createFromFormat('H:i:s', $startTime->format('H:i:s'));
        $endHour = \DateTime::createFromFormat('H:i:s', $endTime->format('H:i:s'));
        $interval = $startHour->diff($endHour);
        $duration = $interval->format('%H:%I:%S');

        // Preparar los datos actualizados
        $data = [
            'title'     => $this->request->getPost('title'),
            'start'     => $this->request->getPost('start'),
            'end'       => $this->request->getPost('end'),
            'location'  => $this->request->getPost('location'),
            'permax'    => $this->request->getPost('permax'),
            'duration'  => $duration,
            'presName'  => $this->request->getPost('presName'),
            'documento' => $rutaDocumento,
        ];
        // Actualizar el evento en la base de datos
        $eventModel->update($id, $data);
        // Redirigir al calendario
        return redirect()->to('calendario');
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
