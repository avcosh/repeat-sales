<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class ="container"><center>
<h1>Отслеживание даты</h1>
<hr>
<h2>Уже добавленные отслеживания</h2>
<p>
<hr>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col">Действие</th>
      <th scope="col">Сущность</th>
      <th scope="col">Набор логических операций</th>
      <th scope="col">Поле для отслеживания</th>
      <th scope="col">Удалить отслеживание</th>
	  <th scope="col">Редактировать отслеживание</th>
	</tr>
  </thead>
  <tbody>

  <?php foreach($clientData as $data):?>
    <tr>
	
	  <!-- Действие-->
      <td>
		<?php if($data->activity == 'bizproz'){
			echo "Бизнес-процесс";
		}elseif($data->activity == 'notify'){
			echo "Уведомление";
		}elseif($data->activity == 'task'){
			echo "задача";
		}
		?>
      </td>
	  <!-- -->
	  
	  <!-- Сущность -->
      <td>
		<?php if($data->entity_type == 'contact'){
			echo "Контакт";
		}elseif($data->entity_type == 'company'){
			echo "Компания";
		}
		?>
      </td>
	  <!-- -->
	  
	  <!-- Набор логических операций -->
      <td>
			<?php if($data->operation == '0 day'){
				echo "Равно";
			}elseif($data->operation == '-1 month'){
				echo "Месяц до даты";
			}elseif($data->operation == '-3 weeks'){
				echo "Три недели до даты";
			}elseif($data->operation == '-2 weeks'){
				echo "Две недели до даты";
			}elseif($data->operation == '-1 week'){
				echo "Неделя до даты";
			}elseif($data->operation == '-3 days'){
				echo "Три дня до даты";
			}elseif($data->operation == '-2 days'){
				echo "Два дня до даты";
			}elseif($data->operation == '-1 day'){
				echo "День до даты";
			}elseif($data->operation == '1 month'){
				echo "Месяц после даты";
			}elseif($data->operation == '2 weeks'){
				echo "Две недели после даты";
			}elseif($data->operation == '1 week'){
				echo "Неделя после даты";
			}elseif($data->operation == '3 days'){
				echo "Три дня после даты";
			}elseif($data->operation == '2 days'){
				echo "Два дня после даты";
			}elseif($data->operation == '1 day'){
				echo "День после даты";
			}
			?>
      </td>
	  <!-- -->
	  
	  <!-- Поле для отслеживания -->
      <td><?php getFieldForControl($data->id)?></td>
	  <!-- -->
	  
	  <!-- Удалить отслеживание -->
	  <td>
	      <a href = "<?= base_url(route_to('tracking.delete', $data->id))?>">
		     <button type="button" class="close" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
		  </a>
      </td>
	  <!-- -->
	  
	  <!-- Редактировать отслеживание -->
	  <td>
	    <p align="right">
	      <a href = "<?= base_url(route_to('tracking.edit', $data->id))?>">&#128273; </a>
		</p>
	  </td>
	  <!-- -->
	  
    </tr>
   <?php endforeach ?>

  </tbody>
</table>
</p>
<hr>

<p>
<a href = "<?= base_url(route_to('tracking.create'))?>" class = "btn btn-primary">ДОБАВИТЬ ОТСЛЕЖИВАНИЕ</a>
</p>
</center>
</div>
<?= $this->endSection() ?>

