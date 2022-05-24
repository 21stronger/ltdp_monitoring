<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class View_activity_pica_model extends Model{

    protected $table = 'vw_activity_pica';
    protected $primaryKey   = 'id_pica';

    protected $allowedFields = [
        'picaDueDate', 
        'rootCause', 
        'capa', 
        'activityMonth'
    ];
}