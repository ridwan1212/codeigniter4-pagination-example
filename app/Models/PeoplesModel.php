<?php

namespace App\Models;

use CodeIgniter\Model;

class PeoplesModel extends Model
{
  // your table
  protected $table = 'peoples';
  // primary key
  protected $primaryKey = 'id';
  // table fields
  protected $allowedFields = ['name', 'address', 'created_at', 'updated_at'];
}
