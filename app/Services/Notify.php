<?php
namespace App\Services;
use App\ThirdParty\Crest\Crest;

class Notify
{
	public $notification_recipient;
	public $notification_text;
	public $entity_type;
    public $entityId;
	
	public function __construct($notification_recipient, $notification_text, $entity_type, $entityId )
	{
		$this->notification_recipient = $notification_recipient;
		$this->notification_text = $notification_text;
		$this->entity_type = $entity_type;
		$this->entityId = $entityId;
		
	}
	
	public function run()
	{
		
       $result = CRest::call(
       'im.notify.personal.add', // im.notify.personal.add
       [
       
		  'USER_ID' => $this->notification_recipient,
          'MESSAGE' => $this->getText($this->notification_text)
        ]); 
		if($result){
            echo "Уведомление отправлено";
		}else{
            echo "Ошибка";
        }
	}
	
	private function getText($text) // Продлить контакт BRANDPOL LAST_NAME BIRTHDATE UF_CRM_167885154
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
}