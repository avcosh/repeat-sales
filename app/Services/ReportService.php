<?php
namespace App\Services;
use App\ThirdParty\Crest\Crest;

class ReportService
{
	// Количество новых сделок
	public function totalDeals($startDate, $endDate, $assignedById)
	{
		$result = CRest::call(
			'crm.deal.list',
			[
				'filter' => [
				    '>=DATE_CREATE' => $startDate.'T00:00:00+00:00', //Дата создания
					'<=DATE_CREATE' => $endDate.'T23:59:59+00:00', //Дата создания
					'ASSIGNED_BY_ID' => $assignedById, // Ответственный 
					'SOURCE_ID' => '5|TELEGRAM', //  Источник = Повторные продажи
					'CATEGORY_ID' => 10,  // Воронка
					],
				
			]
			); 
			if(isset($result['result']))
			{
			    return $result['total'];	
			}
			else
			{
				while(!isset($result['result'])){
					$result = CRest::call(
						'crm.deal.list',
						[
							'filter' => [
							    '>=DATE_CREATE' => $startDate.'T00:00:00+00:00', //Дата создания
								'<=DATE_CREATE' => $endDate.'T23:59:59+00:00', //Дата создания
								'ASSIGNED_BY_ID' => $assignedById, // Ответственный 
								'SOURCE_ID' => '5|TELEGRAM', //  Источник = Повторные продажи
								'CATEGORY_ID' => 10,  // Воронка
							
							],
							
						]
						);
				}
				return $result['total'];
	        }
	}
	
	
	// количество сделок в работе
	public function dealsInProgress($startDate, $endDate, $assignedById)
	{
		$result = CRest::call(
			'crm.deal.list',
			[
				'filter' => [
				    '>=DATE_CREATE' => $startDate.'T00:00:00+00:00', //Дата создания
					'<=DATE_CREATE' => $endDate.'T23:59:59+00:00', //Дата создания
					'ASSIGNED_BY_ID' => $assignedById, // Ответственный 
					'SOURCE_ID' => '5|TELEGRAM', //  Источник = Повторные продажи
					'CATEGORY_ID' => 10,  // Воронка
					'STAGE_ID' => ['C10:NEW', 'C10:PREPARATION', 'C10:PREPAYMENT_INVOIC', 'C10:EXECUTING', 'C10:FINAL_INVOICE'],
					],
				
			]
			); 
			if(isset($result['result']))
			{
			    return $result['total'];	
			}
			else
			{
				while(!isset($result['result'])){
					$result = CRest::call(
						'crm.deal.list',
						[
							'filter' => [
							    '>=DATE_CREATE' => $startDate.'T00:00:00+00:00', //Дата создания
								'<=DATE_CREATE' => $endDate.'T23:59:59+00:00', //Дата создания
								'ASSIGNED_BY_ID' => $assignedById, // Ответственный 
								'SOURCE_ID' => '5|TELEGRAM', //  Источник = Повторные продажи
								'CATEGORY_ID' => 10,  // Воронка
								'STAGE_ID' => ['C10:NEW', 'C10:PREPARATION', 'C10:PREPAYMENT_INVOIC', 'C10:EXECUTING', 'C10:FINAL_INVOICE'],
							
							],
							
						]
						);
				}
				return $result['total'];
	        }
	}
	
	
	// количество сделок в стадии провал
	public function lostDeals($startDate, $endDate, $assignedById)
	{
		$result = CRest::call(
			'crm.deal.list',
			[
				'filter' => [
				    '>=DATE_CREATE' => $startDate.'T00:00:00+00:00', //Дата создания
					'<=DATE_CREATE' => $endDate.'T23:59:59+00:00', //Дата создания
					'ASSIGNED_BY_ID' => $assignedById, // Ответственный 
					'SOURCE_ID' => '5|TELEGRAM', //  Источник = Повторные продажи
					'CATEGORY_ID' => 10,  // Воронка
					'STAGE_ID' => 'C10:LOSE',
					],
				
			]
			); 
			if(isset($result['result']))
			{
			    return $result['total'];	
			}
			else
			{
				while(!isset($result['result'])){
					$result = CRest::call(
						'crm.deal.list',
						[
							'filter' => [
							    '>=DATE_CREATE' => $startDate.'T00:00:00+00:00', //Дата создания
								'<=DATE_CREATE' => $endDate.'T23:59:59+00:00', //Дата создания
								'ASSIGNED_BY_ID' => $assignedById, // Ответственный 
								'SOURCE_ID' => '5|TELEGRAM', //  Источник = Повторные продажи
								'CATEGORY_ID' => 10,  // Воронка
								'STAGE_ID' => 'C10:LOSE',
							
							],
							
						]
						);
				}
				return $result['total'];
	        }
	}
	
	
	// Количество сделок в стадии успех
	public function wonDeals($startDate, $endDate, $assignedById)
	{
		
		$result = CRest::call(
				'crm.deal.list',
				[
					'filter' => [
						'>=DATE_CREATE' => $startDate.'T00:00:00+00:00', //Дата создания
						'<=DATE_CREATE' => $endDate.'T23:59:59+00:00', //Дата создания
						'ASSIGNED_BY_ID' => $assignedById, // Ответственный 
						'SOURCE_ID' => '5|TELEGRAM', //  Источник = Повторные продажи
						'CATEGORY_ID' => 10,  // Воронка
						'STAGE_ID' => 'C10:WON',
					],
							
				]
			); 
			if(isset($result['result']))
			{
			    $arRes = $result['result'];	
			}
			else
			{
				while(!isset($result['result'])){
					$result = CRest::call(
						'crm.deal.list',
						[
							'filter' => [
							    '>=DATE_CREATE' => $startDate.'T00:00:00+00:00', //Дата создания
								'<=DATE_CREATE' => $endDate.'T23:59:59+00:00', //Дата создания
								'ASSIGNED_BY_ID' => $assignedById, // Ответственный 
								'SOURCE_ID' => '5|TELEGRAM', //  Источник = Повторные продажи
								'CATEGORY_ID' => 10,  // Воронка
								'STAGE_ID' => 'C10:WON',
						],
							
						]
						);
				}
				$arRes = $result['result'];
	        }
			
		
		if($result['total'] > 50){
				$i = 50;
				while($i < $result['total']){
					$res_x = CRest::call(
						'crm.deal.list',
						[
							'filter' => [
							    '>=DATE_CREATE' => $startDate.'T00:00:00+00:00', //Дата создания
								'<=DATE_CREATE' => $endDate.'T23:59:59+00:00', //Дата создания
								'ASSIGNED_BY_ID' => $assignedById, // Ответственный 
								'SOURCE_ID' => '5|TELEGRAM', //  Источник = Повторные продажи
								'CATEGORY_ID' => 10,  // Воронка
								'STAGE_ID' => 'C10:WON',
						],
							'start' => $i
						]
			        );
					
					if(isset($res_x['result']))
					{
					    $arRes = array_merge($arRes, $res_x['result']);
		                $i = $i + 50; 	
					}else
					
					{
					    while(!isset($res_x['result'])){
							$res_x = CRest::call(
							'crm.deal.list',
							[
								'filter' => [
								    '>=DATE_CREATE' => $startDate.'T00:00:00+00:00', //Дата создания
									'<=DATE_CREATE' => $endDate.'T23:59:59+00:00', //Дата создания
									'ASSIGNED_BY_ID' => $assignedById, // Ответственный 
									'SOURCE_ID' => '5|TELEGRAM', //  Источник = Повторные продажи
									'CATEGORY_ID' => 10,  // Воронка
									'STAGE_ID' => 'C10:WON',
							    ],
								
							]
							);
				        }
						
						$arRes = array_merge($arRes, $res_x['result']);
		                $i = $i + 50;
						
					}
					
	                
				}
            }
		return $arRes;
	}



	
	
	
}