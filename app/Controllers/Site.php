<?php
namespace App\Controllers;
use App\ThirdParty\Crest\Crest;
use App\Services\DataService;

class Site extends BaseController
{
    public function index()
    {
       	return view('site/index' , ['title' => "Сервис повторных продаж от CRM-Мастерской TSL"]);
    }
	
	public function install()
    {
        $result = CRest::installApp();
		if($result['rest_only'] === false):?>
			<head>
				<script src="//api.bitrix24.com/api/v1/"></script>
				<?php if($result['install'] == true):?>
					<script>
						BX24.init(function(){
							BX24.installFinish();
						});
					</script>
				<?php endif;?>
			</head>
			<body>
				<?php if($result['install'] == true):?>
					installation has been finished
				<?php else:?>
					installation error
				<?php endif;?>
			</body>
		<?php endif;
    }
	
	public function launch()
	{
        $service = new DataService();
		$service->run();
		
	}
	
	
	
}
