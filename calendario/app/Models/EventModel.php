<?php namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
     // Nombre de la tabla en la base de datos que usará este modelo
     protected $table = 'eventos';

     // Llave primaria de la tabla (campo 'id')
     protected $primaryKey = 'id';
      // Campos que pueden ser insertados o actualizados
   protected $allowedFields = [
      'title', 'start', 'end', 'location',
      'permax', 'duration', 'presName', 'documento',
      'slug', 'descripcion', 'modalidad', 'tipo', 'estado',
      'creado_por', 'created_at', 'updated_at'
  ];
       

}
