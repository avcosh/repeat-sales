<?php
namespace App\Services;
use App\ThirdParty\Crest\Crest;

class Bizproz
{
	public $business_process_id; //TEMPLATE_ID тот ID что в БД
	public $documentId;   // DOCUMENT_ID Идентификатор документа БП  = ID сущности контакта или компании
	public $code;
	
	
	public function __construct($business_process_id, $documentId, $code)
	{
		$this->business_process_id = $business_process_id;
		$this->documentId          = $documentId;
		$this->code               = $code;
		
	}
	
	public function run()
	{

    $result = CRest::call(
       'bizproc.workflow.start',
       [

          'TEMPLATE_ID' => $this->business_process_id,
		   'DOCUMENT_ID' => ['crm',  $this->code , $this->documentId],
           'PARAMETERS' => null
       ]);
        
        if($result){
            echo "БП запущен";
		}else{
            echo "Ошибка";
        }
	}
}