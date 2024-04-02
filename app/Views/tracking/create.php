<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<style>
form .hidden { display: none; important! }
form .visible { display: block; important! }
</style>
<div class ="container"><center>
<h1>Создание</h1>
<hr>
<p>
<form id="form" method = "post" action = "<?= base_url(route_to('tracking.store')) ?>">

<div class="form-inline">
  <div class="form-group">
    <label for="entity">Что отслеживаем (Контакт или Компания)&nbsp;&nbsp;</label>
	<select class="form-control" id="entity" name = "entity_type">
	  <option value="contact">Контакт</option>
	  <option value="company">Компания</option>
    </select>	
  </div>
</div>
<hr>
<div class="form-inline">
  <div class="form-group">
    <label for="answer">Поле для отслеживания &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
	  <select class="form-control" id = "answer" name = "field_for_control">
	    <?php getFieldForControlWhenCreate('crm.contact.fields')?>
	  </select>
  </div>
</div>
<hr>
<div class="form-inline">
  <div class="form-group">
    <label for="operation">Набор логических операций &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
	  <select class="form-control" id = "operation" name = "operation">
	    <option value="0 day">Равно</option>
	    <option value="-1 month">Месяц до даты</option>
	    <option value="-2 weeks">Две недели до даты</option>
		<option value="-3 weeks">Три недели до даты</option>
	    <option value="-1 week">Неделя до даты</option>
	    <option value="-3 days">Три дня до даты</option>
	    <option value="-2 days">Два дня до даты</option>
	    <option value="-1 day">День до даты</option>
        <option value="1 month">Месяц после даты</option>
	    <option value="2 weeks">Две недели после даты</option>
	    <option value="1 week">Неделя после даты</option>
	    <option value="3 days">Три дня после даты</option>
	    <option value="2 days">Два дня после даты</option>
	    <option value="1 day">День после даты</option>
	  </select>
  </div>
</div>
<hr>
<div class="box">
      <label><strong>Что делаем:</strong></label>
      <label>
        <input type="radio" name="activity" id="task" value="task" />
        Ставим задачу</label>
      <label>
        <input type="radio" name="activity" id="notify" value="notify" />
        Отсылаем уведомление</label>
      <label>
        <input type="radio" name="activity" id="bizproz" value="bizproz" />
        Запускаем бизнес-процесс</label>
    </div>
	<hr>
	
	
    <div class="box" data-show="task" data-hide="activity">
	
      <div class="col-md-12">
        <label for="validationCustom01" class="form-label">Название задачи</label>
        <input type="text" class="form-control" name ="task_name" value="" id = "task_name">  
      </div>
	  <br>
	  
		<!-- Кнопка-триггер модального окна -->
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
		  ......
		</button>
		<!-- Модальное окно -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Выберите поля документа</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
			  </div>
				<div class="modal-body">
					<select id = "taskfield">
					    <option value=""></option>
					    <?php getDocumentFieldName('crm.contact.fields');?>
					</select>
				</div>
			 <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Вставить</button>
			
			  </div>
			</div>
		  </div>
		</div>
		<!-- -->
	  <hr>
	  
	  
	  <div class="col-md-12">
        <label for="validationCustom01" class="form-label">Описание задачи</label>
        <input type="text" class="form-control" name ="task_description" value="" id = "task_description" >
      </div>
	  <br>
	  <!-- Кнопка-триггер модального окна -->
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
		  ......
		</button>
		<!-- Модальное окно -->
		<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel2">Выберите поля документа</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
			  </div>
				<div class="modal-body">
					<select id = "taskfield2">
					    <option value=""></option>
					    <?php getDocumentFieldName('crm.contact.fields');?>
					</select>
				</div>
			 <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Вставить</button>
				
			  </div>
			</div>
		  </div>
		</div>
		<!-- -->
	<hr>
	  
	  <div class="col-md-12">
        <label for="validationCustom02" class="form-label">Постановщик задачи &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <select class="form-select" aria-label="Default select example" name = "task_setter">
		   <option value="">Ответственный*</option>
           <?php getUsers();?>
	    </select>
       </div>
	   <hr>
	   <div class="col-md-12">
        <label for="validationCustom02" class="form-label">Ответственный за задачу</label>
        <select class="form-select" aria-label="Default select example" name = "responsible_for_task">
           <option value="">Ответственный*</option>
		   <?php getUsers();?>
	    </select>
       </div>
	   <hr>
	   
	   <div class="col-md-12">
        <label for="validationCustom01" class="form-label">Дедлайн задачи (Количество календарных дней с момента постановки задачи)</label>
       
		    <select class="form-select" aria-label="Default select example" name = "task_deadline">
			   <option value="1">1 день</option>
			   <option value="2">2 дня</option>
			   <option value="3">3 дня</option>
			   <option value="4">4 дня</option>
			   <option value="5">5 дней</option>
			   <option value="6">6 дней</option>
			   <option value="7">1 неделя</option>
			   <option value="8">8 дней</option>
			   <option value="9">9 дней</option>
			   <option value="10">10 дней</option>
			   <option value="14">2 недели</option>
		   </select>
       </div>
	</div>
	<hr>
	
	<div class="box" data-show="notify" data-hide="activity">
	
	
        <div class="col-md-12">
        <label for="validationCustom02" class="form-label">Получатель уведомления</label>
        <select class="form-select" aria-label="Default select example" name = "notification_recipient">
           <option value=""></option>
		   <?php getUsers();?>
	    </select>
       </div>
      
	   <hr>
       <div class="col-md-12">
        <label for="validationCustom01" class="form-label">Текст уведомления</label>
        <input type="text" class="form-control" name ="notification_text" value="" id = "notification_text" >
      </div>
      <br>
      <!-- Кнопка-триггер модального окна -->
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal3">
		  ......
		</button>
		<!-- Модальное окно -->
		<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel2">Выберите поля документа</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
			  </div>
				<div class="modal-body">
					<select id = "taskfield3">
					    <option value=""></option>
					    <?php getDocumentFieldName('crm.contact.fields');?>
					</select>
				</div>
			 <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Вставить</button>
				<!--<button type="button" class="btn btn-primary">Сохранить изменения</button>-->
			  </div>
			</div>
		  </div>
		</div>
		<!-- -->	  
        <hr>
    </div>
	
	
	
	<div class="box" data-show="bizproz" data-hide="activity">
     
      <div class="col-md-12">
        <label for="validationCustom02" class="form-label">Название Бизнес процесса</label>
        <select id = "answer2" class="form-select" aria-label="Default select example" name = "business_process_id">
           <option value=""></option>
		   <?php getBusinessProcessName('CCrmDocumentContact');?>
	       
	    </select>
       </div>
    </div>
	<hr>
	
