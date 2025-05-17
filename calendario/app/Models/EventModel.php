<?php namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
     // Nombre de la tabla en la base de datos que usará este modelo
     protected $table = 'events';

     // Llave primaria de la tabla (campo 'id')
     protected $primaryKey = 'id';
     
      // Lista de campos que se pueden insertar o actualizar en la base de datos
    protected $allowedFields = ['title', 'start', 'end','location',
    'permax','duration','presName','documento'];
       

}
