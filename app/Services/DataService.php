<?php
namespace App\Services;
use App\Models\Clientdata;
use App\Services\Task;
use App\Services\Bizproz;
use App\Services\Notify;
use App\ThirdParty\Crest\Crest;

set_time_limit(500);

class DataService
{
    public $activity;
    public $task;
    public $bizproz;
    public $notify;


    public function run()
	{  
	
	   $model = new Clientdata(); 
	   $data = $model->findAll(); // Получаем все отслеживания клиента

	// Запускаем цикл перебора отслеживаний клиента
	  foreach($data as $clientdata){
		
		$IdList = $this->getIdList($clientdata->entity_type); // получаем массив ID выбранных сущностей (контакты или компании)
		
		//запускаем внутренний цикл перебора ID выбранных сущностей 
		foreach($IdList as $list) {
			
			$field = $this->getUserfield($clientdata->entity_type, $list['ID'], $clientdata->field_for_control); // получаем значение нужного нам поля
			
			//Если значение поля совпадает с заданной логикой отслеживания - то запускаем нужное действие
			if($this->getlaunch($field, $clientdata->operation)){  
			
				if($clientdata->activity == 'task'){
					
					
					if($clientdata->entity_type == "contact"){
					    $code = 'C_';	
					} elseif($clientdata->entity_type == "company"){
					    $code = 'CO_';	
					}
					
					$task = new Task($clientdata->task_name,
					$clientdata->task_description,
					$clientdata->task_setter,
					$clientdata->responsible_for_task,
					$clientdata->task_deadline,
		            $code,
					$list['ID'],
					$clientdata->entity_type
					
					);  
					$task->run();
					
				}elseif($clientdata->activity == 'notify'){
					$notify = new Notify($clientdata->notification_recipient, $clientdata->notification_text, $clientdata->entity_type,
					                     $list['ID'] );
					$notify->run();
					
				}elseif($clientdata->activity == 'bizproz'){
					
					if($clientdata->entity_type == "contact"){
					    $code = 'CCrmDocumentContact';
						
						
					} elseif($clientdata->entity_type == "company"){
					    $code = 'CCrmDocumentCompany';
                        					
					}
					
					$bizproz = new Bizproz($clientdata->business_process_id, $list['ID'], $code);
					$bizproz->run();
				}
			}
		}
			
				
	  }

	}	  
		/*
		* Вспомогательный метод - возвращает массив ID сущностей
        */		
		  
		private function getIdList($entity_type)
		{
			
		if($entity_type == "contact"){
		$result = CRest::call(
       'crm.contact.list',
       [
        'select' => [
		  "id"
		   ]

        ]);
		}elseif($entity_type == "company"){
			
			$result = CRest::call(
           'crm.company.list',
           [
            'select' => [
		    "id"
		   ]

        ]);
		}
		
		return $result['result'];
		}

		
	/*
	*  Вспомогательны Метод получает на вход значение поля для контроля и логическую операцию
	*  неделя- месяц...
	*  Вычисляет и сравнивает с текущей датой, если совпадает - то возвращает true 
	*/
	
	private function getlaunch($field, $operation )
	{
        if(empty($field))return false;
        $fielddate = date_create($field); 
		$datelaunch =  date_modify($fielddate, $operation);
		
		return date("d.m.y") === date_format($datelaunch, 'd.m.y');
	}	




    /*Метод возвращает значение отслеживаемого поля
	*
	*/
	
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
	
		
		return $result['result'][0][$field_for_control];
	}
	
}