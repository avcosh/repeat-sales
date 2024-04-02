<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class ="container"><center>
<h1>Редактирование</h1>
<hr>
<p>
<hr>
<form  method = "post" action = "<?= base_url(route_to('tracking.update', $clientData->id)) ?>">
<div class="form-inline">
  <div class="form-group">
    <label for="operation">Набор логических операций</label>
	  <select class="form-control" name = "operation" id="operation" value = "<?=$clientData->operation?>">
	    <option value="0 day" <?=$clientData->operation == '0 day'? "selected" : "" ?>>Равно</option>
		<option value="-1 month" <?=$clientData->operation == '-1 month'? "selected" : "" ?>>Месяц до даты</option>
		<option value="-3 weeks" <?=$clientData->operation == '-3 weeks'? "selected" : "" ?>>Три недели до даты</option>
	    <option value="-2 weeks" <?=$clientData->operation == '-2 weeks'? "selected" : "" ?>>Две недели до даты</option>
	    <option value="-1 week" <?=$clientData->operation == '-1 week'? "selected" : "" ?>>Неделя до даты</option>
		<option value="-3 days" <?=$clientData->operation == '-3 days'? "selected" : "" ?>>Три дня до даты</option>
		<option value="-2 days" <?=$clientData->operation == '-2 days'? "selected" : "" ?>>Два дня до даты</option>
		<option value="-1 day" <?=$clientData->operation == '-1 day'? "selected" : "" ?>>День до даты</option>
        <option value="1 month" <?=$clientData->operation == '1 month'? "selected" : "" ?>>Месяц после даты</option>
		<option value="2 weeks" <?=$clientData->operation == '2 weeks'? "selected" : "" ?>>Две недели после даты</option>
		<option value="1 week" <?=$clientData->operation == '1 week'? "selected" : "" ?>>Неделя после даты</option>
		<option value="3 days" <?=$clientData->operation == '3 days'? "selected" : "" ?>>Три дня после даты</option>
		<option value="2 days" <?=$clientData->operation == '2 days'? "selected" : "" ?>>Два дня после даты</option>
		<option value="1 day" <?=$clientData->operation == '1 day'? "selected" : "" ?>>День после даты</option>
	  </select>
	  
  </div>
</div>
<hr>
<div class="form-inline">
  <div class="form-group">
    <input type="submit" class="btn btn-primary mb-2" name = "submit" value = "Сохранить изменения">
  </div>
</div>
</form>
</p>
</center>
</div>
<?= $this->endSection() ?>

