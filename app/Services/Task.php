<?php
namespace App\Services;
use App\ThirdParty\Crest\Crest;

class Task
{
	public $task_name;
	public $task_description;
	public $task_setter;
	public $responsible_for_task;
	public $task_deadline;
    public $code;
	public $entityId;
	public $entity_type;
	
	
	public function __construct($task_name, $task_description, $task_setter, $responsible_for_task, $task_deadline,
	$code, $entityId, $entity_type
	)
	{
	    $this->task_name = $task_name; 
        $this->task_description = $task_description; 
        $this->task_setter = $task_setter;
        $this->responsible_for_task = $responsible_for_task;
        $this->task_deadline = $task_deadline;
        $this->code = $code;
		$this->entityId = $entityId;
		$this->entity_type = $entity_type;
		
	}
	
	public function run( )
	{

        $result = CRest::call(
       'tasks.task.add',
       [
        'fields' =>[
          'TITLE' => $this->getText($this->task_name), 
          'DESCRIPTION' => $this->getText($this->task_description), 
          'CREATED_BY' => $this->getResponsibleForTask($this->task_setter, $this->entity_type, $this->entityId),
		  'RESPONSIBLE_ID' => $this->getResponsibleForTask($this->responsible_for_task, $this->entity_type, $this->entityId),
          'DEADLINE' => $this->getDeadline($this->task_deadline),
          'UF_CRM_TASK'  => [$this->code . $this->entityId]

        ]
        ]);
		
		if($result){
            echo "Задача поставлена"; 
		}else{
            echo "Ошибка"; 
		}
	}
	
	private function getText($text) 
	{
		$array = explode(' ', $text);
		$result = '';
		if ($array) {
			foreach($array as $field_for_control){
				if($this->isSystemField($this->entity_type, $field_for_control)){ 
                    if(is_array($this->getUserfield($this->entity_type, $this->entityId, $field_for_control))){
						$res = $this->getUserfield($this->entity_type, $this->entityId, $field_for_control);
		                $result .= $res[0]['VALUE'] . " ";
					} else{
						if($this->isDateField($this->entity_type, $field_for_control)){
					    $result .= date('d.m.Y', strtotime(substr($this->getUserfield($this->entity_type, $this->entityId, $field_for_control) , 0, 10))) . " ";
					}else{
			        $result .= $this->getUserfield($this->entity_type, $this->entityId, $field_for_control) . " " ;
					    }
					}
                }else	{
					$result .= $field_for_control . " ";
				}   
			} 
		}
		return $result;
	}
	
	private function getUserfield($entity_type, $id, $field_for_control)
	{
	 
		if($entity_type == "contact"){
		$result = CRest::call(
       'crm.contact.list',
       [

           'order' =>[
		   'SORT' => 'ASC'
		   ],
           'filter' =>[
		   'ID' => $id
		   ],
          'select' => [
		   $field_for_control
		   ]

			]);
			}elseif($entity_type == "company"){
				$result = CRest::call(
			   'crm.company.list',
			   [

				   'order' =>[
				   'SORT' => 'ASC'
				   ],
				   'filter' =>[
				   'ID' => $id
				   ],
				  'select' => [
				   $field_for_control
				   ]

					]);
			}
	
		
		return $result['result'][0][$field_for_control] ?? " " ;
		
	}
	
	private function isSystemField($entity_type, $field_for_control)
	{
		if($entity_type == 'contact'){
		$method = 'crm.contact.fields';  
	    }elseif($entity_type == 'company'){
		  $method = 'crm.company.fields';
	    }
		
		$result = CRest::call(
        $method,
        []);
			 
		if(isset($result['result'][$field_for_control])){
				return true; 
		} 
			else{ 
				return false;
			}
	}
	
	private function isDateField($entity_type, $field_for_control)
	{
	    if($entity_type == 'contact'){
		$method = 'crm.contact.fields';  
	    }elseif($entity_type == 'company'){
		  $method = 'crm.company.fields';
	    }
        
		$result = CRest::call(
           $method,
           []);
		   
			if($result['result'][$field_for_control]["type"] == "date"){
				return true;
				
			}else{ 
				return false;
			}
		
	}
	
	private function getDeadline($task_deadline) 
	{
	 
	 return date("Y-m-d", time()+(60*60*24*$task_deadline)) . 'T' . date("H:i:s", time()+(60*60*24*$task_deadline)) . '+03:00'; 
	 	
	}
	
	private function getResponsibleForTask($responsible_for_task, $entity_type, $entityId)
	{
	    if($responsible_for_task === NULL){
			if($entity_type == 'contact'){
			$method = 'crm.contact.list';  
		  }elseif($entity_type == 'company'){
			  $method = 'crm.company.list';
		  }
			$result = CRest::call(
				$method,
			   [

				   'order' =>[
				   'SORT' => 'ASC'
				   ],
				   'filter' =>[
				   'ID' => $entityId
				   ],
				  'select' => [
				   'ASSIGNED_BY_ID'
				   ]

					]);
		   return $result['result'][0]['ASSIGNED_BY_ID'];
        }else{
			return $responsible_for_task;
		}	   
	}
	
	
	
}