<?php
namespace App\Controllers;
use App\Services\DataService;
use App\Models\Clientdata;
//use App\ThirdParty\Crest\Crest;

class Tracking extends BaseController
{
    public $clientdata;

    public function __construct()
    {
        $this->clientdata = new Clientdata();
    }
	
	public function index()
    {
		
        $clientData = $this->clientdata->findAll();
        helper('app');
		 
		return view('tracking/index', [
		    'title' => "Отслеживания",
		    'clientData' => $clientData,
			]);
	}
	
	public function create()
    {
        helper('app');
        return view('tracking/create', [
		    'title' => "Создание",
		   ]);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $this->clientdata->insert($data);
        return redirect('tracking.index');
    }
	
	
	public function edit($id)
	{
		$clientData = $this->clientdata->find($id);
		return view('tracking/edit', [
		    'title' => "Редактирование",
		    'clientData' => $clientData,
			]);
	}
	
	public function update($id)
    {
        $data = $this->request->getPost();
        $this->clientdata->update($id, $data);
        return redirect('tracking.index');
    }

	
	public function delete($id)
	{
		$this->clientdata->delete($id);
        return redirect('tracking.index');
	}
	
	public function ajax()
	{
	    helper('app');
		$method = $_GET['method'] ? : 'crm.contact.fields';

		getFieldForControlWhenCreate($method);	
	}
	
	public function ajax2()
	{
	    helper('app');
		$method = $_GET['method'] ? : 'crm.contact.fields';

		getBusinessProcessName($method);	
	}
	
	public function ajax3()
	{
	    helper('app');
		$method = $_GET['method'] ? : 'crm.contact.fields';

		getDocumentFieldName($method);	
	}

}
