<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Pica_model extends Model{

    protected $table        = 'tb_pica';
    protected $primaryKey   = 'id_pica';

    protected $allowedFields = [
        'id_pica', 
        'pica_due_date', 
        'root_cause', 
        'capa', 
        'id_monthly_activity'
    ];
}