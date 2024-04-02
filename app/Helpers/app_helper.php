<?php
use App\ThirdParty\Crest\Crest;
use App\Models\Clientdata;

    function getFieldForControl($id)
	{
	  $model = new ClientData();
	  $clientData = $model->find($id);
	  
	  if($clientData->entity_type == 'contact'){
		$method = 'crm.contact.fields';  
	  }elseif($clientData->entity_type == 'company'){
		  $method = 'crm.company.fields';
	  }
	  
	  $result = CRest::call(
       $method,
       []);
	   foreach($result['result'] as $res){
			if ($res['type'] == 'date' && isset($res['listLabel'])){
			  if($res['title'] == $clientData->field_for_control){
				echo $res['listLabel'];  
			  }
			 
			}
        }
	}
	
    function getFieldForControlWhenCreate($method)
	{
	  
	  $result = CRest::call(
       $method,
       []);
		foreach($result['result'] as $res){
			if ($res['type'] == 'date' && isset($res['listLabel'])) :?>
			    <option value="<?=$res['title']?>"><?=$res['listLabel']?></option>
			<?php endif?><?php
        }
    }
	
	function getBusinessProcessName($entity)
	{
	 
	    $result = CRest::call(
           'bizproc.workflow.template.list',
           [
		      'select' =>[
			  'ID', 
			  'ENTITY',
			  'NAME'
		      ],
			  'filter' => [
			    'ENTITY' => $entity
			   ]
		   ]);  
        foreach($result['result'] as $res):?>

			    <option value="<?=$res['ID'] ?>"> <?= $res['NAME'] ?> </option>
				
        <?php endforeach ?> <?php
        
	}
	
	function getDocumentFieldName($method)
	{
		$result = CRest::call(
        $method,
        []);
		
		foreach($result['result'] as $key => $value){
			if (isset($value['listLabel'])):?>
				<option value="<?=$value['title']?>"><?=$value['listLabel']?></option>
			<?php else:?>
		        <option value="<?=$key?>"><?=$value['title']?></option>
			<?php endif?><?php
		}
	}
	
	function getUsers()
	{
	 
	    $result = CRest::call(
           'user.get',
           []);  
        foreach($result['result'] as $res):?>

			    <option value="<?=$res['ID'] ?>"> <?= $res['NAME'] ?> <?= $res['LAST_NAME'] ?></option>
				
        <?php endforeach ?> <?php
        
		 
	   
	}