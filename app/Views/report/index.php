<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<?php
use App\Services\ReportService;
$reportService = new ReportService();
?>
<div class ="container">
<center><h1>Отчет</h1></center>
<hr>
<form  method = "get" action = "<?= base_url(route_to('report.index')) ?>">
  <div class="form-inline">
	  <div class="form-group">
		<label for="startDate">Диапазон&nbsp;&nbsp;</label>
		<input type="date" name = "startDate" class="form-control" id="startDate"
		value='<?=(!empty($_SESSION['startDate'])) ? $_SESSION['startDate'] : "" ?>' required>
		<label for="endDate"></label>
		<input type="date" name = "endDate" class="form-control" id="endDate"
        value='<?=(!empty($_SESSION['endDate'])) ? $_SESSION['endDate'] : "" ?>' required>
	  </div>
  
	  <div class="form-group">
		<label for="users">&nbsp;&nbsp;Пользователь&nbsp;&nbsp;</label>
		<select class="form-control" name = "users[]" id="users" multiple="multiple">
			<?php foreach($managersInSettings as $us):?>
			<option value="<?=$us['ID']?>"
			<?=(!empty($_SESSION['users'])) && in_array($us['ID'], $_SESSION['users']) ? "selected" : "" ?>>
			<?=$us['NAME']?> <?=$us['LAST_NAME']?></option>
		    <?php endforeach ?>
		</select>
	  </div>
	  
	  <div class="form-group">
		<label for="allusers">&nbsp;&nbsp;Все пользователи&nbsp;&nbsp;</label>
	  <input type="checkbox" name="allusers" value = "1" id = "allusers" <?= !empty($_SESSION['userchecked']) ? "checked" : ''?>>
	  </div>
	</div><hr>
	<input type="submit" class="btn btn-primary mb-2" name = "submit" value = "Сформировать отчет">
</form>
<hr>
<h2>Отчет за период : <?= $startDate?> - <?= $endDate?></h2>
<table class="table table-bordered table-striped">
<thead>
<tr>
 <th scope="col" class="bg-info">Пользователь</th>
 <th scope="col" class="bg-primary">Создано сделок</th>
 <th scope="col" class="bg-primary">В работе</th>
 <th scope="col" class="bg-primary text-center" colspan = "2" >Провал</th>
 <th scope="col" class="bg-primary text-center" colspan = "2">Успех</th>
 <th scope="col" class="bg-primary">Сумма продаж</th>
</tr>
<tr>
<th scope="col"></th>
<th scope="col">Кол-во</th>
<th scope="col">Кол-во</th>
<th scope="col">Кол-во</th>
<th scope="col">Конверсия %</th>
<th scope="col">Кол-во</th>
<th scope="col">Конверсия %</th>
<th scope="col">Руб.</th>
</tr>
</thead>
<tbody>
<?php
    $totaltotalDeals = 0;
    $totaldealsInProgress = 0;
    $totallostDeals = 0;
    $totalwonDeals = 0;
    $totalsum = 0;	
?>
<?php foreach($users as $user):?>
<tr>
  <!-- Пользователь -->
	<td>
	<?php 
		echo $user['LAST_NAME'];
		echo " ";
		echo $user['NAME'];
	?>
	</td>
    <!-- -->
	
	<!-- Создано сделок -->
	<td>
	<?php
	    $totalDeals = $reportService->totalDeals($startDate, $endDate, $user['ID']);
		echo $totalDeals;
		$totaltotalDeals += $totalDeals;
	?>
	</td>
	<!-- -->
	
	<!-- -->
	<td>
	<?php
	    $dealsInProgress = $reportService->dealsInProgress($startDate, $endDate, $user['ID']);
		echo $dealsInProgress;
        $totaldealsInProgress += $dealsInProgress;		
	?>
	</td>
	<!-- -->
	
	<!-- -->
	<td>
	<?php
	    $lostDeals = $reportService->lostDeals($startDate, $endDate, $user['ID']);
		echo $lostDeals; 
        $totallostDeals += $lostDeals;  		
	?>
	</td>
	<!-- -->
	
	<!-- -->
	<td>
	<?php
	      if($totalDeals === 0){
			echo "0%";}else{
				echo round(($lostDeals / $totalDeals) * 100, 2). "%";
				}
	?>
	</td>
	<!-- -->
	
	<!-- -->
	<td>
	<?php
        $wonDeals = $reportService->wonDeals($startDate, $endDate, $user['ID']);
		echo count($wonDeals);
        $totalwonDeals += count($wonDeals); 		
	?>
	</td>
	<!-- -->
	
	<!-- -->
	<td>
	<?php
	      if($totalDeals === 0){
			echo "0%";}else{
				echo round((count($wonDeals) / $totalDeals) * 100, 2). "%";
				}   
	?>
	</td>
	<!-- -->
	
	<!-- -->
	<td>
	<?php
	    $sum = 0;
		foreach($wonDeals as $sum1){
			$sum += $sum1['OPPORTUNITY'];
		}  
        echo $sum;
        $totalsum += $sum;	 		
	?>
	</td>
	<!-- -->
</tr>
<?php
    $sum = 0;
?>
<?php endforeach ?>
<tr>
<th class="bg-info">Итого</th>
<td><strong><?=$totaltotalDeals?></strong></td>
<td><strong><?=$totaldealsInProgress?></strong></td>
<td><strong><?=$totallostDeals?></strong></td>
<td><strong><?php
	      if($totaltotalDeals === 0){
			echo "0%";}else{
				echo round(($totallostDeals / $totaltotalDeals) * 100, 2). "%";
				}
	?></strong></td>
<td><strong><?=$totalwonDeals?></strong></td>
<td><strong><?php
	      if($totaltotalDeals === 0){
			echo "0%";}else{
				echo round(($totalwonDeals / $totaltotalDeals) * 100, 2). "%";
				}
	?></strong></td>
<td><strong><?=$totalsum?></strong></td>
</tr>
</tbody>
</table>
<script type="text/javascript">
    $(document).ready(function() {
        $('#users').multiselect();
    });
</script>
<?= $this->endSection() ?>