<div class="form-inline">
  <div class="form-group">
    <input type="submit" class="btn btn-primary mb-2" name = "submit" value = "Создать">
  </div>
</div>
</form>
</p>
</center>
</div>
<script src="<?= base_url('js/jquery.formalist.js')?>"></script>
<script src="<?= base_url('js/bootstrap.js')?>"></script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>

<script>
$(function(){
  $('#form').formalist();
});
</script>

<script> 
    
	 $('#entity').on('change', function() {
     var res =  this.value;
	 if(res === 'contact'){
		var method = 'crm.contact.fields';
	 }else if(res === 'company'){
		var method = 'crm.company.fields';
	 }
	 $.ajax({
        url: "<?= base_url(route_to('tracking.ajax')) ?>",
		method: 'get',
        data : {'method':method},
        success: function(data){
        $('#answer').html(data);
           },
        });
    });

</script>

<script> 
    
	 $('#entity').on('change', function() {
     var res =  this.value;
	 if(res === 'contact'){
		var method = 'CCrmDocumentContact';
	 }else if(res === 'company'){
		var method = 'CCrmDocumentCompany';
	 }
	 $.ajax({
         url: "<?= base_url(route_to('tracking.ajax2')) ?>",
         method: 'get',
        // dataType: 'html',
		 //data: "method=" + method,
		 data : {'method':method},
         success: function(data){
         $('#answer2').html(data);
           },
        });
    });

</script>

<script>
$('#taskfield').on('change', function() {
     var res =  this.value;
	
	$('#task_name').val($('#task_name').val() + ' ' + res);
	 
	});

$('#taskfield2').on('change', function() {
     var res =  this.value;
	
	 $('#task_description').val($('#task_description').val() + ' ' + res);
	 
	});
	
	$('#taskfield3').on('change', function() {
     var res =  this.value;
	
	 $('#notification_text').val($('#notification_text').val() + ' ' + res);
	 
	});
</script>

<script> 
    
	 $('#entity').on('change', function() {
     var res =  this.value;
	 if(res === 'contact'){
		var method = 'crm.contact.fields';
	 }else if(res === 'company'){
		var method = 'crm.company.fields';
	 }
	 $.ajax({
         url: "<?= base_url(route_to('tracking.ajax3')) ?>",
         method: 'get',
        // dataType: 'html',
		 //data: "method=" + method,
		 data : {'method':method},
         success: function(data){
         $('#taskfield, #taskfield2, #taskfield3').html(data);
           },
        });
    });

</script>
<?= $this->endSection() ?>

