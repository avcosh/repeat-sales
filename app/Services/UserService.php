<?php
namespace App\Services;
use App\ThirdParty\Crest\Crest;

class UserService
{
	
	public function getUsers($users = [])
	{
	    $result = CRest::call(
           'user.get',
           [
		       'filter' =>[
		           'ACTIVE' => true,
				   'ID' => $users
		       ],
		   ]);
        if(isset($result['result'])){
			return $result['result'];    
		   }
        while(!isset($result['result'])){
			$result = CRest::call(
			   'user.get',
			   [
				   'filter' =>[
					   'ACTIVE' => true,
					   'ID' => $users
				   ],
			   ]);
			
		}		   
 		return $result['result'];    
		   	
	}
	
	public function getAllUsers()
	{
	    $result = CRest::call(
           'user.get',
           [
		       'filter' =>[
		           'ACTIVE' => true,
				],
		   ]); 
		if(isset($result['result'])){
			return $result['result'];    
		   }
        while(!isset($result['result'])){
			$result = CRest::call(
           'user.get',
           [
		       'filter' =>[
		           'ACTIVE' => true,
				],
		   ]);
		 }
        return $result['result']; 		 
	}
	
}