<?php
namespace App\Controllers;
use App\Services\UserService;
//use App\Services\DataService;
//use App\Models\Clientdata;
//use App\ThirdParty\Crest\Crest;

class Report extends BaseController
{
   
	public function index()
    {
		session_start();
		
		$startDate = '';
		$endDate = '';
		$users = [];
		$userService = new UserService();
		$managersInSettings = $userService->getAllUsers();
		 
		if(isset($_GET['submit'])){
		    $startDate = strip_tags(htmlspecialchars(trim($_GET['startDate']))); 
			$endDate = strip_tags(htmlspecialchars(trim($_GET['endDate'])));
			$_SESSION['startDate'] = $startDate;
            $_SESSION['endDate'] = $endDate;
			
		    if(!empty($_GET['users'])){
				$users = $_GET['users'];
				$_SESSION['users'] = $_GET['users'];
				$_SESSION['userchecked'] = [];
			}
			if(!empty($_GET['allusers'])){
		    $users = $userService->getAllUsers();
            $_SESSION['users'] = [];
            $_SESSION['userchecked'] = 'yes';			
	       }else{
			   $users = $userService->getUsers($users);
		   }
		}
        return view('report/index', [
		    'title' => "Отчет",
			'startDate'  => $startDate,
			'endDate'   => $endDate,
			'managersInSettings'  => $managersInSettings,
			'users'  => $users,
		]);
	}
	
}
