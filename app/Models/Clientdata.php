<?php

namespace App\Models;

use CodeIgniter\Model;

class Clientdata extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'clientdata';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'entity_type', 'field_for_control', 'operation', 'activity',
	                               'task_name', 'task_description', 'task_setter', 'responsible_for_task',
								   'task_deadline', 'notification_recipient', 'notification_text', 'business_process_id'
								  ];
}
